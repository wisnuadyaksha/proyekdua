<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Peminjaman;

$pinjamans = Peminjaman::all();
echo "Total Peminjaman: " . count($pinjamans) . "\n";
foreach($pinjamans as $p) {
    echo 'Peminjaman ID: ' . $p->id_peminjaman . ' | Barang ID: ' . $p->id_barang . ' | Barang Exists: ' . ($p->barang ? 'Yes' : 'No') . "\n";
}
