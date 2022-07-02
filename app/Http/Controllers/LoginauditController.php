<?php

namespace App\Http\Controllers;

use App\Models\Loginaudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginauditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logins=Loginaudit::latest()->get();
        return view('admin.loginaudit.index',array('user'=>Auth::user()),compact('logins'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loginaudit  $loginaudit
     * @return \Illuminate\Http\Response
     */
    public function show(Loginaudit $loginaudit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loginaudit  $loginaudit
     * @return \Illuminate\Http\Response
     */
    public function edit(Loginaudit $loginaudit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loginaudit  $loginaudit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loginaudit $loginaudit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loginaudit  $loginaudit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loginaudit $loginaudit)
    {
        //
    }
}
