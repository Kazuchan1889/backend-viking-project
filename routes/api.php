<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('news', [NewsController::class, 'index']);
Route::get('news/{id}', [NewsController::class, 'show']);
Route::post('news', [NewsController::class, 'store']);
Route::put('news/{id}', [NewsController::class, 'update']);
Route::delete('news/{id}', [NewsController::class, 'destroy']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php';
