<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // && Auth::user()->role->id != 2 && Auth::user()->role->id != 3
        if (Auth::check() && (!Auth::user()->hasAnyRole('Super Admin') || !Auth::user()->hasAnyRole('Admin'))) {
            return redirect()->back();
        }
        return $next($request);
    }
}
