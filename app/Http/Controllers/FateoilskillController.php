<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Fateoilskill;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FateoilskillController extends Controller
{
    public function store(Request $request){
      
        $fospill=new Fateoilskill();
        $fospill->caption=$request->caption;
        $fospill->evidence=$request->evidence;
        $fospill->user_id=$request->user_id;
        $fospill->legend_id=$request->legend_id;
        $fospill->competenceassessment_id=$request->competenceassessment_id;

        $fospill->save();

        return redirect()->back()->with('success', $fospill->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $foilspill=Fateoilskill::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.foilspill_edit',array('user'=>Auth::user()),compact('foilspill','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $fospill=Fateoilskill::find($id);
        $fospill->caption=$request->caption;
        $fospill->evidence=$request->evidence;
        $fospill->user_id=$request->user_id;
        $fospill->legend_id=$request->legend_id;
        $fospill->competenceassessment_id=$request->competenceassessment_id;

        $fospill->save();

        // return redirect()->back()->with('success', $fospill->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $fospill->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $foilspill=Fateoilskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $foilspill->profiassebyassessor=$request->profiassebyassessor;
        $foilspill->assessedby=$assessor_fullname;
        $foilspill->review=$request->review;
        $foilspill->isassessed='1';
        $foilspill->assessedbyfirst='1';
        $foilspill->save();

        return redirect()->back()->with('success',$foilspill->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Fateoilskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $foilspill=Fateoilskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $foilspill->profassesslevelbygm=$request->profassesslevelbygm;
        $foilspill->commentbygm=$request->commentbygm;
        $foilspill->nameofgm=$nameofgm;
        $foilspill->isapproved='1';
        $foilspill->save();

        return redirect()->back()->with('success',$foilspill->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $fospill=Fateoilskill::find($id);
        $fospill->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
