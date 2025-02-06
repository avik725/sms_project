<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareAuthData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        // Check which guard is logged in
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $userGuard = 'admin';
        } elseif (Auth::guard('staff')->check()) {
            $user = Auth::guard('staff')->user();
            $userGuard = 'staff';
        }

        // Share variables with all views
        View::share('user', $user);
        View::share('userGuard', $userGuard);

        return $next($request);
    }
}
