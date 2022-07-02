<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('name','asc')->get();
        return view('admin.location.index', array('user' => Auth::user()), compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location=new Location;
        $location->name=$request->name;
        $location->isapproved='1';
        $location->save();

        return redirect()->route('location.index')->with('success','New Location added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $locations = Location::where('id', $location->id)->first();
        return view('admin.location.edit', array('user' => Auth::user()), compact('locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $location=Location::find($location->id);
        $location->name=$request->name;
        $location->save();

        return redirect()->route('location.index')->with('success','Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->back()->with('deleted','Location deleted successfully!');
    }

    public function approve($id){
        $location=Location::find($id);
        $location->isapproved='1';
        $location->save();

        //saving the location approval details
        // $locapproval=new Locapproval;
        // $locapproval->user_id=Auth::user()->id;
        // $locapproval->location_id=$location->id;
        // $locapproval->save();

        //for notification

        return redirect()->back();
    }
}
