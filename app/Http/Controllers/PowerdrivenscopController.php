<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Powerdrivenscop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PowerdrivenscopController extends Controller
{
    public function store(Request $request){
      
        $powerdriven=new Powerdrivenscop();
        $powerdriven->caption=$request->caption;
        $powerdriven->evidence=$request->evidence;
        $powerdriven->user_id=$request->user_id;
        $powerdriven->legend_id=$request->legend_id;
        $powerdriven->competenceassessment_id=$request->competenceassessment_id;

        $powerdriven->save();

        return redirect()->back()->with('success', $powerdriven->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $powerdriven=Powerdrivenscop::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.powerdriven_edit',array('user'=>Auth::user()),compact('powerdriven','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $powerdriven=Powerdrivenscop::find($id);
        $powerdriven->caption=$request->caption;
        $powerdriven->evidence=$request->evidence;
        $powerdriven->user_id=$request->user_id;
        $powerdriven->legend_id=$request->legend_id;
        $powerdriven->competenceassessment_id=$request->competenceassessment_id;

        $powerdriven->save();

        // return redirect()->back()->with('success', $powerdriven->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $powerdriven->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $powerdriven=Powerdrivenscop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $powerdriven->profiassebyassessor=$request->profiassebyassessor;
        $powerdriven->assessedby=$assessor_fullname;
        $powerdriven->review=$request->review;
        $powerdriven->isassessed='1';
        $powerdriven->assessedbyfirst='1';
        $powerdriven->save();

        return redirect()->back()->with('success',$powerdriven->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Powerdrivenscop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $powerdriven=Powerdrivenscop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $powerdriven->profassesslevelbygm=$request->profassesslevelbygm;
        $powerdriven->commentbygm=$request->commentbygm;
        $powerdriven->nameofgm=$nameofgm;
        $powerdriven->isapproved='1';
        $powerdriven->save();

        return redirect()->back()->with('success',$powerdriven->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $powerdriven=Powerdrivenscop::find($id);
        $powerdriven->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
