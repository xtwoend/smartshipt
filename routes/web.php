<?php

use Illuminate\Support\Facades\Route;
use Psr\Http\Message\RequestInterface;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NaviController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TelegramBotController;

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

Route::get('/alarm-report/{id}', [ReportController::class, 'alarmReport'])->name('alarm-report');


Route::group([
    'middleware' => 'auth'
], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/route', [NaviController::class, 'route'])->name('route');
    Route::get('/fleet/{id}', [FleetController::class, 'index'])->name('fleet');
    Route::get('/fleet/{id}/track', [FleetController::class, 'track'])->name('fleet.track');
    Route::get('/fleet/{id}/pumps', [FleetController::class, 'pumps'])->name('fleet.pumps');
    Route::get('/fleet/{id}/engine', [FleetController::class, 'engine'])->name('fleet.engine');
    Route::get('/fleet/{id}/cargo', [FleetController::class, 'cargo'])->name('fleet.cargo');
    Route::get('/fleet/{id}/bunker', [FleetController::class, 'bunker'])->name('fleet.bunker');
    Route::get('/fleet/{id}/balast', [FleetController::class, 'balast'])->name('fleet.balast');

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
            
            Route::get('{id}/pic', 'pic')->name('pic');
            Route::post('{id}/pic/update', 'picUpdate')->name('pic.update');
            Route::delete('pic/delete/{id}', 'picDelete')->name('pic.delete');

            Route::get('{id}/edit-cargo-information','editCargo')->name('editCargo');
            Route::put('{id}/update-cargo-information', 'updateCargo')->name('updateCargo');
            Route::get('{id}/edit-bunker-information', 'editBunker')->name('editBunker');
            Route::put('{id}/update-bunker-information', 'updateBunker')->name('updateBunker');
        });

        Route::resource('ports', \App\Http\Controllers\Master\PortController::class);

        Route::resource('user', \App\Http\Controllers\Master\UserController::class);
        Route::group(['as' => 'user.', 'prefix' => 'user', 'controller' => \App\Http\Controllers\Master\UserController::class], function(){
            Route::get('change-password', 'changePassword')->name('change-password');
            Route::post('change-password', 'changePasswordPost')->name('change-password.post');
            Route::get('{id}/permission', 'editUserPermission')->name('permission');
            Route::get('{id}/get-permission', 'getUserPermission')->name('permission.get');
            Route::post('{id}/update-permission', 'updateUserPermission')->name('permission.update');
        });

        Route::get('permission/json', [\App\Http\Controllers\Master\PermissionController::class, 'json'])->name('permission.json');
        Route::resource('permission', \App\Http\Controllers\Master\PermissionController::class);
        Route::resource('users', \App\Http\Controllers\Master\UserController::class);

        Route::delete('sensors/delete/{id}', [\App\Http\Controllers\Master\SensorController::class, 'destroy'])->name('sensors.destroy');
        Route::post('sensors/update', [\App\Http\Controllers\Master\SensorController::class, 'update'])->name('sensors.edit');
    });

    Route::post('/upload/svg', [\App\Http\Controllers\Master\FleetController::class, 'uploadSvg'])->name('upload.svg');
});

Route::get('/coba/{id}', function($id){
    // $fleet = \App\Models\Fleet::findOrFail($id);    
    // $d = (new \App\Report\CreateSensorConditionReport($fleet));

    // return $d->handle();
});