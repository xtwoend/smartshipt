<?php


use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('fleet/navi', function(Request $request){
    $fleets = Fleet::with('navigation');
    if($request->has('q')){
        $fleets = $fleets->where('name', $request->q);
    }
    $fleets = $fleets->get();
    return response()->json($fleets);
});