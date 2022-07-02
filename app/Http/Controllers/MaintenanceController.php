<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Srequipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenances = Maintenance::latest()->get();
        $engineers=User::orderBy('email','asc')->get();

        return view('admin.maintenance.index', array('user' => Auth::user()), compact('maintenances','engineers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $srequipments = Srequipment::orderBy('name','asc')->where('isapproved','1')->get();
        $engineers=User::orderBy('email','asc')->get();

        return view('admin.maintenance.create', array('user' => Auth::user()), compact('srequipments','engineers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maint=new Maintenance;
        $maint->srequipment_id=$request->srequipment_id;
        $maint->user_id=$request->user_id;
        $maint->maintcycle=$request->maintcycle;
        $maint->lastmaintdate=$request->lastmaintdate;
        $maint->nextmaintdate=$request->nextmaintdate;
        $maint->activitydescription=$request->activitydescription;
        $maint->sparesrequired=$request->sparesrequired;

        $maint->save();

        //notify CNA email center
        $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new SreMaintainNotification($maint));

        return redirect()->route('maintenance.index')->with('success','Maintenance logged successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        $maint=Maintenance::find($maintenance->id);
        // $approvedby=Mapproval::where('maintenance_id',$maintenance->id)->first();
        // $confirmedby=Mconfirm::where('maintenance_id',$maintenance->id)->first();

        return view('admin.maintenance.show', array('user' => Auth::user()), compact('maint','approvedby','confirmedby'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        $maint=Maintenance::where('id',$maintenance->id)->first();
        $srequipments = Srequipment::orderBy('name','asc')->where('isapproved','1')->get();
        return view('admin.maintenance.edit', array('user' => Auth::user()), compact('maint','srequipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $maint=Maintenance::find($maintenance->id);
        $maint->srequipment_id=$request->srequipment_id;
        $maint->user_id=$request->user_id;
        $maint->maintcycle=$request->maintcycle;
        $maint->lastmaintdate=$request->lastmaintdate;
        $maint->nextmaintdate=$request->nextmaintdate;
        $maint->activitydescription=$request->activitydescription;
        $maint->sparesrequired=$request->sparesrequired;

        $maint->save();

        //notify CNA email center
        // $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new SreMaintainNotification($maint));

        return redirect()->route('maintenance.index')->with('success','Maintenance log updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->back()->with('deleted','Maintenance Detail deleted successfully!');
    }

    public function approve($id){
        $maintenance=Maintenance::find($id);
        $maintenance->isapproved='1';
        $maintenance->save();

        //saving the maintenance approval details
        // $mapproval=new Mapproval;
        // $mapproval->user_id=Auth::user()->id;
        // $mapproval->maintenance_id=$maintenance->id;
        // $mapproval->save();

        //for notification

        return redirect()->back();
    }
    public function confirm($id){
        $maintenance=Maintenance::find($id);
        $maintenance->isconfirmed='1';
        $maintenance->save();

        //saving the maintenance confirm details
        // $mconfirm=new Mconfirm;
        // $mconfirm->user_id=Auth::user()->id;
        // $mconfirm->maintenance_id=$maintenance->id;
        // $mconfirm->save();

        //for notification

        return redirect()->back();
    }
}
