<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Responseequip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseequipController extends Controller
{
    public function store(Request $request){
      
        $respequip=new Responseequip();
        $respequip->caption=$request->caption;
        $respequip->evidence=$request->evidence;
        $respequip->user_id=$request->user_id;
        $respequip->legend_id=$request->legend_id;
        $respequip->competenceassessment_id=$request->competenceassessment_id;

        $respequip->save();

        return redirect()->back()->with('success', $respequip->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $respequip=Responseequip::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.respequip_edit',array('user'=>Auth::user()),compact('respequip','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $respequip=Responseequip::find($id);
        $respequip->caption=$request->caption;
        $respequip->evidence=$request->evidence;
        $respequip->user_id=$request->user_id;
        $respequip->legend_id=$request->legend_id;
        $respequip->competenceassessment_id=$request->competenceassessment_id;

        $respequip->save();

        // return redirect()->back()->with('success', $respequip->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $respequip->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $respequip=Responseequip::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $respequip->profiassebyassessor=$request->profiassebyassessor;
        $respequip->assessedby=$assessor_fullname;
        $respequip->review=$request->review;
        $respequip->isassessed='1';
        $respequip->assessedbyfirst='1';
        $respequip->save();

        return redirect()->back()->with('success',$respequip->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Responseequip::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $respequip=Responseequip::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $respequip->profassesslevelbygm=$request->profassesslevelbygm;
        $respequip->commentbygm=$request->commentbygm;
        $respequip->nameofgm=$nameofgm;
        $respequip->isapproved='1';
        $respequip->save();

        return redirect()->back()->with('success',$respequip->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $respequip=Responseequip::find($id);
        $respequip->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
