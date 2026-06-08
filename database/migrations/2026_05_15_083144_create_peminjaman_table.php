<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('peminjaman')) {
            Schema::create('peminjaman', function (Blueprint $table) {
                $table->id('id_peminjaman');
                $table->unsignedBigInteger('id_siswa')->nullable();
                $table->string('nama_tamu')->nullable();
                $table->unsignedBigInteger('id_barang');
                $table->integer('jumlah_pinjam');
                $table->date('tgl_pinjam')->nullable();
                $table->date('tgl_kembali')->nullable();
                $table->string('status')->default('Menunggu Persetujuan');
                $table->text('catatan')->nullable();
                $table->timestamps();

                $table->foreign('id_siswa')->references('id')->on('users')->onDelete('set null');
                $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
