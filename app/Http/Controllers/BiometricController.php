<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Biometric;
use Illuminate\Http\Request;

class BiometricController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        $staffs = User::with('bio')->get();
        return view('admin.biometric.index', compact('user','staffs'));
    }

    public function add()
    {
        $user = Auth::user();
        return view('admin.biometric.add', compact('user'));
    }


   
    public function create()
    {
        $bios = Biometric::all();
        $users = User::all();
        return view('admin.biometric.create', compact('users', 'bios'));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['template']);

        $bio = new Biometric;
        $bio->template = $request->template;
        $bio->user_id = $request->user_id;
        $bio->created_by = Auth::user()->email;
        $bio->save();

        return response()->json('Your bio data have been capture and stored successfully. Thank you', 200);
    }

    
    public function show()
    {
         $bios = Biometric::get()->toArray();

         return json_encode($bios, true);
    }

    
    public function destroy($userId)
    {
        Biometric::whereUserId($userId)->delete();

        return redirect()->back()->with('deleted','Biometric data deleted successfully!');
    }
}
