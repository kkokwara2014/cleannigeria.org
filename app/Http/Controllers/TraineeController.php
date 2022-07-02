<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alltrainees=Trainee::latest()->get();

        return view('admin.traineecertificate.trainee.index',array('user'=>Auth::user()),compact('alltrainees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.traineecertificate.trainee.create',array('user'=>Auth::user()));
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
            'lastname'=>'required|min:3',
            'firstname'=>'required|min:3',
            'traineeemail'=>'required|unique:trainees',
            'phone'=>'required|unique:trainees',
            'companyname'=>'required|min:3',
        ]);

        $trainee=new Trainee();
        $trainee->lastname=$request->lastname;
        $trainee->firstname=$request->firstname;
        $trainee->othername=$request->othername;
        $trainee->traineeemail=$request->traineeemail;
        $trainee->phone=$request->phone;
        $trainee->companyname=$request->companyname;
        $trainee->user_id=Auth::user()->id;
        
        $trainee->save();

        return redirect()->route('trainees.index')->with('success','New Trainee created successfully! ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainee=Trainee::where('id',$id)->first();

        return view('admin.traineecertificate.trainee.edit',array('user'=>Auth::user()),compact('trainee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'lastname'=>'required|min:3',
            'firstname'=>'required|min:3',
            'traineeemail'=>'required',
            'phone'=>'required',
            'companyname'=>'required|min:3',
        ]);

        $trainee=Trainee::find($id);

        if ($trainee->traineeemail==$request->traineeemail && $trainee->phone==$request->phone) {
            $trainee->lastname=$request->lastname;
            $trainee->firstname=$request->firstname;
            $trainee->othername=$request->othername;
            $trainee->companyname=$request->companyname;
            $trainee->user_id=Auth::user()->id;
            
            $trainee->save();

            return redirect()->route('trainees.index')->with('success','Trainee edited successfully! ');
        } else {
            
            $trainee->lastname=$request->lastname;
            $trainee->firstname=$request->firstname;
            $trainee->othername=$request->othername;
            $trainee->traineeemail=$request->traineeemail;
            $trainee->phone=$request->phone;
            $trainee->companyname=$request->companyname;
            $trainee->user_id=Auth::user()->id;
            
            $trainee->save();

            return redirect()->route('trainees.index')->with('success','Trainee edited successfully! ');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainee=Trainee::find($id);

        $trainee->delete();

        return redirect()->back()->with('deleted', 'Trainee called '.$trainee->lastname.' has been deleted successfully!');
    }
}
