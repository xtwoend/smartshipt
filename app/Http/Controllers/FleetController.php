<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index($id, Request $request)
    {
        $fleet =  Fleet::findOrFail($id);
        return view('fleet.index', compact('fleet'));
    }
}
