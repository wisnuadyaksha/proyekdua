<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() 
    { 
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_input' => 'required',
            'password'    => 'required',
            'role_target' => 'required' // Tambahkan hidden input di form: 'siswa' atau 'admin'
        ]);

        $login_input = $request->input('login_input');
        $password = $request->input('password');
        $roleTarget = $request->input('role_target');

        // Tentukan kolom (Email untuk Admin, NIS untuk Siswa)
        $fieldType = filter_var($login_input, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        $credentials = [
            $fieldType => $login_input,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userRole = trim(strtolower($user->role));

            // VALIDASI: Apakah role user sesuai dengan form yang digunakan?
            if ($userRole !== trim(strtolower($roleTarget))) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'login_input' => "Akun Anda terdaftar sebagai $userRole, tidak bisa login di form $roleTarget.",
                ])->onlyInput('login_input');
            }

            $request->session()->regenerate();

            // Redirect sesuai role yang sudah divalidasi
            if ($userRole === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } 
            
            if ($userRole === 'siswa') {
                return redirect()->intended('/siswa/dashboard');
            }

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