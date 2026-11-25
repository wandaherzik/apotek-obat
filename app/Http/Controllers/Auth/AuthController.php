<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        return view('layouts.auth.login');
    }

    /**
     * Proses autentikasi
     */
public function authenticate(Request $request)
{
    $credentials = $request->validate([

        'username'=>'required',

        'password'=>'required'

    ]);

    if(Auth::attempt($credentials))
    {
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()->with('error','Username atau Password salah.');
}

    /**
     * Logout
     */
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}