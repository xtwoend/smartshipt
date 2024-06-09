<?php

namespace App\Http\Controllers\Master;

use App\Models\Fleet;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    public function show($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        $list = $fleet->equipments()->paginate(20);
        $groups = ['engine' => 'Main Engine', 'cargo_pump' => 'Cargo Pump'];

        return view('master.equipment.index', compact('list', 'fleet', 'groups'));
    }

    public function create($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);

        return view('master.equipment.create', compact('fleet'));
    }

    public function store($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        $fleet->equipments()->create($request->all());

        return redirect()->route('master.equipment.show', $fleet->id);
    }

    public function edit($id, Request $request)
    {
        $data = Equipment::findOrFail($id);
        $fleet = Fleet::findOrFail($data->fleet_id);
        return view('master.equipment.edit', compact('data', 'fleet'));
    }

    public function update($id, Request $request)
    {
        $data = Equipment::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('master.equipment.show', $data->fleet_id);
    }

    public function destroy($id)
    {
        $data = Equipment::findOrFail($id);
        $fleetId = $data->fleet_id;
        $data->delete();
        
        return redirect()->route('master.equipment.show', $fleetId);
    }
}
