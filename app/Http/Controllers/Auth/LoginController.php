<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Loginaudit;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','userLogout']);
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $req)
    {
    
        $user = User::whereEmail($req->email)->first();
        if ($user)
        {
            Auth::login($user);

            return redirect()->intended('dashboard.index');
        }

        return redirect()->route('login');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        
        if (is_numeric($request->email)) {
            return ['phone'=>$request->email,'password'=>$request->password, 'isactive' => 1];
        }elseif($request->email){
            return ['email'=>$request->email,'password'=>$request->password, 'isactive' => 1];
        }
        return $request->only($this->username(), 'password');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function userLogout(Request $request)
    {
        if (Auth::check()) {
        //updating the last login time of the user
        $user=User::find(auth()->user()->id);
        $user->last_login_at=$user->login_at;
        $user->save();

        Auth::logout();

        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        
        return redirect()->route('login');
        }

        return redirect()->route('login');
    }

    protected function authenticated(Request $request, $user)
    {
        
        if ($user->profileupdated==0) {
            //saving the users last login and ip address
            Auth::logoutOtherDevices($request->password);
            $user->login_at=Carbon::now()->toDateTimeString();
            $user->last_login_ip=$request->getClientIp();
            $user->save();

            return redirect()->route('user.profile');
        }
        return redirect()->route('dashboard.index');
    }

    protected function sendLoginResponse(Request $request)
    {
        //getting user details while logging in
        $login=new Loginaudit();
        $login->user_id=auth()->id();
        $login->ipaddress=$request->getClientIp();
        $login->device=$request->userAgent();
        $login->save();

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
}
