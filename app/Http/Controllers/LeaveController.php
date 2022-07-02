<?php

namespace App\Http\Controllers;

use App\Events\LeaveEvent;
use App\Http\Requests\LeaveStoreRequest;
use App\Http\Requests\LeaveUpdateRequest;
use App\Models\Leave;
use App\Models\Leavetype;
use App\Mail\ApprovedLeaveMail;
use App\Models\Approvedleave;
use App\Notifications\LeaveAppliedNotification;
use App\Notifications\LeaveApprovedNotification;
use App\Notifications\LeaveForApprovalNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LeaveController extends Controller
{
    public $leaveApprovers;
    public function __construct(){
        $this->middleware('auth');

        $this->leaveApprovers=User::with(['roles'])->whereHas('roles', function($query) {
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
     * @see Approvers
     */
    // public static function leaveApprovers(){
    //     return User::with(['roles'])->whereHas('roles', function($query) {
    //         $query->where('name', '=', 'General Manager')
    //             ->orWhere('name', '=', 'Accounts & Admin Manager')
    //             ->orWhere('name', '=', 'East Regional Superintendent')
    //             ->orWhere('name', '=', 'West Regional Superintendent')
    //             ->orWhere('name', '=', 'East Regional Supervisor')
    //             ->orWhere('name', '=', 'West Regional Supervisor');
    //     })->get();
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::with(['user','approvedleaves'])->where('isapproved','0')->latest()->get();
        // $senttos=User::where('id','2')->orWhere('id','3')->orderBy('email','asc')->get();
        $senttos=$this->leaveApprovers;
        $leavetypes=Leavetype::orderBy('name','asc')->get();

        $totalleavesapprovedbyyou=Leave::with(['user','approvedleaves'])->where('sendto_id',Auth::user()->id)->where('isapproved','1')->count();
        $leavetobeapprovebyme=Leave::with(['user','approvedleaves'])->where('sendto_id',Auth::user()->id)->count();

        $leaveapprovers=User::get();
       
        return view('admin.leave.index', array('user' => Auth::user()), compact('leaves','senttos','leavetypes','totalleavesapprovedbyyou','leavetobeapprovebyme','leaveapprovers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $takenleaveents=Leave::where('user_id',Auth::user()->id)->get();
        $senttos=$this->leaveApprovers;
        $leavetypes=Leavetype::orderBy('name','asc')->get();
        return view('admin.leave.create', array('user' => Auth::user()), compact('senttos','leavetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->numofdays>Auth::user()->leaveent) {
            return redirect()->back()->with('refusal','Your leave request is more than your leave entitlement');
        }else{

        $leave=new Leave;
        $leave->user_id=$request->user_id;
        $leave->sendto_id=$request->sendto_id;
        $leave->leavetype_id=$request->leavetype_id;
        $leave->starting=$request->starting;
        $leave->ending=$request->ending;
        $leave->numofdays=$request->numofdays;
        $leave->description=$request->description;
        $leave->save();

        //update user leave entitlement
        // $userleaveent=User::where('id',Auth::user()->id)->first();
        $userleaveent=User::where('id',$leave->user_id)->first();
        $leaveent_balance=$userleaveent->leaveent - $leave->numofdays;
        $userleaveent->leaveent=$leaveent_balance;
        $userleaveent->save();


        //notify applicant
        // $leave->user->notify(new LeaveAppliedNotification($leave));

        //notify Approver
        $receipient=User::find($leave->sendto_id);
        
        // $receipient->notify(new LeaveForApprovalNotification($leave));

        SMSController::sendLeaveApplicationToStaffSMS($leave);
        SMSController::sendLeaveApplicationToApproverSMS($leave);

        return redirect()->route('leave.index')->with('success','Leave applied successfully!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        $leave = Leave::find($leave->id);
        $senttos=$this->leaveApprovers;
        $leavetypes=Leavetype::orderBy('name','asc')->get();
        // $approvedby=Leaveapprovedby::where('leave_id',$leave->id)->first();
        return view('admin.leave.show', array('user' => Auth::user()), compact('leave','senttos','leavetypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        $leaves = Leave::where('id',$leave->id)->first();
        $senttos=$this->leaveApprovers;
        $leavetypes=Leavetype::orderBy('name','asc')->get();
        return view('admin.leave.edit', array('user' => Auth::user()), compact('leaves','senttos','leavetypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {

        if ($request->numofdays>Auth::user()->leaveent) {
            return redirect()->back()->with('refusal','Your leave request is more than your leave entitlement');
        }else{

        if ($leave->slug!=$leave->slug) {
            // $leave=Leave::find($leave->id);
            $leave->user_id=$request->user_id;
            $leave->sendto_id=$request->sendto_id;
            $leave->leavetype_id=$request->leavetype_id;
            $leave->starting=$request->starting;
            $leave->ending=$request->ending;
            $leave->numofdays=$request->numofdays;
            $leave->description=$request->description;
            $leave->save();


            //update user leave entitlement
            $userleaveent=User::where('id',$leave->user_id)->first();
            $leaveent_balance=30 - $leave->numofdays;
            $userleaveent->leaveent=$leaveent_balance;
            $userleaveent->save();
        }else{
            // $leave=Leave::find($leave->id);
            $leave->user_id=$request->user_id;
            $leave->sendto_id=$request->sendto_id;
            $leave->leavetype_id=$request->leavetype_id;
            $leave->starting=$request->starting;
            $leave->ending=$request->ending;
            $leave->numofdays=$request->numofdays;
            $leave->description=$request->description;
            $leave->save();


            //update user leave entitlement
            $userleaveent=User::where('id',$leave->user_id)->first();
            $leaveent_balance=30 - $leave->numofdays;
            $userleaveent->leaveent=$leaveent_balance;
            $userleaveent->save();
        }

        }

        return redirect()->route('leave.index')->with('success','Leave updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()->back()->with('deleted','Leave deleted successfully!');
    }

    public function confirm($id){

        $leave=Leave::find($id);

        if (Auth::user()->id==$leave->sendto_id || auth()->user()->hasAnyRole(['Admin'])) {
            
            $leave->isapproved='1';
            $leave->save();

            //saving the approver and leave details
            $approvedleave=new Approvedleave();
            $approvedleave->user_id=auth()->user()->id;
            $approvedleave->leave_id=$leave->id;
            $approvedleave->save();

            //notifying applicant of the approval
            // $leave->user->notify(new LeaveApprovedNotification($leave));

            //sending mails to CNA Staff
            // foreach (['maxmilian.nwosu@cleannigeria.org','etiese.etuk@cleannigeria.org','mfon.edet@cleannigeria.org','ralph.uwhumiakpor@cleannigeria.org'] as $recipient) {
                // Mail::to($recipient)->send(new ApprovedLeaveMail($leave));
            // }

            SMSController::sendLeaveApprovalToStaffSMS($leave);

            return redirect()->back()->with('success','Leave approved and sent to Approved leave page!');

        } else {
            return redirect()->route('access.denied');
        }
    }


    public function trackapprovedleaves(){
        $id=Auth::user()->id;

        $leavesapprovedbyyou=Leave::where('sendto_id',$id)->where('isapproved','1')->latest()->simplePaginate(5);
        $totalleavesapprovedbyyou=Leave::where('sendto_id',$id)->where('isapproved','1')->count();

        return view('admin.leave.trackapprovedleaves', array('user' => Auth::user()), compact('leavesapprovedbyyou','totalleavesapprovedbyyou'));
    }

    public function approvedLeaves(){
        $approvedleaves=Leave::where('isapproved','1')->latest()->simplePaginate(10);
        $totalleavesapproved=Leave::where('isapproved','1')->count();
        return view('admin.leave.approvedleaves', array('user' => Auth::user()), compact('approvedleaves','totalleavesapproved'));
    }

    public function allapprovedleaves(){
        $allapprovedleaves=Leave::with(['user','approvedleaves'])->where('isapproved','1')->orderBy('updated_at','desc')->get();
        $leavetobeapprovebyme=Leave::with(['user','approvedleaves'])->where('sendto_id',Auth::user()->id)->count();
        $totalleavesapprovedbyyou=Leave::with(['user','approvedleaves'])->where('sendto_id',Auth::user()->id)->where('isapproved','1')->count();

        $leaveapprovers=User::get();
        return view('admin.leave.allapprovedleaves', array('user' => Auth::user()), compact('allapprovedleaves','leavetobeapprovebyme','leaveapprovers','totalleavesapprovedbyyou'));
    }
}
