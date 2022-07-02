<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Selfloaderop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelfloaderopController extends Controller
{
    public function store(Request $request){
      
        $selfloadop=new Selfloaderop();
        $selfloadop->caption=$request->caption;
        $selfloadop->evidence=$request->evidence;
        $selfloadop->user_id=$request->user_id;
        $selfloadop->legend_id=$request->legend_id;
        $selfloadop->competenceassessment_id=$request->competenceassessment_id;

        $selfloadop->save();

        return redirect()->back()->with('success', $selfloadop->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $selfloadop=Selfloaderop::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.selfloadop_edit',array('user'=>Auth::user()),compact('selfloadop','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $selfloadop=Selfloaderop::find($id);
        $selfloadop->caption=$request->caption;
        $selfloadop->evidence=$request->evidence;
        $selfloadop->user_id=$request->user_id;
        $selfloadop->legend_id=$request->legend_id;
        $selfloadop->competenceassessment_id=$request->competenceassessment_id;

        $selfloadop->save();

        // return redirect()->back()->with('success', $selfloadop->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $selfloadop->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $selfloadop=Selfloaderop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $selfloadop->profiassebyassessor=$request->profiassebyassessor;
        $selfloadop->assessedby=$assessor_fullname;
        $selfloadop->review=$request->review;
        $selfloadop->isassessed='1';
        $selfloadop->assessedbyfirst='1';
        $selfloadop->save();

        return redirect()->back()->with('success',$selfloadop->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Selfloaderop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }
    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $selfloadop=Selfloaderop::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $selfloadop->profassesslevelbygm=$request->profassesslevelbygm;
        $selfloadop->commentbygm=$request->commentbygm;
        $selfloadop->nameofgm=$nameofgm;
        $selfloadop->isapproved='1';
        $selfloadop->save();

        return redirect()->back()->with('success',$selfloadop->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $selfloadop=Selfloaderop::find($id);
        $selfloadop->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
