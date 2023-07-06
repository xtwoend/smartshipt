<?php

namespace App\Http\Controllers\Master;

use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensorController extends Controller
{
    public function update(Request $request)
    {
        $sensor = Sensor::find($request->id);

        return $sensor->update($request->all());
    }
}
