<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Fleet;
use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Models\NavigationLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    public function history($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);

        $from  = $request->input('from', Carbon::now()->format('Y-m-d'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d'));
        $interval = $request->input('interval', 1800);

        $from = Carbon::parse($from)->timezone('Asia/Jakarta');
        $to = Carbon::parse($to)->timezone('Asia/Jakarta');
        $fromClone = clone $from;
        $toClone = clone $to;

        $fromDiff = $fromClone->format("Y-m-01 00:00:00");
        $toDiff = $toClone->format("Y-m-01 00:00:00");
        $fromTable = Carbon::parse($fromDiff);
        
        $count = Carbon::parse($fromDiff)->diffInMonths(Carbon::parse($toDiff));
       
        for($i=0; $i <= $count; $i++) {
            $tableName = NavigationLog::table($fleet->id, $fromTable)->getTable();
           
            $query[] = "
            (select 
                UNIX_TIMESTAMP(ct.terminal_time) as unix_time, ct.*
                from {$tableName} as `ct` 
                    inner join 
                    (
                        SELECT MIN(terminal_time) as times, FLOOR(UNIX_TIMESTAMP(terminal_time)/{$interval}) AS timekey 
                        FROM {$tableName} 
                        WHERE DATE(terminal_time) BETWEEN '{$fromClone->format('Y-m-d')}' AND '{$toClone->format('Y-m-d')}' 
                        GROUP BY timekey
                    ) ctx 
                    on `ct`.`terminal_time` = `ctx`.`times`)
            ";
            
            $fromTable = $fromTable->addMonth();
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();

        return response()->json($rows);
    }

    public function trend($id, Request $request)  
    {
        $fleet = Fleet::findOrFail($id);
        $date = $request->input('date');
        
        $interval = $request->input('interval', 60);
        $interval = $interval * 60;
        $select = $request->input('select', ['*']);

        $from = Carbon::parse($request->input('from'))->timezone('Asia/Jakarta');
        $to = Carbon::parse($request->input('to'))->timezone('Asia/Jakarta');
        $fromClone = clone $from;
        $toClone = clone $to;

        $fromDiff = $fromClone->format("Y-m-01 00:00:00");
        $toDiff = $toClone->format("Y-m-01 00:00:00");
        $fromTable = Carbon::parse($fromDiff);
        
        $count = Carbon::parse($fromDiff)->diffInMonths(Carbon::parse($toDiff));
       
        for($i=0; $i <= $count; $i++) {
            $tableName = NavigationLog::table($fleet->id, $fromTable)->getTable();
           
            $query[] = "
            (select 
                UNIX_TIMESTAMP(ct.terminal_time) * 1000 as unix_time, ct.*
                from {$tableName} as `ct` 
                    inner join 
                    (
                        SELECT MIN(terminal_time) as times, FLOOR(UNIX_TIMESTAMP(terminal_time)/{$interval}) AS timekey 
                        FROM {$tableName} 
                        WHERE DATE(terminal_time) BETWEEN '{$fromClone->format('Y-m-d H:i:s')}' AND '{$toClone->format('Y-m-d H:i:s')}' 
                        GROUP BY timekey
                    ) ctx 
                    on `ct`.`terminal_time` = `ctx`.`times`)
            ";
            
            $fromTable = $fromTable->addMonth();
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();

        return response()->json($rows);
    }

    public function currentNav($id) 
    {
        $fleet = Fleet::findOrFail($id);
        return response()->json($fleet->navigation, 200);
    }

    public function export($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);

        $from  = $request->input('from', Carbon::now()->format('Y-m-d'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d'));
        $interval = $request->input('interval', 1800);

        $from = Carbon::parse($from)->timezone('Asia/Jakarta');
        $to = Carbon::parse($to)->timezone('Asia/Jakarta');
        $fromClone = clone $from;
        $toClone = clone $to;

        $fromDiff = $fromClone->format("Y-m-01 00:00:00");
        $toDiff = $toClone->format("Y-m-01 00:00:00");
        $fromTable = Carbon::parse($fromDiff);
        
        $count = Carbon::parse($fromDiff)->diffInMonths(Carbon::parse($toDiff));
       
        for($i=0; $i <= $count; $i++) {
            $tableName = NavigationLog::table($fleet->id, $fromTable)->getTable();
           
            $query[] = "
            (select 
                UNIX_TIMESTAMP(ct.terminal_time) as unix_time, ct.*
                from {$tableName} as `ct` 
                    inner join 
                    (
                        SELECT MIN(terminal_time) as times, FLOOR(UNIX_TIMESTAMP(terminal_time)/{$interval}) AS timekey 
                        FROM {$tableName} 
                        WHERE DATE(terminal_time) BETWEEN '{$fromClone->format('Y-m-d')}' AND '{$toClone->format('Y-m-d')}' 
                        GROUP BY timekey
                    ) ctx 
                    on `ct`.`terminal_time` = `ctx`.`times`)
            ";
            
            $fromTable = $fromTable->addMonth();
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();

        $headers = [
            'wind_speed' => 'Wind Speed',
            'wind_direction' => 'Wind Direction',
            'lat' => 'Latitude',
            'lat_dir' => 'Latitude Dir',
            'lng' => 'Longtitude',
            'lng_dir' => 'Longtitude Dir',
            'sog' => 'SOG',
            'cog' => 'COG',
            'total_distance' => 'Total Distance',
            'distance' => 'Distance',
            'heading' => 'Heading',
            'rot' => 'ROT',
            'depth' => 'Depth'
        ];

        return exportCsv($headers, $rows, 'export-navigation.csv');
    } 
}
