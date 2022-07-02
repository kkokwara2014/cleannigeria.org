<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.service.index', array('user' => Auth::user()), compact('services'));
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
            Image::make($image)->resize(792, 422)->save(public_path('images/services/' . $imageName));
           
            $service = new Service;
            $service->title = $request->title;
            $service->user_id = $request->user_id;
            $service->description = $request->description;
            $service->image = $imageName;

            $service->save();
        }  

        return redirect()->route('service.index')->with('success','Service added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        // $service = Service::find($service->id);
      
        return view('admin.service.show', array('user' => Auth::user()), compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        // $service = Service::where('id',$service->id)->first();
        return view('admin.service.edit', array('user' => Auth::user()), compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(792, 422)->save(public_path('images/services/' . $imageName));
           
            // $service =Service::find($service->id);
            $service->title = $request->title;
            $service->user_id = $request->user_id;
            $service->description = $request->description;
            $service->image = $imageName;

            $service->save();
        }else{

            // $service =Service::find($service->id);
            $service->title = $request->title;
            $service->user_id = $request->user_id;
            $service->description = $request->description;
            $service->image = $request->service_image;

            $service->save();
            
        } 

        return redirect()->route('service.index')->with('success','Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //deleting files from folder
        File::delete([public_path('images/services/' . $service)]);

        //deleting  files from the database
        $service->delete();

        //redirecting page
        return redirect()->back()->with('deleted','Service deleted successfully!');
    }
}
