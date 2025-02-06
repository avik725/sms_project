<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Use View::composer('*', function()) to share data with all views
        View::composer('*', function ($view) {
            $user = null;
            $userGuard = 'guest';

            // Check if an admin or staff is logged in
            if (Auth::guard('admin')->check()) {
                $user = Auth::guard('admin')->user();
                $userGuard = 'admin';
            } elseif (Auth::guard('staff')->check()) {
                $user = Auth::guard('staff')->user();
                $userGuard = 'staff';
            }

            // Share variables with all views
            $view->with('user', $user);
            $view->with('userGuard', $userGuard);
        });
    }
}
