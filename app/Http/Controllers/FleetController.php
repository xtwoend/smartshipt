<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alarm;
use App\Models\Fleet;
use App\Models\FleetOilLube;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    protected function accessFleet($id, Request $request) {
        $user = $request->user();
        if($user->is_root || $user->can('All Fleets') || in_array($id, $user->fleets->pluck('id')->toArray())) {
           
        }else{
            return abort('403');
        }
    }

    public function index($id, Request $request)
    {
        $this->accessFleet($id, $request);
        
        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.index', compact('fleet'));
    }

    public function track($id, Request $request) 
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.track', compact('fleet'));
    }

    public function engine($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        $routeName = $request->route()->getName();
        if($fleet->submenu()->count() > 0) {
            $page = $fleet->submenu()->where('route', 'fleet.engine')->first();
            if($page && !is_null($page->views)) {
                return view($page->views, compact('fleet'));
            }
        }
        return view('fleet.engine', compact('fleet'));
    }

    public function cargo($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        $routeName = $request->route()->getName();
        if($fleet->submenu()->count() > 0) {
            $page = $fleet->submenu()->where('route', 'fleet.cargo')->first();
            if($page && !is_null($page->views)) {
                return view($page->views, compact('fleet'));
            }
        }
        return view('fleet.cargo', compact('fleet'));
    }

    public function bunker($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        return view('fleet.fuel', compact('fleet'));
    }

    public function balast($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        return view('fleet.balast', compact('fleet'));
    }

    public function trend($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.trend', compact('fleet'));
    }

    public function notes($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.notes', compact('fleet'));
    }

    public function docs($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.docs', compact('fleet'));
    }

    public function reports($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.reports', compact('fleet'));
    }

    public function diagnotics($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.diagnotics', compact('fleet'));
    }

    public function alarms($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $alarms = Alarm::table($fleet->id);
        
        if($request->has('from') || $request->has('to')) {
            $from = $request->input('from', Carbon::now()->subMonth()->format('Y-m-d'));
            $to = $request->input('to', Carbon::now()->format('Y-m-d'));
            $alarms = $alarms->whereDate('started_at', '>=', $from)->whereDate('started_at', '<=', $to);
        }

        $alarms = $alarms->latest()->paginate(25);

        return view('fleet.alarms', compact('fleet', 'alarms'));
    }

    public function emision($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.emision', compact('fleet'));
    }

    public function charter($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.charter', compact('fleet'));
    }

    public function pumps($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.pumps', compact('fleet'));
    }

    public function oils($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $oils = FleetOilLube::table($id)->orderBy('sample_date', 'desc')->paginate(25);

        return view('fleet.oils', compact('fleet', 'oils'));
    }

    public function generator($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.generator', compact('fleet'));
    }

    public function equipment($id, Request $request)
    {
        $this->accessFleet($id, $request);
        
        $fleet = Fleet::findOrFail($id);
        $equipments = $fleet->equipments;
        
        return view('fleet.equipment', compact('fleet', 'equipments'));
    }
}
