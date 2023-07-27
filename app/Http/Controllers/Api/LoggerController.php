<?php

namespace App\Http\Controllers\Api;

use App\Models\Fleet;
use App\Models\Logger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoggerController extends Controller
{
    public function data($id, Request $request)
    {
        $fleet = Fleet::findOrFail($id);

        $group = $request->input('group', 'navigation');
        $data = Logger::table($fleet->id)->where('group', $group)->orderBy('terminal_time', 'asc')->limit(500)->get();

        return response()->json($data, 200);
    }
}
