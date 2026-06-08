<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Barang;

$barangs = Barang::all();
foreach($barangs as $b) {
    if (str_starts_with($b->foto_barang, 'alat/')) {
        $filename = str_replace('alat/', '', $b->foto_barang);
        $oldPath = storage_path('app/public/' . $b->foto_barang);
        $newPath = public_path('img/alat/' . $filename);
        
        if (file_exists($oldPath)) {
            copy($oldPath, $newPath);
            echo "Copied: $filename\n";
        }
        
        // Update DB
        $b->foto_barang = $filename;
        $b->save();
        echo "Updated DB for: " . $b->nama_barang . "\n";
    }
}
echo "Selesai sinkronisasi gambar!\n";
