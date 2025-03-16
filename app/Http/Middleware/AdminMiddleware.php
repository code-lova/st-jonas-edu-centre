<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return $next($request);
            } else{
               // Redirect users based on their role
               if (Auth::user()->role === 'teacher') {
                return redirect('/teacher/dashboard')->with('error', 'Access Denied: You are not an Admin');
            } elseif (Auth::user()->role === 'student') {
                return redirect('/student/dashboard')->with('error', 'Access Denied: You are not an Admin');
            }

            // Default redirect if the role is unknown
            return redirect('/')->with('error', 'Access Denied: Unauthorized Role');
            }
        }
        else{
            return redirect('/teachers-portal')->with('message', 'Please Login to Continue');
        }
    }
}
