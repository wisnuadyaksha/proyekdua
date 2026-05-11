<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    
    // Memberitahu Laravel bahwa Primary Key-nya bukan 'id'
    protected $primaryKey = 'id_peminjaman';

    // Jika id_peminjaman adalah AI (Auto Increment) di database, tambahkan ini:
    public $incrementing = true;

    protected $fillable = [
        'id_siswa', 
        'nama_tamu', 
        'id_barang', 
        'jumlah_pinjam', 
        'tgl_pinjam', 
        'tgl_kembali', 
        'status', 
        'catatan'
    ];

    /**
     * Relasi ke model Barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    /**
     * Relasi ke model Siswa
     */
    public function siswa()
    {
        // Pastikan primary key di tabel siswa adalah 'id_siswa'
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}