<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Routes for News
Route::get('news', [NewsController::class, 'index']);
Route::get('news/{id}', [NewsController::class, 'show']);
Route::post('news', [NewsController::class, 'store']);
Route::put('news/{id}', [NewsController::class, 'update']);
Route::delete('news/{id}', [NewsController::class, 'destroy']);

// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'role' => $request->user()->getRoleNames()->first()
        ]);
    });

    // Admin session endpoint
    Route::post('/admin/session', function () {
        return response()->json(['status' => 'admin logged in']);
    });
});

// Public route
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Auth route file (only required once)
require __DIR__.'/auth.php';
