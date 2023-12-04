<?php

namespace App\Report;

use Carbon\Carbon;
use App\Models\Alarm;
use App\Models\Fleet;
use App\Models\NavigationLog;
use Barryvdh\DomPDF\Facade\Pdf;


class CreateAlarmReport
{
    protected $fleet;
    protected $date;
    protected $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fleet, $date = null, $path = '/report')
    {
        $this->fleet = $fleet;
        $this->date = $date;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $to = $this->date;
        $to = $to ? Carbon::parse($to)->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d 13:00:00');

        $fleet = $this->fleet;
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

        $alarms = Alarm::table($fleet->id)->whereBetween('started_at', [$from, $to])->latest()->get();
        $filename = $this->path . "/alarm-report-{$fleet->id}-{$date}.pdf";

        $pdf = Pdf::loadView('report.alarm-report', compact('fleet', 'navigation', 'avgSpeed', 'status', 'from', 'alarms'));
        $pdf->save(public_path($filename));

        return $filename;
        // return view('report.alarm-report', compact('fleet', 'navigation', 'avgSpeed', 'status', 'from', 'alarms'));
    }
}