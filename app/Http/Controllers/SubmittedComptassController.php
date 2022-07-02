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

class SubmittedComptassController extends Controller
{
    
    public function selectcomptassyear(){
        $comptassyears=[];

        for ($year=2019; $year <= 2070 ; $year++)  
            $comptassyears[$year]=$year;
            
        return view('admin.comptence_assessment.selectcomptassyear',array('user'=>Auth::user()),compact('comptassyears'));
    }

    public function yearlysubmittedcomptasss(Request $request){
        $this->validate($request,[
            'comptassyear'=>'required'
        ]);

        $comptassyear=$request->comptassyear;
        $comptassment=Competenceassessment::where('assessmentyear',$comptassyear)->where('published','1')->first();
        $assessors=User::latest()->get();

        if ($comptassment['assessmentyear']==$comptassyear) {
            
            $submittedcomptassments=Competenceassessmentuser::with(
                ['user',
                'competenceassessment'
                ])->where('competenceassessment_id',$comptassment->id)
                ->orderBy('id','desc')
                ->get();

            return view('admin.comptence_assessment.submittedcomptassments',array('user'=>Auth::user()),compact('submittedcomptassments','comptassyear','assessors'));
        } else {
            $errormsg='There is no Submitted Competence Assessment for year ('. $comptassyear .')';
            return redirect()->back()->with('warning',$errormsg);
        }
    }
   

    public function getsomptassbyyou(){
        $comptassyears=[];

        for ($year=2019; $year <= 2070 ; $year++)  
            $comptassyears[$year]=$year;
            
        return view('admin.comptence_assessment.selectcomptassbyyou',array('user'=>Auth::user()),compact('comptassyears'));
    }

    public function yearlysubmittedcomptasssbyyou(Request $request){
        $this->validate($request,[
            'comptassyear'=>'required'
        ]);

        $user=User::where('id',auth()->user()->id)->first();

        $comptassyear=$request->comptassyear;
        $comptassment=Competenceassessment::where('assessmentyear',$comptassyear)->where('published','1')->first();
        $assessors=User::latest()->get();

        if ($comptassment['assessmentyear']==$comptassyear) {
            
            $submittedcomptassments=Competenceassessmentuser::with(
                ['user',
                'competenceassessment'
                ])->where('competenceassessment_id',$comptassment->id)
                ->where('user_id',$user->id)
                ->orderBy('id','desc')
                ->get();

            return view('admin.comptence_assessment.submittedcomptassmentsbyyou',array('user'=>Auth::user()),compact('submittedcomptassments','comptassyear','assessors'));
        } else {
            $errormsg='There is no Submitted Competence Assessment for year ('. $comptassyear .')';
            return redirect()->back()->with('warning',$errormsg);
        }
    }

    // public function allsubmittedappraisals(){
    //     $submittedappraisals=Competenceassessmentuser::with(['appraisal','user','sentto'])->latest()->get();
    //     $appraisers=User::latest()->get();
    
    //     return view('admin.staff.submittedappraisals',array('user'=>Auth::user()),compact('submittedappraisals','appraisers'));
    // }

    public function comptassbyyou(){
        $mysubmittedcomptassments=Competenceassessmentuser::with(
            ['user',
            'competenceassessment'
            ])->where('user_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->get();

            return view('admin.comptence_assessment.comptassbyyou',array('user'=>Auth::user()),compact('mysubmittedcomptassments'));
    }
    public function comptassforyou(){
        $submittedcomptassforyou=Competenceassessmentuser::with(
            ['user',
            'competenceassessment'
            ])->where('sentto_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->get();
            return view('admin.comptence_assessment.comptassforyou',array('user'=>Auth::user()),compact('submittedcomptassforyou'));
        
    }
    public function senttosuperior(){

        if (auth()->user()->hasAnyRole(['East Regional Superintendent'])||auth()->user()->hasAnyRole(['West Regional Superintendent'])||auth()->user()->hasAnyRole(['East Regional Supervisor'])||auth()->user()->hasAnyRole(['West Regional Supervisor'])||auth()->user()->hasAnyRole(['General Manager'])||auth()->user()->hasAnyRole(['Admin'])){
        $submittedcomptassforsuperior=Competenceassessmentuser::with(
            ['user',
            'competenceassessment'
            ])->where('senttosuperior_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->get();
            return view('admin.comptence_assessment.comptassforreassessment',array('user'=>Auth::user()),compact('submittedcomptassforsuperior'));
        }else{
            return view('admin.unauthorized.accessdenied',array('user'=>Auth::user()));
        }
        
    }
    public function senttogm(){

        if(auth()->user()->hasAnyRole(['General Manager'])||auth()->user()->hasAnyRole(['Admin'])){

        $submittedcomptassforgm=Competenceassessmentuser::with(
            ['user',
            'competenceassessment'
            ])->where('finalassessor_id',auth()->user()->id)
            ->orderBy('id','desc')
            ->get();
            return view('admin.comptence_assessment.comptassforgm',array('user'=>Auth::user()),compact('submittedcomptassforgm'));
        }else{
            return view('admin.unauthorized.accessdenied',array('user'=>Auth::user()));
        }
        
    }

    public function makefinalassessment($comptassid,$staffid){

        $comptass=Competenceassessment::find($comptassid);
        $staff_id=$staffid;
        $staff=User::find($staff_id);

        $legends=Legend::orderBy('name','asc')->get();

        // $assessors=Competenceassessmentuser::where('competenceassessment_id',$comptassid)->get();
        $assessor=Competenceassessmentuser::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();

        //getting 
        $hsworkenv=Hsworkenvironment::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $hsrisk=Hsrisk::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $fatraining=Fatraining::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $gastesting=Gastesting::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $ophandover=Operationhandover::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $forkliftop=Forkliftop::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $selfloader=Selfloaderop::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $powerdriven=Powerdrivenscop::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $respequip=Responseequip::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $miscresp=Miscinnorespskill::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $fateoil=Fateoilskill::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $impoilpollu=Impactoilpollution::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $survmodviz=Survmodelvisualization::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $dispers=Dispersant::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $inlandresp=Inlandresponse::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $incidmgt=Incidentmgt::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();


        $comptassuser=Competenceassessmentuser::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $comptassapproval=Comptassapproval::where('competenceassessmentuser_id',$comptassuser->id)->where('user_id',$staff_id)->first();
        

        // $senttosuperiors=User::where('id',5)->orWhere('id',7)->orWhere('id',8)->get();
        // $finalassessors=User::where('id',5)->get();

        $allassessors=User::all();
        
        $senttosuperiors=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'General Manager')
                ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'East Regional Superintendent')
                ->orWhere('name', '=', 'West Regional Superintendent')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();
        $finalassessors=$senttosuperiors;
        //notify staff of the assessment


        // return $comptassapproval;

        return view('admin.comptence_assessment.finalassessment.makefinalassessment',array('user'=>Auth::user()),
        compact('comptass','staff_id',
        'staff','hsworkenv',
        'hsrisk','hsriskmgt',
        'fatraining','gastesting',
        'ophandover','forkliftop',
        'respequip','miscresp',
        'selfloader','powerdriven',
        'fateoil','impoilpollu',
        'survmodviz','offshoreresp',
        'dispers','shorelineresp',
        'inlandresp','incidmgt',
        'assessor','legends',
        'comptassuser','comptassapproval',
        'senttosuperiors',
        'finalassessors',
        'allassessors'
        ));

    }


}
