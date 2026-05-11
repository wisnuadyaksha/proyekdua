<?php

// Tambahkan use model Siswa di paling atas
use App\Models\Siswa; 

return [

   'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // Balikin ke User::class
    ],
],

    // ... bagian lain tetap sama ...
];