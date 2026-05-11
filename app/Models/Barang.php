<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memberitahu Laravel nama tabel yang benar
    protected $table = 'barang';

    // Tambahkan baris ini karena primary key Anda bukan 'id'
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'spesifikasi',
        'stok_total',
        'stok_tersedia',
        'kategori',
        'foto_barang'
    ];
}