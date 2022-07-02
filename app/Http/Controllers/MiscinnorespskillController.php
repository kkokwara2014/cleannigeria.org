<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Legend;
use App\Models\Miscinnorespskill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiscinnorespskillController extends Controller
{
    public function store(Request $request){
      
        $miscresp=new Miscinnorespskill();
        $miscresp->caption=$request->caption;
        $miscresp->evidence=$request->evidence;
        $miscresp->user_id=$request->user_id;
        $miscresp->legend_id=$request->legend_id;
        $miscresp->competenceassessment_id=$request->competenceassessment_id;

        $miscresp->save();

        return redirect()->back()->with('success', $miscresp->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $miscresp=Miscinnorespskill::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.miscresp_edit',array('user'=>Auth::user()),compact('miscresp','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $miscresp=Miscinnorespskill::find($id);
        $miscresp->caption=$request->caption;
        $miscresp->evidence=$request->evidence;
        $miscresp->user_id=$request->user_id;
        $miscresp->legend_id=$request->legend_id;
        $miscresp->competenceassessment_id=$request->competenceassessment_id;

        $miscresp->save();

        // return redirect()->back()->with('success', $miscresp->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $miscresp->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $miscresp=Miscinnorespskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $miscresp->profiassebyassessor=$request->profiassebyassessor;
        $miscresp->assessedby=$assessor_fullname;
        $miscresp->review=$request->review;
        $miscresp->isassessed='1';
        $miscresp->assessedbyfirst='1';
        $miscresp->save();

        return redirect()->back()->with('success',$miscresp->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Miscinnorespskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $miscresp=Miscinnorespskill::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $miscresp->profassesslevelbygm=$request->profassesslevelbygm;
        $miscresp->commentbygm=$request->commentbygm;
        $miscresp->nameofgm=$nameofgm;
        $miscresp->isapproved='1';
        $miscresp->save();

        return redirect()->back()->with('success',$miscresp->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $miscresp=Miscinnorespskill::find($id);
        $miscresp->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
