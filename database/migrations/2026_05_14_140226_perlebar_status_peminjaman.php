<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('peminjaman', function (Blueprint $table) {
        // Ini kodenya, ditaruh di file migration ini
        $table->string('status', 50)->change(); 
    });

}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
