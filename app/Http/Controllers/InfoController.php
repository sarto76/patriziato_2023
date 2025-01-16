<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\Info;
use App\Models\Member;
use App\Models\News;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {

        $info = Info::first();
        return view('info.index',compact('info'));
    }

    public function update(Request $request,$id)
    {

        $request->validate([
            'text' => 'required|max:255',
        ]);

        $news = Info::find($id);
        $news->update($request->only('text'));

        return redirect()->route('info.index')->with('success','Info modificata.');
    }
}
