<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Keypersonnel;
use App\Models\Membcompany;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function baseoperation()
    {
        return view('frontend.about.baseoperation');
    }
    public function membercompanies()
    {
        $membcompanies=Membcompany::latest()->paginate(20);
        return view('frontend.about.membercompanies',compact('membcompanies'));
    }
    public function cnaobjectives()
    {
        return view('frontend.about.cnaobjectives');
    }
    public function membership()
    {
        return view('frontend.about.membership');
    }
    public function services()
    {
        $services=Service::orderBy('id','asc')->paginate(10);
        return view('frontend.about.services',compact('services'));
    }
    public function gallery()
    {
        $galleries=Gallery::latest()->paginate(20);
        return view('frontend.about.gallery',compact('galleries'));
    }
    public function keystaff(){
        $keypersonnels=Keypersonnel::orderBy('id','asc')->paginate(10);
        return view('frontend.about.keystaff',compact('keypersonnels'));
    }
}
