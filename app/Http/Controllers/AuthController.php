<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ====== SHOW LOGIN ======
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view('auth.login');
    }

    // ====== LOGIN POST ======
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('profile'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput(['username' => $request->username]);
    }

    // ====== SHOW REGISTER ======
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view('auth.register');
    }

    // ====== REGISTER POST ======
    public function register(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|unique:users,email',
            'username'              => 'required|string|min:3|max:50|unique:users,username',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'email.unique'    => 'Email sudah terdaftar.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min'    => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('profile');
    }

    // ====== LOGOUT ======
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
