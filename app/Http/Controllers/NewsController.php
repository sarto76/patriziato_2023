<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = News::query()->orderBy("created_at",'desc')->paginate(10);
        return view('news.index',compact('news'));
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
        ]);


        News::create($request->post());

        return redirect()->route('news.index')->with('success','News creata.');
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

        return redirect()->route('news.index')->with('success','News modificata.');
    }
    public function destroy(News $news)
    {
        $news = News::find($news->id);
        $news->delete();
        return redirect()->route('news.index')->with('success','News eliminata.');
    }
}
