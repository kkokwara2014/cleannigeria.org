<?php

namespace App\Http\Controllers;

use App\Models\Competenceassessment;
use App\Models\Competenceassessmentuser;
use App\Models\Comptassapproval;
use App\Models\Dispersant;
use App\Models\Fateoilskill;
use App\Models\Fatraining;
use App\Models\Forkliftop;
use App\Models\Gastesting;
use App\Models\Hsrisk;
use App\Models\Hsriskmgt;
use App\Models\Hsworkenvironment;
use App\Models\Impactoilpollution;
use App\Models\Incidentmgt;
use App\Models\Inlandresponse;
use App\Models\Legend;
use App\Models\Location;
use App\Models\Miscinnorespskill;
use App\Models\Offshoreresponse;
use App\Models\Operationhandover;
use App\Models\Powerdrivenscop;
use App\Models\Responseequip;
use App\Models\Role;
use App\Models\Selfloaderop;
use App\Models\Shorelineresponse;
use App\Models\Staffcategory;
use App\Models\Survmodelvisualization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffroles=Role::where('id','>','1')->orderBy('name','asc')->get();
        $staffs=User::latest()->get();
        $staffcategories=Staffcategory::orderBy('name','asc')->get();
        $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();

        return view('admin.staff.index',array('user' => Auth::user()), compact('staffroles','staffs','staffcategories','locations'));
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
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required|unique:users|min:11',
        ]);

        $user = new User;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->staffcategory_id = $request->staffcategory_id;
        $user->location_id = $request->location_id;
        // $user->role_id = $request->role_id;

        $user->save();

        //attaching newly created staff to a role
        // $userRole=Role::where('id',$request->role_id)->first();
        $userRole=Role::where('name','Staff')->first();
        $user->roles()->attach($userRole);


        //notify CNA email center
        $cna_email_center=User::where('email','info@cleannigeria.org')->first();
        // $cna_email_center->notify(new NewStaffNotification($user));

        //new staff private notification
        // $user->notify(new NewStaffPrivateNotification($user));


        return redirect(route('staff.index'))->with('success', 'New Staff created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $staff)
    {
        // $staff = User::find($staff->id);

        $staff_id=$staff->id;

        $comptassusers=Competenceassessmentuser::latest()->where('user_id',$staff->id)->simplePaginate(5);

        $allassessors=User::all();
        
        $senttosuperiors=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'General Manager')
                // ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'East Regional Superintendent')
                ->orWhere('name', '=', 'West Regional Superintendent')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();

        return view('admin.staff.show', array('user' => Auth::user()), compact('staff','comptassusers','staff_id','allassessors','senttosuperiors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        $staffroles=Role::where('id','>','1')->orderBy('name','asc')->get();
        
        // $staff = User::where('id',$staff->id)->first();
        $staffcategories=Staffcategory::orderBy('name','asc')->get();
        $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();

        return view('admin.staff.edit', array('user' => Auth::user()), compact('staff','staffroles','staffcategories','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        // $user =User::find($staff->id);
        $staff->lastname = $request->lastname;
        $staff->firstname = $request->firstname;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        // $staff->password = bcrypt($request->password);
        // $staff->password = bcrypt($request->phone);
        $staff->staffcategory_id = $request->staffcategory_id;
        $staff->location_id = $request->location_id;
        // $staff->role_id = $request->role_id;

        $staff->save();

        //assigning staff to a new selected role
        $userRole=Role::where('id',$request->role_id)->first();
        $staff->roles()->sync($userRole);

        return redirect(route('staff.index'))->with('success', 'Staff updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $staff)
    {
       //deleting files from folder
       File::delete([public_path('user_images/' . $staff->id)]);

       //deleting  files from the database
       $staff->delete();

       //redirecting page
       return redirect()->back()->with('deleted','Staff deleted successfully!');
    }

    public function activate($id)
    {
        $admin = User::find($id);
        $admin->isactive = '1';
        $admin->save();

        return back();
    }
    public function deactivate($id)
    {
        $admin = User::find($id);
        $admin->isactive = '0';
        $admin->save();

        return back();
    }

    public function showcomptass($comptassid,$staffid){

        $comptass=Competenceassessment::find($comptassid);
        $staff_id=$staffid;
        $staff=User::find($staff_id);

        $legends=Legend::orderBy('name','asc')->get();

        // $assessors=Competenceassessmentuser::where('competenceassessment_id',$comptassid)->get();
        $assessor=Competenceassessmentuser::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();

        //getting 
        $hsworkenv=Hsworkenvironment::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $hsrisk=Hsrisk::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $hsriskmgt=Hsriskmgt::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $fatraining=Fatraining::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $gastesting=Gastesting::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $ophandover=Operationhandover::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $forkliftop=Forkliftop::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $selfloader=Selfloaderop::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $powerdriven=Powerdrivenscop::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $respequip=Responseequip::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $miscresp=Miscinnorespskill::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $fateoil=Fateoilskill::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $impoilpollu=Impactoilpollution::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $survmodviz=Survmodelvisualization::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $offshoreresp=Offshoreresponse::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $dispers=Dispersant::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $shorelineresp=Shorelineresponse::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $inlandresp=Inlandresponse::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $incidmgt=Incidentmgt::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();


        $comptassuser=Competenceassessmentuser::where('competenceassessment_id',$comptass->id)->where('user_id',$staff_id)->first();
        $comptassapproval=Comptassapproval::where('competenceassessmentuser_id',$comptassuser->id)->where('user_id',$staff_id)->first();
        

        // $senttosuperiors=User::where('id',5)->orWhere('id',7)->orWhere('id',8)->get();
        // $finalassessors=User::where('id',5)->get();

        $allassessors=User::all();
        
        $senttosuperiors=User::with(['roles'])->whereHas('roles', function($query) {
            $query->where('name', '=', 'General Manager')
                // ->orWhere('name', '=', 'Admin')
                ->orWhere('name', '=', 'Accounts & Admin Manager')
                ->orWhere('name', '=', 'East Regional Superintendent')
                ->orWhere('name', '=', 'West Regional Superintendent')
                ->orWhere('name', '=', 'East Regional Supervisor')
                ->orWhere('name', '=', 'West Regional Supervisor');
        })->get();
        $finalassessors=$senttosuperiors;
        //notify staff of the assessment


        // return $comptassapproval;

        return view('admin.staff.comptass_details',array('user'=>Auth::user()),
        compact('comptass','staff_id',
        'staff','hsworkenv',
        'hsrisk','hsriskmgt',
        'fatraining','gastesting',
        'ophandover','forkliftop',
        'respequip','miscresp',
        'selfloader','powerdriven',
        'fateoil','impoilpollu',
        'survmodviz','offshoreresp',
        'dispers','shorelineresp',
        'inlandresp','incidmgt',
        'assessor','legends',
        'comptassuser','comptassapproval',
        'senttosuperiors',
        'finalassessors',
        'allassessors'
        ));

    }

    public function editStaffDetails($id){

        $staff = User::where('id',$id)->first();
        $staffcategories=Staffcategory::orderBy('name','asc')->get();
        $locations=Location::orderBy('name','asc')->where('isapproved','1')->get();
        $roles=Role::where('id','>','1')->orderBy('name','asc')->get();

        return view('admin.staff.editstaffdetails', array('user' => Auth::user()), compact('staff','staffcategories','locations','roles'));
    }

    public function updateStaffDetails(Request $request, $id){

        $this->validate($request,[
            'lastname'=>'required',
            'firstname'=>'required',
            'staffcategory_id'=>'required',
            'location_id'=>'required',
        ]);
        
        $user =User::find($id);

        if ($user->email==$request->email || $user->phone==$request->phone) {
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->staffcategory_id = $request->staffcategory_id;
            $user->location_id = $request->location_id;
            $user->role_id = $request->role_id;
            $user->save();
            return redirect()->route('dashboard.index')->with('success', 'Staff details updated successfully!');
        }else{
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->staffcategory_id = $request->staffcategory_id;
            $user->location_id = $request->location_id;
            $user->role_id = $request->role_id;
            $user->save();

            return redirect()->route('dashboard.index')->with('success', 'Staff details updated successfully!');
        }
    }

    public function changeStaffPassword(Request $request){
        
        $userpassword=User::find(auth()->user()->id);
        $userpassword->password=bcrypt($request->password);
        $userpassword->save();

        return redirect()->back()->with('success','Password changed successfully!');
    }

    public function viewuploadedfile($filename){
        
        // file path
         $path = public_path('storage/staff_appraisal_documents' . '/' . $filename);
          // header
         $header = [
           'Content-Type' => 'application/pdf',
           'Content-Disposition' => 'inline; filename="' . $filename . '"'
         ];
        return response()->file($path, $header);
    }

}
