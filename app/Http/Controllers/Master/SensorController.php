<?php

namespace App\Http\Controllers\Master;

use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensorController extends Controller
{
    public function update(Request $request)
    {
        if($request->id !== 0) {
            $sensor = Sensor::find($request->id)->update($request->all());
        }else{
            $sensor = Sensor::create($request->all());
        }
        return $sensor;
    }

    public function destroy($id)
    {
        return Sensor::findOrFail($id)->delete();
    }
}
