<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\DashboardController;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if the user is not authenticated with the 'admin' guard
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login'); // Update with your actual admin login route name
        }

        return $next($request);
    }
}
