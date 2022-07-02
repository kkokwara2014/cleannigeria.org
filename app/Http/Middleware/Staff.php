<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Staff
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
        // if(Auth::check() && Auth::user()->role->id != 3){
        if(Auth::check() && Auth::user()->role->id != 3){
            return redirect()->back();
        }
        return $next($request);
    }
}
