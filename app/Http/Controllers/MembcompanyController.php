<?php

namespace App\Http\Controllers;

use App\Models\Membcompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;

class MembcompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membcompanies = Membcompany::latest()->get();
        return view('admin.membcompany.index', array('user' => Auth::user()), compact('membcompanies'));
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(768, 770)->save(public_path('images/membcomp/' . $imageName));
           
            $membcompany = new Membcompany;
            $membcompany->name = $request->name;
            $membcompany->user_id = $request->user_id;
            $membcompany->image = $imageName;

            $membcompany->save();
        }  

        return redirect()->route('membcompany.index')->with('success','Member company added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membcompany  $membcompany
     * @return \Illuminate\Http\Response
     */
    public function show(Membcompany $membcompany)
    {
        $membcompany = Membcompany::find($membcompany->id);
      
        return view('admin.membcompany.show', array('user' => Auth::user()), compact('membcompany'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membcompany  $membcompany
     * @return \Illuminate\Http\Response
     */
    public function edit(Membcompany $membcompany)
    {
        $membcompany = Membcompany::where('id',$membcompany->id)->first();
        return view('admin.membcompany.edit', array('user' => Auth::user()), compact('membcompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membcompany  $membcompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membcompany $membcompany)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(768, 770)->save(public_path('images/membcomp/' . $imageName));
           
            $membcompany = Membcompany::find($membcompany->id);
            $membcompany->name = $request->name;
            $membcompany->user_id = $request->user_id;
            $membcompany->image = $imageName;

            $membcompany->save();
        }else{
            $membcompany = Membcompany::find($membcompany->id);
            $membcompany->name = $request->name;
            $membcompany->user_id = $request->user_id;
            $membcompany->image = $request->membcompany_image;

            $membcompany->save();
        } 

        return redirect()->route('membcompany.index')->with('success','Member company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membcompany  $membcompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membcompany $membcompany)
    {
        //deleting files from folder
        File::delete([public_path('images/membcomp/' . $membcompany)]);

        //deleting  files from the database
        $membcompany->delete();

        //redirecting page
        return redirect()->back()->with('deleted','Member company deleted successfully!');
    }
}
