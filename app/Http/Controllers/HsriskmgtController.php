<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Hsriskmgt;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HsriskmgtController extends Controller
{
    public function store(Request $request){
      
        $hsriskmgt=new Hsriskmgt();
        $hsriskmgt->caption=$request->caption;
        $hsriskmgt->evidence=$request->evidence;
        $hsriskmgt->user_id=$request->user_id;
        $hsriskmgt->legend_id=$request->legend_id;
        $hsriskmgt->competenceassessment_id=$request->competenceassessment_id;

        $hsriskmgt->save();

        return redirect()->back()->with('success', $hsriskmgt->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $hsriskmgt=Hsriskmgt::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.hsriskmgt_edit',array('user'=>Auth::user()),compact('hsriskmgt','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        
        $hsriskmgt=Hsriskmgt::find($id);
        $hsriskmgt->caption=$request->caption;
        $hsriskmgt->evidence=$request->evidence;
        $hsriskmgt->user_id=$request->user_id;
        $hsriskmgt->legend_id=$request->legend_id;
        $hsriskmgt->competenceassessment_id=$request->competenceassessment_id;

        $hsriskmgt->save();

        // return redirect()->back()->with('success', $hsriskmgt->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $hsriskmgt->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $hsriskmgt->profiassebyassessor=$request->profiassebyassessor;
        $hsriskmgt->assessedby=$assessor_fullname;
        $hsriskmgt->review=$request->review;
        $hsriskmgt->isassessed='1';
        $hsriskmgt->assessedbyfirst='1';
        $hsriskmgt->save();

        return redirect()->back()->with('success',$hsriskmgt->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Hsriskmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $hsriskmgt->profassesslevelbygm=$request->profassesslevelbygm;
        $hsriskmgt->commentbygm=$request->commentbygm;
        $hsriskmgt->nameofgm=$nameofgm;
        $hsriskmgt->isapproved='1';
        $hsriskmgt->save();

        return redirect()->back()->with('success',$hsriskmgt->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $hsriskmgt=Hsriskmgt::find($id);
        $hsriskmgt->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
