<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
    * Display the login view.
    */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
    * Handle an incoming authentication request.
    */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        $user = auth()->user(); // Get authenticated user
    
        if ($user->hasRole('admin')) {
            return redirect('/admin'); // Redirect to admin dashboard
        }  else {
            return redirect('/products'); // Redirect to home for other users
        }
    
        return redirect('/home'); // Default redirect for other users
    }

    /**
    * Destroy an authenticated session.
    */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}