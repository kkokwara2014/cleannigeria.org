<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Share;
class SocialShareController extends Controller
{
    public function socialshare($slug){

        $currentURL=URL::current();
        $news=News::where('slug',$slug)->first();

        $socialshares=Share::page($currentURL,$news->title)
        ->facebook()
        ->whatsapp()
        ->telegram()
        ->twitter()
        ->linkedin()
        ->getRawLinks();

       return view('frontend.socialshare.socials',compact('socialshares'));
    }
}
