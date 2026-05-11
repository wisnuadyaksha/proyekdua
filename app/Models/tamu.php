<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $table = 'tamu';
    protected $primaryKey = 'id_tamu';

    protected $fillable = [
        'nama_tamu',
        'instansi',
        'keperluan',
        'tgl_kunjungan',
        'telepon'
    ];
}