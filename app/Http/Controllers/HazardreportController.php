<?php

namespace App\Http\Controllers;

use App\Models\Actiontracking;
use App\Models\Hazardreport;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HazardreportController extends Controller
{

    public $receivingstaff;
    public function __construct(){
        $this->receivingstaff=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'General Manager')
                ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'East Regional Superintendent')
                ->orWhere('name', '=', 'West Regional Superintendent')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations=Location::where('isapproved','1')->where('id','>','1')->orderBy('name','asc')->get();
        $hazards=Hazardreport::latest()->get();
        $actiontrackings=Actiontracking::latest()->get();
               
        return view('admin.hazards.index',array('user'=>Auth::user()),compact('locations','hazards','actiontrackings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $senttos=$this->receivingstaff;
        $locations=Location::where('isapproved','1')->where('id','>','1')->orderBy('name','asc')->get();
        return view('admin.hazards.create',array('user'=>Auth::user()),compact('locations','senttos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $hreport=new Hazardreport;
        $hreport->uniquenum='CNA-QHSE-'.rand(250099,876599);
        $hreport->unsafeact=$request->unsafeact;
        $hreport->unsafecondition=$request->unsafecondition;
        $hreport->nearmiss=$request->nearmiss;
        $hreport->description=$request->description;
        $hreport->correctiveaction=$request->correctiveaction;
        $hreport->furtheraction=$request->furtheraction;
        $hreport->riskcategory=$request->riskcategory;
        $hreport->dateofoccurence=$request->dateofoccurence;
        $hreport->timeofoccurence=$request->timeofoccurence;
        $hreport->dateofreporting=$request->dateofreporting;
        $hreport->timeofreporting=$request->timeofreporting;
        $hreport->location_id=$request->location_id;
        $hreport->user_id=auth()->user()->id;
        $hreport->sentto_id=$request->sentto_id;
        $hreport->save();

        //notify the staff in charge
        $receipient=User::find($hreport->sentto_id);
        // $receipient->notify(new HazardreportNotification($hreport));


        //notify via SMS
        SMSController::sendHazardReportToStaffSMS($hreport);
        SMSController::sendHazardReportToApproverSMS($hreport);

        return redirect()->route('hazardreports.index')->with('success','New incident report submitted!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hazardreport  $hazardreport
     * @return \Illuminate\Http\Response
     */
    public function show(Hazardreport $hazardreport)
    {
        $hreport = Hazardreport::find($hazardreport->id);
        $senttos=$this->receivingstaff;
        $locations=Location::where('isapproved','1')->where('id','>','1')->orderBy('name','asc')->get();
        return view('admin.hazards.track', array('user' => Auth::user()), compact('hreport','senttos','locations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hazardreport  $hazardreport
     * @return \Illuminate\Http\Response
     */
    public function edit(Hazardreport $hazardreport)
    {
        $hreport = Hazardreport::where('id',$hazardreport->id)->first();
        $senttos=$this->receivingstaff;
        $locations=Location::where('isapproved','1')->where('id','>','1')->orderBy('name','asc')->get();
        return view('admin.hazards.edit', array('user' => Auth::user()), compact('hreport','senttos','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hazardreport  $hazardreport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hazardreport $hazardreport)
    {
        
        $hreport=Hazardreport::find($hazardreport->id);
        $hreport->unsafeact=$request->unsafeact;
        $hreport->unsafecondition=$request->unsafecondition;
        $hreport->nearmiss=$request->nearmiss;
        $hreport->description=$request->description;
        $hreport->correctiveaction=$request->correctiveaction;
        $hreport->furtheraction=$request->furtheraction;
        $hreport->riskcategory=$request->riskcategory;
        $hreport->dateofoccurence=$request->dateofoccurence;
        $hreport->timeofoccurence=$request->timeofoccurence;
        $hreport->dateofreporting=$request->dateofreporting;
        $hreport->timeofreporting=$request->timeofreporting;
        $hreport->location_id=$request->location_id;
        $hreport->user_id=auth()->user()->id;
        $hreport->sentto_id=$request->sentto_id;
        $hreport->save();
        //notify the staff in charge

        return redirect()->route('hazardreports.index')->with('success','Incident report updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hazardreport  $hazardreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hazardreport $hazardreport)
    {
        $hazardreport->delete();
        return redirect()->back()->with('deleted','Hazard Report deleted successfully!');
    }

    public function closereport($id){
        $hazard=Hazardreport::find($id);
        $hazard->isclosed='1';
        $hazard->save();

        return back()->with('success','Hazard Report closed successfully!');

    }
}
