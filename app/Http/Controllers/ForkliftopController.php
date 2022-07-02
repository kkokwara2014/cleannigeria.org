<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Forkliftop;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForkliftopController extends Controller
{
    public function store(Request $request){
      
        $forkliftop=new Forkliftop();
        $forkliftop->caption=$request->caption;
        $forkliftop->evidence=$request->evidence;
        $forkliftop->user_id=$request->user_id;
        $forkliftop->legend_id=$request->legend_id;
        $forkliftop->competenceassessment_id=$request->competenceassessment_id;

        $forkliftop->save();

        return redirect()->back()->with('success', $forkliftop->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $forkliftop=Forkliftop::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.forkliftop_edit',array('user'=>Auth::user()),compact('forkliftop','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $forkliftop=Forkliftop::find($id);
        $forkliftop->caption=$request->caption;
        $forkliftop->evidence=$request->evidence;
        $forkliftop->user_id=$request->user_id;
        $forkliftop->legend_id=$request->legend_id;
        $forkliftop->competenceassessment_id=$request->competenceassessment_id;

        $forkliftop->save();

        // return redirect()->back()->with('success', $forkliftop->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $forkliftop->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $forkliftop=Forkliftop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $forkliftop->profiassebyassessor=$request->profiassebyassessor;
        $forkliftop->assessedby=$assessor_fullname;
        $forkliftop->review=$request->review;
        $forkliftop->isassessed='1';
        $forkliftop->assessedbyfirst='1';
        $forkliftop->save();

        return redirect()->back()->with('success',$forkliftop->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Forkliftop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $forkliftop=Forkliftop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $forkliftop->profassesslevelbygm=$request->profassesslevelbygm;
        $forkliftop->commentbygm=$request->commentbygm;
        $forkliftop->nameofgm=$nameofgm;
        $forkliftop->isapproved='1';
        $forkliftop->save();

        return redirect()->back()->with('success',$forkliftop->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $forkliftop=Forkliftop::find($id);
        $forkliftop->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
