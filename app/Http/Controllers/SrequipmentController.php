<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Itemunit;
use App\Models\Location;
use App\Models\Srequipment;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class SrequipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipnumb=rand(234567, 994559);
        $categories=Category::orderBy('name','asc')->where('isapproved','1')->get();
        $stores=Store::orderBy('name','asc')->where('isapproved','1')->get();
        $itemunits=Itemunit::orderBy('name','asc')->get();
        $suppliers=Supplier::orderBy('name','asc')->where('isapproved','1')->get();
        $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();

        return view('admin.srequipment.create',array('user'=>Auth::user()),compact('categories','stores','itemunits','suppliers','locations','equipnumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $srequipment=new Srequipment;
        $srequipment->refnumb=$request->refnumb;
        $srequipment->name=$request->name;
        $srequipment->slug=Str::slug($request->name).'-'.$request->refnumb;
        $srequipment->matricnumb=$request->matricnumb;
        $srequipment->serialnumb=$request->serialnumb;
        $srequipment->modelnumb=$request->modelnumb;
        $srequipment->manufacdate=$request->manufacdate;
        $srequipment->qty=$request->qty;
        $srequipment->description=$request->description;
        $srequipment->remarks=$request->remarks;
        $srequipment->status=$request->status;
        $srequipment->store_id=$request->store_id;
        $srequipment->category_id=$request->category_id;
        $srequipment->itemunit_id=$request->itemunit_id;
        $srequipment->user_id=$request->user_id;
        $srequipment->supplier_id=$request->supplier_id;
        $srequipment->save();

        //notifying CNA Email center
        // $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new NewEquipmentNotification($srequipment));


        return redirect()->route('equipment')->with('success','New SR Equipment added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
            $srequipments = Srequipment::where('slug',$slug)->first();
            
            $categories=Category::orderBy('name','asc')->where('isapproved','1')->get();
            $stores=Store::orderBy('name','asc')->where('isapproved','1')->get();
            $itemunits=Itemunit::orderBy('name','asc')->get();
            $suppliers=Supplier::orderBy('name','asc')->where('isapproved','1')->get();

            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();

            return view('admin.srequipment.show', array('user' => Auth::user()), compact('srequipments','categories','stores','itemunits','suppliers','locations'));

            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Srequipment  $srequipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Srequipment $srequipment)
    {
            $equipment = Srequipment::where('id',$srequipment->id)->first();
            $categories=Category::orderBy('name','asc')->where('isapproved','1')->get();
            $stores=Store::orderBy('name','asc')->where('isapproved','1')->get();
            $itemunits=Itemunit::orderBy('name','asc')->get();
            $suppliers=Supplier::orderBy('name','asc')->where('isapproved','1')->get();
            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();

            return view('admin.srequipment.edit', array('user' => Auth::user()), compact('equipment','categories','stores','itemunits','suppliers','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Srequipment  $srequipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Srequipment $srequipment)
    {

        $srequipment=Srequipment::find($srequipment->id);
        $srequipment->refnumb=$request->refnumb;
        $srequipment->name=$request->name;
        $srequipment->matricnumb=$request->matricnumb;
        $srequipment->serialnumb=$request->serialnumb;
        $srequipment->modelnumb=$request->modelnumb;
        $srequipment->manufacdate=$request->manufacdate;
        $srequipment->qty=$request->qty;
        $srequipment->description=$request->description;
        $srequipment->remarks=$request->remarks;
        $srequipment->status=$request->status;
        $srequipment->store_id=$request->store_id;
        $srequipment->category_id=$request->category_id;
        $srequipment->itemunit_id=$request->itemunit_id;
        $srequipment->user_id=$request->user_id;
        $srequipment->supplier_id=$request->supplier_id;

        if ($srequipment->slug!=$srequipment->slug) {
            $srequipment->slug=Str::slug($request->slug);
        }

        $srequipment->save();


        return redirect()->back()->with('success','SR Equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Srequipment  $srequipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Srequipment $srequipment)
    {
        $srequipment->delete();

        return redirect()->back()->with('deleted','SR Equipment deleted successfully!');
    }


    public function srequipments($type = '')
    {
        if ($type == 'unapproved') {
            $srequipments = Srequipment::where('isapproved', '0')->where('qty','>','0')->latest()->get();
            $categories=Category::orderBy('name','asc')->where('isapproved','1')->get();
            $stores=Store::orderBy('name','asc')->where('isapproved','1')->get();
            $itemunits=Itemunit::orderBy('name','asc')->get();
            $suppliers=Supplier::orderBy('name','asc')->where('isapproved','1')->get();
            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();


        } elseif ($type == 'approved') {
            $srequipments = Srequipment::where('isapproved', '1')->where('qty','>','0')->latest()->get();
            $categories=Category::orderBy('name','asc')->where('isapproved','1')->get();
            $stores=Store::orderBy('name','asc')->where('isapproved','1')->get();
            $itemunits=Itemunit::orderBy('name','asc')->get();
            $suppliers=Supplier::orderBy('name','asc')->where('isapproved','1')->get();
            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();


        } else {
            $srequipments = Srequipment::latest()->where('qty','>','0')->get();
            $categories=Category::orderBy('name','asc')->where('isapproved','1')->get();
            $stores=Store::orderBy('name','asc')->where('isapproved','1')->get();
            $itemunits=Itemunit::orderBy('name','asc')->get();
            $suppliers=Supplier::orderBy('name','asc')->where('isapproved','1')->get();
            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();


        }

        return view('admin.srequipment.index', array('user' => Auth::user()), compact('srequipments','categories','stores','itemunits','suppliers','locations'));
    }


    public function confirm($id){
        $srequipment=Srequipment::find($id);
        $srequipment->isapproved='1';
        $srequipment->save();

        //notify CNA email center
        $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new SreApprovedGeneralNotification($srequipment));

        //private notification
        // $srequipment->user->notify(new SreApprovedPrivateNotification($srequipment));

        return redirect()->back()->with('success','SR Equipment approved successfully');
    }

}
