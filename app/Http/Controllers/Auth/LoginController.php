<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() { return view('auth.login'); }

    public function login(Request $request)
{
    $login_input = $request->input('login_input');
    $password = $request->input('password');

    // Tentukan kolom (Email untuk Admin, NIS untuk Siswa)
    $fieldType = filter_var($login_input, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

    $request->validate([
        'login_input' => 'required',
        'password'    => 'required',
    ]);

    $credentials = [
        $fieldType => $login_input,
        'password' => $password,
    ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        $user = Auth::user();

        // LOGIKA REDIRECT YANG LEBIH TEGAS
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } 
        
        if ($user->role === 'siswa') {
            return redirect()->route('dashboard.siswa');
        }

        // Kalau role gak jelas, lempar ke home
        return redirect('/');
    }

    return back()->withErrors([
        'login_input' => 'Kredensial tidak cocok dengan data kami.',
    ])->onlyInput('login_input');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}