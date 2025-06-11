<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  if (Auth::check() && Auth::user()->reset_code) {
        //     return $next($request);
        // }
        // return redirect('/')->with('error', 'Unauthorized access or reset already completed.');

        if(Auth::guard('web')->check()) { 
            redirect("/");
        }
        return $next($request);
    }
}
