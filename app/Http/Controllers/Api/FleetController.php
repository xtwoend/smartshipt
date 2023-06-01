<?php

namespace App\Http\Controllers\Api;

use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FleetController extends Controller
{
    public function show($id, Request $request)
    {
        $fleet = Fleet::with('navigation', 'engine')->findOrFail($id);
        return response()->json($fleet);
    }
}
