<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$admin = User::where('email', 'admin@admin.com')->orWhere('role', 'admin')->first();

if ($admin) {
    $admin->password = Hash::make('admin123');
    $admin->save();
    echo "Akun Admin ditemukan!\n";
    echo "Email/Login Input : " . $admin->email . "\n";
    echo "Password          : admin123\n";
} else {
    // Kalau nggak ada, kita buatin
    $admin = User::create([
        'name' => 'Administrator',
        'email' => 'admin@admin.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);
    echo "Akun Admin baru saja dibuat!\n";
    echo "Email/Login Input : admin@admin.com\n";
    echo "Password          : admin123\n";
}
