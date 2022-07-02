<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyRole(['Admin'])) {
            $staffs=User::latest()->get();
            return view('admin.manageuser.index',array('user'=>Auth::user()),compact('staffs'));
        } else {
            return redirect()->route('access.denied');
        }
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
        //
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
        if (Auth::user()->id==$id) {
            return redirect()->route('manageusers.index')->with('success','You are not allowed to edit yourself!');
        }
        $staff=User::find($id);
        $roles=Role::orderBy('name','asc')->get();
        return view('admin.manageuser.edit',array('user'=>Auth::user()),compact('staff','roles'));
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
        if (Auth::user()->id==$id) {
            return redirect()->route('manageusers.index')->with('success','You are not allowed to edit yourself!');
        }

        $user=User::find($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('manageusers.index')->with('success','Staff Role has been managed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id==$id) {
            return redirect()->route('manageusers.index')->with('deleted','You are not allowed to delete yourself!');
        }

        $user=User::find($id);
        $user->delete();

        return redirect()->route('manageusers.index')->with('success','Staff deleted successfully!');
    }
}
