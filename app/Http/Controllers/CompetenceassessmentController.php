<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Competenceassessmentuser;
use App\Models\Comptassapproval;
use App\Models\Dispersant;
use App\Models\Fateoilskill;
use App\Models\Fatraining;
use App\Models\Forkliftop;
use App\Models\Gastesting;
use App\Models\Hsrisk;
use App\Models\Hsriskmgt;
use App\Models\Hsworkenvironment;
use App\Models\Impactoilpollution;
use App\Models\Incidentmgt;
use App\Models\Inlandresponse;
use App\Models\Legend;
use App\Models\Miscinnorespskill;
use App\Models\Offshoreresponse;
use App\Models\Operationhandover;
use App\Models\Powerdrivenscop;
use App\Models\Responseequip;
use App\Models\Selfloaderop;
use App\Models\Shorelineresponse;
use App\Models\Survmodelvisualization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CompetenceassessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comptasses=Competenceassessment::latest()->get();
        return view('admin.comptence_assessment.index',array('user'=>Auth::user()),compact('comptasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasAnyRole(['Admin'])) {

            $assessmentyears=[];

            for ($year=2019; $year <= 2070 ; $year++)  
                $assessmentyears[$year]=$year;

            return view('admin.comptence_assessment.create',array('user'=>Auth::user()),compact('assessmentyears'));
            
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $comptass=new Competenceassessment();
        $comptass->title=$request->title;
        $comptass->slug=Str::slug($request->title.'-'.$request->assessmentyear);
        $comptass->starting=$request->starting;
        $comptass->ending=$request->ending;
        $comptass->assessmentyear=$request->assessmentyear;
        $comptass->user_id=auth()->user()->id;
        $comptass->save();

        return redirect()->route('competenceassessment.index')->with('success','New Competence Assessment created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comptass=Competenceassessment::find($id);
        $staff=User::find($id);
        $staff_id=$id;
        $comptassusers=Competenceassessmentuser::where('user_id',$staff->id)->get();

        return view('admin.comptence_assessment.show',array('user'=>Auth::user()),compact('comptass','staff','staff_id','comptassusers'));
    }

    public function showcomptass($comptassid,$staffid){

        $comptass=Competenceassessment::find($comptassid);
        $staff=User::find($staffid);

        return view('admin.comptence_assessment.show',array('user'=>Auth::user()),compact('comptass'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['Admin'])) {
            
            $comptass=Competenceassessment::find($id);
            $assessmentyears=[];

                for ($year=2019; $year <= 2070 ; $year++)  
                    $assessmentyears[$year]=$year;

            return view('admin.comptence_assessment.edit',array('user'=>Auth::user()),compact('comptass','assessmentyears'));
        } else {
            return redirect()->back();
        }
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
        if (auth()->user()->hasAnyRole(['Admin'])) {
            $comptass=Competenceassessment::find($id);
            if ($comptass->title!=$request->title) {
                $comptass->title=$request->title;
                $comptass->slug=Str::slug($request->title.'-'.$request->assessmentyear);
                $comptass->starting=$request->starting;
                $comptass->ending=$request->ending;
                $comptass->assessmentyear=$request->assessmentyear;
                $comptass->user_id=auth()->user()->id;
                $comptass->save();

                return redirect()->route('competenceassessment.index')->with('success', $comptass->title.' '.' updated successfully!');
            } else {
                $comptass->title=$request->title;
                $comptass->assessmentyear=$request->assessmentyear;
                $comptass->starting=$request->starting;
                $comptass->ending=$request->ending;
                $comptass->user_id=auth()->user()->id;
                $comptass->save();

                return redirect()->route('competenceassessment.index')->with('success', $comptass->title.' '.' updated successfully!');
            }

        } else {
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasAnyRole(['Admin'])) {
            $comptass=Competenceassessment::find($id);
            $comptass->delete();

            return redirect()->back()->with('deleted',$comptass->title.' '.' deleted successfully!');

        } else {
            return redirect()->back();
        }
    }

    public function publish($id){
        if (auth()->user()->hasAnyRole(['Admin'])) {
            $comptass=Competenceassessment::find($id);
            $comptass->published='1';
            $comptass->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function unpublish($id){
        if (auth()->user()->hasAnyRole(['Admin'])) {
            $comptass=Competenceassessment::find($id);
            $comptass->published='0';
            $comptass->save();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function publishedcomptass(){

        $comptass=Competenceassessment::where('published','1')->latest()->get();
        return view('admin.comptence_assessment.published',array('user'=>Auth::user()),compact('comptass'));

    }

    public function fillcomptassform($slug){

        $comptass=Competenceassessment::where('slug',$slug)->where('published','1')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        $levels=Legend::orderBy('name','asc')->get();

        $hsworkenviron=Hsworkenvironment::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $hsworkenv=Hsworkenvironment::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();
        
        $hsriskidentify=Hsrisk::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $hsrisk=Hsrisk::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $hsriskmanage=Hsriskmgt::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $fatraining=Fatraining::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $ftrain=Fatraining::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $gastesting=Gastesting::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $gtesting=Gastesting::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $ophandover=Operationhandover::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $ophand=Operationhandover::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $forkliftop=Forkliftop::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $fliftop=Forkliftop::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $selfloader=Selfloaderop::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $sloader=Selfloaderop::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();
        
        $powerdriven=Powerdrivenscop::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $pdriven=Powerdrivenscop::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $respequip=Responseequip::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $requip=Responseequip::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $miscinskill=Miscinnorespskill::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $miscskill=Miscinnorespskill::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $fateoilskill=Fateoilskill::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $foilskill=Fateoilskill::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $impactoilpollu=Impactoilpollution::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $impactoil=Impactoilpollution::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $survmodviz=Survmodelvisualization::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $survmod=Survmodelvisualization::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();
        
        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $offshresp=Offshoreresponse::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $dispersant=Dispersant::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $dispant=Dispersant::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $shoreresp=Shorelineresponse::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $inlandresp=Inlandresponse::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $inlresp=Inlandresponse::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        $incidentmgt=Incidentmgt::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->count();
        $incidmgt=Incidentmgt::where('competenceassessment_id',$ctass->id)->where('user_id',Auth::user()->id)->first();

        // $senttos=User::where('profileupdated','1')->get();
        $senttos=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'General Manager')
                ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'East Regional Superintendent')
                ->orWhere('name', '=', 'West Regional Superintendent')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();

        return view('admin.comptence_assessment.fillform',array('user'=>Auth::user()),
        compact('comptass','ctass',
        'levels','hsworkenviron','hsworkenv',
        'hsriskidentify','hsrisk',
        'hsriskmanage','hsriskmgt',
        'fatraining','ftrain',
        'gastesting','gtesting',
        'ophandover','ophand',
        'forkliftop','fliftop',
        'selfloader','sloader',
        'powerdriven','pdriven',
        'respequip','requip',
        'miscinskill','miscskill',
        'fateoilskill','foilskill',
        'impactoilpollu','impactoil',
        'survmodviz','survmod',
        'offshoreresp','offshresp',
        'dispersant','dispant',
        'shorelineresp','shoreresp',
        'inlandresp','inlresp',
        'incidentmgt','incidmgt',
        'senttos'
    ));

    }

    public function submittedcomptass(){
        $submittedcomptassessments=Competenceassessmentuser::latest()->get();
        return view('admin.comptence_assessment.submittedcomptass',array('user'=>Auth::user()),compact('submittedcomptassessments'));
    }




    public function assessedcomptass(){
        $assessedcomptassessments=Competenceassessmentuser::latest()->get();
        return view('admin.comptence_assessment.assessedcomptass',array('user'=>Auth::user()),compact('assessedcomptassessments'));
    }

    public function deletesubmittedcomptass($comptass_id,$user_id){

        $hsworkenv=Hsworkenvironment::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $hsworkenv->delete();

        $hsrisk=Hsrisk::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $hsrisk->delete();

        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $hsriskmgt->delete();

        $fatraining=Fatraining::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $fatraining->delete();

        $gastesting=Gastesting::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $gastesting->delete();

        $ophandover=Operationhandover::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $ophandover->delete();

        $forkliftop=Forkliftop::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $forkliftop->delete();

        $selfloader=Selfloaderop::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $selfloader->delete();

        $pdriven=Powerdrivenscop::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $pdriven->delete();

        $respequip=Responseequip::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $respequip->delete();

        $miscresp=Miscinnorespskill::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $miscresp->delete();

        $fateoilspill=Fateoilskill::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $fateoilspill->delete();

        $impactoilpollu=Impactoilpollution::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $impactoilpollu->delete();

        $survmodviz=Survmodelvisualization::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $survmodviz->delete();

        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $offshoreresp->delete();

        $dispers=Dispersant::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $dispers->delete();

        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $shorelineresp->delete();

        $inlandresp=Inlandresponse::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $inlandresp->delete();

        $incidmgt=Incidentmgt::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $incidmgt->delete();

        $comptassuser=Competenceassessmentuser::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $comptassuser->delete();

        $staff=User::find($user_id);

        return redirect()->back()->with('deleted','Competence Assessment for '. $staff->firstname.' '. $staff->lastname.' has been deleted successfully!');
    }

    public function approveassessedcomptass(Request $request, $comptass_id,$user_id){
        
        $hsworkenv=Hsworkenvironment::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $hsworkenv->isapproved='1';
        $hsworkenv->save();

        $hsrisk=Hsrisk::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $hsrisk->isapproved='1';
        $hsrisk->save();

        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $hsriskmgt->isapproved='1';
        $hsriskmgt->save();

        $fatraining=Fatraining::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $fatraining->isapproved='1';
        $fatraining->save();

        $gastesting=Gastesting::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $gastesting->isapproved='1';
        $gastesting->save();

        $ophandover=Operationhandover::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $ophandover->isapproved='1';
        $ophandover->save();

        $forkliftop=Forkliftop::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $forkliftop->isapproved='1';
        $forkliftop->save();

        $selfloader=Selfloaderop::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $selfloader->isapproved='1';
        $selfloader->save();

        $pdriven=Powerdrivenscop::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $pdriven->isapproved='1';
        $pdriven->save();

        $respequip=Responseequip::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $respequip->isapproved='1';
        $respequip->save();

        $miscresp=Miscinnorespskill::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $miscresp->isapproved='1';
        $miscresp->save();

        $fateoilspill=Fateoilskill::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $fateoilspill->isapproved='1';
        $fateoilspill->save();

        $impactoilpollu=Impactoilpollution::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $impactoilpollu->isapproved='1';
        $impactoilpollu->save();

        $survmodviz=Survmodelvisualization::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $survmodviz->isapproved='1';
        $survmodviz->save();

        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $offshoreresp->isapproved='1';
        $offshoreresp->save();

        $dispers=Dispersant::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $dispers->isapproved='1';
        $dispers->save();

        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $shorelineresp->isapproved='1';
        $shorelineresp->save();

        $inlandresp=Inlandresponse::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $inlandresp->isapproved='1';
        $inlandresp->save();

        $incidmgt=Incidentmgt::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $staff=User::find($user_id);

        //keep record of the approver
        $comptassapproval=new Comptassapproval();
        $comptassapproval->competenceassessmentuser_id=$request->competenceassessmentuser_id;
        $comptassapproval->user_id=Auth::user()->id;
        $comptassapproval->comment=$request->comment;
        $comptassapproval->isapproved='1';
        $comptassapproval->save();

        return redirect()->back()->with('success','Approval given for '. $staff->firstname.' '. $staff->lastname.'\'s Competence Assessment');
    }


    
}
