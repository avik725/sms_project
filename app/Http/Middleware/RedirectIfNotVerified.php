<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotVerified
{
    public function handle($request, Closure $next)
    {
        // Check if the user is not authenticated with the 'admin' guard
        if (Auth::guard('admin')->check()) {
            Auth::shouldUse('admin'); // Force Laravel to use admin guard
        } elseif (Auth::guard('staff')->check()) {
            Auth::shouldUse('staff'); // Force Laravel to use staff guard
        } else {
            return redirect()->route('staff/login'); // Redirect if neither is authenticated
        }

        
        return $next($request);
    }
}
