<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() == false){
            return redirect('/');
        }

        else if (\Auth::user() && \Auth::user()->user_role_id == 3) 
        {
            return $next($request);
        } 
        else 
        {
            return redirect('/'); 
        }
    }
}
