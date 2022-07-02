<?php

namespace App\Http\Controllers;

use App\Models\Maintdequipevidence;
use App\Models\Maintdequipment;
use App\Models\Maintschedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintdequipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintdequipments=Maintdequipment::latest()->simplePaginate(10);
        foreach ($maintdequipments as $maintdequip) {
            $morefiles=Maintdequipevidence::where('maintdequipment_id',$maintdequip->id)->latest()->get();
        }

        return view('admin.maintschedule.maintdequipment.index', array('user' => Auth::user()), compact('maintdequipments','morefiles'));
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
            'maintstartdate'=>'required',
            'maintenddate'=>'required',
            'activitydone'=>'required|min:3',
            'maintreportfile' => 'required',
            'maintreportfile.*' => 'mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx'
        ]);


        if ($request->maintenddate<$request->maintstartdate) {
           return redirect()->back()->with('deleted','Maint. End Date should NOT be less than Maint. Start Date!');
        } else {
           //uploading maintained equipment file 
            if ($request->hasFile('maintreportfile')) {
                
                $filename=time().'.'.$request->maintreportfile->getClientOriginalExtension();
                $request->maintreportfile->storeAs('public/maintained_equipment/', $filename);
                
                $maintdequip=new Maintdequipment;
                $maintdequip->maintschedule_id=$request->maintschedule_id;
                $maintdequip->maintstartdate=$request->maintstartdate;
                $maintdequip->maintenddate=$request->maintenddate;
                $maintdequip->activitydone=$request->activitydone;
                $maintdequip->user_id=auth()->user()->id;
                $maintdequip->sentto_id=$request->sentto_id;
                $maintdequip->maintreportfile=$filename;
                
                $maintdequip->save();
            }

            //send notification to the GM for approval
            // $staffincharge=User::where('id','25')->first();
            $receipientGM=User::where('role_id','1')->orWhere('role_id','2')->first();

            // Mail::to($receipientGM->email)->send(new MasterDocRegisterMail($documreg,$staffincharge));

            return redirect()->route('maintenanceschedule.index')->with('success','New Maintained Equipment added successfully!');
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
        //
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
        //
    }

    public function downloadreport($maintreportfile){
        $file = public_path('storage/maintained_equipment/'.$maintreportfile);
        $name = basename($file);
        return response()->download($file, $name);
    }

    public function approveworkorder($id){
        $maintequip=Maintdequipment::find($id);
        $maintequip->isapproved='1';
        $maintequip->approvedby=auth()->user()->firstname.' '.auth()->user()->lastname;
        $maintequip->approverphone=auth()->user()->phone;
        $maintequip->approvedon=date('Y-m-d H:i:s');
        $maintequip->save();

        $maintschedule=Maintschedule::find($maintequip->maintschedule_id);
        $maintschedule->ismaintained='1';
        //adding the scheduled maintenance cycle to the existing due date for maintenance
        $maintschedule->duedateformaint=Carbon::now()->addMonths($maintschedule->maintcycle);
        $maintschedule->save();
        //send email to the trainee
        // $trainee=Trainee::find($cert->trainee_id);       
        
        // Mail::to($trainee->traineeemail)->send(new CertificateApprovedMail($cert));

        return redirect()->back()->with('success', 'Work Order approved successfully!');
    }

    public function uploadmorefiles(Request $request){
        request()->validate([
            'moremaintreportfile' => 'required',
            'moremaintreportfile.*' => 'mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx'
        ]);
        $moreUploadedFiles = $request->file('moremaintreportfile');
        //uploading more files
        if ($request->hasFile('moremaintreportfile')) {
            foreach ($moreUploadedFiles as $key=> $docum) {
                
                $filename=rand(2345678,7890989).'.'.$docum->getClientOriginalExtension();
                $docum->storeAs('public/maintained_equipment/', $filename);
                
                $uploadeddoc=new Maintdequipevidence;
                $uploadeddoc->user_id=auth()->user()->id;
                $uploadeddoc->maintdequipment_id=$request->maintequip_id;
                $uploadeddoc->maintreportfile=$filename;
                $uploadeddoc->save();
            }
        }        
        return redirect()->back()->with('success','More Document(s) uploaded successfully!');
    }

    
    public function approved(){
        $maintdequipments=Maintdequipment::where('isapproved','1')->latest()->simplePaginate(10);
        foreach ($maintdequipments as $maintdequip) {
            $morefiles=Maintdequipevidence::where('maintdequipment_id',$maintdequip->id)->latest()->get();
        }

        return view('admin.maintschedule.maintdequipment.approved', array('user' => Auth::user()), compact('maintdequipments','morefiles'));
    }
    public function unapproved(){
        $maintdequipments=Maintdequipment::where('isapproved','0')->latest()->simplePaginate(10);
        foreach ($maintdequipments as $maintdequip) {
            $morefiles=Maintdequipevidence::where('maintdequipment_id',$maintdequip->id)->latest()->get();
        }

        return view('admin.maintschedule.maintdequipment.unapproved', array('user' => Auth::user()), compact('maintdequipments','morefiles'));
    }
}
