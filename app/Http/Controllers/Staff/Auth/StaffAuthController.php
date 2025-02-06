<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StaffLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class StaffAuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('StaffLogin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('staff')->attempt($request->only('email', 'password'))) {
            Auth::shouldUse('staff'); // Force Laravel to use 'staff' guard
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('staff')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('staff/login');
    }
}