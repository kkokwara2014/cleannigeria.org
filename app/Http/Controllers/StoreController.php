<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::orderBy('name','asc')->get();
        $locations = Location::orderBy('name','asc')->where('isapproved','1')->get();
        return view('admin.store.index', array('user' => Auth::user()), compact('stores','locations'));
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
        $store=new Store;
        $store->name=$request->name;
        $store->location_id=$request->location_id;
        $store->isapproved='1';
        $store->save();

        return redirect()->route('store.index')->with('success','New Store added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $stores = Store::where('id', $store->id)->first();
        $locations = Location::orderBy('name','asc')->where('isapproved','1')->get();
        return view('admin.store.edit', array('user' => Auth::user()), compact('stores','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store=Store::find($store->id);
        $store->name=$request->name;
        $store->location_id=$request->location_id;
        $store->save();

        return redirect()->route('store.index')->with('success','Store updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->back()->with('deleted','Store deleted successfully!');
    }

    public function approve($id){
        $store=Store::find($id);
        $store->isapproved='1';
        $store->save();

        //saving the store approval details
        // $stapproval=new Stapproval;
        // $stapproval->user_id=Auth::user()->id;
        // $stapproval->store_id=$store->id;
        // $stapproval->save();

        //for notification

        return redirect()->back();
    }
}
