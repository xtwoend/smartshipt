<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\BunkerInformation;
use App\Models\CargoInformation;
use App\Models\Fleet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $users;
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $list = $this->users->paginate(25);
        return view('master.user.index')->with(['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $row = $this->users;
        $row->fill($request->all());
        $row->password = Hash::make($request->password);
        $row->save();

        return redirect()->route('master.user.index')->with('message', 'Success add new user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->users->findOrFail($id);

        return view('master.user.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed'
        ]);

        $row = $this->users->findOrFail($id);
        $row->fill($request->all());
        if($request->has('password')){
            $row->password = Hash::make($request->password);
        }
        $row->save();

        return redirect()->route('master.user.index')->with('message', 'Success add new user');
    }

    public function changePassword(Request $request)
    {
        $row = $request->user();
        return view('master.user.change', compact('row'));
    }

    public function changePasswordPost(Request $request)
    {

        $this->validate($request,[
            'oldpassword' => 'required',
            'password' => 'confirmed'
        ]);

        $user = $request->user();


        if(Hash::check($request->oldpassword, $user->password)){
            if($request->has('password')){
                $user->password = Hash::make($request->password);
                $user->save();
            }
            return redirect()->route('dashboard')->with('message', 'Success add new user');
        }else{
            return redirect()->back()->withErrors(['oldpassword' => 'Old password not valid']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->users->where('id', $id)->delete();
        return redirect()->route('master.user.index')->with('message', 'User has been removed');
    }

    public function editUserPermission($id)
    {
        $row = $this->users->with('permissions')->findOrFail($id);
        return view('master.user.permission', compact('row'));
    }

    public function getUserPermission(Request $request, $id)
    {
        $row = $this->users->with('permissions')->findOrFail($id);
        $permissions = $row->permissions()->pluck('name')->toArray();
        return response()->json([
            'success' => true,
            'data' => array_merge($row->toArray(), ['permissions' => $permissions])
        ], 200);
    }

    public function updateUserPermission(Request $request, $id)
    {
        $row = $this->users->findOrFail($id);
        $row->syncPermissions($request->permission);

        return redirect()->route('master.user.index')->with('message', 'User permission has been updated');
    }
}
