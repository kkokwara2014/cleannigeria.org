<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Operationhandover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationhandoverController extends Controller
{
    public function store(Request $request){
      
        $ophandover=new Operationhandover();
        $ophandover->caption=$request->caption;
        $ophandover->evidence=$request->evidence;
        $ophandover->user_id=$request->user_id;
        $ophandover->legend_id=$request->legend_id;
        $ophandover->competenceassessment_id=$request->competenceassessment_id;

        $ophandover->save();

        return redirect()->back()->with('success', $ophandover->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $ophandover=Operationhandover::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.ophandover_edit',array('user'=>Auth::user()),compact('ophandover','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $ophandover=Operationhandover::find($id);
        $ophandover->caption=$request->caption;
        $ophandover->evidence=$request->evidence;
        $ophandover->user_id=$request->user_id;
        $ophandover->legend_id=$request->legend_id;
        $ophandover->competenceassessment_id=$request->competenceassessment_id;

        $ophandover->save();

        // return redirect()->back()->with('success', $ophandover->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $ophandover->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $ophandover=Operationhandover::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $ophandover->profiassebyassessor=$request->profiassebyassessor;
        $ophandover->assessedby=$assessor_fullname;
        $ophandover->review=$request->review;
        $ophandover->isassessed='1';
        $ophandover->assessedbyfirst='1';
        $ophandover->save();

        return redirect()->back()->with('success',$ophandover->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Operationhandover::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $ophandover=Operationhandover::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $ophandover->profassesslevelbygm=$request->profassesslevelbygm;
        $ophandover->commentbygm=$request->commentbygm;
        $ophandover->nameofgm=$nameofgm;
        $ophandover->isapproved='1';
        $ophandover->save();

        return redirect()->back()->with('success',$ophandover->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $ophandover=Operationhandover::find($id);
        $ophandover->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
