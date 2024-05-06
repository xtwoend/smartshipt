<?php

namespace App\Http\Controllers\Master;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = new Setting;
        return view('master.setting.index', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        if(isset($input['_token'])) {
            unset($input['_token']);
        }

        foreach($input as $key => $val) {
            Setting::updateOrCreate([
                'key' => $key,
                'group' => 'email'
            ], [
                'value' => $val
            ]);
        }

        return redirect()->route('master.settings.index');
    }
}
