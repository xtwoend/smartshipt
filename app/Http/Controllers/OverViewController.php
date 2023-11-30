<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Models\FleetDailyReport;
use Illuminate\Support\Facades\DB;
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
}
