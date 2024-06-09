<?php

namespace App\Http\Controllers\Master;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\EquipmentSensor;
use App\Http\Controllers\Controller;

class EquipmentSensorController extends Controller
{
    public function show($id, Request $request)
    {
        $equipment = Equipment::findOrFail($id);
        $list = $equipment->sensors()->with('sensor')->paginate(20);

        return view('master.equipment_sensor.index', compact('list', 'equipment'));
    }

    public function create($id, Request $request)
    {
        $equipment = Equipment::findOrFail($id);
        return view('master.equipment_sensor.create', compact('equipment'));
    }

    public function store($id, Request $request)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->sensors()->create($request->all());

        return redirect()->route('master.equipment.sensor.show', $id);
    }

    public function edit($id, Request $request)
    {
        $sensor = EquipmentSensor::findOrFail($id);
        
        return view('master.equipment_sensor.edit', compact('sensor'));
    }

    public function update($id, Request $request)
    {
        $data = EquipmentSensor::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('master.equipment.sensor.show', $data->equipment_id);
    }

    public function destroy($id)
    {
        $data = EquipmentSensor::findOrFail($id);
        $data->delete();

        return redirect()->route('master.equipment.sensor.show', $data->equipment_id);
    }
}
