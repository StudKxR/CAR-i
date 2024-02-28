<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRoles = Auth::user()->roles;
    
            // Check if the user's role matches any of the roles passed as parameters
            if (in_array($userRoles, $roles)) {
                return $next($request);
            }
        }

        // If the user's role doesn't match, redirect back or to another route
        return redirect()->back()->with('error', 'Unauthorized access.');
    }
}
