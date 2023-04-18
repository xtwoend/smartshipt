<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NaviController extends Controller
{
    public function route(Request $request)
    {
        return view('route');
    }
}
