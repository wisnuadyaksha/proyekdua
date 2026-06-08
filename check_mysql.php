<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=proyekdua', 'root', '');
    echo "Connected!\n\n";

    // Semua tabel di MySQL
    echo "=== SEMUA TABEL DI DATABASE ===\n";
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $t) echo " - $t\n";

    // Cek tabel cache
    echo "\n=== CEK TABEL CACHE ===\n";
    if (in_array('cache', $tables)) {
        echo "Cache table: ADA\n";
    } else {
        echo "Cache table: TIDAK ADA\n";
    }

    // Cek data barang lengkap
    echo "\n=== DATA BARANG LENGKAP ===\n";
    $rows = $db->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
    echo "Total barang: " . count($rows) . "\n";
    foreach ($rows as $r) echo json_encode($r) . "\n";

    // Cek users/siswa yang ada
    echo "\n=== DATA USERS ===\n";
    $cols = $db->query("DESCRIBE users")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $c) echo " - " . $c['Field'] . " | " . $c['Type'] . "\n";
    $users = $db->query("SELECT id, name, email FROM users LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $u) echo json_encode($u) . "\n";

    // Cek migrations yang sudah jalan
    echo "\n=== MIGRATIONS YG SUDAH JALAN ===\n";
    $migs = $db->query("SELECT migration FROM migrations ORDER BY batch, migration")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($migs as $m) echo " - $m\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
