<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;

class CheckDocentAdmin
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
        if (\Auth::user() && \Auth::user()->user_role === 1 || \Auth::user()->user_role === 2) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
