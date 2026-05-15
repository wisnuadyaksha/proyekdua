<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Kita ubah tipe datanya jadi string biasa (panjang 50 karakter)
            // Biar bisa nampung 'Dipinjam', 'Menunggu Persetujuan', 'Dikembalikan', dll.
            $table->string('status', 50)->change();
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->string('status', 20)->change();
        });
    }
};