<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings=Training::latest()->get();

        return view('admin.traineecertificate.training.index',array('user'=>Auth::user()),compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.traineecertificate.training.create',array('user'=>Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:3',
            'startdate'=>'required',
            'enddate'=>'required',
        ]);

        $training=new Training();
        $training->name=$request->name;
        $training->slug=Str::slug($request->name);
        $training->startdate=$request->startdate;
        $training->enddate=$request->enddate;
        
        $training->user_id=Auth::user()->id;
        
        $training->save();

        return redirect()->route('trainings.index')->with('success','New Training created successfully! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training=Training::where('id',$id)->first();

        return view('admin.traineecertificate.training.edit',array('user'=>Auth::user()),compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|min:3',
            'startdate'=>'required',
            'enddate'=>'required',
        ]);

        $training=Training::find($id);
        if ($training->name==$request->name) {
            $training->name=$request->name;
            $training->startdate=$request->startdate;
            $training->enddate=$request->enddate;
            $training->user_id=Auth::user()->id;
        
            $training->save();

            return redirect()->route('trainings.index')->with('success','Training edited successfully! ');
        
        } else {
            $training->name=$request->name;
            $training->slug=Str::slug($request->name);
            $training->startdate=$request->startdate;
            $training->enddate=$request->enddate;
            
            $training->user_id=Auth::user()->id;
            
            $training->save();

            return redirect()->route('trainings.index')->with('success','Training edited successfully! ');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $training=Training::find($id);

        $training->delete();

        return redirect()->back()->with('deleted', $training->name.' deleted successfully!');
    }
}
