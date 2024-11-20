<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\DieselGeneratorLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DGListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $model = $event->model;
        $date = $model->terminal_time;
        $dg_count = $model->dg_count;

        $last = DieselGeneratorLog::table($model->fleet_id, $date, $dg_count)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < 60) {
            return;
        }

        return DieselGeneratorLog::table($model->fleet_id, $date, $dg_count)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
