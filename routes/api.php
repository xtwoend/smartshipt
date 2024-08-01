<?php


use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavController;
use App\Http\Controllers\Api\OilController;
use App\Http\Controllers\Api\FuelController;
use App\Http\Controllers\Api\PumpController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\DraftController;
use App\Http\Controllers\Api\FleetController;
use App\Http\Controllers\Api\EngineController;
use App\Http\Controllers\Api\LoggerController;
use App\Http\Controllers\Api\BallastController;
use App\Http\Controllers\TelegramBotController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'auth'
], function (){

    Route::get('fleets', [FleetController::class, 'fleets'])->name('api.fleets');
    Route::get('fleets/table', [FleetController::class, 'lists'])->name('api.fleets.table');

    Route::get('fleet/{id}/nav/histories', [NavController::class, 'history']);
    Route::get('fleet/{id}', [FleetController::class, 'show'])->name('api.fleet');

    Route::group([
        'as' => 'api.fleet.',
        'prefix' => 'fleet'
    ], function (){

        Route::get('/{id}/nav/trend', [NavController::class, 'trend'])->name('nav.trend');
        Route::get('/{id}/nav/current', [NavController::class, 'currentNav'])->name('nav.current');
        Route::get('/{id}/nav/trend/export', [NavController::class, 'export'])->name('nav.export');

        Route::get('/{id}/engine/trend', [EngineController::class, 'trend'])->name('engine.trend');
        Route::get('/{id}/engine/current', [EngineController::class, 'currentEngine'])->name('engine.current');
        Route::get('/{id}/engine/trend/export', [EngineController::class, 'export'])->name('engine.export');

        Route::get('/{id}/pumps/trend', [PumpController::class, 'trend'])->name('pumps.trend');
        Route::get('/{id}/pumps/current', [PumpController::class, 'currentPumps'])->name('pumps.current');
        Route::get('/{id}/pumps/trend/export', [PumpController::class, 'export'])->name('pumps.export');
        
        Route::get('/{id}/cargo/trend', [CargoController::class, 'trend'])->name('cargo.trend');
        Route::get('/{id}/cargo/current', [CargoController::class, 'currentCargo'])->name('cargo.current');
        Route::get('/{id}/cargo/trend/export', [CargoController::class, 'export'])->name('cargo.export');

        // belum di buat
        Route::get('/{id}/fuel/trend', [FuelController::class, 'trend'])->name('fuel.trend');
        Route::get('/{id}/fuel/trend/export', [FuelController::class, 'export'])->name('fuel.export');


        Route::get('/{id}/ballast/trend', [BallastController::class, 'trend'])->name('ballast.trend');
        Route::get('/{id}/ballast/trend/export', [BallastController::class, 'export'])->name('ballast.export');


        Route::get('/{id}/draft/trend', [DraftController::class, 'trend'])->name('draft.trend');
        Route::get('/{id}/draft/trend/export', [DraftController::class, 'export'])->name('draft.export');


        
        Route::get('/{id}/oils/trend', [OilController::class, 'trend'])->name('oils.trend');
        Route::get('/{id}/oils/current', [OilController::class, 'current'])->name('oils.current');

        Route::get('/{id}/logger', [LoggerController::class, 'data'])->name('logger');
    });

});

// callback telegram
Route::match(['get', 'post'], '/callback_telegram', [TelegramBotController::class, '__invoke']);
