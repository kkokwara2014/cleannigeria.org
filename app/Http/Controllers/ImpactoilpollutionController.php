<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Impactoilpollution;
use App\Models\Legend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpactoilpollutionController extends Controller
{
    public function store(Request $request){
      
        $impoilpol=new Impactoilpollution();
        $impoilpol->caption=$request->caption;
        $impoilpol->evidence=$request->evidence;
        $impoilpol->user_id=$request->user_id;
        $impoilpol->legend_id=$request->legend_id;
        $impoilpol->competenceassessment_id=$request->competenceassessment_id;

        $impoilpol->save();

        return redirect()->back()->with('success', $impoilpol->caption.'  submitted successfully!');
    }

    public function edit($id,$slug){

        $impoilpol=Impactoilpollution::where('id',$id)->where('user_id',Auth::user()->id)->first();
        $levels=Legend::orderBy('name','asc')->get();
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();

        return view('admin.comptence_assessment.impoilpol_edit',array('user'=>Auth::user()),compact('impoilpol','levels','ctass'));
    }

    public function update(Request $request, $id, $slug){
        $impoilpol=Impactoilpollution::find($id);
        $impoilpol->caption=$request->caption;
        $impoilpol->evidence=$request->evidence;
        $impoilpol->user_id=$request->user_id;
        $impoilpol->legend_id=$request->legend_id;
        $impoilpol->competenceassessment_id=$request->competenceassessment_id;

        $impoilpol->save();

        // return redirect()->back()->with('success', $impoilpol->caption.' updated successfully!');
        $ctass=Competenceassessment::where('slug',$slug)->where('published','1')->first();
        return redirect()->route('fillcomptassform',$slug)->with('success', $impoilpol->caption.' updated successfully!');
    }

    public function saveassessment(Request $request){
        $assessor=User::find(auth()->user()->id);
        $assessor_fullname=$assessor->firstname.' '.$assessor->lastname;

        $impoilpol=Impactoilpollution::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $impoilpol->profiassebyassessor=$request->profiassebyassessor;
        $impoilpol->assessedby=$assessor_fullname;
        $impoilpol->review=$request->review;
        $impoilpol->isassessed='1';
        $impoilpol->assessedbyfirst='1';
        $impoilpol->save();

        return redirect()->back()->with('success',$impoilpol->caption. ' assessed and reviewed successfully!');
    }

    public function savesecondassessment(Request $request){
        
        $dispers=Impactoilpollution::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $dispers->profassesslevelbyassessor2=$request->profassesslevelbyassessor2;
        $dispers->assessor2=$request->assessor2;
        $dispers->commentbyassessor2=$request->commentbyassessor2;
        $dispers->assessedbysecond='1';
        $dispers->save();

        return redirect()->back()->with('success',$dispers->caption. ' re-assessed successfully!');
    }

    public function saveassessmentbygm(Request $request){
        
        $nameofgm=auth()->user()->firstname.' '.auth()->user()->lastname;

        $impoilpol=Impactoilpollution::where('competenceassessment_id',$request->competenceassessment_id)->where('user_id',$request->staff_id)->first();
        $impoilpol->profassesslevelbygm=$request->profassesslevelbygm;
        $impoilpol->commentbygm=$request->commentbygm;
        $impoilpol->nameofgm=$nameofgm;
        $impoilpol->isapproved='1';
        $impoilpol->save();

        return redirect()->back()->with('success',$impoilpol->caption. ' reviewed successfully by GM!');
    }

    public function destroy($id){

        $impoilpol=Impactoilpollution::find($id);
        $impoilpol->delete();

        return redirect()->back()->with('deleted','Entries deleted successfully!');

    }
}
