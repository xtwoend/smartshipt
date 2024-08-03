<?php

namespace App\Http\Controllers\Master;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Action;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    /**
     * logger
     */
    public function index(Request $request)
    {
        $userId = $request->input('user_id', null);

        if(is_null($userId)) {
            $lists = Activity::latest()->paginate(15);
        }else {
            $user = User::find($userId);
            $lists = Activity::causedBy($user)->latest()->paginate(15);
        }

        return view('master.logs.index', compact('lists'));
    }
}
