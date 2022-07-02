<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Survmodelvisualization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurvmodelvisualizationController extends Controller
{
    public function store(Request $request){
      
        $survmod=new Survmodelvisualization();
        $survmod->caption=$request->caption;
        $survmod->evidence=$request->evidence;
        $survmod->user_id=$request->user_id;
        $survmod->legend_id=$request->legend_id;
        $survmod->competenceassessment_id=$request->competenceassessment_id;

        $survmod->save();

        return redirect()->back()->with('success', $survmod->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $survmod=Survmodelvisualization::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.survmod_edit',array('user'=>Auth::user()),compact('survmod','levels','ctass'));
    }

    public function update(Request $request, $id,$slug){
        $survmod=Survmodelvisualization::find($id);
        $survmod->caption=$request->caption;
        $survmod->evidence=$request->evidence;
        $survmod->user_id=$request->user_id;
        $survmod->legend_id=$request->legend_id;
        $survmod->competenceassessment_id=$request->competenceassessment_id;

        $survmod->save();

        // return redirect()->back()->with('success', $survmod->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $survmod->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $survmod=Survmodelvisualization::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $survmod->profiassebyassessor=$request->profiassebyassessor;
        $survmod->assessedby=$assessor_fullname;
        $survmod->review=$request->review;
        $survmod->isassessed='1';
        $survmod->assessedbyfirst='1';
        $survmod->save();

        return redirect()->back()->with('success',$survmod->caption. ' assessed and reviewed successfully!');
    }
    

    public function savesecondassessment(Request $request){
        
        $dispers=Survmodelvisualization::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $survmod=Survmodelvisualization::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $survmod->profassesslevelbygm=$request->profassesslevelbygm;
        $survmod->commentbygm=$request->commentbygm;
        $survmod->nameofgm=$nameofgm;
        $survmod->isapproved='1';
        $survmod->save();

        return redirect()->back()->with('success',$survmod->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $survmod=Survmodelvisualization::find($id);
        $survmod->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
