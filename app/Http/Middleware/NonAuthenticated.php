<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;

class NonAuthenticated
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
        if (Session::get('login')) {
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}
