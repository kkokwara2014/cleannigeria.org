<?php

namespace App\Http\Controllers;

use App\Models\Maintrequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintrequests=Maintrequest::with(['user'])->latest()->get();
        return view('admin.maintrequests.index',array('user'=>Auth::user()),compact('maintrequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maintrequests.create',array('user'=>Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maintrequest=new Maintrequest();
        $maintrequest->maintcode=$request->maintcode;
        $maintrequest->membercompany=$request->membercompany;
        $maintrequest->user_id=$request->user_id;
        $maintrequest->jobdesignation=$request->jobdesignation;
        $maintrequest->directphone=$request->directphone;
        $maintrequest->email=$request->email;
        $maintrequest->dateofrequest=$request->dateofrequest;
        $maintrequest->equipmenttype=$request->equipmenttype;
        $maintrequest->equipmentlocation=$request->equipmentlocation;
        $maintrequest->mainttype=$request->mainttype;
        $maintrequest->equipmentfault=$request->equipmentfault;
        $maintrequest->cmdonebefore=$request->cmdonebefore;
        $maintrequest->sparepartavailable=$request->sparepartavailable;
        $maintrequest->sremaintinplace=$request->sremaintinplace;
        $maintrequest->expectedmaintdate=$request->expectedmaintdate;
        $maintrequest->hseriskdesc=$request->hseriskdesc;
        $maintrequest->secriskdesc=$request->secriskdesc;
        $maintrequest->secarrangementdesc=$request->secarrangementdesc;
        $maintrequest->moreinfo=$request->moreinfo;
        $maintrequest->covidppe=$request->covidppe;
        $maintrequest->accomodation=$request->accomodation;
        $maintrequest->safetyoflocation=$request->safetyoflocation;
        $maintrequest->armedsecurity=$request->armedsecurity;
        $maintrequest->transportation=$request->transportation;
        $maintrequest->communiservice=$request->communiservice;
        $maintrequest->incidentsiteaccess=$request->incidentsiteaccess;
        $maintrequest->medicalservices=$request->medicalservices;
        $maintrequest->welfare=$request->welfare;
        $maintrequest->safetycriticaldevice=$request->safetycriticaldevice;
        $maintrequest->save();

        //notification to GM
        $approver=User::with(['roles'])->whereHas('roles',function($query){
            $query->where('name','Admin')
                ->orWhere('name','General Manager');
        })->get();
        
        // EmailController::sendMaintenanceRequestMail($approver->email,$maintrequest);
        //end of notification

        return redirect()->route('maintenancerequest.index')->with('success','Maintenance request sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintrequest  $maintrequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintrequest=Maintrequest::with(['user'])->where('id',$id)->first();
        $approver=User::where('id',$maintrequest->approver_id)->first();
        return view('admin.maintrequests.show',array('user'=>Auth::user()),compact('maintrequest','approver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintrequest  $maintrequest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maintrequest=Maintrequest::with(['user'])->where('id',$id)->first();
        return view('admin.maintrequests.edit',array('user'=>Auth::user()),compact('maintrequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maintrequest  $maintrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $maintrequest=Maintrequest::find($id);
        $maintrequest->maintcode=$request->maintcode;
        $maintrequest->membercompany=$request->membercompany;
        $maintrequest->user_id=$request->user_id;
        $maintrequest->jobdesignation=$request->jobdesignation;
        $maintrequest->directphone=$request->directphone;
        $maintrequest->email=$request->email;
        $maintrequest->dateofrequest=$request->dateofrequest;
        $maintrequest->equipmenttype=$request->equipmenttype;
        $maintrequest->equipmentlocation=$request->equipmentlocation;
        $maintrequest->mainttype=$request->mainttype;
        $maintrequest->equipmentfault=$request->equipmentfault;
        $maintrequest->cmdonebefore=$request->cmdonebefore;
        $maintrequest->sparepartavailable=$request->sparepartavailable;
        $maintrequest->sremaintinplace=$request->sremaintinplace;
        $maintrequest->expectedmaintdate=$request->expectedmaintdate;
        $maintrequest->hseriskdesc=$request->hseriskdesc;
        $maintrequest->secriskdesc=$request->secriskdesc;
        $maintrequest->secarrangementdesc=$request->secarrangementdesc;
        $maintrequest->moreinfo=$request->moreinfo;
        $maintrequest->covidppe=$request->covidppe;
        $maintrequest->accomodation=$request->accomodation;
        $maintrequest->safetyoflocation=$request->safetyoflocation;
        $maintrequest->armedsecurity=$request->armedsecurity;
        $maintrequest->transportation=$request->transportation;
        $maintrequest->communiservice=$request->communiservice;
        $maintrequest->incidentsiteaccess=$request->incidentsiteaccess;
        $maintrequest->medicalservices=$request->medicalservices;
        $maintrequest->welfare=$request->welfare;
        $maintrequest->safetycriticaldevice=$request->safetycriticaldevice;
        $maintrequest->save();

        // //notification to GM
        // $approver=User::with(['roles'])->whereHas('roles',function($query){
        //     $query->where('name','Admin')
        //         ->orWhere('name','General Manager');
        // })->get();

        
        // EmailController::sendMaintenanceRequestMail($approver->email,$maintrequest);
        //end of notification

        return redirect()->route('maintenancerequest.index')->with('success','Maintenance request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintrequest  $maintrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintrequest=Maintrequest::find($id);
        $maintrequest->delete();
        return redirect()->back()->with('deleted','Maintenance request deleted successfully!');
    }

    public function printmaintrequest($id){
        $maintrequest=Maintrequest::with(['user'])->where('id',$id)->first();
        $approver=User::where('id',$maintrequest->approver_id)->first();
        return view('admin.maintrequests.print',array('user'=>Auth::user()),compact('maintrequest','approver'));
    }

    public function approvemaintrequest(Request $request, $id){
        $maintrequest=Maintrequest::find($id);
        $maintrequest->isapproved=1;
        $maintrequest->approver_id=auth()->user()->id;
        $maintrequest->approvercomment=$request->approvercomment;
        $maintrequest->approvaldate=date('d-m-Y H:i:s');
        $maintrequest->save();

        //notify maintenance officer
         $maintofficer=User::with(['roles'])->whereHas('roles',function($query){
            $query->where('name','Admin')
                ->orWhere('name','Maintenance Officer');
        })->get();

        
        // EmailController::sendMaintenanceRequestApprovalMail($maintofficer->email,$maintrequest);
        //end of notification
        

        return redirect()->back()->with('success','Maintenance request approved successfully!');
    }
}
