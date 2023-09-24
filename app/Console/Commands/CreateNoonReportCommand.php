<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Alarm;
use App\Models\Fleet;
use App\Models\NavigationLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;

class CreateNoonReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:noon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Noon report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        $fleet = Fleet::findOrFail($id);
        $from = $request->input('from', Carbon::now()->subHours(24)->format('Y-m-d H:i:s'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d H:i:s'));
        $date = Carbon::parse($from)->format('Y-m-d');
        
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

        return Command::SUCCESS;
    }
}
