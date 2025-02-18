<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NaviController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\Master\LogController;
use App\Http\Controllers\Master\SensorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OverViewController;

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
    'middleware' => ['auth', 'xss_sanitizer', 'logger']
], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/route', [NaviController::class, 'route'])->name('route');

    Route::get('/help/getting-started', function(){
        return view('helps.getting_started');
    })->name('help.getting_started');

    Route::get('/help/basic-vessel-modules', function(){
        return view('helps.basic_vessel_module');
    })->name('help.basic_vessel');
    

    Route::get('/fleet/{id}', [FleetController::class, 'info'])->name('fleet');
    Route::get('/fleet/{id}/nav', [FleetController::class, 'nav'])->name('fleet.nav');
    Route::get('/fleet/{id}/track', [FleetController::class, 'track'])->name('fleet.track');
    Route::get('/fleet/{id}/pumps', [FleetController::class, 'pumps'])->name('fleet.pumps');
    Route::get('/fleet/{id}/engine', [FleetController::class, 'engine'])->name('fleet.engine');
    Route::get('/fleet/{id}/generator', [FleetController::class, 'generator'])->name('fleet.generator');
    Route::get('/fleet/{id}/cargo', [FleetController::class, 'cargo'])->name('fleet.cargo');
    Route::get('/fleet/{id}/bunker', [FleetController::class, 'bunker'])->name('fleet.bunker');
    Route::get('/fleet/{id}/balast', [FleetController::class, 'balast'])->name('fleet.balast');
    Route::get('/fleet/{id}/oils', [FleetController::class, 'oils'])->name('fleet.oils');
    Route::get('/fleet/{id}/equipment', [FleetController::class, 'equipment'])->name('fleet.equipment');

    Route::get('/fleet/{id}/trend', [FleetController::class, 'trend'])->name('fleet.trend');
    Route::get('/fleet/{id}/notes', [FleetController::class, 'notes'])->name('fleet.notes');
    Route::get('/fleet/{id}/docs', [FleetController::class, 'docs'])->name('fleet.docs');
    Route::get('/fleet/{id}/docs/read', [FleetController::class, 'readDocs'])->name('fleet.read_docs');
    Route::get('/fleet/{id}/reports', [FleetController::class, 'reports'])->name('fleet.reports');
    Route::get('/fleet/{id}/diagnotics', [FleetController::class, 'diagnotics'])->name('fleet.diagnotics');
    Route::get('/fleet/{id}/alarms', [FleetController::class, 'alarms'])->name('fleet.alarms');
    Route::get('/fleet/{id}/emision', [FleetController::class, 'emision'])->name('fleet.emision');
    Route::get('/fleet/{id}/charter', [FleetController::class, 'charter'])->name('fleet.charter');

    Route::get('/overview/mileage', [OverViewController::class, 'index'])->name('overview.index');
    Route::get('/overview/speed', [OverViewController::class, 'speed'])->name('overview.speed');
    Route::get('/overview/cargo', [OverViewController::class, 'cargo'])->name('overview.cargo');
    Route::get('/overview/duration', [OverViewController::class, 'fleetStatus'])->name('overview.duration');

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::group([
        'as' => 'master.',
        'prefix' => 'master',
    ], function() {
        Route::resource('fleets', \App\Http\Controllers\Master\FleetController::class);

        Route::get('equipment/{id}', [\App\Http\Controllers\Master\EquipmentController::class, 'show'])->name('equipment.show');
        Route::get('equipment/{id}/create', [\App\Http\Controllers\Master\EquipmentController::class, 'create'])->name('equipment.add');
        Route::get('equipment/{id}/edit', [\App\Http\Controllers\Master\EquipmentController::class, 'edit'])->name('equipment.edit');
        Route::put('equipment/{id}/update', [\App\Http\Controllers\Master\EquipmentController::class, 'update'])->name('equipment.update');
        Route::delete('equipment/{id}/destroy', [\App\Http\Controllers\Master\EquipmentController::class, 'destroy'])->name('equipment.destroy');
        Route::post('equipment/{id}/store', [\App\Http\Controllers\Master\EquipmentController::class, 'store'])->name('equipment.store');

        Route::get('equipment/sensor/{id}', [\App\Http\Controllers\Master\EquipmentSensorController::class, 'show'])->name('equipment.sensor.show');
        Route::get('equipment/sensor/{id}/add', [\App\Http\Controllers\Master\EquipmentSensorController::class, 'create'])->name('equipment.sensor.add');
        Route::post('equipment/sensor/{id}', [\App\Http\Controllers\Master\EquipmentSensorController::class, 'store'])->name('equipment.sensor.store');
        Route::get('equipment/sensor/{id}/edit', [\App\Http\Controllers\Master\EquipmentSensorController::class, 'edit'])->name('equipment.sensor.edit');
        Route::put('equipment/sensor/{id}', [\App\Http\Controllers\Master\EquipmentSensorController::class, 'update'])->name('equipment.sensor.update');
        Route::delete('equipment/sensor/{id}', [\App\Http\Controllers\Master\EquipmentSensorController::class, 'destroy'])->name('equipment.sensor.destroy');


        Route::group([
            'as' => 'fleets.', 
            'prefix' => 'fleets', 
            'middleware' => ['can:Fleet Manage'],
            'controller' => \App\Http\Controllers\Master\FleetController::class], function() {
            Route::get('{id}/pic', 'pic')->name('pic');
            Route::post('{id}/pic/update', 'picUpdate')->name('pic.update')->middleware('can:Fleet PIC Manage');
            Route::delete('pic/delete/{id}', 'picDelete')->name('pic.delete')->middleware('can:Fleet PIC Manage');
            Route::get('{id}/edit-cargo-information','editCargo')->name('editCargo');
            Route::put('{id}/update-cargo-information', 'updateCargo')->name('updateCargo');
            Route::get('{id}/edit-bunker-information', 'editBunker')->name('editBunker');
            Route::put('{id}/update-bunker-information', 'updateBunker')->name('updateBunker');
            Route::get('{id}/docs', 'docs')->name('docs');
            Route::post('{id}/docs', 'uploadDocs')->name('docs.upload');
            Route::post('{id}/sounding', 'uploadSounding')->name('sounding.upload');
            Route::post('{id}/info-sounding', 'getSounding')->name('sounding.detail');
            Route::delete('{id}/docs', 'docDel')->name('docs.delete');
        });

        Route::resource('oils', \App\Http\Controllers\Master\OilAnalyticController::class);
        Route::get('oils/process', [\App\Http\Controllers\Master\OilAnalyticController::class, 'process'])->name('oils.process');
        Route::post('oils/file-upload', [\App\Http\Controllers\Master\OilAnalyticController::class, 'upload'])->name('oils.file-upload');
        Route::post('oils/clear-data', [\App\Http\Controllers\Master\OilAnalyticController::class, 'clearData'])->name('oils.clear-data');

        Route::get('form/main-engine', [\App\Http\Controllers\Master\FormController::class, 'me'])->name('form.main-engine')->middleware('can:Upload Sensor');
        Route::post('form/main-engine-upload', [\App\Http\Controllers\Master\FormController::class, 'meUpload'])->name('form.main-engine.upload')->middleware('can:Upload Sensor');
        Route::post('form/main-engine',  [\App\Http\Controllers\Master\FormController::class, 'store'])->name('form.main-engine.process')->middleware('can:Upload Sensor');

        Route::get('form/dg', [\App\Http\Controllers\Master\DGFromController::class, 'form'])->name('form.dg')->middleware('can:Upload Sensor');
        Route::post('form/dg-upload', [\App\Http\Controllers\Master\DGFromController::class, 'formUpload'])->name('form.dg.upload')->middleware('can:Upload Sensor');
        Route::post('form/dg',  [\App\Http\Controllers\Master\DGFromController::class, 'store'])->name('form.dg.process')->middleware('can:Upload Sensor');

        Route::resource('ports', \App\Http\Controllers\Master\PortController::class)->middleware('can:Port Manage');

        Route::resource('user', \App\Http\Controllers\Master\UserController::class)->middleware('is_superuser');
        Route::group([
            'as' => 'user.', 
            'prefix' => 'user', 
            'middleware' => 'is_superuser',
            'controller' => \App\Http\Controllers\Master\UserController::class], function() {
            Route::get('change-password', 'changePassword')->name('change-password');
            Route::post('change-password', 'changePasswordPost')->name('change-password.post');
            Route::get('{id}/permission', 'editUserPermission')->name('permission');
            Route::get('{id}/get-permission', 'getUserPermission')->name('permission.get');
            Route::get('{id}/get-fleets', 'getUserFleet')->name('fleets.get');
            Route::post('{id}/update-permission', 'updateUserPermission')->name('permission.update');
            Route::post('{id}/update-fleet-access', 'updateUserFleetAccess')->name('fleets.update');
        });
        
        Route::group([
            'middleware' => 'is_superuser'
        ], function() {
            Route::get('roles/json', [\App\Http\Controllers\Master\RoleController::class, 'json'])->name('roles.json');
            Route::resource('roles', \App\Http\Controllers\Master\RoleController::class);
            Route::get('fleets/data/json', [\App\Http\Controllers\Master\FleetController::class, 'json'])->name('fleets.json');
            Route::get('permission/json', [\App\Http\Controllers\Master\PermissionController::class, 'json'])->name('permission.json');
            Route::resource('permission', \App\Http\Controllers\Master\PermissionController::class);

            Route::get('activity/logs', [\App\Http\Controllers\Master\LogController::class, 'index'])->name('activity.logs');
        });

        Route::group([
            'middleware' => 'can:Fleet Threshold Sensor Setting'
        ], function(){
            Route::delete('sensors/delete/{id}', [\App\Http\Controllers\Master\SensorController::class, 'destroy'])->name('sensors.destroy');
            Route::post('sensors/update', [\App\Http\Controllers\Master\SensorController::class, 'update'])->name('sensors.edit');
            Route::post('sensors/add-doc', [\App\Http\Controllers\Master\SensorController::class, 'addDoc'])->name('sensors.add-doc');
        });
        
        Route::resource('settings', \App\Http\Controllers\Master\SettingController::class);
    });
});

Route::post('/upload/svg', [\App\Http\Controllers\Master\FleetController::class, 'uploadSvg'])->middleware(['can:Fleet Threshold Sensor Setting', 'xss_sanitizer'])->name('upload.svg');
        
Route::get('/coba/{id}', function($id){
    // $fleet = \App\Models\Fleet::findOrFail($id);    
    // $d = (new \App\Report\CreateSensorConditionReport($fleet));

    // return $d->handle();
});