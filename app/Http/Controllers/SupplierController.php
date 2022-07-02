<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.supplier.index', array('user' => Auth::user()), compact('suppliers'));
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
        $supplier=new Supplier;
        $supplier->name=$request->name;
        $supplier->email=$request->email;
        $supplier->phone=$request->phone;
        $supplier->address=$request->address;
        $supplier->isapproved='1';
        $supplier->save();

        return redirect()->route('supplier.index')->with('success','New Supplier added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $suppliers = Supplier::where('id', $supplier->id)->first();
        return view('admin.supplier.edit', array('user' => Auth::user()), compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier=Supplier::find($supplier->id);
        $supplier->name=$request->name;
        $supplier->email=$request->email;
        $supplier->phone=$request->phone;
        $supplier->address=$request->address;
        $supplier->save();

        return redirect()->route('supplier.index')->with('success','Supplier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->back()->with('deleted','Supplier deleted successfully!');
    }

    public function approve($id){
        $supplier=Supplier::find($id);
        $supplier->isapproved='1';
        $supplier->save();

        //saving the supplier approval details
        // $supapproval=new Supapproval;
        // $supapproval->user_id=Auth::user()->id;
        // $supapproval->supplier_id=$supplier->id;
        // $supapproval->save();

        //for notification

        return redirect()->back();
    }
}
