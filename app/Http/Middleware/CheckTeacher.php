<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;

class CheckTeacher
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

        else if (\Auth::user() && \Auth::user()->user_role == 'teacher') 
        {
            return $next($request);
        } 
        else 
        {
            return redirect('/');
        }
    }
}
