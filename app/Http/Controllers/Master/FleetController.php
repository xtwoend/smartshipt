<?php

namespace App\Http\Controllers\Master;

use App\Models\Tank;
use App\Models\Fleet;
use App\Models\FleetDoc;
use App\Models\FleetPic;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CargoInformation;
use App\Models\BunkerInformation;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Jobs\ImportBunkerSoundingJob;
use App\Jobs\ImportCargoSoundingJob;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\BunkerSounding;
use App\Models\CargoSounding;

class FleetController extends Controller
{
    protected $fleet;
    protected $tank;
    public function __construct(Fleet $fleet, Tank $tank)
    {
        $this->fleet = $fleet;
        $this->tank = $tank;
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
     * Display a listing of the resource.
     *
     * @return View
     */
    public function json()
    {
        $fleets = $this->fleet->active()->select('id', 'name')->get();
        return response()->json($fleets);
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

        /** Bunker Tanks */
        $bunkerTanks[''] = "-- Select Tank --";
        $this->tank->where('fleet_id', $id)
            ->where('type', Tank::TYPE_BUNKER)
            ->select('id', 'tank_position')
            ->get()
            ->map(function ($item, $key)use(&$bunkerTanks) {
                $bunkerTanks[$item->id] = $item->tank_position;
            });

        /** Cargo Tanks */
        $cargoTanks[''] = "-- Select Tank --";
        $this->tank->where('fleet_id', $id)
            ->where('type', Tank::TYPE_CARGO)
            ->select('id', 'tank_position')
            ->get()
            ->map(function ($item, $key)use(&$cargoTanks) {
                $cargoTanks[$item->id] = $item->tank_position;
            });
        
        return view('master.fleets.show', compact('data', 'bunkerTanks', 'cargoTanks'));
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

        $input = array_filter($request->all());

        $row = BunkerInformation::updateOrCreate(['fleet_id' => $id], $input);

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

    public function picDelete($id, Request $request)
    {
        return FleetPic::find($id)->delete();
    }

    public function uploadSvg(Request $request)
    {
        $fleet = Fleet::find($request->fleet_id);
        $path = $request->file->store('svg');

        return $fleet->mimic()->updateOrCreate([
            'group' => $request->group
        ], [
            'path' => $path
        ]);
    }

    public function docs($id, Request $request) 
    {
        $fleet = Fleet::findOrFail($id);
        $docs = $fleet->docs()->latest()->paginate(20)->withQueryString();

        return view('master.fleets._docs', compact('fleet', 'docs'));
    }

    public function docDel($id)
    {
        $d = FleetDoc::find($id);
        $d->delete();

        return redirect()->route('master.fleets.docs', $d->fleet_id);
    }

    public function uploadDocs($id, Request $request)
    {
        $fleet = Fleet::find($id);
        $file = $request->file('file');
        $size = $file->getSize();
        $name = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();

        $path = $file->store("docs/{$fleet->id}");

        $file = $fleet->docs()->create([
            'fleet_id' => $fleet->id,
            'path' => $path,
            'size' => $size,
            'mime_type' => $mimeType,
            'name' => $request->name ?? $name,
        ]);

        return redirect()->route('master.fleets.docs', $fleet->id);
    }

    public function uploadBunkerSounding(Request $request, int $id)
    {
        $request->validate([
            'tank_id' => 'required',
            'file' => 'required|mimes:xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048', // Adjust max size as needed
        ], [
            'file.required' => 'The file is required.',
            'file.mimes' => 'The file must be an XLSX file.',
            'file.max' => 'The file must not be greater than 2MB.', // Adjust message if you change max size
        ]);
        
        $file = $request->file('file');
        $file->storeAs('', $file->getClientOriginalName(), 'local');
        
        $originalFileName = $file->getClientOriginalName();
        $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
        
        try {
            dispatch_sync(new ImportBunkerSoundingJob(storage_path(sprintf('app/%s', $originalFileName)), $id, $request->input('tank_id', null)));
            return redirect()->route('master.fleets.show', $id);
        } catch (\Exception $e) {
            return redirect()->route('master.fleets.show', $id);
        }
    }

    public function uploadCargoSounding(Request $request, int $id)
    {
        $request->validate([
            'tank_id' => 'required',
            'file' => 'required|mimes:xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048', // Adjust max size as needed
        ], [
            'file.required' => 'The file is required.',
            'file.mimes' => 'The file must be an XLSX file.',
            'file.max' => 'The file must not be greater than 2MB.', // Adjust message if you change max size
        ]);
        
        $file = $request->file('file');
        $file->storeAs('', $file->getClientOriginalName(), 'local');
        
        $originalFileName = $file->getClientOriginalName();
        $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
        
        try {
            dispatch_sync(new ImportCargoSoundingJob(storage_path(sprintf('app/%s', $originalFileName)), $id, $request->input('tank_id', null)));
            return redirect()->route('master.fleets.show', $id);
        } catch (\Exception $e) {
            return redirect()->route('master.fleets.show', $id);
        }
    }

    public function getBunkerSounding(Request $request)
    {
        if (!$request->has('tank_id') || empty($request->input('tank_id'))) {
            return response()->json(['success' => false, 'message' => 'invalid tank id']);
        }

        /** check tank */
        $tank = Tank::find($request->input('tank_id'));
        if (!$tank) {
            return response()->json(['success' => false, 'message' => 'tank not found!']);
        }

        /** get sounding */
        $sounding = (new BunkerSounding())->table($tank->fleet_id);
        $data = $sounding->where([
            'fleet_id' => $tank->fleet_id,
            'tank_id' => $tank->id
        ])->orderBy('created_at', 'desc')->get();
        if (empty($data)) {
            return response()->json(['success' => false, 'message' => 'sounding not found!']);
        }

        $headers = $body = $sounding = array();
        $data->map(function ($item, $key)use(&$headers, &$sounding) {
            if (!in_array($item->trim_index, $headers)) {
                array_push($headers, $item->trim_index);
            }

            if (!in_array($item->sounding_cm, $sounding)) {
                array_push($sounding, $item->sounding_cm);
            }
        });

        sort($headers);
        sort($sounding);
        array_unshift($headers, "sounding");

        if (!empty($sounding) && is_array($sounding)) {
            $data = $data->toArray();
            foreach ($sounding as $cm) {
                $values = array();
                $values[] = $cm;
                
                $lists = $this->searchByArray($data, 'sounding_cm', $cm);
                foreach ($lists as $key => $item) {
                    $values[] = number_format($item['volume'], 3, ".", ",");
                }

                $body[] = $values;

            }
        }
        
        return response()->json(['success' => true, 'headers' => $headers, 'body' => $body]);
    }
    public function getCargoSounding(Request $request)
    {
        if (!$request->has('tank_id') || empty($request->input('tank_id'))) {
            return response()->json(['success' => false, 'message' => 'invalid tank id']);
        }

        /** check tank */
        $tank = Tank::find($request->input('tank_id'));
        if (!$tank) {
            return response()->json(['success' => false, 'message' => 'tank not found!']);
        }

        /** get sounding */
        $sounding = (new CargoSounding())->table($tank->fleet_id);
        $data = $sounding->where([
            'fleet_id' => $tank->fleet_id,
            'tank_id' => $tank->id
        ])->orderBy('created_at', 'desc')->get();
        if (empty($data)) {
            return response()->json(['success' => false, 'message' => 'sounding not found!']);
        }

        $headers = $body = $sounding = array();
        $data->map(function ($item, $key)use(&$headers, &$sounding) {
            if (!in_array($item->trim_index, $headers)) {
                array_push($headers, $item->trim_index);
            }

            if (!in_array($item->ullage, $sounding)) {
                array_push($sounding, $item->ullage);
            }
        });

        sort($headers);
        sort($sounding);
        array_unshift($headers, "sounding");

        if (!empty($sounding) && is_array($sounding)) {
            $data = $data->toArray();
            foreach ($sounding as $cm) {
                $values = array();
                $values[] = $cm;
                
                $lists = $this->searchByArray($data, 'ullage', $cm);
                foreach ($lists as $key => $item) {
                    $values[] = number_format($item['mt'], 3, ".", ",");
                }

                $body[] = $values;

            }
        }
        
        return response()->json(['success' => true, 'headers' => $headers, 'body' => $body]);
    }

    private function searchByArray(array $data, string $index, string $search): Array
    {
        $lists = $sort_col = array();
        foreach ($data as $key => $item) {
            if ($item[$index] == $search) {
                $lists[] = $item;
            }
        }

        foreach ($lists as $key => $row) {
            $sort_col[$key] = $row['trim_index'];
        }

        array_multisort($sort_col, SORT_ASC, $lists);

        return $lists;
    }
}
