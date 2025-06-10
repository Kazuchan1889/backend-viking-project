<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Routes for News
Route::get('news', [NewsController::class, 'index']);
Route::get('news/{id}', [NewsController::class, 'show']);
Route::post('news', [NewsController::class, 'store']);
Route::put('news/{id}', [NewsController::class, 'update']);
Route::delete('news/{id}', [NewsController::class, 'destroy']);

// Get current user (must be authenticated)
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Admin session endpoint (protected)
Route::middleware('auth:sanctum')->post('/admin/session', function () {
    return response()->json(['status' => 'admin logged in']);
});

// Login endpoint
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout endpoint (protected)
Route::middleware('auth:sanctum')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);

require __DIR__.'/auth.php';