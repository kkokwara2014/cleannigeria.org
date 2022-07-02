<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Category;
use App\Contact;
use App\Country;
use App\Models\User as ModelsUser;
use App\Product;
use App\Shop;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['admin'])->except(['index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $allAdmins = User::where('role_id', '1')->count();
        $allStaffs = User::where('role_id', '2')->count();

        return view('admin.index', compact('user', 'allAdmins','allStaffs'));
    }

    public function admins()
    {

            $admins = User::where('role_id', '1')->get();
            return view('admin.admins.index', array('user' => Auth::user()), compact('admins'));

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
        $this->validate($request, [
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->isactive = $request->isactive;

        $user->save();

        return redirect(route('all.admin'))->with('success', 'New Admin has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admins = User::find($id);
            return view('admin.admins.show', array('user' => Auth::user()), compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
