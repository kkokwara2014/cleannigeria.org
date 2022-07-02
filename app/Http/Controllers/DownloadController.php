<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    
    public function document($document){
        $file = public_path('downloads/'.$document);
        $name = basename($file);
        return response()->download($file, $name);
    }
}
