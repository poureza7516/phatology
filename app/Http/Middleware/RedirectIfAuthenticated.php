<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        ////////////////////// back mizadi miraft to safhe  mariz ////////////////////
//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//
//        }
        ///////////////////////////////////////////////////////////////////

     return $next($request);
    }
}
