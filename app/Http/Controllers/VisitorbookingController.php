<?php

namespace App\Http\Controllers;

use App\Models\Visitorbooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorbookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.visitorbooking.index',array('user'=>Auth::user()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.visitorbooking.create',array('user'=>Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitorbooking  $visitorbooking
     * @return \Illuminate\Http\Response
     */
    public function show(Visitorbooking $visitorbooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitorbooking  $visitorbooking
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitorbooking $visitorbooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitorbooking  $visitorbooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitorbooking $visitorbooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitorbooking  $visitorbooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitorbooking $visitorbooking)
    {
        //
    }
}
