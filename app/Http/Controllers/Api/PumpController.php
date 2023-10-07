<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class PumpController extends Controller
{
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
        $query = [];
        for($i=0; $i <= $count; $i++) {

            $classModel = $fleet->cargo_pump_logs();
           
            if(is_null($classModel)) continue;

            $tableName = $classModel::table($fleet->id, $fromTable)->getTable();
            if(! Schema::hasTable($tableName)) continue;
            
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

        if(empty($query)) {
            return response()->json([]);
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();

        return response()->json($rows);
    }

    public function currentPumps($id) 
    {
        $fleet = Fleet::findOrFail($id);
        return response()->json($fleet->cargo_pump(), 200);
    }
}
