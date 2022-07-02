<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Hsrisk;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HsriskController extends Controller
{
    public function store(Request $request){
      
        $hsrisk=new Hsrisk();
        $hsrisk->caption=$request->caption;
        $hsrisk->evidence=$request->evidence;
        $hsrisk->user_id=$request->user_id;
        $hsrisk->legend_id=$request->legend_id;
        $hsrisk->competenceassessment_id=$request->competenceassessment_id;

        $hsrisk->save();

        return redirect()->back()->with('success', $hsrisk->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $hsrisk=Hsrisk::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.hsrisk_edit',array('user'=>Auth::user()),compact('hsrisk','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $hsrisk=Hsrisk::find($id);
        $hsrisk->caption=$request->caption;
        $hsrisk->evidence=$request->evidence;
        $hsrisk->user_id=$request->user_id;
        $hsrisk->legend_id=$request->legend_id;
        $hsrisk->competenceassessment_id=$request->competenceassessment_id;

        $hsrisk->save();

        // return redirect()->back()->with('success', $hsrisk->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $hsrisk->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $hsrisk=Hsrisk::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $hsrisk->profiassebyassessor=$request->profiassebyassessor;
        $hsrisk->assessedby=$assessor_fullname;
        $hsrisk->review=$request->review;
        $hsrisk->isassessed='1';
        $hsrisk->assessedbyfirst='1';
        $hsrisk->save();

        return redirect()->back()->with('success',$hsrisk->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Hsrisk::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $hsrisk=Hsrisk::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $hsrisk->profassesslevelbygm=$request->profassesslevelbygm;
        $hsrisk->commentbygm=$request->commentbygm;
        $hsrisk->nameofgm=$nameofgm;
        $hsrisk->isapproved='1';
        $hsrisk->save();

        return redirect()->back()->with('success',$hsrisk->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $hsrisk=Hsrisk::find($id);
        $hsrisk->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
