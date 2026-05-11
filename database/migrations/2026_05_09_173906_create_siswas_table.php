<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kita cuma tambah NIS dan CLASS saja
            // Bagian ROLE dihapus karena error tadi bilang sudah ada (Duplicate column)
            if (!Schema::hasColumn('users', 'nis')) {
                $table->string('nis')->unique()->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'class')) {
                $table->string('class')->nullable()->after('nis');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nis', 'class']);
        });
    }
};