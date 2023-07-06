<?php

namespace App\Http\Controllers\Master;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $list = User::paginate(10);
        return view('master.users.index', compact('list'));
    }

    function show($id, Request $request) : View {
        $row = User::find($id);
        return view('master.users.show', compact('row'));
    }

    function create(Request $request) : View {
        return view('master.users.create');
    }

    function edit($id, Request $request) : View {
        return view('master.users.edit');
    }
}
