<?php

namespace App\Http\Controllers;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(){
        $links = Link::query()->orderBy("created_at",'desc')->paginate(10);
        return view('link.index',compact('links'));
    }

    public function create()
    {
        return view('link.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required|url',
        ], [
            'name.required' => 'Il nome è obbligatorio.',
            'url.required' => 'Il link è obbligatorio.',
            'url.url' => 'Il link deve essere un URL valido (es. http://www.example.com).',
        ]);


        $news = Link::create($request->post());

        return redirect()->route('link.create', $news->id)->with('success','Link creato.');
    }
    public function edit(Link $link)
    {
        $link = Link::find($link->id);
        return view('link.edit',compact('link'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $link = Link::find($id);
        $link->update($request->all());

        return redirect()->route('link.edit', $link->id)->with('success','Link modificato.');
    }
    public function destroy(Link $link)
    {
        $link = Link::find($link->id);
        $link->delete();
        return redirect()->route('link.index')->with('success','Link eliminato.');
    }
}
