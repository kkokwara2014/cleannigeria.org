<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
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
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', array('user' => Auth::user()), compact('galleries'));
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
            Image::make($image)->resize(995, 604)->save(public_path('images/gallery/' . $imageName));
           
            $gallery = new Gallery;
            $gallery->title = $request->title;
            $gallery->user_id = $request->user_id;
            $gallery->description = $request->description;
            $gallery->image = $imageName;

            $gallery->save();
        }  

        return redirect()->route('gallery.index')->with('success','Gallery added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        // $gallery = Gallery::find($gallery->id);
      
        return view('admin.gallery.show', array('user' => Auth::user()), compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        // $gallery = Gallery::where('id',$gallery->id)->first();
        return view('admin.gallery.edit', array('user' => Auth::user()), compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(995, 604)->save(public_path('images/gallery/' . $imageName));
           
            // $gallery =Gallery::find($gallery->id);
            $gallery->title = $request->title;
            $gallery->user_id = $request->user_id;
            $gallery->description = $request->description;
            $gallery->image = $imageName;

            $gallery->save();
        }else{

            // $gallery =Gallery::find($gallery->id);
            $gallery->title = $request->title;
            $gallery->user_id = $request->user_id;
            $gallery->description = $request->description;
            $gallery->image = $request->gallery_image;

            $gallery->save();
            
        } 

        return redirect()->route('gallery.index')->with('success','Gallery updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //deleting files from folder
        File::delete([public_path('images/gallery/' . $gallery)]);

        //deleting  files from the database
        $gallery->delete();

        //redirecting page
        return redirect()->back()->with('deleted','Gallery deleted successfully!');
    }
}
