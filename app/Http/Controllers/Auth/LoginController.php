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

            // Validasi Role (agar Guru tidak bisa login via form Siswa, dll)
            if ($roleTarget && $userRole !== $roleTarget) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'login_input' => 'Akses ditolak. Pastikan Anda login melalui tab (' . ucfirst($userRole) . ') yang sesuai dengan peran akun Anda.',
                ])->onlyInput('login_input');
            }

            $request->session()->regenerate();

            // Redirect sesuai role yang sudah divalidasi
            if ($userRole === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } 
            
            if ($userRole === 'guru') {
                // Cek apakah guru sudah verifikasi email
                if (!$user->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice');
                }
                return redirect()->intended('/guru/dashboard');
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

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'login_input' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $login_input = $request->input('login_input');
        $fieldType = filter_var($login_input, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        $user = \App\Models\User::where($fieldType, $login_input)->first();

        if (!$user) {
            return back()->withErrors(['login_input' => 'Akun dengan NIS/Email tersebut tidak ditemukan.'])->onlyInput('login_input');
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui! Silakan login dengan sandi baru.');
    }
}