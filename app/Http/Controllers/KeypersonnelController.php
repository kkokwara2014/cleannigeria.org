<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeypersonnelStoreRequest;
use App\Http\Requests\KeypersonnelUpdateRequest;
use App\Models\Keypersonnel;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class KeypersonnelController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $keypersonnels = Keypersonnel::latest()->get();
        $roles=Role::where('id','>','1')->orderBy('id','asc')->get();
        return view('admin.keypersonnel.index', array('user' => Auth::user()), compact('keypersonnels','roles'));
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
            Image::make($image)->resize(192, 193)->save(public_path('images/keystaff/' . $imageName));
           
            $keypersonnel = new Keypersonnel;
            $keypersonnel->fullname = $request->fullname;
            $keypersonnel->role_id = $request->role_id;
            $keypersonnel->user_id = $request->user_id;
            $keypersonnel->biography = $request->biography;
            $keypersonnel->image = $imageName;

            $keypersonnel->save();
        }

                

        return redirect()->route('keypersonnel.index')->with('success','Key Personnel added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Keypersonnel  $keypersonnel
     * @return \Illuminate\Http\Response
     */
    public function show(Keypersonnel $keypersonnel)
    {
        // $keypersonnel = Keypersonnel::find($keypersonnel->id);
      
        return view('admin.keypersonnel.show', array('user' => Auth::user()), compact('keypersonnel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keypersonnel  $keypersonnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Keypersonnel $keypersonnel)
    {
        // $keypersonnel = Keypersonnel::where('id',$keypersonnel->id)->first();
        $roles=Role::where('id','>','1')->orderBy('id','asc')->get();
        return view('admin.keypersonnel.edit', array('user' => Auth::user()), compact('keypersonnel','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keypersonnel  $keypersonnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keypersonnel $keypersonnel)
    {
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(192, 193)->save(public_path('images/keystaff/' . $imageName));
           
            // $keypersonnel = Keypersonnel::find($keypersonnel->id);
            $keypersonnel->fullname = $request->fullname;
            $keypersonnel->role_id = $request->role_id;
            $keypersonnel->user_id = $request->user_id;
            $keypersonnel->biography = $request->biography;
            $keypersonnel->image = $imageName;

            $keypersonnel->save();
        }else{
            // $keypersonnel = Keypersonnel::find($keypersonnel->id);
            $keypersonnel->fullname = $request->fullname;
            $keypersonnel->role_id = $request->role_id;
            $keypersonnel->user_id = $request->user_id;
            $keypersonnel->biography = $request->biography;
            $keypersonnel->image = $request->keystaff_image;

            $keypersonnel->save();
           
        }

        return redirect()->route('keypersonnel.index')->with('success','Key Personnel updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keypersonnel  $keypersonnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keypersonnel $keypersonnel)
    {
        //deleting files from folder
        File::delete([public_path('images/keystaff/' . $keypersonnel)]);

        //deleting  files from the database
        $keypersonnel->delete();

        //redirecting page
        return redirect()->back()->with('deleted','Key personnel deleted successfully!');
    }
}
