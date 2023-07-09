<?php


use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\FleetController;
use App\Http\Controllers\Api\EngineController;
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

Route::get('fleet/{id}/nav/histories', [NavController::class, 'history']);
Route::get('fleet/{id}/nav/trend', [NavController::class, 'trend']);
Route::get('fleet/{id}', [FleetController::class, 'show'])->name('api.fleet');

Route::group([
    'as' => 'api.fleet.',
    'prefix' => 'fleet',
], function (){
    Route::get('/{id}/engine/trend', [EngineController::class, 'trend'])->name('engine.trend');
    Route::get('/{id}/cargo/trend', [CargoController::class, 'trend'])->name('cargo.trend');
});