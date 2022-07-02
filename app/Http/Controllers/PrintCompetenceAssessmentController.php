<?php

namespace App\Http\Controllers;

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

class PrintCompetenceAssessmentController extends Controller
{
    
    public function printapproveassessedcomptass(Request $request, $comptass_id,$user_id){
        
        $hsworkenv=Hsworkenvironment::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $hsrisk=Hsrisk::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $hsriskmgt=Hsriskmgt::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $fatraining=Fatraining::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $gastesting=Gastesting::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $ophandover=Operationhandover::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $forkliftop=Forkliftop::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $selfloader=Selfloaderop::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $pdriven=Powerdrivenscop::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $respequip=Responseequip::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $miscresp=Miscinnorespskill::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $fateoilspill=Fateoilskill::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $impactoilpollu=Impactoilpollution::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $survmodviz=Survmodelvisualization::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $offshoreresp=Offshoreresponse::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $dispers=Dispersant::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $shorelineresp=Shorelineresponse::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $inlandresp=Inlandresponse::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $incidmgt=Incidentmgt::where('competenceassessment_id', $comptass_id)->where('user_id', $user_id)->where('isassessed','1')->first();
        
        $staff=User::find($user_id);

        $comptassuser=Competenceassessmentuser::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();
        $assessor=Competenceassessmentuser::where('competenceassessment_id',$comptass_id)->where('user_id',$user_id)->first();

        return view('admin.comptence_assessment.print_report.print',array('user'=>Auth::user()),compact(
        'staff','hsworkenv',
        'hsrisk','hsriskmgt',
        'fatraining','gastesting',
        'ophandover','forkliftop',
        'respequip','miscresp',
        'selfloader','pdriven',
        'fateoilspill','impactoilpollu',
        'survmodviz','offshoreresp',
        'dispers','shorelineresp',
        'inlandresp','incidmgt',
        'assessor','comptassuser'
        ));
    }
}
