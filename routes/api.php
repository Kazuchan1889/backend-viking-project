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
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestWednesdayController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestTuesdayController;
use App\Http\Controllers\Api\GameInfo\QuestInformation\DailyQuestMondayController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\GameInfo\ServerRulesController;
use App\Http\Controllers\Api\GameInfo\MapInformationController;
use App\Http\Controllers\Api\Donation\DonationInformationController;
use App\Http\Controllers\Api\GameInfo\GameInformationController;
use App\Http\Controllers\Api\Donation\RetailDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonation\ServiceDonationController;
use App\Http\Controllers\Api\Donation\ServiceDonation\TabResourcesController;
use App\Http\Controllers\Api\Donation\ServiceDonation\TabGemstoneController;

use App\Http\Controllers\Api\Donation\SeassonPassDonationController;
use App\Http\Controllers\Api\Donation\PackageDonationController;
use App\Http\Controllers\Api\Donation\HowToDonationController;


// =======================
// Game Info Routes
// Prefix all routes in this group with 'game-info'
// =======================
Route::prefix('game-info')->name('game-info.')->group(function () {

    // Game Information (General) - CRUD for game_informations table
    // URL: /api/game-info/game-data
    Route::apiResource('game-data', GameInformationController::class);

    // Server Information - Grouping various server-related data
    Route::prefix('server-information')->name('server-information.')->group(function () {

        // Feature Information
        // URL: /api/game-info/server-information/pendant-information
        Route::apiResource('pendant-information', PendantInformationController::class)->names('pendant-information');
        // URL: /api/game-info/server-information/gem-information
        Route::apiResource('gem-information', GemInformationController::class)->names('gem-information');

        Route::apiResource('feature-disable', FeaturesDisableController::class)->names('feature-disable');
        // URL: /api/game-info/server-information/feature-enable
        Route::apiResource('feature-enable', FeaturesEnableController::class)->names('feature-enable');

        // NPC List Information
        $NPCList = [
            'elanplateaunpc' => ElanPlateauNpcController::class,
            'racehqnpc' => RaceHqNpcController::class,
            'settedessertnpc' => SetteDessertNpcController::class,
            'volcaniccauldronnpc' => VolcanicCauldronNpcController::class,
        ];
        foreach ($NPCList as $prefix => $controller) {
            // URL: /api/game-info/server-information/{prefix} (e.g., /elanplateaunpc)
            Route::apiResource($prefix, $controller)->names($prefix);
        }

        // Drop List Information
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
            // URL: /api/game-info/server-information/{prefix} (e.g., /droponhq)
            Route::apiResource($prefix, $controller)->names($prefix);
        }
    }); // End of server-information group


    // Quest Information
    Route::prefix('quest-information')->name('quest-information.')->group(function () {
        $quests = [
            'dailyquestafterwar' => DailyQuestAfterWarController::class,
            'dailyquesttuesday' => DailyQuestTuesdayController::class,
            'dailyquestwednesday' => DailyQuestWednesdayController::class,
            'dailyquestthursday' => DailyQuestThursdayController::class,
            'dailyquestfriday' => DailyQuestFridayController::class,
            'dailyquestsaturday' => DailyQuestSaturdayController::class,
            'dailyquestsunday' => DailyQuestSundayController::class,
            'dailyquestmonday' => DailyQuestMondayController::class,
        ];
        foreach ($quests as $prefix => $controller) {
            // URL: /api/game-info/quest-information/{prefix} (e.g., /dailyquestafterwar)
            Route::apiResource($prefix, $controller)->names($prefix);
        }
    }); // End of quest-information group


    // Server Rules
    // URL: /api/game-info/server-rules
    Route::apiResource('server-rules', ServerRulesController::class)->names('server-rules');


    // Map Information
    Route::prefix('mapinfo')->name('mapinfo.')->group(function () {
        // Custom route for map data by number
        // URL: /api/game-info/mapinfo/by-number/{mapNumber}
        Route::get('by-number/{mapNumber}', [MapInformationController::class, 'getMapDataByNumber'])->name('by-number');

        // Standard CRUD for Map Information
        // URL: /api/game-info/mapinfo (for index, store)
        // URL: /api/game-info/mapinfo/{mapinfo} (for show, update, destroy)
        Route::apiResource('/', MapInformationController::class)->except(['create', 'edit'])->parameters(['' => 'mapinfo']);
    }); // End of mapinfo group

}); // End of game-info group

// =======================
// Main Donation Routes
// Prefix all routes in this group with 'donation'
// =======================
Route::prefix('donation')->name('donation.')->group(function () {

    Route::apiResource('donation-info', DonationInformationController::class)->names('donation-info');
    Route::prefix('service')->name('service.')->group(function () {

        Route::apiResource('gemstone', TabGemstoneController::class)->names('gemstone');
        Route::apiResource('resources', TabResourcesController::class)->names('resources');
        Route::apiResource('services', ServiceDonationController::class)->names('services'); // Ini adalah rute yang ingin Anda gunakan untuk daftar ServiceDonation
    });
    $otherDonationTypes = [
        'retail' => RetailDonationController::class,
        'seassonpass' => SeassonPassDonationController::class,
        'package' => PackageDonationController::class,
        'howto' => HowToDonationController::class,
    ];

    foreach ($otherDonationTypes as $prefix => $controller) {
        // URL: /api/donation/{prefix} (e.g., /retail, /seassonpass)
        Route::apiResource($prefix, $controller)->names($prefix);
    }

}); // End of main donation group


Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::middleware('auth:sanctum')->get('/logout', [AuthenticatedSessionController::class, 'destroy']);

require __DIR__ . '/auth.php';