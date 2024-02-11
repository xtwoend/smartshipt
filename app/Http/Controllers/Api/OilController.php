<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Fleet;
use App\Models\FleetOilLube;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OilController extends Controller
{
    public function trend($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);

        $from = Carbon::parse($request->input('from'))->timezone('Asia/Jakarta');
        $to = Carbon::parse($request->input('to'))->timezone('Asia/Jakarta');
        $select = $request->input('select', ['*']);

        $rows = FleetOilLube::table($fleet->id)
            ->select($select)
            ->whereBetween('sample_date', [$from, $to])
            ->orderBy('sample_date', 'desc')
            ->get();

        return response()->json($rows, 200);
    }
}
