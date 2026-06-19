<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('foto')) {
            // Delete old photo if it exists and is not the default
            if ($user->foto && file_exists(public_path('img/' . $user->foto))) {
                unlink(public_path('img/' . $user->foto));
            }

            // Upload new photo
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/users'), $fileName);
            
            // Save path to DB
            $user->foto = 'users/' . $fileName;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'siswa') {
            $request->validate([
                'name' => 'required|string|max:255',
                'nis' => 'required|string|max:50|unique:users,nis,' . $user->id,
                'class' => 'required|string|max:50',
            ]);

            $user->name = $request->name;
            $user->nis = $request->nis;
            $user->class = $request->class;
        } elseif ($user->role === 'guru') {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
