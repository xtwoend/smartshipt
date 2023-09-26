<?php

namespace App\Http\Controllers\Master;

use App\Models\Fleet;
use App\Models\FleetPic;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CargoInformation;
use App\Models\BunkerInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class FleetController extends Controller
{
    protected $fleet;
    public function __construct(Fleet $fleet)
    {
        $this->fleet = $fleet;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $list = $this->fleet->paginate(25);
        return view('master.fleets.index')->with(['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.fleets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->fleet->rules());

        $row = $this->fleet;
        $row->fill($request->all());
        $row->save();

        return redirect()->route('master.fleets.index')->with('message', 'Success add new fleets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $data = $this->fleet->with(['cargo_information', 'bunker_information'])->findOrFail($id);
        
        return view('master.fleets.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $data = $this->fleet->findOrFail($id);
        return view('master.fleets.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->fleet->rules());
        $input = $request->all();
        if($request->has('image') && $request->file('image')->isValid()) {
            $input['image'] = $request->image->store('fleets');          
        }
        $row = $this->fleet->findOrFail($id);
        $row->fill($input);
        $row->save();
        return redirect()->route('master.fleets.index')->with('message', 'Success update fleet detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function editCargo($id)
    {
        $fleet = $this->fleet->findOrFail($id);
        $data = $fleet->cargo_information;
        return view('master.fleets.edit_cargo')->with(['data' => $data, 'fleet' => $fleet]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCargo(Request $request, $id)
    {
        $this->validate($request, [
            'group' => 'required',
            'total' => 'required',
            'grade' => 'required',
            'capacity' => 'required',
            'capacity_percentage' => 'required',
            'capacity_sg' => 'required',
            'max_capacity' => 'required',
            'max_capacity_percentage' => 'required',
            'max_capacity_sg' => 'required',
        ]);

        $row = CargoInformation::updateOrCreate(['fleet_id' => $id], $request->all());

        return redirect()->route('master.fleets.show', $id)->with('message', 'Success update fleet bunker information');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function editBunker($id)
    {
        $fleet = $this->fleet->findOrFail($id);
        $data = $fleet->bunker_information;
        return view('master.fleets.edit_bunker')->with(['data' => $data, 'fleet' => $fleet]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBunker(Request $request, $id)
    {
        $this->validate($request, [
            'speed_service' => 'required',
            'pumping_rate' => 'required',
            'presure_discharge' => 'required',
            'loading_rate' => 'required',
            'commision_days' => 'required',
            'transport_loss' => 'required',
        ]);

        $row = BunkerInformation::updateOrCreate(['fleet_id' => $id], $request->all());

        return redirect()->route('master.fleets.show', $id)->with('message', 'Success update fleet bunker information');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function picUpdate($id, Request $request)
    {
        $input = array_merge($request->all(), ['fleet_id' => $id]);
        $fleet = Fleet::find($id);
        if($request->has('id') && $request->id !== 0) {
            $pic = $fleet->pic()->find($request->id)->update($input);
        }else{
            $pic = $fleet->pic()->create($input);
        }

        return response()->json($pic);
    }

    public function picDelete($id, Request $reqeust)
    {
        return FleetPic::find($id)->delete();
    }
}
