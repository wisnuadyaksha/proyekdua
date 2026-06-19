<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $role = $request->input('role');

        // Validasi dasar
        $rules = [
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:siswa,guru',
            'foto'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
        ];

        // Validasi tambahan berdasarkan role
        if ($role === 'siswa') {
            $rules['nis']   = 'required|string|max:50|unique:users,nis';
            $rules['class'] = 'required|string|max:50';
        } else {
            $rules['email'] = 'required|email|unique:users,email';
        }

        $request->validate($rules);

        // Upload Foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/users'), $fileName);
            $fotoPath = 'users/' . $fileName;
        }

        // Buat user baru
        $userData = [
            'name'     => $request->name,
            'password' => $request->password,
            'role'     => $role,
            'foto'     => $fotoPath,
        ];

        if ($role === 'siswa') {
            $userData['nis']   = $request->nis;
            $userData['class'] = $request->class;
            // Siswa otomatis terverifikasi (tidak pakai email)
            $userData['email_verified_at'] = now();
        } else {
            $userData['email'] = $request->email;
            // Guru belum terverifikasi
            $userData['email_verified_at'] = null;
        }

        $user = User::create($userData);

        // Langsung login
        Auth::login($user);

        // Jika Guru, kirim email verifikasi dan arahkan ke halaman notifikasi
        if ($role === 'guru') {
            $user->sendEmailVerificationNotification();
            return redirect()->route('verification.notice')
                ->with('info', 'Akun berhasil dibuat! Silakan cek email ' . $user->email . ' untuk memverifikasi akun Anda.');
        }

        return redirect()->route('dashboard.siswa')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    }
}
