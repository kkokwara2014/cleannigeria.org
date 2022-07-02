<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Inlandresponse;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InlandresponseController extends Controller
{
    public function store(Request $request){
      
        $inlandresp=new Inlandresponse();
        $inlandresp->caption=$request->caption;
        $inlandresp->evidence=$request->evidence;
        $inlandresp->user_id=$request->user_id;
        $inlandresp->legend_id=$request->legend_id;
        $inlandresp->competenceassessment_id=$request->competenceassessment_id;

        $inlandresp->save();

        return redirect()->back()->with('success', $inlandresp->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $inlandresp=Inlandresponse::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.inlandresp_edit',array('user'=>Auth::user()),compact('inlandresp','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $inlandresp=Inlandresponse::find($id);
        $inlandresp->caption=$request->caption;
        $inlandresp->evidence=$request->evidence;
        $inlandresp->user_id=$request->user_id;
        $inlandresp->legend_id=$request->legend_id;
        $inlandresp->competenceassessment_id=$request->competenceassessment_id;

        $inlandresp->save();

        // return redirect()->back()->with('success', $inlandresp->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $inlandresp->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $inlandresp=Inlandresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $inlandresp->profiassebyassessor=$request->profiassebyassessor;
        $inlandresp->assessedby=$assessor_fullname;
        $inlandresp->review=$request->review;
        $inlandresp->isassessed='1';
        $inlandresp->assessedbyfirst='1';
        $inlandresp->save();

        return redirect()->back()->with('success',$inlandresp->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Inlandresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $inlandresp=Inlandresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $inlandresp->profassesslevelbygm=$request->profassesslevelbygm;
        $inlandresp->commentbygm=$request->commentbygm;
        $inlandresp->nameofgm=$nameofgm;
        $inlandresp->isapproved='1';
        $inlandresp->save();

        return redirect()->back()->with('success',$inlandresp->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $inlandresp=Inlandresponse::find($id);
        $inlandresp->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
