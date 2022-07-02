<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Gastesting;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastestingController extends Controller
{
    public function store(Request $request){
      
        $gatest=new Gastesting();
        $gatest->caption=$request->caption;
        $gatest->evidence=$request->evidence;
        $gatest->user_id=$request->user_id;
        $gatest->legend_id=$request->legend_id;
        $gatest->competenceassessment_id=$request->competenceassessment_id;

        $gatest->save();

        return redirect()->back()->with('success', $gatest->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $gatest=Gastesting::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.gatest_edit',array('user'=>Auth::user()),compact('gatest','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $gatest=Gastesting::find($id);
        $gatest->caption=$request->caption;
        $gatest->evidence=$request->evidence;
        $gatest->user_id=$request->user_id;
        $gatest->legend_id=$request->legend_id;
        $gatest->competenceassessment_id=$request->competenceassessment_id;

        $gatest->save();

        // return redirect()->back()->with('success', $gatest->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $gatest->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $gatest=Gastesting::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $gatest->profiassebyassessor=$request->profiassebyassessor;
        $gatest->assessedby=$assessor_fullname;
        $gatest->review=$request->review;
        $gatest->isassessed='1';
        $gatest->assessedbyfirst='1';
        $gatest->save();

        return redirect()->back()->with('success',$gatest->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Gastesting::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $gatest=Gastesting::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $gatest->profassesslevelbygm=$request->profassesslevelbygm;
        $gatest->commentbygm=$request->commentbygm;
        $gatest->nameofgm=$nameofgm;
        $gatest->isapproved='1';
        $gatest->save();

        return redirect()->back()->with('success',$gatest->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $gatest=Gastesting::find($id);
        $gatest->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
