<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\Info;
use App\Models\Member;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::query()->where("active",1)->orderBy("created_at",'desc')->paginate(10);
        $member = Member::query()->paginate(10);
        $estates = Estate::query()->paginate(10);
        return view('home.index')->with('news', $news)->with('member', $member)->with('estates', $estates);
    }


}
