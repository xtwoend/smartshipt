<?php


use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavController;
use App\Http\Controllers\Api\FuelController;
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


Route::get('fleets', [FleetController::class, 'fleets'])->name('api.fleets');
Route::get('fleets/table', [FleetController::class, 'lists'])->name('api.fleets.table');

Route::get('fleet/{id}/nav/histories', [NavController::class, 'history']);
Route::get('fleet/{id}', [FleetController::class, 'show'])->name('api.fleet');

Route::group([
    'as' => 'api.fleet.',
    'prefix' => 'fleet',
], function (){

    Route::get('/{id}/nav/trend', [NavController::class, 'trend'])->name('nav.trend');
    Route::get('/{id}/engine/trend', [EngineController::class, 'trend'])->name('engine.trend');
    Route::get('/{id}/engine/current', [CargoController::class, 'currentEngine'])->name('engine.current');
    Route::get('/{id}/cargo/trend', [CargoController::class, 'trend'])->name('cargo.trend');
    Route::get('/{id}/cargo/current', [CargoController::class, 'currentCargo'])->name('cargo.current');
    Route::get('/{id}/fuel/trend', [FuelController::class, 'trend'])->name('fuel.trend');
    Route::get('/{id}/ballast/trend', [BallastController::class, 'trend'])->name('ballast.trend');
    Route::get('/{id}/draft/trend', [DraftController::class, 'trend'])->name('draft.trend');
    Route::get('/{id}/logger', [LoggerController::class, 'data'])->name('logger');
});


// callback telegram
Route::match(['get', 'post'], '/callback_telegram', [TelegramBotController::class, '__invoke']);
