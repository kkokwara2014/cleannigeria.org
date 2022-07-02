<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsmediaController extends Controller
{
    public function events()
    {
        return view('frontend.newsandmedia.events');
    }

    public function news()
    {
        $news = News::where('isapproved','1')->latest()->paginate(5);
        return view('frontend.newsandmedia.news',compact('news'));
    }

    public function show($slug){
        $nw=News::where('slug',$slug)->first();
        return view('frontend.newsandmedia.show',compact('nw'));
    }

    public function newsletter()
    {
        return view('frontend.newsandmedia.newsletter');
    }
    public function mediaresources()
    {
        return view('frontend.newsandmedia.mediares');
    }

    public function file($filename){
        $file = public_path('storage/news_files/'.$filename);
        $name = basename($file);
        return response()->download($file, $name);
    }
}
