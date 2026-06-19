<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'nis', 
        'class',
        'foto',
        'email_verified_at',
    ];

    /**
     * BIARKAN TETAP NIS ATAU EMAIL SECARA STATIS
     * Karena kamu punya NIS dan Email, biarkan Laravel tahu 
     * keduanya bisa jadi identitas, tapi di Controller sudah kita urus.
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Override: Siswa (yang pakai NIS) dianggap sudah terverifikasi otomatis.
     * Hanya Guru (yang punya email) yang wajib melewati verifikasi.
     */
    public function hasVerifiedEmail(): bool
    {
        // Siswa tidak memiliki email — langsung anggap terverifikasi
        if ($this->role === 'siswa') {
            return true;
        }

        return $this->email_verified_at !== null;
    }
}