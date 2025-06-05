<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json([
        'user' => $request->user(),
        'role' => $request->user()->getRoleNames()->first()
    ]);
});


require __DIR__.'/auth.php';
