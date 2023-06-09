<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NaviController;
use App\Http\Controllers\FleetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['register' => false, 'reset' => false]);

Route::group([
    'middleware' => 'auth'
], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/route', [NaviController::class, 'route'])->name('route');
    Route::get('/fleet/{id}', [FleetController::class, 'index'])->name('fleet');

    Route::get('/fleet/{id}/engine', [FleetController::class, 'engine'])->name('fleet.engine');
    Route::get('/fleet/{id}/cargo', [FleetController::class, 'cargo'])->name('fleet.cargo');
    Route::get('/fleet/{id}/bunker', [FleetController::class, 'bunker'])->name('fleet.bunker');
    Route::get('/fleet/{id}/ballast', [FleetController::class, 'ballast'])->name('fleet.ballast');

    Route::get('/fleet/{id}/trend', [FleetController::class, 'trend'])->name('fleet.trend');
    Route::get('/fleet/{id}/notes', [FleetController::class, 'notes'])->name('fleet.notes');
    Route::get('/fleet/{id}/docs', [FleetController::class, 'docs'])->name('fleet.docs');
    Route::get('/fleet/{id}/reports', [FleetController::class, 'reports'])->name('fleet.reports');
    Route::get('/fleet/{id}/diagnotics', [FleetController::class, 'diagnotics'])->name('fleet.diagnotics');
    Route::get('/fleet/{id}/alarms', [FleetController::class, 'alarms'])->name('fleet.alarms');
    Route::get('/fleet/{id}/emision', [FleetController::class, 'emision'])->name('fleet.emision');
    Route::get('/fleet/{id}/charter', [FleetController::class, 'charter'])->name('fleet.charter');

    Route::group([
        'as' => 'master.',
        'prefix' => 'master',
    ], function() {
        Route::resource('fleets', \App\Http\Controllers\Master\FleetController::class);
        Route::group(['as' => 'fleets.', 'prefix' => 'fleets', 'controller' => \App\Http\Controllers\Master\FleetController::class], function(){
            Route::get('fleets/{id}/edit-cargo-information','editCargo')->name('editCargo');
            Route::put('fleets/{id}/update-cargo-information', 'updateCargo')->name('updateCargo');
            Route::get('fleets/{id}/edit-bunker-information', 'editBunker')->name('editBunker');
            Route::put('fleets/{id}/update-bunker-information', 'updateBunker')->name('updateBunker');
        });
    });

});
