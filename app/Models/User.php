<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'nis', 'class',
    ];

    /**
     * INI KUNCINYA NU!
     * Memberitahu Laravel kolom mana yang jadi identitas login (NIS atau Email)
     */
    public function getAuthIdentifierName()
    {
        // Jika input login mengandung '@', anggap itu email. Jika tidak, paksa pakai NIS.
        if (request()->has('login_input')) {
            return filter_var(request('login_input'), FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';
        }
        
        return 'email'; // Default balik ke email
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}