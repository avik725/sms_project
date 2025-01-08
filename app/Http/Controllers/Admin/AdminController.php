<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function Dashboard()
    // {
    //     return view('admin/dashboard/index'); 
    // }
    public function Dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Set headers to prevent caching
        return response()
            ->view('admin/dashboard')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }


    public function Admin()
    {
        return view('login'); // admin login form route
    }



    // public function Login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials) && auth()->user()->is_admin) {
    //         return redirect()->intended('admin');  // add the wri of admin dashboard route in web.php
    //     }
    //     return back()->withErrors(['email' => 'Invalid credentials or not an admin.']);
    // }

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();
            // Redirect to dashboard
            return redirect()->route('dashboard')->with('isLoggedIn', true);
        }
        // If login fails, return back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // public function Logout()
    // {
    //     Auth::logout();
    //     return redirect('admin/login');  // redirected to login page 
    // }

    public function Logout()
    {
        Auth::logout();
        session()->invalidate();   // Invalidate the session
        session()->regenerateToken();   // Regenerate the CSRF token
        // In your logout function
        session()->forget('isLoggedIn');
        return redirect('admin/login');
    }
}
