<?php

namespace App\Http\Controllers;

use App\Models\Replenish;
use App\Models\Srequipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplenishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs=User::where('role_id','<','3')->orderBy('id','asc')->get();
        $srequipments=Srequipment::orderBy('name','asc')->where('qty','>','0')->get();

        $replenishes=Replenish::latest()->get();

        return view('admin.replenish.index', array('user' => Auth::user()), compact('srequipments','replenishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $srequipments=Srequipment::orderBy('name','asc')->where('qty','>=','0')->get();

        // return view('admin.replenish.create', array('user' => Auth::user()), compact('srequipments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $srequipment=Srequipment::where('id',$request->srequipment_id)->first();

        if ($request->qty<=0) {
            return redirect()->back()->with('msg','Quantity should be greater than '.$srequipment->qty);
        }

        //updating the equipment
        $equipment_balance=$srequipment->qty + $request->qty;
        $srequip_update=Srequipment::find($request->srequipment_id);
        $srequip_update->qty=$equipment_balance;
        $srequip_update->save();

        //scrapping equipment
        $replenish=new Replenish;
        $replenish->user_id=$request->user_id;
        $replenish->srequipment_id=$request->srequipment_id;
        $replenish->qty=$request->qty;
        $replenish->save();

        //notify CNA email center
        // $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new ReplenishedNotification($replenish));


        //notifying the GM
        // $gm=User::where('role_id','2')->first();
        // $gm->notify(new ReplenishedNotification($replenish));

        return redirect()->route('replenish.index')->with('success','SREquipment replenished successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Replenish  $replenish
     * @return \Illuminate\Http\Response
     */
    public function show(Replenish $replenish)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Replenish  $replenish
     * @return \Illuminate\Http\Response
     */
    public function edit(Replenish $replenish)
    {
        $srequipments=Srequipment::orderBy('name','asc')->get();
        $replenishes = Replenish::where('id', $replenish->id)->first();
        return view('admin.replenish.edit', array('user' => Auth::user()), compact('replenishes','srequipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Replenish  $replenish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replenish $replenish)
    {
        $srequipment=Srequipment::where('id',$request->srequipment_id)->first();

        if ($request->qty<=0) {
            return redirect()->back()->with('msg','Quantity should be greater than '.$srequipment->qty);
        }

        //updating the equipment
        $equipment_balance=$srequipment->qty + $request->qty;
        $srequip_update=Srequipment::find($request->srequipment_id);
        $srequip_update->qty=$equipment_balance;
        $srequip_update->save();

        //replenishing equipment
        $replenish=Replenish::find($replenish->id);
        $replenish->user_id=$request->user_id;
        $replenish->srequipment_id=$request->srequipment_id;
        $replenish->qty=$request->qty;
        $replenish->save();



        return redirect()->route('replenish.index')->with('success','SREquipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Replenish  $replenish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replenish $replenish)
    {
        $srequipment=Srequipment::where('id',$replenish->srequipment_id)->first();

        //updating the equipment
        $equipment_balance=$srequipment->qty - $replenish->qty;
        $srequip_update=Srequipment::find($replenish->srequipment_id);
        $srequip_update->qty=$equipment_balance;
        $srequip_update->save();

        //deleting the replenishment
        $replenish->delete();

        return redirect()->back()->with('deleted','Replenished Equipment deleted successfully!');
    }

    public function approve($id){
        $replenish=Replenish::find($id);
        $replenish->isapproved='1';
        $replenish->save();

        //saving the replenish approval details
        // $repapproval=new Repapproval;
        // $repapproval->user_id=Auth::user()->id;
        // $repapproval->replenish_id=$replenish->id;
        // $repapproval->save();

        //for notification

        return redirect()->back();
    }
}
