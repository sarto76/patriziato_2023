<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\Info;
use App\Models\Link;
use App\Models\Component;
use App\Models\News;
use App\Models\Documents;
use App\Models\Property;


class HomeController extends Controller
{
    public function index()
    {
        $news = News::query()->where("active",1)->orderBy("created_at",'desc')->paginate(3);
        $component = Component::query()->paginate(10);
        $estates = Estate::query()->paginate(10);
        $info = Info::first();
        $documents = Documents::query()->orderBy("created_at",'desc')->get();
        $properties = Property::query()->orderBy("created_at",'desc')->get();
        $links = Link::query()->orderBy("created_at",'desc')->get();
        return view('home.index')->with('news', $news)->with('member', $component)->with('estates', $estates)->with('info', $info)
            ->with('documents', $documents)
            ->with('properties', $properties)
            ->with('links', $links);
    }


}
