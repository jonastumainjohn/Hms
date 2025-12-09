<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlySuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
    if (auth()->user()->type != 'superAdmin') {
        // Redirect to the login page if not authenticated or not a superAdmin
        return redirect()->route('admin.login')->with('error', 'You are not allowed to access this page!');
    }
        return $next($request);

    }
}
