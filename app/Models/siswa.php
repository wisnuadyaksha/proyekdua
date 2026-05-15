<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nis', 
        'nama_siswa', 
        'kelas', 
        'password',
        'role' 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Pastikan password otomatis di-hash saat disimpan
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}