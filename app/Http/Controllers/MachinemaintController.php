<?php

namespace App\Http\Controllers;

use App\Models\Machinemaint;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachinemaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machinemaints=Machinemaint::latest()->get();
        return view('admin.machinemaints.index',array('user'=>Auth::user()),compact('machinemaints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules=Schedule::where('isapproved','1')->get();
        return view('admin.machinemaints.create',array('user'=>Auth::user()),compact('schedules'));
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
            'schedule_id'=>'required|integer',
            'startdate'=>'required',
            'enddate'=>'required',
            'actiontaken'=>'required',
            'recommendation'=>'required',
        ]);

        $machinemaint=new Machinemaint;
        $machinemaint->uniquenumb=rand(90786,12345);
        $machinemaint->user_id=Auth::user()->id;
        $machinemaint->schedule_id=$request->schedule_id;
        $machinemaint->startdate=$request->startdate;
        $machinemaint->enddate=$request->enddate;
        $machinemaint->actiontaken=$request->actiontaken;
        $machinemaint->recommendation=$request->recommendation;
        $machinemaint->ismaintained='1';
        $machinemaint->save();

        //updating the schedule record
        $schedule=Schedule::where('machine_id',$machinemaint->schedule->machine->id)->first();
        $schedule->ismaintained='1';
        $schedule->save();

        return redirect()->route('machinemaints.index')->with('success','New Machine Maintenance record added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $machinemaint=Machinemaint::find($id);
        $approvedby=Maintapproval::where('machinemaint_id',$machinemaint->id)->first();
        return view('admin.machinemaints.show',array('user'=>Auth::user()),compact('machinemaint','approvedby'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $machinemaint=Machinemaint::find($id);
        $machinemaint->delete();

        return redirect()->back()->with('deleted','Maintained machine with ref #'.$machinemaint->uniquenumb.' deleted successfully! ');
    }

    public function confirm($id){
        $machinemaint=Machinemaint::find($id);
        $machinemaint->isapproved='1';
        $machinemaint->save();

        //saving the approver and schedule details
        // $approvedby=new Maintapproval();
        // $approvedby->user_id=Auth::user()->id;
        // $approvedby->machinemaint_id=$machinemaint->id;
        // $approvedby->save();

        //notifying applicant of the approval
        // $machinemaint->user->notify(new MachinemaintApprovalNotification($machinemaint));

        return redirect()->back();
    }

}
