<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// -----------------------------
// Public routes
// -----------------------------
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

// -----------------------------
// Protected routes (auth:sanctum)
// -----------------------------
Route::middleware(['auth:sanctum'])->group(function () {

    // Authenticated user data
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    // Get current user + role
    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'role' => $request->user()->getRoleNames()->first() // if using Spatie Roles
        ]);
    });

    // News management (only for authenticated users)
    Route::post('/news', [NewsController::class, 'store']);
    Route::put('/news/{id}', [NewsController::class, 'update']);
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    // Dummy admin endpoint
    Route::post('/admin/session', function () {
        return response()->json(['status' => 'admin logged in']);
    });
});
