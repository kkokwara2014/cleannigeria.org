<?php

namespace App\Http\Controllers;

use App\Models\Multirecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultipleRecordController extends Controller
{
    
    public function multiplerecordform(){
        return view('multiplerecord',array('user'=>Auth::user()));
    }

    public function store(Request $request){
        
        // $inputs=$request->except('_token');
        // $inputs=$request->all();       
       
        foreach ($request->name as $key=> $value) {
           
            $data=array(
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
            );
                        
            Multirecord::create([
                'name'=>$data['name'][$key],
                'email'=>$data['email'][$key],
                'phone'=>$data['phone'][$key],
            ]);
        }
        
        return redirect()->back()->with('success','Records saved successfully!');
    }
}
