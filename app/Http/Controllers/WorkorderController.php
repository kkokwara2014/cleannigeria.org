<?php

namespace App\Http\Controllers;

use App\Models\Srequipment;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Workorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workorders=Workorder::latest()->get();
        return view('admin.maintschedule.workorder.index', array('user' => Auth::user()), compact('workorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'srequipment_id'=>'required|integer',
            'vendor_id'=>'required|integer',
            'sentto_id'=>'required|integer',
            'amount'=>'required',
            'duedateformaint'=>'required',
            'description'=>'required|string',
        ]);

        $workorder= new Workorder();
        $workorder->uniquecode=$request->uniquecode;
        $workorder->srequipment_id=$request->srequipment_id;
        $workorder->vendor_id=$request->vendor_id;
        $workorder->amount=$request->amount;
        $workorder->duedateformaint=$request->duedateformaint;
        $workorder->description=$request->description;
        $workorder->sentto_id=$request->sentto_id;
        $workorder->maintoption=$request->maintoption;
        $workorder->user_id=auth()->user()->id;
        $workorder->save();

        //send email to First Approver
        $recipient=User::where('role_id','1')->orWhere('id',$workorder->sentto_id)->orWhere('id',)->first();
        // Mail::to($recipient->email)->send(new WorkorderCreatedMail($workorder));

        return redirect()->route('workorder.index')->with('success','Work Order with number '.$workorder->uniquecode.' has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workorder=Workorder::where('id',$id)->first();
        $approver=User::where('id',$workorder->sentto_id)->first();
        $finalapprover=User::where('role_id','1')->first();
        return view('admin.maintschedule.workorder.show', array('user' => Auth::user()), compact('workorder','approver','finalapprover'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workorder=Workorder::where('id',$id)->first();
        $srequipments=Srequipment::orderBy('name','asc')->get();
        $vendors=Vendor::orderBy('vendorname','asc')->get();
        $senttos=User::where('id','5')->orWhere('id','7')->orderBy('firstname','asc')->get();
        return view('admin.maintschedule.workorder.edit', array('user' => Auth::user()), compact('workorder','srequipments','vendors','senttos'));
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
            'srequipment_id'=>'required|integer',
            'vendor_id'=>'required|integer',
            'amount'=>'required',
            'duedateformaint'=>'required',
            'description'=>'required|string',
        ]);

        $workorder= Workorder::find($id);
        // $workorder->uniquecode=$request->uniquecode;
        $workorder->srequipment_id=$request->srequipment_id;
        $workorder->vendor_id=$request->vendor_id;
        $workorder->amount=$request->amount;
        $workorder->duedateformaint=$request->duedateformaint;
        $workorder->description=$request->description;
        $workorder->sentto_id=$request->sentto_id;
        $workorder->maintoption=$request->maintoption;
        $workorder->user_id=auth()->user()->id;
        $workorder->save();

        return redirect()->route('workorder.index')->with('success','Work Order with number '.$workorder->uniquecode.' has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workorder=Workorder::find($id);
        $workorder->delete();

        return redirect()->back()->with('deleted','Work Order with number '.$workorder->uniquecode.' has been deleted successfully!');
    }

    public function givefirstapproval(Request $request, $id){
        
        $workorder=Workorder::find($id);
        $workorder->firstapprover=Auth::user()->firstname.' '.Auth::user()->lastname;
        $workorder->firstapproveddate=date('Y-m-d H:i:s');
        $workorder->firstapprovercomment=$request->firstapprovercomment;
        $workorder->isapproved1='1';
        $workorder->save();

        //send email to GM
        $recipient=User::where('role_id','1')->orWhere('role_id','2')->first();
        // Mail::to($recipient->email)->send(new WorkorderApprovalMail($workorder));


        //send email to interest parties about first approval


        return redirect()->back()->with('success','Work Order with number '.$workorder->uniquecode.' has been given first approval!');
    }

    public function givefinalapproval(Request $request, $id){
        
        $workorder=Workorder::find($id);
        $workorder->secondapprover=Auth::user()->firstname.' '.Auth::user()->lastname;
        $workorder->secondapproveddate=date('Y-m-d H:i:s');
        $workorder->secondapprovercomment=$request->secondapprovercomment;
        $workorder->isapproved2='1';
        $workorder->save();

        //send email to GM
        $recipient=User::where('role_id','1')->orWhere('role_id','2')->first();
        // Mail::to($recipient->email)->send(new WorkorderApprovalMail($workorder));

        //send email to interest parties about final approval


        return redirect()->back()->with('success','Work Order with number '.$workorder->uniquecode.' has been given final approval!');
    }

    public function printworkorder($id){

        $workorder=Workorder::find($id);
        $approver=User::where('id',$workorder->sentto_id)->first();
        $finalapprover=User::where('role_id','1')->first();
        return view('admin.maintschedule.workorder.print',array('user'=>Auth::user()),compact(
            'workorder',
            'approver',
            'finalapprover'
            ));
    }
}
