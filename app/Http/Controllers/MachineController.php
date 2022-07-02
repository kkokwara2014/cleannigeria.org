<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $machines=Machine::latest()->get();

        return view('admin.machines.index',array('user'=>Auth::user()),compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations=Location::where('isapproved','1')->orderBy('name','asc')->get();

        return view('admin.machines.create',array('user'=>Auth::user()),compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $machine=new Machine;
        $machine->uniquenumb=rand(12345,56789);
        $machine->name=$request->name;
        $machine->slug=Str::slug($request->name);
        $machine->user_id=Auth::user()->id;
        $machine->location_id=$request->location_id;
        $machine->status=$request->status;
        $machine->beforeuse=$request->beforeuse;
        $machine->afteruse=$request->afteruse;
        $machine->monthly=$request->monthly;
        $machine->quarterly=$request->quarterly;
        $machine->semiannually=$request->semiannually;
        $machine->annually=$request->annually;
        $machine->save();

        return redirect()->route('machines.index')->with('success', $machine->name. ' added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $machine=Machine::find($id);
        $locations=Location::where('isapproved','1')->orderBy('name','asc')->get();

        return view('admin.machines.show',array('user'=>Auth::user()),compact('locations','machine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $machine=Machine::find($id);
        $locations=Location::where('isapproved','1')->orderBy('name','asc')->get();

        return view('admin.machines.edit',array('user'=>Auth::user()),compact('locations','machine'));
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
        $machine=Machine::find($id);
        if ($machine->name==$request->name) {
            $machine->location_id=$request->location_id;
            $machine->status=$request->status;
            $machine->beforeuse=$request->beforeuse;
            $machine->afteruse=$request->afteruse;
            $machine->monthly=$request->monthly;
            $machine->quarterly=$request->quarterly;
            $machine->semiannually=$request->semiannually;
            $machine->annually=$request->annually;
            $machine->save();
        } else {
            $machine->name==$request->name;
            $machine->slug=Str::slug($request->name);
            $machine->location_id=$request->location_id;
            $machine->status=$request->status;
            $machine->beforeuse=$request->beforeuse;
            $machine->afteruse=$request->afteruse;
            $machine->monthly=$request->monthly;
            $machine->quarterly=$request->quarterly;
            $machine->semiannually=$request->semiannually;
            $machine->annually=$request->annually;
            $machine->save();
            
        }
        
        return redirect()->route('machines.index')->with('success', $machine->name. ' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $machine=Machine::find($id);
        $machine->delete();

        return redirect()->back()->with('deleted', $machine->name.' deleted successfully! ');
    }
}
