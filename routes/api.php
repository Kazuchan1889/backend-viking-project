<?php

use App\Http\Controllers\Api\ItemsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\Api\GameInfo\MapInformationController;
use App\Http\Controllers\Api\GameInfo\ServerRulesController;

use App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation\PendantInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation\GemInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\SystemInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\ServersInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\FeaturesInformation\FeaturesDisableController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\FeaturesInformation\FeaturesEnableController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation\NpcListController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\DropListController;

use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestAfterWarController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestController;

use App\Http\Controllers\Api\Donation\RetailDonationController;
use App\Http\Controllers\Api\Donation\SeassonPassDonationController; 
use App\Http\Controllers\Api\Donation\HowToDonationController;

use App\Http\Controllers\Api\Donation\ServiceDonation\ServiceDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonation\TabResourcesController;
use App\Http\Controllers\Api\Donation\ServiceDonation\TabGemstoneController;

use App\Http\Controllers\Api\PackageCategoryController;
use App\Http\Controllers\Api\PackagesController;
use App\Http\Controllers\Api\PackageBonusController;
use App\Http\Controllers\Api\ItemPackageBonusController;


// =======================
// Game Info Routes
// Prefix all routes in this group with 'game-info'
// =======================
Route::prefix('game-info')->name('game-info.')->group(function () {

    Route::apiResource('server-rules', ServerRulesController::class);
    Route::apiResource('items', ItemsController::class);
    // Map Info Routes
    Route::apiResource('mapinfo', MapInformationController::class)->except(['create', 'edit']);
    Route::get('mapinfo/by-number/{mapNumber}', [MapInformationController::class, 'getMapDataByNumber'])->name('mapinfo.by-number');


    Route::prefix('server-information')->name('server-information.')->group(function () {
        Route::apiResource('pendant-information', PendantInformationController::class);
        Route::apiResource('gem-information', GemInformationController::class);
        Route::apiResource('serversinfo', ServersInformationController::class);
        Route::apiResource('systeminfo', SystemInformationController::class);
        Route::apiResource('feature-disable', FeaturesDisableController::class);
        Route::apiResource('feature-enable', FeaturesEnableController::class);
        Route::apiResource('npclist', NpcListController::class);
        Route::apiResource('droplist', DropListController::class);
    });

    Route::prefix('quest-information')->name('quest-information.')->group(function () {
        $quests = [
            'dailyquestafterwar' => DailyQuestAfterWarController::class,
            'dailyquest' => DailyQuestController::class,
        ];

        foreach ($quests as $prefix => $controller) {
            Route::apiResource($prefix, $controller)->names($prefix);
        }
    });

});

// =======================
// Donation Routes
// Moved outside game-info prefix
// =======================
Route::prefix('donation')->name('donation.')->group(function () {

    Route::prefix('service')->name('service.')->group(function () {
        Route::apiResource('gemstone', TabGemstoneController::class);
        Route::apiResource('resources', TabResourcesController::class);
        Route::apiResource('services', ServiceDonationController::class);
    });

    $otherDonationTypes = [
        'retail' => RetailDonationController::class,
        'seassonpass' => SeassonPassDonationController::class,
        'package-bonuses' => PackageBonusController::class,
        'package-categories' => PackageCategoryController::class,
        'item-package' => ItemPackageBonusController::class,
        'packages' => PackagesController::class,
        'howto' => HowToDonationController::class,
    ];

    foreach ($otherDonationTypes as $prefix => $controller) {
        Route::apiResource($prefix, $controller)->names($prefix);
    }
});

// =======================
// News Routes
// =======================
Route::apiResource('news', NewsController::class)->except(['create', 'edit']); // Using apiResource for consistency


// =======================
// Authenticated routes
// =======================
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']); // Use POST for logout
    Route::get('/me', fn (Request $request) => response()->json([
        'user' => $request->user(),
        'role' => $request->user()->getRoleNames()->first()
    ]));

    // This route seems specific for an admin session check, keep if needed.
    Route::post('/admin/session', fn () => response()->json(['status' => 'admin logged in']));
});

// =======================
// Public Auth routes
// =======================
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);

// Optional additional auth routes
require __DIR__.'/auth.php';