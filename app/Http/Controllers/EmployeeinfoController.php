<?php

namespace App\Http\Controllers;

use App\Models\Employeeinfo;
use App\Models\Location;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employeeinfo::latest()->get();
        
        return view('admin.employeeinfo.index', array('user' => Auth::user()), compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->updateempinfo==0) {
            $locations = Location::where('isapproved','1')->orderBy('name','asc')->get();
            $states=State::orderBy('name','asc')->get();
            return view('admin.employeeinfo.create', array('user' => Auth::user()), compact('locations','states'));
            
        } else {
            return redirect()->back()->with('success','You have filled the Employee Information form!');
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
        
        $empinfo=new Employeeinfo();
        $empinfo->user_id=auth()->user()->id;
        $empinfo->state_id=$request->state_id;
        $empinfo->lga_id=$request->lga_id;
        $empinfo->location_id=$request->location_id;
        $empinfo->title=$request->title;
        $empinfo->address=$request->address;
        $empinfo->city=$request->city;
        $empinfo->dob=$request->dob;
        $empinfo->maritalstatus=$request->maritalstatus;
        $empinfo->spousename=$request->spousename;
        $empinfo->spouseemployer=$request->spouseemployer;
        $empinfo->spousephone=$request->spousephone;
        $empinfo->qualification=$request->qualification;
        $empinfo->profession=$request->profession;
        $empinfo->jobtitle=$request->jobtitle;
        $empinfo->supervisor=$request->supervisor;
        $empinfo->dateofemployment=$request->dateofemployment;
        $empinfo->contractenddate=$request->contractenddate;
        $empinfo->nextofkin=$request->nextofkin;
        $empinfo->nokaddress=$request->nokaddress;
        $empinfo->nokphone=$request->nokphone;
        $empinfo->nokrelationship=$request->nokrelationship;
        $empinfo->acceptdeclaration='1';
        $empinfo->save();

        //update user's record
        $user=User::find($empinfo->user_id);
        $user->updateempinfo='1';
        $user->save();

        return redirect()->route('employees.index')->with('success','Thank you for completing and submitting the Employee Information form.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $employee = Employeeinfo::find($id);
        
        return view('admin.employeeinfo.show', array('user' => Auth::user()), compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employeeinfo::find($id);
        $locations = Location::where('isapproved','1')->orderBy('name','asc')->get();
        $states=State::orderBy('name','asc')->get();
        
        return view('admin.employeeinfo.edit', array('user' => Auth::user()), compact('employee','locations','states'));
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
        $empinfo=Employeeinfo::find($id);
        $empinfo->user_id=auth()->user()->id;
        $empinfo->state_id=$request->state_id;
        $empinfo->lga_id=$request->lga_id;
        $empinfo->location_id=$request->location_id;
        $empinfo->title=$request->title;
        $empinfo->address=$request->address;
        $empinfo->city=$request->city;
        $empinfo->dob=$request->dob;
        $empinfo->maritalstatus=$request->maritalstatus;
        $empinfo->spousename=$request->spousename;
        $empinfo->spouseemployer=$request->spouseemployer;
        $empinfo->spousephone=$request->spousephone;
        $empinfo->qualification=$request->qualification;
        $empinfo->profession=$request->profession;
        $empinfo->jobtitle=$request->jobtitle;
        $empinfo->supervisor=$request->supervisor;
        $empinfo->dateofemployment=$request->dateofemployment;
        $empinfo->contractenddate=$request->contractenddate;
        $empinfo->nextofkin=$request->nextofkin;
        $empinfo->nokaddress=$request->nokaddress;
        $empinfo->nokphone=$request->nokphone;
        $empinfo->nokrelationship=$request->nokrelationship;
        $empinfo->acceptdeclaration='1';
        $empinfo->save();

        //update user's record
        $user=User::find($empinfo->user_id);
        $user->updateempinfo='1';
        $user->save();

        return redirect()->route('employees.index')->with('success','Thank you for  updating your record!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $creator=Auth::user()->id;

        $empinfo=Employeeinfo::find($id);

        if ($creator==$empinfo->user_id || Auth::user()->hasAnyRole(['Admin'])|| Auth::user()->hasAnyRole(['General Manager'])) {
            
            //update user's record before deleting his employee record.
            $user=User::find($creator);
            $user->updateempinfo='0';
            $user->save();
            
            $empinfo->delete();

            return redirect()->back()->with('deleted','Employee Information deleted successfully!');
        }else{

            return redirect()->back()->with('deleted','You did not create this record, therefore you are not authorized to delete it!');
        }
    }
}
