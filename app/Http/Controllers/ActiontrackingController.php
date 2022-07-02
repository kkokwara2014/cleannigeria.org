<?php

namespace App\Http\Controllers;

use App\Models\Actiontracking;
use Illuminate\Http\Request;

class ActiontrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $actiontracking=new Actiontracking;
        $actiontracking->hazardreport_id=$request->hazardreport_id;
        $actiontracking->user_id=auth()->user()->id;
        $actiontracking->proposedclosingddate=$request->proposedclosingdate;
        $actiontracking->remark=$request->remark;
        $actiontracking->timeline=$request->timeline;
        $actiontracking->save();

        return redirect()->route('hazardreports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actiontracking  $actiontracking
     * @return \Illuminate\Http\Response
     */
    public function show(Actiontracking $actiontracking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actiontracking  $actiontracking
     * @return \Illuminate\Http\Response
     */
    public function edit(Actiontracking $actiontracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actiontracking  $actiontracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actiontracking $actiontracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actiontracking  $actiontracking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actiontracking $actiontracking)
    {
        //
    }
}
