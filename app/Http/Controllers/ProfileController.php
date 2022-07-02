<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function updateprofile(){
        return view('admin.staff.updateprofile',array('user'=>Auth::user()));
    }

    public function profileupdated(Request $request, $id){
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'password'=>'required|confirmed',
        ]);

        $staff=User::find($id);
        $staff->lastname=$request->lastname;
        $staff->firstname=$request->firstname;
        $staff->email=$request->email;
        $staff->phone=$request->phone;
        $staff->password=bcrypt($request->password);
        $staff->profileupdated=1;
        $staff->save();
               
        //attaching newly created staff to a role
        // $userRole=Role::where('name','Sales Staff')->first();
        // $staff->roles()->attach($userRole);

        return redirect()->route('dashboard')->with('success','Profile updated successfully!');
    }

    public function userprofile(){
        return view('admin.profile.userprofile',array('user'=>Auth::user()));
    }

    public function uploadprofileimage(Request $request){
        $this->validate($request, [
            'userimage' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('userimage')) {
            $userimage = $request->file('userimage');
            $filename = time() . '.' . $userimage->getClientOriginalExtension();
            Image::make($userimage)->resize(300, 300)->save(public_path('user_images/' . $filename));

            $user = User::find(auth()->user()->id);
            $user->profileupdated = '1';
            $user->userimage = $filename;
            $user->save();
        }

        return redirect()->back()->with('success','Profile image uploaded successfully!');
    }

    public function staffprofile($id){
        $staff=User::find($id);
        return view('admin.profile.staffprofile',array('user'=>Auth::user()),compact('staff'));
    }
}
