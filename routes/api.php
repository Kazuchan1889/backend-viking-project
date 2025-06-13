<?php
use App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation\PendantInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation\GemInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\FeaturesInformation\FeaturesDisableController; 
use App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\FeaturesInformation\FeaturesEnableController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation\RaceHqNpcController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation\ElanPlateauNpcController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation\SetteDessertNpcController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation\VolcanicCauldronNpcController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\DropOnHqController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\ElanPlateauController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\VolcanicCauldronController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\OutcastLandController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\SetteDesertController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\EtherPlatformController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\ElfLandController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\PitbossDropController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation\CragmineController;

use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestAfterWarController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestSundayController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestSaturdayController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestFridayController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestThursdayController;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\ServerRulesController;
use App\Http\Controllers\Api\MapInformationController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\GameInfo\GameInformationController;
use App\Http\Controllers\Api\Donation\RetailDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonationController;
use App\Http\Controllers\Api\Donation\SeassonPassDonationController;
use App\Http\Controllers\Api\Donation\PackageDonationController;
use App\Http\Controllers\Api\Donation\HowToDonationController;



Route::prefix('game-info')->name('game-info.')->group(function () {

    // --------------------
    // Game Information (General) - CRUD for game_informations table
    // PERBAIKAN: Mengubah prefix dari 'general-information' menjadi 'game-data'
    // --------------------
    Route::prefix('game-data')->name('game-data.')->group(function () {
        Route::get('/', [GameInformationController::class, 'index'])->name('index');
        Route::post('/', [GameInformationController::class, 'store'])->name('store');
        Route::get('/{id}', [GameInformationController::class, 'show'])->name('show');
        Route::put('/{id}', [GameInformationController::class, 'update'])->name('update');
        Route::delete('/{id}', [GameInformationController::class, 'destroy'])->name('destroy');
    });

    // --------------------
    // Server Information
    // --------------------
    Route::prefix('server-information')->name('server-information.')->group(function () {

        // Pendant Info
        Route::get('/pendant-information', [PendantInformationController::class, 'index'])->name('pendant.index');
        Route::post('/pendant-information', [PendantInformationController::class, 'store'])->name('pendant.store');
        Route::get('/pendant-information/{id}', [PendantInformationController::class, 'show'])->name('pendant.show');
        Route::put('/pendant-information/{id}', [PendantInformationController::class, 'update'])->name('pendant.update');
        Route::delete('/pendant-information/{id}', [PendantInformationController::class, 'destroy'])->name('pendant.destroy');

        // Gem Info
        Route::get('/gem-information', [GemInformationController::class, 'index'])->name('gem.index');
        Route::post('/gem-information', [GemInformationController::class, 'store'])->name('gem.store');
        Route::get('/gem-information/{id}', [GemInformationController::class, 'show'])->name('gem.show');
        Route::put('/gem-information/{id}', [GemInformationController::class, 'update'])->name('gem.update');
        Route::delete('/gem-information/{id}', [GemInformationController::class, 'destroy'])->name('gem.destroy');

        // Features Disable
        Route::get('/feature-disable', [FeaturesDisableController::class, 'index'])->name('featuresdisable.index');
        Route::post('/feature-disable', [FeaturesDisableController::class, 'store'])->name('featuresdisable.store');
        Route::get('/feature-disable/{id}', [FeaturesDisableController::class, 'show'])->name('featuresdisable.show');
        Route::put('/feature-disable/{id}', [FeaturesDisableController::class, 'update'])->name('featuresdisable.update');
        Route::delete('/feature-disable/{id}', [FeaturesDisableController::class, 'destroy'])->name('featuresdisable.destroy');

        // Features Enable
        Route::get('/feature-enable', [FeaturesEnableController::class, 'index'])->name('featuresenable.index');
        Route::post('/feature-enable', [FeaturesEnableController::class, 'store'])->name('featuresenable.store');
        Route::get('/feature-enable/{id}', [FeaturesEnableController::class, 'show'])->name('featuresenable.show');
        Route::put('/feature-enable/{id}', [FeaturesEnableController::class, 'update'])->name('featuresenable.update');
        Route::delete('/feature-enable/{id}', [FeaturesEnableController::class, 'destroy'])->name('featuresenable.destroy');

        // NPC Info
        $NPCList = [
            'elanplateaunpc' => ElanPlateauNpcController::class,
            'racehqnpc' => RaceHqNpcController::class,
            'settedessertnpc' => SetteDessertNpcController::class,
            'volcaniccauldronnpc' => VolcanicCauldronNpcController::class,
        ];

        foreach ($NPCList as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                Route::get('/', [$controller, 'index'])->name('index');
                Route::post('/', [$controller, 'store'])->name('store');
                Route::get('/{id}', [$controller, 'show'])->name('show');
                Route::put('/{id}', [$controller, 'update'])->name('update');
                Route::delete('/{id}', [$controller, 'destroy'])->name('destroy');
            });
        }

        // Drop List Info
        $droplist = [
            'droponhq' => DropOnHqController::class,
            'elanplateau' => ElanPlateauController::class,
            'elfland' => ElfLandController::class,
            'etherplatform' => EtherPlatformController::class,
            'outcastland' => OutcastLandController::class,
            'pitbossdrop' => PitbossDropController::class,
            'settedesert' => SetteDesertController::class,
            'cragmine' => CragmineController::class,
            'volcaniccauldron' => VolcanicCauldronController::class,
        ];

        foreach ($droplist as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                Route::get('/', [$controller, 'index'])->name('index');
                Route::post('/', action: [$controller, 'store'])->name('store');
                Route::get('/{id}', [$controller, 'show'])->name('show');
                Route::put('/{id}', [$controller, 'update'])->name('update');
                Route::delete('/{id}', [$controller, 'destroy'])->name('destroy');
            });
        }
    });


    // --------------------
    // Quest Information
    // --------------------
    Route::prefix('quest-information')->name('quest-information.')->group(function () {
        $quests = [
            'dailyquestafterwar' => DailyQuestAfterWarController::class,
            'dailyquesttuesday' => DailyQuestTuesday::class,
            'dailyquestwednesday' => DailyQuestWednesday::class,
            'dailyquestthursday' => DailyQuestThursdayController::class,
            'dailyquestfriday' => DailyQuestFridayController::class,
            'dailyquestsaturday' => DailyQuestSaturdayController::class,
            'dailyquestsunday' => DailyQuestSundayController::class,
        ];

        foreach ($quests as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                Route::get('/', [$controller, 'index'])->name('index');
                Route::post('/', [$controller, 'store'])->name('store');
                Route::get('/{id}', [$controller, 'show'])->name('show');
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
    Route::prefix('mapinfo')->name('mapinfo.')->group(function () {
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
    'retail-donation' => RetailDonationController::class,
    'service-donation' => ServiceDonationController::class,
    'seassonpass-donation' => SeassonPassDonationController::class,
    'package-donation' => PackageDonationController::class,
    'howto-donation' => HowToDonationController::class,
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