<?php
use App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation\PendantInformationController;
use App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation\GemInformationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\ServerRulesController;
use App\Http\Controllers\Api\MapInformationController; // Asumsi ini adalah controller generik untuk Maps
use App\Http\Controllers\Api\RaceHqNpcController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\Donation\RetailDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonationController;
use App\Http\Controllers\Api\Donation\SeassonPassDonationController;
use App\Http\Controllers\Api\Donation\PackageDonationController;
use App\Http\Controllers\Api\Donation\HowToDonationController;
use App\Http\Controllers\Api\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesDisableController;
use App\Http\Controllers\Api\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesEnableController;

use App\Models\GameInfo\QuestInfo\{
    DailyQuestAfterWar,
    DailyQuestTuesday,
    DailyQuestWednesday,
    DailyQuestThursday,
    DailyQuestFriday,
    DailyQuestSaturday,
    DailyQuestSunday,
};
use App\Models\GameInfo\ServerInfo\DropList\{
    DropOnHq,
    ElanPlateau,
    ElfLand,
    EtherPlatform,
    OutcastLand,
    PitbossDrop,
    SetteDesert,
    VolcanicCauldron,
};
use App\Models\GameInfo\ServerInfo\NPCList\{
    ElanPlateauNpc,
    RaceHqNpc,
    SetteDessertNpc,
    VolcanicCauldronNpc,
};

Route::prefix('game-info')->name('game-info.')->group(function () {

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
        Route::get('/gem-information', [GemInformationController::class, 'index'])->name('gem.index'); // Disesuaikan, seharusnya ini untuk semua gem
        Route::post('/gem-information', [GemInformationController::class, 'store'])->name('gem.store');
        Route::get('/gem-information/{id}', [GemInformationController::class, 'show'])->name('gem.show'); // Disesuaikan, seharusnya ini untuk gem spesifik
        Route::put('/gem-information/{id}', [GemInformationController::class, 'update'])->name('gem.update');
        Route::delete('/gem-information/{id}', [GemInformationController::class, 'destroy'])->name('gem.destroy');

        // Features Disable
        Route::get('/feature-disable', [FeaturesDisableController::class, 'index'])->name('featuresdisable.index'); // show and index were swapped for feature-disable
        Route::post('/feature-disable', [FeaturesDisableController::class, 'store'])->name('featuresdisable.store');
        Route::get('/feature-disable/{id}', [FeaturesDisableController::class, 'show'])->name('featuresdisable.show');
        Route::put('/feature-disable/{id}', [FeaturesDisableController::class, 'update'])->name('featuresdisable.update');
        Route::delete('/feature-disable/{id}', [FeaturesDisableController::class, 'destroy'])->name('featuresdisable.destroy');

        // Features Enable
        Route::get('/feature-enable', [FeaturesEnableController::class, 'index'])->name('featuresenable.index'); // Adjusted
        Route::post('/feature-enable', [FeaturesEnableController::class, 'store'])->name('featuresenable.store'); // Corrected
        Route::get('/feature-enable/{id}', [FeaturesEnableController::class, 'show'])->name('featuresenable.show'); // Adjusted
        Route::put('/feature-enable/{id}', [FeaturesEnableController::class, 'update'])->name('featuresenable.update'); // Corrected
        Route::delete('/feature-enable/{id}', [FeaturesEnableController::class, 'destroy'])->name('featuresenable.destroy'); // Corrected

        // NPC Info
        $npclist = [
            'elanplateaunpc' => ElanPlateauNpc::class,
            'racehqnpc' => RaceHqNpc::class,
            'settedessertnpc' => SetteDessertNpc::class,
            'volcaniccauldronnpc' => VolcanicCauldronNpc::class,
        ];

        foreach ($npclist as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                // Biasanya index tidak memiliki {id} dan show memilikinya
                Route::get('/', [$controller, 'index'])->name('index'); // Untuk mengambil semua
                Route::post('/', [$controller, 'store'])->name('store');
                Route::get('/{id}', [$controller, 'show'])->name('show'); // Untuk mengambil spesifik
                Route::put('/{id}', [$controller, 'update'])->name('update');
                Route::delete('/{id}', [$controller, 'destroy'])->name('destroy');
            });
        }

        // Drop List Info
        $droplist = [
            'droponhq' => DropOnHq::class,
            'elanplateau' => ElanPlateau::class,
            'elfland' => ElfLand::class,
            'etherplatform' => EtherPlatform::class,
            'outcastland' => OutcastLand::class,
            'pitbossdrop' => PitbossDrop::class,
            'settedesert' => SetteDesert::class,
            'volcaniccauldron' => VolcanicCauldron::class,
        ];

        foreach ($droplist as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                // Biasanya index tidak memiliki {id} dan show memilikinya
                Route::get('/', [$controller, 'index'])->name('index'); // Untuk mengambil semua
                Route::post('/', [$controller, 'store'])->name('store');
                Route::get('/{id}', [$controller, 'show'])->name('show'); // Untuk mengambil spesifik
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
            'dailyquestafterwar' => DailyQuestAfterWar::class,
            'dailyquesttuesday' => DailyQuestTuesday::class,
            'dailyquestwednesday' => DailyQuestWednesday::class,
            'dailyquestthursday' => DailyQuestThursday::class,
            'dailyquestfriday' => DailyQuestFriday::class,
            'dailyquestsaturday' => DailyQuestSaturday::class,
            'dailyquestsunday' => DailyQuestSunday::class,
        ];

        foreach ($quests as $prefix => $controller) {
            Route::prefix($prefix)->name("$prefix.")->group(function () use ($controller) {
                // Biasanya index tidak memiliki {id} dan show memilikinya
                Route::get('/', [$controller, 'index'])->name('index'); // Untuk mengambil semua
                Route::post('/', [$controller, 'store'])->name('store');
                Route::get('/{id}', [$controller, 'show'])->name('show'); // Untuk mengambil spesifik
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
