<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alarm;
use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Models\NavigationLog;

class ReportController extends Controller
{
    public function noonReport($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        $from = $request->input('from', Carbon::now()->subHours(24)->format('Y-m-d H:i:s'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d H:i:s'));

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

        // return view('emails.noon-report', compact('fleet', 'navigation', 'avgSpeed', 'status', 'from', 'alarms'));

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.noon-report', compact('fleet', 'navigation', 'avgSpeed', 'status'));
        return $pdf->download('noon-report-'. $fleet->name .'-'.$from.'.pdf');
    }
}
