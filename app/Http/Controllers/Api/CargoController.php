<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Fleet;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CargoController extends Controller
{
    public function trend($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        $date = $request->input('date');
        
        $interval = $request->input('interval', 60);
        $interval = $interval * 60;
        $select = $request->input('select', ['*']);

        $formattingSelect = array_map(function($val){
            $explode = explode('_', $val);
            if(end($explode) == 'percentage') {
                $val = strip_tags(str_replace('_percentage', '', $val));
            }else {
                $val = strip_tags($val);
            }
            return "ct.{$val}";
        }, $select);
    
        $select_column = implode(',', $formattingSelect);

        $from = Carbon::parse($request->input('from'))->timezone('Asia/Jakarta');
        $to = Carbon::parse($request->input('to'))->timezone('Asia/Jakarta');
        $fromClone = clone $from;
        $toClone = clone $to;

        $fromDiff = $fromClone->format("Y-m-01 00:00:00");
        $toDiff = $toClone->format("Y-m-01 00:00:00");
        $fromTable = Carbon::parse($fromDiff);
        
        $count = Carbon::parse($fromDiff)->diffInMonths(Carbon::parse($toDiff));
        $query = [];
        for($i=0; $i <= $count; $i++) {

            $classModel = $fleet->cargo_logs();
            if(is_null($classModel)) continue;

            $tableName = $classModel::table($fleet->id, $fromTable)->getTable();
            if(! Schema::hasTable($tableName)) continue;
            
            $query[] = "
            (select 
                UNIX_TIMESTAMP(ct.terminal_time) * 1000 as unix_time, ct.terminal_time, {$select_column}
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

        if(empty($query)) {
            return response()->json([]);
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();

        return response()->json($rows, 200);
    }
    
    public function currentCargo($id) 
    {
        $fleet = Fleet::findOrFail($id);
        return response()->json($fleet->cargo(), 200);
    }

    public function export($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        
        $interval = $request->input('interval', 60);
        $interval = $interval * 60;
        $select = parse_url($request->input('select', ['*']));
        $arraySelect = explode(',', $select['path'] ?? '');
        
        $formattingSelect = array_map(function($val){
            $val = strip_tags($val);
            return "ct.{$val}";
        }, $arraySelect);
        
        $select_column = implode(',', $formattingSelect);

        $from = Carbon::parse($request->input('from'))->timezone('Asia/Jakarta');
        $to = Carbon::parse($request->input('to'))->timezone('Asia/Jakarta');
        $fromClone = clone $from;
        $toClone = clone $to;

        $fromDiff = $fromClone->format("Y-m-01 00:00:00");
        $toDiff = $toClone->format("Y-m-01 00:00:00");
        $fromTable = Carbon::parse($fromDiff);
        
        $count = Carbon::parse($fromDiff)->diffInMonths(Carbon::parse($toDiff));
        $query = [];
        for($i=0; $i <= $count; $i++) {

            $classModel = $fleet->cargo_logs();
            if(is_null($classModel)) continue;

            $tableName = $classModel::table($fleet->id, $fromTable)->getTable();
            if(! Schema::hasTable($tableName)) continue;
            
            $query[] = "
            (select 
                UNIX_TIMESTAMP(ct.terminal_time) * 1000 as unix_time, ct.terminal_time, {$select_column}
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

        if(empty($query)) {
            return response()->json([]);
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();
        
        $headers = Sensor::whereIn('sensor_name', $arraySelect)->where('fleet_id', $id)->get()->pluck('name', 'sensor_name')->toArray();
        
        return exportCsv($headers, $rows, 'export.csv');
    } 
}
