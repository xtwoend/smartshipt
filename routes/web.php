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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/route', [NaviController::class, 'route'])->name('route');
Route::get('/fleet/{id}', [FleetController::class, 'index'])->name('fleet');

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
