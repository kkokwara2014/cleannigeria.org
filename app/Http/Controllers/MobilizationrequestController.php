<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobilizationStoreRequest;
use App\Models\Mobilizationrequest;
use App\Notifications\MobilizationCNANotification;
use App\Notifications\MobilizationNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class MobilizationrequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobilizationrequests = Mobilizationrequest::latest()->get();

        return view('admin.mobreq.index', array('user' => Auth::user()), compact('mobilizationrequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.mobilizationrequest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mobilizationrequest  $mobilizationrequest
     * @return \Illuminate\Http\Response
     */
    public function show(Mobilizationrequest $mobilizationrequest)
    {
        $mobreq=Mobilizationrequest::find($mobilizationrequest->id);
        return view('admin.mobreq.show', array('user' => Auth::user()), compact('mobreq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mobilizationrequest  $mobilizationrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Mobilizationrequest $mobilizationrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mobilizationrequest  $mobilizationrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mobilizationrequest $mobilizationrequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mobilizationrequest  $mobilizationrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobilizationrequest $mobilizationrequest)
    {
        //
    }
}
