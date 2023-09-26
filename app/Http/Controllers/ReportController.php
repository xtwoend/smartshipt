<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Report\CreateNoonReport;

class ReportController extends Controller
{
    public function noonReport($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);
        $to = $request->input('to', Carbon::now()->format('Y-m-d H:i:s'));

        $filename = (new CreateNoonReport($fleet, $to))->handle();

        // return $filename;
        return response()->download(public_path($filename));
    }
}
