<?php

namespace App\Http\Controllers\Api;

use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FleetResource;

class FleetController extends Controller
{
    public function fleets(Request $request)
    {
        $user = $request->user();

        if($user && $user->can('All Fleets') || $user->is_root) {
            $fleets = Fleet::select('id', 'name', 'image', 'imo_number', 'last_connection', 'connected', 'fleet_status', 'last_port')->with('navigation')->active();
        }else{
            $fleets = $user->fleets()->select('fleets.id', 'fleets.name', 'fleets.image', 'fleets.imo_number', 'fleets.last_connection', 'fleets.connected', 'fleets.fleet_status', 'fleets.last_port')->with('navigation');
        }

        if($request->has('q')){
            $fleets = $fleets->where('name', 'LIKE', '%'.$request->q.'%');
        }

        if($request->has('fleet_status') && $request->fleet_status !== 'all') {
            $fleets = $fleets->where('fleet_status', $request->fleet_status);
        }

        $fleets = $fleets->get();

        return response()->json(FleetResource::collection($fleets));
    }

    public function show($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return response()->json(new FleetResource($fleet));
    }

    public function lists(Request $request)
    {
        $fleets = Fleet::with('navigation')->active();
        if($request->has('q')){
            $fleets = $fleets->where('name', $request->q);
        }
        $fleets = $fleets->paginate($request->input('rpp', 5));

        return response()->json(FleetResource::collection($fleets));
    }
}
