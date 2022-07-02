<?php

namespace App\Http\Controllers;

use App\Models\Waybill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function printwaybill(Waybill $waybill){
        return view('admin.waybills.print',array('user'=>Auth::user()),compact('waybill'));
    }
}
