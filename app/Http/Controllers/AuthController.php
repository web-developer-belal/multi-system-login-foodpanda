<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Show login page
    public function home()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    // Show registration page
    public function registerPage()
    {
        return view('register');
    }

    // Handle user registration
    public function registerStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Sync user to foodpanda app
        try {
            // Http::post(env('SECOND_APP_URL').'/api/sync-user', [
            //     'name'     => $user->name,
            //     'email'    => $user->email,
            //     'password' => $user->password, 
            // ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->route('dashboard');
    }

    // Show dashboard
    public function dashboard()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }

    // Logout from both apps
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        try {
            // Http::withHeaders([
            //     'Accept' => 'application/json',
            // ])->post(env('SECOND_APP_URL').'/logout');
        } catch (\Exception $e) {
            // Log error if needed
            Log::error($e->getMessage());
        }

        return redirect()->route('home');
    }

}
