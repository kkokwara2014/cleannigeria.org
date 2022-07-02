<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class UserController extends Controller
{
    public function profileimage()
    {
        return view('admin.user.profile', array('user' => Auth::user()));
    }

    public function updateprofileimage(Request $request)
    {
        $this->validate($request, [
            'userimage' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('userimage')) {
            $userimage = $request->file('userimage');
            $filename = time() . '.' . $userimage->getClientOriginalExtension();
            Image::make($userimage)->resize(300, 300)->save(public_path('user_images/' . $filename));

            $user = User::find(auth()->user()->id);
            $user->userimage = $filename;
            $user->profileupdated = '1';
            $user->save();
        }

        if (Auth::user()->profileupdated==1) {
            return redirect()->route('dashboard.index');
        }else{
            return view('admin.user.profile', array('user' => Auth::user()));
        }

    }
}
