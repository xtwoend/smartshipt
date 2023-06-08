<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index($id, Request $request)
    {
        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.index', compact('fleet'));
    }

    public function engine($id, Request $request)
    {
        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.engine', compact('fleet'));
    }

    public function cargo($id, Request $request)
    {
        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.cargo', compact('fleet'));
    }

    public function trend($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.trend', compact('fleet'));
    }

    public function notes($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.notes', compact('fleet'));
    }

    public function docs($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.docs', compact('fleet'));
    }

    public function reports($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.reports', compact('fleet'));
    }

    public function diagnotics($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.diagnotics', compact('fleet'));
    }

    public function alarms($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.alarms', compact('fleet'));
    }

    public function emision($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.emision', compact('fleet'));
    }

    public function charter($id, Request $request)
    {
        $fleet = Fleet::with('navigation')->findOrFail($id);
        return view('fleet.charter', compact('fleet'));
    }
}
