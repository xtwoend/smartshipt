<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FleetDashboardResource;

class FleetController extends Controller
{
    public function lists(Request $request)
    {
        $fleets = Fleet::where('active', 1);
        if($request->has('q')){
            $fleets = $fleets->where('name', $request->q);
        }
        $fleets = $fleets->get();

        return response()->json(FleetDashboardResource::collection($fleets));
    }
}
