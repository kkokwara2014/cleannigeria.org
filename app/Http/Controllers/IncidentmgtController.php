<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Competenceassessmentuser;
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
use Illuminate\Support\Facades\DB;

class IncidentmgtController extends Controller
{
    public function store(Request $request){
      
        $incidmgt=new Incidentmgt();
        $incidmgt->caption=$request->caption;
        $incidmgt->evidence=$request->evidence;
        $incidmgt->user_id=$request->user_id;
        $incidmgt->legend_id=$request->legend_id;
        $incidmgt->competenceassessment_id=$request->competenceassessment_id;

        $incidmgt->save();

        //saving competenceassessment id and user id in competenceassessmentuser model
        $comptassessuser=new Competenceassessmentuser();
        $comptassessuser->competenceassessment_id=$request->competenceassessment_id;
        $comptassessuser->user_id=auth()->user()->id;
        $comptassessuser->sentto_id=$request->sentto_id;
        $comptassessuser->save();
        
        //notify the Assessor about a submitted competence assessment
        $stafftobeassessed =User::where('id',$comptassessuser->user_id)->first();
        $comptassessor =User::where('id',$comptassessuser->sentto_id)->first();
        // Mail::to($stafftobeassessed->email)->send(new CompetenceAssessmentSubmittedMail($comptassessuser,$comptassessor));
        // Mail::to($comptassessor->email)->send(new CompetenceAssessmentForAssessorMail($comptassessuser,$comptassessor));


        //send sms
        SMSController::sendComptassApplicationToStaffSMS($comptassessuser);
        SMSController::sendComptassApplicationToApproverSMS($comptassessuser);

        return redirect()->back()->with('success', $incidmgt->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $incidmgt=Incidentmgt::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        // $senttos=User::all();

        $senttos=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'General Manager')
                // ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'East Regional Superintendent')
                ->orWhere('name', '=', 'West Regional Superintendent')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();

        return view('admin.comptence_assessment.incidmgt_edit',array('user'=>Auth::user()),compact('incidmgt','levels','ctass','senttos'));
    }

    public function update(Request $request, $id, $slug){
        $incidmgt=Incidentmgt::find($id);
        $incidmgt->caption=$request->caption;
        $incidmgt->evidence=$request->evidence;
        $incidmgt->user_id=$request->user_id;
        $incidmgt->legend_id=$request->legend_id;
        $incidmgt->competenceassessment_id=$request->competenceassessment_id;

        $incidmgt->save();

        // return redirect()->back()->with('success', $incidmgt->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $incidmgt->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;
        
        DB::transaction(function () use($request, $assessor_fullname) {
                $incidmgt=Incidentmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
                $incidmgt->profiassebyassessor=$request->profiassebyassessor;
                $incidmgt->assessedby=$assessor_fullname;
                $incidmgt->review=$request->review;
                $incidmgt->isassessed='1';
                $incidmgt->assessedbyfirst='1';
                $incidmgt->save();
            
                //update assesor
                $comptuserupdate=Competenceassessmentuser::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
                $comptuserupdate->senttosuperior_id=$request->senttosuperior_id;
                $comptuserupdate->isassessed='1';
                $comptuserupdate->save();

                //notify superior Assessor
                $superiorassessor=User::find($comptuserupdate->senttosuperior_id);
                //  Mail::to($superiorassessor->email)->send(new SuperiorAssessorMail($comptuserupdate,$superiorassessor));

        });
        

        return redirect()->back()->with('success','Incident Management assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        DB::transaction(function () use($request) {
            $dispers=Incidentmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
            $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
            $dispers->assessor2=$request->assessor2;
            $dispers->commentbyassessor2=$request->commentbyassessor2;
            $dispers->assessedbysecond='1';
            $dispers->save();

            //update assesor
            $comptuserupdate=Competenceassessmentuser::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
            $comptuserupdate->finalassessor_id=$request->finalassessor_id;
            $comptuserupdate->save();


            //notify final Assessor
            $finalassessor=User::find($comptuserupdate->finalassessor_id);
            // Mail::to($finalassessor->email)->send(new FinalAssessorMail($comptuserupdate,$finalassessor));
        });
        

        return redirect()->back()->with('success','Incident Management re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $incidmgt=Incidentmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Hsworkenvironment::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Hsrisk::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Hsriskmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Fatraining::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Gastesting::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Operationhandover::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Forkliftop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Selfloaderop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Powerdrivenscop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Responseequip::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Miscinnorespskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Fateoilskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Impactoilpollution::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Survmodelvisualization::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Offshoreresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Dispersant::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Shorelineresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        $incidmgt=Inlandresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $incidmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $incidmgt->commentbygm=$request->commentbygm;
        $incidmgt->nameofgm=$nameofgm;
        $incidmgt->isapproved='1';
        $incidmgt->save();

        return redirect()->back()->with('success','Final assessment and approval done successfully!');
    }

    public function destroy($id){

        $incidmgt=Incidentmgt::find($id);
        $incidmgt->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
