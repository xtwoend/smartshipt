<?php

namespace App\Http\Controllers\Api;

use App\Models\Sensor;
use App\Models\SensorDoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensorDocController extends Controller
{
    public function doc(Request $request) {
        $fleet_id = $request->fleet_id;
        $sensorName = $request->sensor_name;

        $doc = SensorDoc::where('fleet_id', $fleet_id)->where('sensor_name', $sensorName)->first();
        $name = Sensor::where('fleet_id', $fleet_id)->where('sensor_name', $sensorName)->first();
        
        if($name) {
            $doc['name'] = $name->name;
        }

        if($doc) {
            return response()->json($doc);
        }
        return response()->json(false);
    }
}
