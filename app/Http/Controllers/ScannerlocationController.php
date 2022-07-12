<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Scannerlocation;

class ScannerlocationController extends Controller
{
   
    public function index()
    {
        $locations = Scannerlocation::all();
        $companies = Company::all();
        $user = Auth::user();

        return view('admin.biometric.locations', compact('user','locations', 'companies'));
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), ['company_id'=>'required|numeric', 'name'=>'required|string']);
        if($validate->fails()){
            
            return back()->with('errors',$validate->errors());

        }

        $location = Scannerlocation::create($request->all());

        return redirect()->back()->withSuccess('Location have been saved');

    }

    
    public function show(Scannerlocation $scannerlocation)
    {
        //
    }

   
    public function edit(Scannerlocation $scannerlocation)
    {
        //
    }

    
    public function update(Request $request, Scannerlocation $scannerlocation)
    {
        //
    }


    public function destroy($scannerlocation)
    {
        $Scannerlocation = Scannerlocation::whereId($scannerlocation)->delete();

        return redirect()->back()->withDeleted('Location have been deleted.');

    }
}
