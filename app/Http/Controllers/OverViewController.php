<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Models\FleetDailyReport;
use Illuminate\Support\Facades\DB;
use App\Models\FleetStatusDuration;
use Illuminate\Support\Facades\Schema;

class OverViewController extends Controller
{
    public function index(Request $request) 
    {
        $type = $request->input('type', 'last-week');

        $from = ($type == 'last-month') ? Carbon::now()->subMonth()->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $mileage = [];
        $query = [];
        foreach(Fleet::active()->get() as $fleet) {
            $tableName = FleetDailyReport::table($fleet->id)->getTable();
            if(! Schema::hasTable($tableName)) continue;
            $query [] = "(SELECT fleet_id, sum(value) as mileage FROM {$tableName} WHERE {$tableName}.`date` BETWEEN '{$from}' AND '{$to}' AND {$tableName}.`sensor` = 'distance' GROUP BY  {$tableName}.`fleet_id`)";
        }
        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $fleetIds = $rows->pluck('fleet_id')->toArray();
        $fleets = Fleet::whereIn('id', $fleetIds)->get();

        $fleets->map(function($item) use ($rows) {
            $row = $rows->where('fleet_id', $item->id)->first();
            if($row) {
                $item['mileage'] = $row->mileage;
            }
        });

        return view('overview.mileage', compact('fleets'));
    }

    /**
     * speed overview
     */
    public function speed(Request $request) 
    {
        $type = $request->input('type', 'last-week');

        $from = ($type == 'last-month') ? Carbon::now()->subMonth()->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $mileage = [];
        $query = [];
        foreach(Fleet::active()->get() as $fleet) {
            $tableName = FleetDailyReport::table($fleet->id)->getTable();
            if(! Schema::hasTable($tableName)) continue;
            $query [] = "(SELECT fleet_id, AVG(after) as speed FROM {$tableName} WHERE {$tableName}.`date` BETWEEN '{$from}' AND '{$to}' AND {$tableName}.`sensor` = 'speed' GROUP BY  {$tableName}.`fleet_id`)";
        }
        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $fleetIds = $rows->pluck('fleet_id')->toArray();
        $fleets = Fleet::whereIn('id', $fleetIds)->get();

        $fleets->map(function($item) use ($rows) {
            $row = $rows->where('fleet_id', $item->id)->first();
            if($row) {
                $item['speed'] = $row->speed;
            }
        });

        return view('overview.speed', compact('fleets'));
    }

    /**
     * cargo percentage overview
     */
    public function cargo(Request $request) 
    {
        $type = $request->input('type', 'last-week');

        $from = ($type == 'last-month') ? Carbon::now()->subMonth()->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $mileage = [];
        $query = [];
        foreach(Fleet::active()->get() as $fleet) {
            $tableName = FleetDailyReport::table($fleet->id)->getTable();
            if(! Schema::hasTable($tableName)) continue;
            $query [] = "(SELECT fleet_id, AVG(after) as capacity FROM {$tableName} WHERE {$tableName}.`date` BETWEEN '{$from}' AND '{$to}' AND {$tableName}.`sensor` = 'cargo_percentage' GROUP BY  {$tableName}.`fleet_id`)";
        }
        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $fleetIds = $rows->pluck('fleet_id')->toArray();
        $fleets = Fleet::whereIn('id', $fleetIds)->get();

        $fleets->map(function($item) use ($rows) {
            $row = $rows->where('fleet_id', $item->id)->first();
            if($row) {
                $item['capacity'] = $row->capacity;
            }
        });

        return view('overview.cargo', compact('fleets'));
    }

    /**
     * speed overview
     */
    public function fleetStatus(Request $request) 
    {
        $status = $request->input('status', 'at_port');
        $type = $request->input('type', 'last-week');
        $from = ($type == 'last-month') ? Carbon::now()->subMonth()->format('Y-m-d') : Carbon::now()->subDays(7)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $fleets = FleetStatusDuration::with('fleet')->select(DB::raw('fleet_id, SUM(TIMESTAMPDIFF(SECOND, started_at, finished_at)) as seconds', 'fleet_id'))
            ->whereNotNull('finished_at')
            ->where('fleet_status', $status)
            ->whereDate('started_at', '>=', $from)
            ->whereDate('started_at', '<=', $to)
            ->groupBy('fleet_id')
            ->orderBy('seconds', 'desc')
            ->get();

        return view('overview.durations', compact('fleets', 'status'));
    }
}
