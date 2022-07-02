<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Dispersant;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DispersantController extends Controller
{
    public function store(Request $request){
      
        $disper=new Dispersant();
        $disper->caption=$request->caption;
        $disper->evidence=$request->evidence;
        $disper->user_id=$request->user_id;
        $disper->legend_id=$request->legend_id;
        $disper->competenceassessment_id=$request->competenceassessment_id;

        $disper->save();

        return redirect()->back()->with('success', $disper->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $dispers=Dispersant::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.dispers_edit',array('user'=>Auth::user()),compact('dispers','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $disper=Dispersant::find($id);
        $disper->caption=$request->caption;
        $disper->evidence=$request->evidence;
        $disper->user_id=$request->user_id;
        $disper->legend_id=$request->legend_id;
        $disper->competenceassessment_id=$request->competenceassessment_id;

        $disper->save();

        // return redirect()->back()->with('success', $disper->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $disper->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $dispers=Dispersant::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profiassebyassessor=$request->profiassebyassessor;
        $dispers->assessedby=$assessor_fullname;
        $dispers->review=$request->review;
        $dispers->isassessed='1';
        $dispers->assessedbyfirst='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' assessed and reviewed successfully!');
    }
    public function savesecondassessment(Request $request){
        
        $dispers=Dispersant::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $dispers=Dispersant::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbygm=$request->profassesslevelbygm;
        $dispers->commentbygm=$request->commentbygm;
        $dispers->nameofgm=$nameofgm;
        $dispers->isapproved='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $disper=Dispersant::find($id);
        $disper->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
