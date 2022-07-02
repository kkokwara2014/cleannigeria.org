<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Hsworkenvironment;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HsworkenvironmentController extends Controller
{
    public function store(Request $request){
      
        $hswenv=new Hsworkenvironment();
        $hswenv->caption=$request->caption;
        $hswenv->evidence=$request->evidence;
        $hswenv->user_id=$request->user_id;
        $hswenv->legend_id=$request->legend_id;
        $hswenv->competenceassessment_id=$request->competenceassessment_id;

        $hswenv->save();

        return redirect()->back()->with('success', $hswenv->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $hsworkenv=Hsworkenvironment::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.hsworkenv_edit',array('user'=>Auth::user()),compact('hsworkenv','levels','ctass'));
    }


    public function update(Request $request, $id, $slug){
        $hswenv=Hsworkenvironment::find($id);
        $hswenv->caption=$request->caption;
        $hswenv->evidence=$request->evidence;
        $hswenv->user_id=$request->user_id;
        $hswenv->legend_id=$request->legend_id;
        $hswenv->competenceassessment_id=$request->competenceassessment_id;

        $hswenv->save();

        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $hswenv->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        // $assessor=User::find($request->assessedby);
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $hswenv=Hsworkenvironment::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $hswenv->profiassebyassessor=$request->profiassebyassessor;
        $hswenv->assessedby=$assessor_fullname;
        $hswenv->review=$request->review;
        $hswenv->isassessed='1';
        $hswenv->assessedbyfirst='1';
        $hswenv->save();

        return redirect()->back()->with('success',$hswenv->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Hsworkenvironment::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $hswenv=Hsworkenvironment::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $hswenv->profassesslevelbygm=$request->profassesslevelbygm;
        $hswenv->commentbygm=$request->commentbygm;
        $hswenv->nameofgm=$nameofgm;
        $hswenv->isapproved='1';
        $hswenv->save();

        return redirect()->back()->with('success',$hswenv->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $hswenv=Hsworkenvironment::find($id);
        $hswenv->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
