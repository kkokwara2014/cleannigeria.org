<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessDeniedController extends Controller
{
    public function index(){
        return view('admin.unauthorized.accessdenied',array('user'=>Auth::user()));
    }
}
