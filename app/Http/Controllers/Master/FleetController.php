<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index()
    {
        return view('master.fleets.index');
    }
}
