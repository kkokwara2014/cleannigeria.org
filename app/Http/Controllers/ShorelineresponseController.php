<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Shorelineresponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShorelineresponseController extends Controller
{
    public function store(Request $request){
      
        $shorelineresp=new Shorelineresponse();
        $shorelineresp->caption=$request->caption;
        $shorelineresp->evidence=$request->evidence;
        $shorelineresp->user_id=$request->user_id;
        $shorelineresp->legend_id=$request->legend_id;
        $shorelineresp->competenceassessment_id=$request->competenceassessment_id;

        $shorelineresp->save();

        return redirect()->back()->with('success', $shorelineresp->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $shorelineresp=Shorelineresponse::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.shorelineresp_edit',array('user'=>Auth::user()),compact('shorelineresp','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $shorelineresp=Shorelineresponse::find($id);
        $shorelineresp->caption=$request->caption;
        $shorelineresp->evidence=$request->evidence;
        $shorelineresp->user_id=$request->user_id;
        $shorelineresp->legend_id=$request->legend_id;
        $shorelineresp->competenceassessment_id=$request->competenceassessment_id;

        $shorelineresp->save();

        // return redirect()->back()->with('success', $shorelineresp->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $shorelineresp->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $shorelineresp->profiassebyassessor=$request->profiassebyassessor;
        $shorelineresp->assessedby=$assessor_fullname;
        $shorelineresp->review=$request->review;
        $shorelineresp->isassessed='1';
        $shorelineresp->assessedbyfirst='1';
        $shorelineresp->save();

        return redirect()->back()->with('success',$shorelineresp->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Shorelineresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $shorelineresp->profassesslevelbygm=$request->profassesslevelbygm;
        $shorelineresp->commentbygm=$request->commentbygm;
        $shorelineresp->nameofgm=$nameofgm;
        $shorelineresp->isapproved='1';
        $shorelineresp->save();

        return redirect()->back()->with('success',$shorelineresp->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $shorelineresp=Shorelineresponse::find($id);
        $shorelineresp->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
