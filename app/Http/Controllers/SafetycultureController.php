<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SafetycultureController extends Controller
{
    public function policies()
    {
        return view('frontend.safetyculture.policies');
    }
}
