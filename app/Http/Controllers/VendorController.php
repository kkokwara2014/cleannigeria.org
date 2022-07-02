<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors=Vendor::latest()->get();
        return view('admin.maintschedule.vendor.index', array('user' => Auth::user()), compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maintschedule.vendor.create', array('user' => Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'vendorname'=>'required',
            'vendorphone'=>'required|unique:vendors',
            'vendoraddress'=>'required',
        ]);

        $vendor = new Vendor;
        $vendor->vendorname=$request->vendorname;
        $vendor->vendorphone=$request->vendorphone;
        $vendor->vendoraddress=$request->vendoraddress;
        $vendor->user_id=auth()->user()->id;
        $vendor->save();

        return redirect()->route('vendors.index')->with('success','New Vendor created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor=Vendor::where('id',$id)->first();
        return view('admin.maintschedule.vendor.edit', array('user' => Auth::user()), compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request,[
        //     'vendorname'=>'required',
        //     'vendorphone'=>'required|unique:vendors',
        //     'vendoraddress'=>'required',
        // ]);

        $vendor=Vendor::find($id);

        if ($vendor->vendorphone==$request->vendorphone) {
           return redirect()->back()->with('deleted','This Phone number has been used in registering a Vendor!');
        } else {
            $vendor->vendorname=$request->vendorname;
            $vendor->vendorphone=$request->vendorphone;
            $vendor->vendoraddress=$request->vendoraddress;
            $vendor->user_id=auth()->user()->id;
            $vendor->save();
    
            return redirect()->route('vendors.index')->with('success','Vendor updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor=Vendor::find($id);
        $vendor->delete();

        return redirect()->back()->with('deleted','Vendor deleted successfully!');
    }
}
