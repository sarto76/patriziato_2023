<?php

namespace App\Http\Controllers;
use App\Models\Patrizio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PatriziController extends Controller
{
    public function index(){
      /*  $patrizi = Patrizio::query()->orderBy("lastname",'asc')->paginate(30);*/
        return view('patrizi.index');
    }

    public function getPatriziData()
    {
       //return DataTables::of(Patrizio::where('living',1)->orderBy('lastname','asc'))->make(true);

        return DataTables::of(Patrizio::where('living', 1)->orderBy('lastname', 'asc'))
            ->addColumn('mother', function ($patrizio) {
                $mother = $patrizio->mother;
                return $mother->firstname . ' ' . $mother->lastname;
            })
            ->addColumn('father', function ($patrizio) {
                $father = $patrizio->father;
                return $father->firstname . ' ' . $father->lastname;
            })
            ->filterColumn('mother', function($query, $keyword) {
                $query->whereIn('id', function ($subquery) use ($keyword) {
                    $subquery->select('relations.patrizio2_id')
                        ->from('relations')
                        ->join('patrizi as mothers', 'relations.patrizio1_id', '=', 'mothers.id')
                        ->where('relations.type', 'mother')
                        ->where(function($q) use ($keyword) {
                            $q->where('mothers.firstname', 'like', "%$keyword%")
                                ->orWhere('mothers.lastname', 'like', "%$keyword%");
                        });
                });
            })
            ->filterColumn('father', function($query, $keyword) {
                $query->whereIn('id', function ($subquery) use ($keyword) {
                    $subquery->select('relations.patrizio2_id')
                        ->from('relations')
                        ->join('patrizi as fathers', 'relations.patrizio1_id', '=', 'fathers.id')
                        ->where('relations.type', 'father')
                        ->where(function($q) use ($keyword) {
                            $q->where('fathers.firstname', 'like', "%$keyword%")
                                ->orWhere('fathers.lastname', 'like', "%$keyword%");
                        });
                });
            })
            ->make(true);
    }

    public function create()
    {
        return view('news.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'active' => 'required',
        ], [
            'title.required' => 'Il titolo è obbligatorio.',
            'text.required' => 'Il testo è obbligatorio.',
            'active.required' => 'Lo stato attivo è obbligatorio.',
        ]);


        $news = News::create($request->post());

        return redirect()->route('news.create', $news->id)->with('success','News creata.');
    }
    public function edit($patrizioId)
    {
        //$patrizio = Patrizio::find(477); // Ottieni un modello
        //dd($patrizio->father()->toSql());
        $patrizi = Patrizio::where('living',1)->orderBy('lastname','asc')->get();

        $patrizio = Patrizio::find($patrizioId);

        return view('patrizi.edit', compact('patrizio','patrizi'));
    }

    public function searchPatrizi(Request $request)
    {
        $query = $request->input('q');

        $patrizi = Patrizio::where('firstname', 'like', "%$query%")
            ->orWhere('lastname', 'like', "%$query%")
            ->limit(10)
            ->get();

        return response()->json($patrizi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'register_number' => 'required|numeric',
            'firstname' => 'required',
            'lastname' => 'required',
            'birth' => 'required|date',
            'death' => 'nullable|date',
            'patriziato_lost' => 'nullable|date',
            'zip' => 'nullable|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $patrizio = Patrizio::find($id);

        if ($request->hasFile('picture')) {
            $imageName = time().'.'.$request->picture->extension();
            $filePath = $request->picture->storeAs('images', $imageName, 'public');
            $patrizio->picture = $filePath;
        }

        $patrizio->update($request->except('picture', 'father_id', 'mother_id'));

        // PADRE
        if ($request->filled('father_id')) {
            DB::table('relations')->updateOrInsert(
                ['patrizio2_id' => $patrizio->id, 'type' => 'father'],
                ['patrizio1_id' => $request->input('father_id')]
            );
        } else {
            DB::table('relations')
                ->where('patrizio2_id', $patrizio->id)
                ->where('type', 'father')
                ->delete();
        }

// MADRE
        if ($request->filled('mother_id')) {
            DB::table('relations')->updateOrInsert(
                ['patrizio2_id' => $patrizio->id, 'type' => 'mother'],
                ['patrizio1_id' => $request->input('mother_id')]
            );
        } else {
            DB::table('relations')
                ->where('patrizio2_id', $patrizio->id)
                ->where('type', 'mother')
                ->delete();
        }

        return redirect()->route('patrizi.edit', $patrizio->id)->with('success','Patrizio modificato.');
    }
    public function destroy(News $news)
    {
        $news = News::find($news->id);
        $news->delete();
        return redirect()->route('news.index')->with('success','News eliminata.');
    }
}
