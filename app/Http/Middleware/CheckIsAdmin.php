<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- Important: Add this line

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in AND if their role is 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            // If they are an admin, allow them to proceed
            return $next($request);
        }

        // Otherwise, redirect them to the homepage
        return redirect('/');
    }
}