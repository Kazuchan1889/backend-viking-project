<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    // ✅ Override: pastikan XSRF-TOKEN dikirim dengan benar ke frontend (Vercel)
    Route::get('/sanctum/csrf-cookie', function () {
        return response()->json(['message' => 'CSRF cookie set manually'])
            ->withCookie(
                cookie(
                    'XSRF-TOKEN',
                    csrf_token(),
                    120, // Menit
                    '/', // path
                    '.vercel.app', // domain
                    true, // secure
                    false, // httpOnly (false agar bisa diakses JS)
                    false, // raw
                    'None' // SameSite
                )
            );
    });

    // ✅ Debug endpoint: lihat apakah Laravel bisa set cookie dengan benar
    Route::get('/check-cookie', function () {
        return response()->json([
            'xsrf' => Cookie::get('XSRF-TOKEN'),
            'session' => Cookie::get(config('session.cookie', Str::slug(env('APP_NAME', 'laravel'), '_').'_session'))
        ]);
    });
});

// Route tambahan bawaan Breeze (jika ada)
require __DIR__.'/auth.php';
