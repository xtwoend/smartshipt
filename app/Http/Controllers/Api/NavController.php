<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Fleet;
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

        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        $fromClone = clone $from;
        $toClone = clone $to;

        $fromDiff = $from->format("Y-m-01 00:00:00");
        $toDiff = $to->format("Y-m-01 00:00:00");
        
        $count = Carbon::parse($fromDiff)->diffInMonths(Carbon::parse($toDiff));

        for($i=0; $i <= $count; $i++) {
            $tableName = NavigationLog::table($fleet->id, $from)->getTable();
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
            $from = $from->addMonth();
        }

        $query = implode(' UNION ', $query);
        $rows = collect(DB::select($query));
        $rows = $rows->sortBy('unix_time')->values()->all();

        // $current = null;
        // $data = [];
        // foreach($rows as $row) {
        //     if($current){
        //         $r = calc_crow($current->lat, $current->lng, $row->lat, $row->lng);
        //         if($r > 100) {
        //             continue;
        //         }
        //     }
        //     $current = $row;
        //     $data[] = $row;
        // }

        return response()->json($rows);
    }
}
