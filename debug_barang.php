<?php
// Simulate apa yang dilakukan controller createSiswa()
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Boot Laravel
$app->boot();

use App\Models\Barang;

echo "=== TEST QUERY BARANG (seperti di createSiswa) ===\n\n";

try {
    $barangs = Barang::where('stok_total', '>', 0)->get();
    echo "Jumlah barang ditemukan: " . $barangs->count() . "\n\n";

    if ($barangs->isEmpty()) {
        echo "!!! KOSONG - Dropdown akan KOSONG !!!\n";
    } else {
        foreach ($barangs as $b) {
            echo "ID: {$b->id_barang} | Nama: {$b->nama_barang} | Stok: {$b->stok_total}\n";
        }
    }

    echo "\n=== TEST QUERY TANPA FILTER ===\n";
    $all = Barang::all();
    echo "Total semua barang: " . $all->count() . "\n";
    foreach ($all as $b) {
        echo "ID: {$b->id_barang} | Nama: {$b->nama_barang} | Stok: {$b->stok_total}\n";
    }

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
