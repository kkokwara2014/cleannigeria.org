<?php

namespace App\Http\Controllers;

use App\Models\Maintdequipevidence;
use App\Models\Maintdequipment;
use App\Models\Maintschedule;
use App\Models\Srequipment;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintscheduleController extends Controller
{
    public function showscheduleoption(){

        return view('admin.maintschedule.showoption', array('user' => Auth::user()));
    }

    public function redirectbasedonoption(Request $request){
        $this->validate($request,[
            'maintoption'=>'required',
        ]);

        $maintoption=$request->maintoption;

        if ($maintoption=='Preventive Maintenance') {
            $generatedcode=rand(21,88).bin2hex(random_bytes(2));
            $srequipments=Srequipment::orderBy('name','asc')->get();
            return view('admin.maintschedule.create', array('user' => Auth::user()), compact('srequipments','generatedcode','maintoption'));
        } else {
            $generatedcode=rand(40,97).bin2hex(random_bytes(2));
            $srequipments=Srequipment::orderBy('name','asc')->get();
            $vendors=Vendor::orderBy('vendorname','asc')->get();
            $senttos=User::where('id','5')->orWhere('id','7')->orderBy('firstname','asc')->get();
            
            return view('admin.maintschedule.workorder.createworkorder', array('user' => Auth::user()), compact('srequipments','generatedcode','maintoption','vendors','senttos'));
        }
        
        // return view('admin.maintschedule.selectmainttype', array('user' => Auth::user()));
    }

    public function createschedule(Request $request){

        $maintenaceType = $request->mainttype;

        $generatedcode=rand(21,88).bin2hex(random_bytes(2));
        $srequipments=Srequipment::orderBy('name','asc')->get();
        return view('admin.maintschedule.create', array('user' => Auth::user()), compact('srequipments','generatedcode','maintenaceType'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $srequipments=Srequipment::orderBy('name','asc')->get();

        $maintschedules=Maintschedule::latest()->get();

        foreach ($maintschedules as $maintsch) {
            if($maintsch->duedateformaint==date('d/m/Y')){
                $maintschedule=Maintschedule::where('id',$maintsch->id)->first();
                $maintschedule->ismaintained='0';
                $maintschedule->save();

                //send email to the scheduler
            }
        }

        return view('admin.maintschedule.index', array('user' => Auth::user()), compact('srequipments','maintschedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generatedcode=rand(21,88).bin2hex(random_bytes(2));

        $srequipments=Srequipment::orderBy('name','asc')->get();
        return view('admin.maintschedule.create', array('user' => Auth::user()), compact('srequipments','generatedcode'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingequipment=Maintschedule::where('srequipment_id',$request->srequipment_id)->where('ismaintained','0')->first();

        if ($existingequipment=== null) {
            $maintschedule=new Maintschedule;
            $maintschedule->schedulecode=$request->schedulecode;
            $maintschedule->srequipment_id=$request->srequipment_id;
            $maintschedule->maintcycle=$request->maintcycle;
            $maintschedule->duedateformaint=$request->duedateformaint;
            $maintschedule->user_id=auth()->user()->id;
            $maintschedule->mainttype=$request->mainttype;
            $maintschedule->comment=$request->comment;
            $maintschedule->save();
    
            return redirect()->route('maintenanceschedule.index')->with('success','New Maintenance Schedule created successfully!');
        } else {
            return redirect()->back()->with('deleted','The Equipment you selected has already been scheduled and yet to be maintained! Please, select another Equipment to Schedule.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintschedule=Maintschedule::find($id);
        $maintdequipments=Maintdequipment::where('maintschedule_id',$id)->latest()->simplePaginate(5);

        foreach ($maintdequipments as $maintdequip) {
            $morefiles=Maintdequipevidence::where('maintdequipment_id',$maintdequip->id)->latest()->get();
        }

        return view('admin.maintschedule.show', array('user' => Auth::user()), compact('maintschedule','maintdequipments','morefiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $srequipments=Srequipment::orderBy('name','asc')->get();
        $maintschedule=Maintschedule::where('id',$id)->first();
        return view('admin.maintschedule.edit', array('user' => Auth::user()), compact('maintschedule','srequipments'));
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
        $maintschedule=Maintschedule::find($id);
        $maintschedule->schedulecode=$request->schedulecode;
        $maintschedule->srequipment_id=$request->srequipment_id;
        $maintschedule->maintcycle=$request->maintcycle;
        $maintschedule->duedateformaint=$request->duedateformaint;
        $maintschedule->user_id=auth()->user()->id;
        $maintschedule->save();

        return redirect()->route('maintenanceschedule.index')->with('success','Maintenance Schedule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintschedule=Maintschedule::find($id);
        $maintschedule->delete();

        return redirect()->back()->with('deleted','Maintenance Schedule deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addmaintdequpment($id)
    {
        $maintschedule=Maintschedule::where('id',$id)->first();
        $receivingstaffs=User::where('id',5)->orWhere('id',7)->orderBy('firstname','asc')->get();
        return view('admin.maintschedule.createmaintdequip', array('user' => Auth::user()), compact('maintschedule','receivingstaffs'));
    }
}
