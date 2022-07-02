<?php

namespace App\Http\Controllers;

use App\Models\Masterdocregister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

class MasterdocregisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterdocregisters=Masterdocregister::latest()->get();
        return view('admin.masterdocumentregister.index',array('user'=>Auth::user()),compact('masterdocregisters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Auth::user()->id==5) {
        if (Auth::user()->hasAnyRole(['Document Registrar']) || auth()->user()->hasAnyRole(['Admin'])) {
            return view('admin.masterdocumentregister.create',array('user'=>Auth::user()));
        } else {
            return redirect()->back()->with('deleted','You do not have the privilege to perform this task!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'doctitle'=>'required|min:3|unique:masterdocregisters',
            'docnumber'=>'required|min:3|max:23|unique:masterdocregisters',
            'revisionstatus'=>'required',
            'dateprepared'=>'required',
            'docfilename' => 'required',
            'docfilename.*' => 'mimes:pdf'
        ]);


        //uploading document register 
        if ($request->hasFile('docfilename')) {
            
                $filename=time().'.'.$request->docfilename->getClientOriginalExtension();
                $request->docfilename->storeAs('public/master_document_registers/', $filename);
                
                $documreg=new Masterdocregister();
                $documreg->doctitle=$request->doctitle;
                $documreg->slug=Str::slug($request->doctitle);
                $documreg->docnumber=$request->docnumber;
                $documreg->uniquecode=rand(234567,987899);
                $documreg->user_id=$request->user_id;
                $documreg->revisionstatus=$request->revisionstatus;
                $documreg->dateprepared=$request->dateprepared;
                $documreg->description=$request->description;
                $documreg->filename=$filename;
                
                $documreg->save();
                
            }

            //send notification to the GM for approval
            // $staffincharge=User::where('id','25')->first();
            // $receipientGM=User::where('role_id','1')->orWhere('role_id','2')->first();

            // Mail::to($receipientGM->email)->send(new MasterDocRegisterMail($documreg,$staffincharge));

        return redirect()->route('documentregisters.index')->with('success','New Document with number '.$documreg->docnumber.' added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $masterdocum=Masterdocregister::where('slug',$slug)->first();
        return view('admin.masterdocumentregister.show',array('user'=>Auth::user()),compact('masterdocum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // if (Auth::user()->id==5) {
        if (Auth::user()->hasAnyRole(['Document Registrar']) || auth()->user()->hasAnyRole(['Admin'])) {
            $docum=Masterdocregister::where('slug',$slug)->first();

            return view('admin.masterdocumentregister.edit',array('user'=>Auth::user()),compact('docum'));
        } else {
            return redirect()->back()->with('deleted','You do not have the privilege to perform this task!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request,[
            'doctitle'=>'required|min:3',
            'docnumber'=>'required|min:3|max:23',
            'revisionstatus'=>'required',
            'dateprepared'=>'required',
            'docfilename.*' => 'mimes:pdf'
        ]);


        //uploading document register 
        if ($request->hasFile('docfilename')) {
            
                $filename=time().'.'.$request->docfilename->getClientOriginalExtension();
                $request->docfilename->storeAs('public/master_document_registers/', $filename);
                
                $documreg=Masterdocregister::where('slug',$slug)->first();

                if ($documreg->doctitle==$request->doctitle && $documreg->docnumber==$request->docnumber) {
                    $documreg->user_id=$request->user_id;
                    $documreg->revisionstatus=$request->revisionstatus;
                    $documreg->dateprepared=$request->dateprepared;
                    $documreg->description=$request->description;
                    $documreg->filename=$filename;
                    
                    $documreg->save();
                }else{
                    $documreg->doctitle=$request->doctitle;
                    $documreg->slug=Str::slug($request->doctitle);
                    $documreg->docnumber=$request->docnumber;
                    $documreg->user_id=$request->user_id;
                    $documreg->revisionstatus=$request->revisionstatus;
                    $documreg->dateprepared=$request->dateprepared;
                    $documreg->description=$request->description;
                    $documreg->filename=$filename;
                    
                    $documreg->save();   
                }
                
                //redirect to all documents
                // return redirect()->route('documentregisters.index')->with('success','Document with number '.$documreg->docnumber.' edited successfully!');
            }
            
            
            if (!$request->hasFile('docfilename')) {
                $documreg=Masterdocregister::where('slug',$slug)->first();

                if ($documreg->doctitle==$request->doctitle && $documreg->docnumber==$request->docnumber) {
                    $documreg->user_id=$request->user_id;
                    $documreg->revisionstatus=$request->revisionstatus;
                    $documreg->dateprepared=$request->dateprepared;
                    $documreg->description=$request->description;
                                        
                    $documreg->save();
                }else{
                    $documreg->doctitle=$request->doctitle;
                    $documreg->slug=Str::slug($request->doctitle);
                    $documreg->docnumber=$request->docnumber;
                    $documreg->user_id=$request->user_id;
                    $documreg->revisionstatus=$request->revisionstatus;
                    $documreg->dateprepared=$request->dateprepared;
                    $documreg->description=$request->description;
                                        
                    $documreg->save();   
                }
            }
            
            //redirect to all documents
            return redirect()->route('documentregisters.index')->with('success','Document with number '.$documreg->docnumber.' edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deleting  file from the database
        $documreg=Masterdocregister::find($id);
        $documreg->delete();

        //deleting manifesto files from folder
        File::delete([public_path('storage/master_document_registers/' . $documreg->filename)]);

        //redirecting page
        return redirect()->back()->with('deleted','Document with number '.$documreg->docnumber.' has been deleted successfully!');
    }


    public function approve($id){
        $documreg=Masterdocregister::find($id);
        $documreg->isapproved='1';
        $documreg->save();

        return redirect()->back()->with('success', 'Document with number '.$documreg->docnumber.' has been approved successfully!');
    }

    public function viewuploadedfile($filename){
        $uploadedfile=Masterdocregister::where('filename',$filename)->first();
        return view('admin.masterdocumentregister.mdrfileview',array('user'=>Auth::user()),compact('uploadedfile'));
    }

    public function viewmasterdocregister($filename){
        
        // file path
         $path = public_path('storage/master_document_registers/'. $filename);
          // header
         $header = [
           'Content-Type' => 'application/pdf',
           'Content-Disposition' => 'inline; filename="' . $filename . '"'
         ];
        return response()->file($path, $header);
    }

}
