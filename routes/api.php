<?php

use App\Http\Controllers\Api\GameInfoSectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\ServerRulesController;
use App\Http\Controllers\Api\Donation\RetailDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonationController;
use App\Http\Controllers\Api\Donation\SeassonPassDonationController; // Corrected typo: SeassonPass to SeasonPass
use App\Http\Controllers\Api\Donation\PackageDonationController;
use App\Http\Controllers\Api\Donation\HowToDonationController;
// use App\Http\Controllers\GameInfo\ServerInfo\GeneralInfo\GeneralInformationController;

// From the other branch's changes
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// =======================
// Game Info Group
// =======================
Route::prefix('game-info')->name('game-info.')->group(function () {
    Route::get('/', [GameInfoSectionController::class, 'index'])->name('index');
    Route::post('/', [GameInfoSectionController::class, 'store'])->name('store');
    Route::get('/{id}', [GameInfoSectionController::class, 'show'])->name('show');
    Route::put('/{id}', [GameInfoSectionController::class, 'update'])->name('update');
    Route::delete('/{id}', [GameInfoSectionController::class, 'destroy'])->name('destroy');
});


// =======================
// Server Rules Group
// =======================
Route::prefix('server')->name('server.')->group(function () {
    Route::get('/', [ServerRulesController::class, 'index'])->name('index');
    Route::post('/', [ServerRulesController::class, 'store'])->name('store');
    Route::get('/{id}', [ServerRulesController::class, 'show'])->name('show');
    Route::put('/{id}', [ServerRulesController::class, 'update'])->name('update');
    Route::delete('/{id}', [ServerRulesController::class, 'destroy'])->name('destroy');
});

// =======================
// Main Donation Routes
// =======================
Route::prefix('donations')->name('donations.')->group(function () {
    Route::get('/', [DonationController::class, 'index'])->name('index');
    Route::post('/', [DonationController::class, 'store'])->name('store');
    Route::get('/{id}', [DonationController::class, 'show'])->name('show');
    Route::put('/{id}', [DonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [DonationController::class, 'destroy'])->name('destroy');
});


// =======================
// Specific Donation Type Routes
// =======================
Route::prefix('retail-donations')->name('retail-donations.')->group(function () {
    Route::get('/', [RetailDonationController::class, 'index'])->name('index');
    Route::post('/', [RetailDonationController::class, 'store'])->name('store');
    Route::get('/{id}', [RetailDonationController::class, 'show'])->name('show');
    Route::put('/{id}', [RetailDonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [RetailDonationController::class, 'destroy'])->name('destroy');
});

Route::prefix('service-donations')->name('service-donations.')->group(function () {
    Route::get('/', [ServiceDonationController::class, 'index'])->name('index');
    Route::post('/', [ServiceDonationController::class, 'store'])->name('store');
    Route::get('/{id}', [ServiceDonationController::class, 'show'])->name('show');
    Route::put('/{id}', [ServiceDonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ServiceDonationController::class, 'destroy'])->name('destroy');
});

Route::prefix('seasonpass-donations')->name('seasonpass-donations.')->group(function () {
    // Corrected controller name
    Route::get('/', [SeassonPassDonationController::class, 'index'])->name('index');
    Route::post('/', [SeassonPassDonationController::class, 'store'])->name('store');
    Route::get('/{id}', [SeassonPassDonationController::class, 'show'])->name('show');
    Route::put('/{id}', [SeassonPassDonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [SeassonPassDonationController::class, 'destroy'])->name('destroy');
});

Route::prefix('package-donations')->name('package-donations.')->group(function () {
    Route::get('/', [PackageDonationController::class, 'index'])->name('index');
    Route::post('/', [PackageDonationController::class, 'store'])->name('store');
    Route::get('/{id}', [PackageDonationController::class, 'show'])->name('show');
    Route::put('/{id}', [PackageDonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [PackageDonationController::class, 'destroy'])->name('destroy');
});

Route::prefix('howto-donations')->name('howto-donations.')->group(function () {
    Route::get('/', [HowToDonationController::class, 'index'])->name('index');
    Route::post('/', [HowToDonationController::class, 'store'])->name('store');
    Route::get('/{id}', [HowToDonationController::class, 'show'])->name('show');
    Route::put('/{id}', [HowToDonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [HowToDonationController::class, 'destroy'])->name('destroy');
});

// =======================
// Authentication Routes (from the other branch)
// =======================
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);

// This line typically pulls in additional authentication-related routes (e.g., for registration, password reset)
require __DIR__.'/auth.php';