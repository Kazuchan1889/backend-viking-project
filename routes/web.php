use Illuminate\Support\Facades\Route;

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth', 'admin'])->get('/admin', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

require __DIR__.'/auth.php';
