<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\ServerRulesController;
use App\Http\Controllers\Api\MapInformationController;
use App\Http\Controllers\Api\RaceHqNpcController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\Donation\RetailDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonationController;
use App\Http\Controllers\Api\Donation\SeassonPassDonationController;
use App\Http\Controllers\Api\Donation\PackageDonationController;
use App\Http\Controllers\Api\Donation\HowToDonationController;
use App\Http\Controllers\Api\GemInformationController;
use App\Models\GameInfo\ServerInfo\FeatureInfo\PendantInformation;
use App\Models\GameInfo\QuestInfo\{
    DailyQuestAfterWar,
    DailyQuestTuesday,
    DailyQuestWednesday,
    DailyQuestThursday,
    DailyQuestFriday,
    DailyQuestSaturday,
    DailyQuestSunday
};

// =======================
// Game Info Routes
// =======================
Route::prefix('game-info')->name('game-info.')->group(function () {

    // --------------------
    // Server Information
    // --------------------
    Route::prefix('server-information')->name('server-information.')->group(function () {

        // Pendant Info
        Route::get('/pendant-information/{id}', [PendantInformation::class, 'index'])->name('pendant.index');
        Route::post('/pendant-information', [PendantInformation::class, 'store'])->name('pendant.store');
        Route::get('/pendant-information', [PendantInformation::class, 'show'])->name('pendant.show');
        Route::put('/pendant-information/{id}', [PendantInformation::class, 'update'])->name('pendant.update');
        Route::delete('/pendant-information/{id}', [PendantInformation::class, 'destroy'])->name('pendant.destroy');

        // Gem Info
        Route::get('/gem-information/{id}', [GemInformationController::class, 'index'])->name('gem.index');
        Route::post('/gem-information', [GemInformationController::class, 'store'])->name('gem.store');
        Route::get('/gem-information', [GemInformationController::class, 'show'])->name('gem.show');
        Route::put('/gem-information/{id}', [GemInformationController::class, 'update'])->name('gem.update');
        Route::delete('/gem-information/{id}', [GemInformationController::class, 'destroy'])->name('gem.destroy');

        // NPC Info
        Route::get('/npc-list-information/{id}', [RaceHqNpcController::class, 'index'])->name('npc.index');
        Route::post('/npc-list-information', [RaceHqNpcController::class, 'store'])->name('npc.store');
        Route::get('/npc-list-information', [RaceHqNpcController::class, 'show'])->name('npc.show');
        Route::put('/npc-list-information/{id}', [RaceHqNpcController::class, 'update'])->name('npc.update');
        Route::delete('/npc-list-information/{id}', [RaceHqNpcController::class, 'destroy'])->name('npc.destroy');

        // Drop List Info
        Route::get('/drop-list-information/{id}', [RaceHqNpcController::class, 'index'])->name('drop.index');
        Route::post('/drop-list-information', [RaceHqNpcController::class, 'store'])->name('drop.store');
        Route::get('/drop-list-information', [RaceHqNpcController::class, 'show'])->name('drop.show');
        Route::put('/drop-list-information/{id}', [RaceHqNpcController::class, 'update'])->name('drop.update');
        Route::delete('/drop-list-information/{id}', [RaceHqNpcController::class, 'destroy'])->name('drop.destroy');
    });

    // --------------------
    // Quest Information
    // --------------------
    Route::prefix('quest-information')->name('quest-information.')->group(function () {
        $quests = [
            'after-war' => DailyQuestAfterWar::class,
            'tuesday' => DailyQuestTuesday::class,
            'wednesday' => DailyQuestWednesday::class,
            'thursday' => DailyQuestThursday::class,
            'friday' => DailyQuestFriday::class,
            'saturday' => DailyQuestSaturday::class,
            'sunday' => DailyQuestSunday::class,
        ];

        foreach ($quests as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                Route::get('/{id}', [$controller, 'index'])->name('index');
                Route::post('/', [$controller, 'store'])->name('store');
                Route::get('/', [$controller, 'show'])->name('show');
                Route::put('/{id}', [$controller, 'update'])->name('update');
                Route::delete('/{id}', [$controller, 'destroy'])->name('destroy');
            });
        }
    });

    // --------------------
    // Server Rules
    // --------------------
    Route::prefix('server-rules')->name('server-rules.')->group(function () {
        Route::get('/', [ServerRulesController::class, 'index'])->name('index');
        Route::post('/', [ServerRulesController::class, 'store'])->name('store');
        Route::get('/{id}', [ServerRulesController::class, 'show'])->name('show');
        Route::put('/{id}', [ServerRulesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServerRulesController::class, 'destroy'])->name('destroy');
    });

    // --------------------
    // Map Information
    // --------------------
    Route::prefix('map-information')->name('map-information.')->group(function () {
        Route::get('/', [MapInformationController::class, 'index'])->name('index');
        Route::post('/', [MapInformationController::class, 'store'])->name('store');
        Route::get('/{id}', [MapInformationController::class, 'show'])->name('show');
        Route::put('/{id}', [MapInformationController::class, 'update'])->name('update');
        Route::delete('/{id}', [MapInformationController::class, 'destroy'])->name('destroy');
    });
});

// =======================
// Main Donation Routes
// =======================
$donationRoutes = [
    'retail' => RetailDonationController::class,
    'service' => ServiceDonationController::class,
    'season-pass' => SeassonPassDonationController::class,
    'package' => PackageDonationController::class,
    'how-to' => HowToDonationController::class,
];

Route::prefix('donations')->name('donations.')->group(function () use ($donationRoutes) {
    Route::get('/', [DonationController::class, 'index'])->name('index');
    Route::post('/', [DonationController::class, 'store'])->name('store');
    Route::get('/{id}', [DonationController::class, 'show'])->name('show');
    Route::put('/{id}', [DonationController::class, 'update'])->name('update');
    Route::delete('/{id}', [DonationController::class, 'destroy'])->name('destroy');

    foreach ($donationRoutes as $prefix => $controller) {
        Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
            Route::get('/', [$controller, 'index'])->name('index');
            Route::post('/', [$controller, 'store'])->name('store');
            Route::get('/{id}', [$controller, 'show'])->name('show');
            Route::put('/{id}', [$controller, 'update'])->name('update');
            Route::delete('/{id}', [$controller, 'destroy'])->name('destroy');
        });
    }
});

// =======================
// Authentication Routes
// =======================
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::middleware('auth:sanctum')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);

require __DIR__ . '/auth.php';
