<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Location;
use App\Models\Maintrequest;
use App\Models\Role;
use App\Models\Staffcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners=User::with(['company'])->where('staffcategory_id','3')->latest()->get();

        return view('admin.partners.index',array('user'=>Auth::user()),compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasAnyRole(['Admin'])) {
            $staffroles=Role::where('id','>','1')->orderBy('name','asc')->get();
            $staffcategories=Staffcategory::orderBy('name','asc')->get();
            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();
            $companies=Company::where('id','>','1')->orderBy('name','asc')->get();

            return view('admin.partners.create',array('user' => Auth::user()), compact('staffroles','staffcategories','locations','companies'));
        } else {
            return redirect()->back();
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
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required|unique:users|min:11',
        ]);

        $partner_password=rand(2345670,8901234);

        $partner = new User;
        $partner->lastname = $request->lastname;
        $partner->firstname = $request->firstname;
        $partner->email = $request->email;
        $partner->phone = $request->phone;
        $partner->password = bcrypt($partner_password);
        $partner->staffcategory_id = $request->staffcategory_id;
        $partner->location_id = $request->location_id;
        $partner->company_id = $request->company_id;
    
        $partner->save();

        //attaching newly created staff to a role
        $partnerRole=Role::where('name','Staff')->first();
        $partner->roles()->attach($partnerRole);

       SMSController::sendPasswordToNewPartnerBySMS($partner, $partner_password);
      
       

        // EmailController::sendEmailToNewPartner($partner,$partner_password);
       

        return redirect(route('cnapartners.index'))->with('success', 'New CNA Partner added successfully!');
    }

     // sending Password by SMS method
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner=User::find($id);
        $usermaintrequest=User::with(['maintrequests'])->where('id',$id)->first();
       
        return view('admin.partners.show',array('user' => Auth::user()), compact('partner','usermaintrequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['Admin'])) {
            $partner=User::find($id);
            $staffroles=Role::where('id','>','1')->orderBy('name','asc')->get();
            $staffcategories=Staffcategory::orderBy('name','asc')->get();
            $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();
            $companies=Company::where('id','>','1')->orderBy('name','asc')->get();
            return view('admin.partners.edit',array('user' => Auth::user()), compact('partner','staffroles','staffcategories','locations','companies'));
        } else {
           return redirect()->back();
        }
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
        $partner = User::find($id);
        $partner->lastname = $request->lastname;
        $partner->firstname = $request->firstname;
        $partner->email = $request->email;
        $partner->phone = $request->phone;
        
        // $partner->staffcategory_id = $request->staffcategory_id;
        $partner->location_id = $request->location_id;
        $partner->company_id = $request->company_id;
    
        $partner->save();

        return redirect(route('cnapartners.index'))->with('success', 'CNA Partner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $partner)
    {
        //deleting files from folder
       File::delete([public_path('user_images/' . $partner->id)]);

       //deleting  partner details from the database
        $partner->delete();
        return redirect()->back()->with('Partner deleted successfully!');
    }
}
