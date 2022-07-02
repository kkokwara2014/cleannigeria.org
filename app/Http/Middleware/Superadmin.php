<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(Auth::check() && (Auth::user()->role->id != 1 || Auth::user()->role->id != 2)){
        if(Auth::check() && (Auth::user()->hasAnyRole('Super Admin'))){
            return redirect()->back();
        }
        return $next($request);
    }
}
