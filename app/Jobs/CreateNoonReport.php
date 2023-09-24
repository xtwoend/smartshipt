<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Alarm;
use App\Models\Fleet;
use App\Models\NavigationLog;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateNoonReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fleetId;
    protected $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fleetId, $date)
    {
        $this->fleetId = $fleetId;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $id = $this->fleetId;
        $to = $this->date;

        $to = $to ? Carbon::parse($to)->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d 13:00:00');


        $fleet = Fleet::findOrFail($id);
        $from = Carbon::parse($to)->subHours(24)->format('Y-m-d H:i:s');

        $date = Carbon::parse($to)->format('Y-m-d');
        
        $navigation = $fleet->navigation;
        $avgSpeed = NavigationLog::table($fleet->id, $from)
            ->whereBetween('terminal_time', [$from, $to])
            ->where('sog', '>=', 2)
            ->avg('sog');

        $status = [
            'at_port' => 'At Port',
            'underway' => 'Underway',
            'lost_connection' => 'Lost Connection',
            'at_anchorage' => 'At Anchorage',
            'other' => 'Other'
        ];

        $alarms = Alarm::table($fleet->id)->whereBetween('started_at', [$from, $to])->get();
        $filename = "/report/noon-report-{$fleet->id}-{$date}.pdf";

        $pdf = Pdf::loadView('emails.noon-report', compact('fleet', 'navigation', 'avgSpeed', 'status', 'from', 'alarms'));
        $pdf->save(public_path($filename));
    }
}
