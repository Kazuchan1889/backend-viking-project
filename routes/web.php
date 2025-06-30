<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Halaman utama atau root
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// ✅ Auth routes that need CSRF/session/cookies
Route::middleware(['web'])->group(function () {
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
    Route::post('/reset-password', [NewPasswordController::class, 'store']);

    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'role' => $request->user()?->getRoleNames()->first()
        ]);
    });

    Route::post('/admin/session', fn() => response()->json(['status' => 'admin logged in']));
});

// Masih boleh kalau ada route bawaan breeze
require __DIR__.'/auth.php';
