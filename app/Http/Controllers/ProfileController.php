<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.profile');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()) {
            if($request->ajax()){
                return response()->json($validator->errors()->first(), 422);
            }
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->ajax()) {
            return response()->json('success');
        }

        return redirect()->route('user.profile');
    }
}
