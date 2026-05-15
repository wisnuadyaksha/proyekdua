<?php

namespace App\Models;
use App\Models\User; // Tambahkan ini di paling atas kalau belum ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman'; // Sesuai DB lu
    public $incrementing = true;

    protected $fillable = [
        'id_siswa', 
        'nama_tamu', // Nama yang diketik di form masuk ke sini
        'id_barang', 
        'jumlah_pinjam', 
        'tgl_pinjam', 
        'tgl_kembali', 
        'status', 
        'catatan'
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // POIN PENTING: Relasi ke User (Login Lu)
    public function siswa()
{
    // id_siswa (di tabel peminjaman) nyambung ke id (di tabel users)
    return $this->belongsTo(User::class, 'id_siswa', 'id');
}
}