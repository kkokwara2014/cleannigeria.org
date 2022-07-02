<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Schedtype;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $schedules=Schedule::where('isapproved','0')->latest()->get();
        $schedules=Schedule::latest()->get();
        return view('admin.schedules.index',array('user'=>Auth::user()),compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $machines=Machine::orderby('name','asc')->get();
        $scheduletypes=Schedtype::orderby('name','asc')->get();

        return view('admin.schedules.create',array('user'=>Auth::user()),compact('machines','scheduletypes'));
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
            'machine_id'=>'required|integer',
            'schedtype_id'=>'required|integer',
            'nextmaintperiod'=>'required',
        ]);
        
            $schedule=new Schedule;
            $schedule->uniquenumb=rand(78906,54321);
            $schedule->user_id=Auth::user()->id;
            $schedule->machine_id=$request->machine_id;
            $schedule->schedtype_id=$request->schedtype_id;
            $schedule->nextmaintperiod=$request->nextmaintperiod;
            $schedule->save();

            return redirect()->route('schedules.index')->with('success','New schedule added successfully!');
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule=Schedule::find($id);
        $approvedby=1;
        // $approvedby=Scheduleapproval::where('schedule_id',$schedule->id)->first();
        
        return view('admin.schedules.show',array('user'=>Auth::user()),compact('schedule','approvedby'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule=Schedule::find($id);
        $machines=Machine::orderby('name','asc')->get();
        $scheduletypes=Schedtype::orderby('name','asc')->get();

        return view('admin.schedules.edit',array('user'=>Auth::user()),compact('schedule','machines','scheduletypes'));
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
        $this->validate($request,[
            'machine_id'=>'required|integer',
            'schedtype_id'=>'required|integer',
            'nextmaintperiod'=>'required',
        ]);
        
            $schedule=Schedule::find($id);
            $schedule->machine_id=$request->machine_id;
            $schedule->schedtype_id=$request->schedtype_id;
            $schedule->nextmaintperiod=$request->nextmaintperiod;
            $schedule->save();

            return redirect()->route('schedules.index')->with('success','Schedule with ref #'.$schedule->uniquenumb.' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule=Schedule::find($id);
        $schedule->delete();

        return redirect()->back()->with('deleted', $schedule->uniquenumb.' deleted successfully! ');
    }

    public function confirm($id){
        $schedule=Schedule::find($id);
        $schedule->isapproved='1';
        $schedule->save();

        //saving the approver and schedule details
        // $approvedby=new Scheduleapproval();
        // $approvedby->user_id=Auth::user()->id;
        // $approvedby->schedule_id=$schedule->id;
        // $approvedby->save();

        //notifying applicant of the approval
        // $schedule->user->notify(new PeriodicScheduleApprovalNotification($schedule));

        return redirect()->back();
    }
}
