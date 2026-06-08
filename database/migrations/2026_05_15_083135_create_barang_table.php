<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('barang')) {
            Schema::create('barang', function (Blueprint $table) {
                $table->id('id_barang');
                $table->string('nama_barang');
                $table->text('spesifikasi')->nullable();
                $table->integer('stok_total')->default(0);
                $table->integer('stok_tersedia')->default(0);
                $table->string('kategori')->nullable();
                $table->string('foto_barang')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
