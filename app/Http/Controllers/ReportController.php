<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Report\CreateAlarmReport;


class ReportController extends Controller
{
    public function alarmReport($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        $to = $request->input('to', Carbon::now()->format('Y-m-d H:i:s'));

        $filename = (new CreateAlarmReport($fleet, $to, '/telegram'))->handle();

        // return $filename;
        return response()->download(public_path($filename));
    }
}
