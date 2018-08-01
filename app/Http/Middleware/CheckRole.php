<?php

namespace App\Http\Middleware;

use Closure;

use App\User as User;
use Illuminate\Support\Facades\Auth;



class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        /*if ($request->user()->hasRole($role))
        {
            //return $next($request);
            echo $role;
        }*/


        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

         return abort(403, 'Access denied');

    }

}
