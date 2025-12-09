<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorReceptMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is NOT a receptionist AND NOT a doctor
        if (auth()->user()->type !== 'receptionist' && auth()->user()->type !== 'doctor') {
            // Redirect to login page with an error message
            return redirect()->route('admin.login')->with('error', 'You are not allowed to access this page!');
        }
        return $next($request);
    }
}
