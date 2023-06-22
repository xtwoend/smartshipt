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
        $fleets = Fleet::with('navigation');
        if($request->has('q')){
            $fleets = $fleets->where('name', $request->q);
        }
        $fleets = $fleets->get();

        return response()->json(FleetResource::collection($fleets));
    }

    public function show($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return response()->json(new FleetResource($fleet));
    }
}
