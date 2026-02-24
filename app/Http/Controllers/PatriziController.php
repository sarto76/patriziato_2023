<?php

namespace App\Http\Controllers;
use App\Models\ExternPerson;
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
        return DataTables::of(Patrizio::query())

            /* ===========================
               COLONNE PADRE E MADRE
            =========================== */
            ->addColumn('mother', function ($patrizio) {
                if (!$patrizio->relationMother) return '';

                if ($patrizio->relationMother->patrizio1_id) {
                    $mother = $patrizio->relationMother->motherPatrizio;
                } else {
                    $mother = $patrizio->relationMother->motherExtern;
                }

                return $mother ? $mother->firstname . ' ' . $mother->lastname : '';
            })
            ->addColumn('father', function ($patrizio) {
                if (!$patrizio->relationFather) return '';

                if ($patrizio->relationFather->patrizio1_id) {
                    $father = $patrizio->relationFather->fatherPatrizio;
                } else {
                    $father = $patrizio->relationFather->fatherExtern;
                }

                return $father ? $father->firstname . ' ' . $father->lastname : '';
            })

            /* ===========================
               FILTRO MADRE
            =========================== */
            ->filterColumn('mother', function ($query, $keyword) {
                $query->whereIn('id', function ($subquery) use ($keyword) {
                    $subquery->select('relations.patrizio2_id')
                        ->from('relations')
                        ->leftJoin('patrizi as mothers', 'relations.patrizio1_id', '=', 'mothers.id')
                        ->leftJoin('extern_persons as extern_mothers', 'relations.extern_person_id', '=', 'extern_mothers.id')
                        ->where('relations.type', 'mother')
                        ->where(function ($q) use ($keyword) {
                            $q->where('mothers.firstname', 'like', "%$keyword%")
                                ->orWhere('mothers.lastname', 'like', "%$keyword%")
                                ->orWhere('extern_mothers.fullname', 'like', "%$keyword%");
                        });
                });
            })

            /* ===========================
               FILTRO PADRE
            =========================== */
            ->filterColumn('father', function ($query, $keyword) {
                $query->whereIn('id', function ($subquery) use ($keyword) {
                    $subquery->select('relations.patrizio2_id')
                        ->from('relations')
                        ->leftJoin('patrizi as fathers', 'relations.patrizio1_id', '=', 'fathers.id')
                        ->leftJoin('extern_persons as extern_fathers', 'relations.extern_person_id', '=', 'extern_fathers.id')
                        ->where('relations.type', 'father')
                        ->where(function ($q) use ($keyword) {
                            $q->where('fathers.firstname', 'like', "%$keyword%")
                                ->orWhere('fathers.lastname', 'like', "%$keyword%")
                                ->orWhere('extern_fathers.fullname', 'like', "%$keyword%");
                        });
                });
            })

            /* ===========================
               ORDINE LATO SERVER
            =========================== */
            ->order(function ($query) {
                $request = request();

                if ($request->has('order')) {
                    $columnIdx = $request->input('order.0.column');
                    $dir = $request->input('order.0.dir', 'asc');

                    // Mappa colonna DataTables → campo DB
                    $columns = [
                        0 => 'register_number',
                        1 => 'firstname',
                        2 => 'lastname',
                        3 => 'birth',
                        4 => 'living',
                        5 => null, // padre virtuale
                        6 => null, // madre virtuale
                        7 => 'death',
                        8 => 'patriziato_lost',
                        9 => 'phone',
                        10 => 'email',
                        11 => 'street',
                        12 => 'zip',
                        13 => 'city',
                        14 => 'picture',
                        15 => 'note',
                        16 => 'created_at'
                    ];

                    if (isset($columns[$columnIdx]) && $columns[$columnIdx]) {
                        $query->orderBy($columns[$columnIdx], $dir);
                    }
                }
            })

            ->make(true);
    }

    public function create()
    {
        return view('patrizi.create');
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

        //dd($patrizi->first()->father);


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
        //se la madre è patrizia il checkbox è già checcato, quindi lo associo
        if ($request->has('mother_is_patrizia')) {
            if ($request->filled('mother_id')) {
                DB::table('relations')->updateOrInsert(
                    ['patrizio2_id' => $patrizio->id, 'type' => 'mother'],
                    ['patrizio1_id' => $request->input('mother_id'), 'extern_person_id' => NULL]
                );
            }
        }
        //se la madre non è patrizia, il checkbox non è checcato,
        // quindi elimino l'eventuale associazione e inserisco nome e cogmome della madre non patrizia all'interno
        // della tabella extern_person

        else {

            // 🔹 elimino eventuale persona esterna già associata
            $oldExtern = DB::table('extern_persons')
                ->leftJoin('relations', 'extern_persons.id', '=', 'relations.extern_person_id')
                ->where('relations.patrizio2_id', $patrizio->id)
                ->where('relations.type', 'mother')
                ->select('extern_persons.id')
                ->first();

            DB::table('relations')
                ->where('patrizio2_id', $patrizio->id)
                ->where('type', 'mother')
                ->delete();



            if ($oldExtern) {
                DB::table('extern_persons')->where('id', $oldExtern->id)->delete();
            }

            // 🔹 Creo/aggiorno la persona esterna (nome completo in una colonna)
            $externId = DB::table('extern_persons')->updateOrInsert(
                ['fullname' => $request->input('mother_name')],
                ['updated_at' => now(), 'created_at' => now()]
            );

            // recupero id appena creato/aggiornato
            $extern = DB::table('extern_persons')
                ->where('fullname', $request->input('mother_name'))
                ->first();

            // 🔹 Inserisco la relazione con la persona esterna
            DB::table('relations')->insert([
                'patrizio1_id'     => null,
                'extern_person_id' => $extern->id,
                'patrizio2_id'     => $patrizio->id,
                'type'             => 'mother',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);




        }
        return redirect()->route('patrizi.edit', $patrizio->id)->with('success','Patrizio modificato.');
    }
    public function destroy(Patrizio $patrizio)
    {
        $patrizio = Patrizio::find($patrizio->id);
        $patrizio->delete();
        return redirect()->route('patrizi.index')->with('success','Patrizio eliminato.');
    }
}
