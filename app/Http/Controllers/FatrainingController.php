<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Fatraining;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FatrainingController extends Controller
{
    public function store(Request $request){
      
        $fatraining=new Fatraining();
        $fatraining->caption=$request->caption;
        $fatraining->evidence=$request->evidence;
        $fatraining->user_id=$request->user_id;
        $fatraining->legend_id=$request->legend_id;
        $fatraining->competenceassessment_id=$request->competenceassessment_id;

        $fatraining->save();

        return redirect()->back()->with('success', $fatraining->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $fatraining=Fatraining::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.ftraining_edit',array('user'=>Auth::user()),compact('fatraining','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $fatraining=Fatraining::find($id);
        $fatraining->caption=$request->caption;
        $fatraining->evidence=$request->evidence;
        $fatraining->user_id=$request->user_id;
        $fatraining->legend_id=$request->legend_id;
        $fatraining->competenceassessment_id=$request->competenceassessment_id;

        $fatraining->save();

        // return redirect()->back()->with('success', $fatraining->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $fatraining->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $fatraining=Fatraining::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $fatraining->profiassebyassessor=$request->profiassebyassessor;
        $fatraining->assessedby=$assessor_fullname;
        $fatraining->review=$request->review;
        $fatraining->isassessed='1';
        $fatraining->assessedbyfirst='1';
        $fatraining->save();

        return redirect()->back()->with('success',$fatraining->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Fatraining::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $fatraining=Fatraining::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $fatraining->profassesslevelbygm=$request->profassesslevelbygm;
        $fatraining->commentbygm=$request->commentbygm;
        $fatraining->nameofgm=$nameofgm;
        $fatraining->isapproved='1';
        $fatraining->save();

        return redirect()->back()->with('success',$fatraining->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $fatraining=Fatraining::find($id);
        $fatraining->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
