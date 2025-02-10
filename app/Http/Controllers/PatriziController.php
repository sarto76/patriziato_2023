<?php

namespace App\Http\Controllers;
use App\Models\Patrizio;
use Illuminate\Http\Request;

class PatriziController extends Controller
{
    public function index(){
        $patrizi = Patrizio::query()->orderBy("lastname",'asc')->paginate(30);
        return view('patrizi.index',compact('patrizi'));
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
    public function edit(News $news)
    {
        $news = News::find($news->id);
        return view('news.edit',compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'active' => 'required',
        ]);

        $news = News::find($id);
        $news->update($request->all());

        return redirect()->route('news.edit', $news->id)->with('success','News modificata.');
    }
    public function destroy(News $news)
    {
        $news = News::find($news->id);
        $news->delete();
        return redirect()->route('news.index')->with('success','News eliminata.');
    }
}
