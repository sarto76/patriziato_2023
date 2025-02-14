<?php

namespace App\Http\Controllers;
use App\Models\Patrizio;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PatriziController extends Controller
{
    public function index(){
      /*  $patrizi = Patrizio::query()->orderBy("lastname",'asc')->paginate(30);*/
        return view('patrizi.index');
    }

    public function getPatriziData()
    {
        return DataTables::of(Patrizio::where('living',1)->orderBy('lastname','asc'))->make(true);
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
        $patrizio = Patrizio::find($patrizioId);
        return view('patrizi.edit',compact('patrizio'));
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

        $patrizio->update($request->except('picture'));

        return redirect()->route('patrizi.edit', $patrizio->id)->with('success','Patrizio modificato.');
    }
    public function destroy(News $news)
    {
        $news = News::find($news->id);
        $news->delete();
        return redirect()->route('news.index')->with('success','News eliminata.');
    }
}
