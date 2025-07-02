<?php

use Illuminate\Support\Facades\Route;

// Halaman utama atau root
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// Masih boleh kalau ada route bawaan breeze
require __DIR__.'/auth.php';
