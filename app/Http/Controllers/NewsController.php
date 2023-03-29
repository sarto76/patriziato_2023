<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = News::query()->where("active",1)->orderBy("created_at",'desc')->paginate(10);
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

        return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }
}
