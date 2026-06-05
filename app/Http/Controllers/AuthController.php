<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Get the authenticated user instance
            $user = Auth::user();

            // Role-Based Redirection matching user_type strings exactly
            if ($user->user_type === 'Root') {
                return redirect()->route('admin.home');
            }

            if ($user->user_type === 'Student') {
                return redirect()->route('student.home');
            }

            // Fallback default dashboard route
            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    // Show Registration Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Registration Request
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Note: We remove Auth::login($user); so they are forced to log in manually after registering.

        // Redirect to login view with a success flash session message
        return redirect()->route('login')->with('success', 'Account created successfully! Wait for admin approval');
    }

    // Handle Logout Request
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
