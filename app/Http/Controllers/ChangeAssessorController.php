<?php

namespace App\Http\Controllers;

use App\Competenceassessmentuser;
use App\Models\Competenceassessmentuser as ModelsCompetenceassessmentuser;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class ChangeAssessorController extends Controller
{

    public function changeassessor(Request $request){
        
        $appraisal_id=$request->competenceassessment_id;
        $user_id=$request->user_id;
        
         $appraisaluser=ModelsCompetenceassessmentuser::where('competenceassessment_id',$appraisal_id)->where('user_id',$user_id)->first();
         $appraisaluser->sentto_id=$request->sentto_id;
         $appraisaluser->save();
         
         $appraiser=User::where('id',$appraisaluser->sentto_id)->first();
         $staffthatchangedassessor=User::where('id',$user_id)->first();
         
         
         
        return redirect()->back()->with('success','Assessor Changed successfully!');
    }
}
