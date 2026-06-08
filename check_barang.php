<?php
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');

// Show all tables
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
echo "TABLES:\n";
foreach ($tables as $t) echo " - $t\n";
echo "\n";

// Show barang table structure
echo "STRUCTURE of 'barang':\n";
try {
    $cols = $db->query("PRAGMA table_info(barang)")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $c) echo " col: " . $c['name'] . " | type: " . $c['type'] . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
echo "\n";

// Show barang data
echo "DATA in 'barang':\n";
try {
    $rows = $db->query("SELECT * FROM barang LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    echo "Count: " . count($rows) . "\n";
    foreach ($rows as $r) echo json_encode($r) . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
