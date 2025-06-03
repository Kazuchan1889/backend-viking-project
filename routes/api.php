<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 97c8637 (admin)
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('news', [NewsController::class, 'index']);
Route::get('news/{id}', [NewsController::class, 'show']);
Route::post('news', [NewsController::class, 'store']);
Route::put('news/{id}', [NewsController::class, 'update']);
Route::delete('news/{id}', [NewsController::class, 'destroy']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
<<<<<<< HEAD

Route::middleware('auth:sanctum')->post('/admin/session', function() {
    Auth::login(Auth::user());
    return response()->json(['status' => 'admin logged in']);
});

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);

require __DIR__.'/auth.php';
=======
>>>>>>> 71945b4 (commit)
