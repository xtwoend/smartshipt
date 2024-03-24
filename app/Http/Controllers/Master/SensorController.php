<?php

namespace App\Http\Controllers\Master;

use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensorController extends Controller
{
    public function update(Request $request)
    {
        $input = $request->all();
        $input['is_ams'] = ($request->is_ams) ? 1 : 0;
        
        if($request->has('id') && $request->id !== 0) {
            $sensor = Sensor::find($request->id)->update($input);
        }else{
            $sensor = Sensor::create($input);
        }
        return $sensor;
    }

    public function destroy($id)
    {
        return Sensor::findOrFail($id)->delete();
    }


    public function addDoc($id, Request $request) 
    {
        $input = $request->all();
        $sensor = Sensor::find($id);

        $doc = SensorDoc::updateOrCreate([
            'fleet_id' => $sensor->fleet_id,
            'sensor_name' => $sensor->sensor_name,
        ], [
            'low_desc' => $request->low_desc,
            'high_desc' => $request->high_desc,
            'image' => $request->image,
            'diagram' => $request->diagram,
        ]);
    }
}
