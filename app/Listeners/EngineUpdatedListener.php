<?php

namespace App\Listeners;

use App\Events\EngineUpdated;
use App\Models\MainEngineLog;
use Illuminate\Support\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EngineUpdatedListener
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
     * @param  \App\Events\EngineUpdated  $event
     * @return void
     */
    public function handle(EngineUpdated $event)
    {
        $model = $event->model;
        $date = $model->terminal_time;
        $last = MainEngineLog::table($model->fleet_id, $date)->orderBy('terminal_time', 'desc')->first();
        $now = Carbon::parse($date);

        // save interval 60 detik
        if ($last && $now->diffInSeconds($last->terminal_time) < 60) {
            return;
        }

        return MainEngineLog::table($model->fleet_id, $date)->updateOrCreate([
            'fleet_id' => $model->fleet_id,
            'terminal_time' => $date,
        ], (array) $model->makeHidden(['id', 'fleet_id', 'created_at', 'updated_at'])->toArray());
    }
}
