<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Offshoreresponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffshoreresponseController extends Controller
{
    public function store(Request $request){
      
        $offshoreresp=new Offshoreresponse();
        $offshoreresp->caption=$request->caption;
        $offshoreresp->evidence=$request->evidence;
        $offshoreresp->user_id=$request->user_id;
        $offshoreresp->legend_id=$request->legend_id;
        $offshoreresp->competenceassessment_id=$request->competenceassessment_id;

        $offshoreresp->save();

        return redirect()->back()->with('success', $offshoreresp->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $offshoreresp=Offshoreresponse::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.offshoreresp_edit',array('user'=>Auth::user()),compact('offshoreresp','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $offshoreresp=Offshoreresponse::find($id);
        $offshoreresp->caption=$request->caption;
        $offshoreresp->evidence=$request->evidence;
        $offshoreresp->user_id=$request->user_id;
        $offshoreresp->legend_id=$request->legend_id;
        $offshoreresp->competenceassessment_id=$request->competenceassessment_id;

        $offshoreresp->save();

        // return redirect()->back()->with('success', $offshoreresp->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $offshoreresp->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $offshoreresp->profiassebyassessor=$request->profiassebyassessor;
        $offshoreresp->assessedby=$assessor_fullname;
        $offshoreresp->review=$request->review;
        $offshoreresp->isassessed='1';
        $offshoreresp->assessedbyfirst='1';
        $offshoreresp->save();

        return redirect()->back()->with('success',$offshoreresp->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Offshoreresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $offshoreresp->profassesslevelbygm=$request->profassesslevelbygm;
        $offshoreresp->commentbygm=$request->commentbygm;
        $offshoreresp->nameofgm=$nameofgm;
        $offshoreresp->isapproved='1';
        $offshoreresp->save();

        return redirect()->back()->with('success',$offshoreresp->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $offshoreresp=Offshoreresponse::find($id);
        $offshoreresp->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
