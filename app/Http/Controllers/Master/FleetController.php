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
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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

        /** Tanks */
        $tanks[''] = "-- Select Tank --";
        $this->tank->all()->map(function ($item, $key)use(&$tanks) {
            $tanks[$item->id] = $item->tank_position;
        });
        
        return view('master.fleets.show', compact('data', 'tanks'));
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

    public function uploadSounding(Request $request, int $id)
    {
        $request->validate([
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

        $this->storeFleetFromExcel(storage_path(sprintf('app/%s', $originalFileName)), $fileName, $id);
        return redirect()->route('master.fleets.show', $id);

        // try {
        //     dispatch_sync(new StoreFleetFromExcel(storage_path(sprintf('app/%s', $originalFileName)), $fileName));
        //     return redirect()->route('master.fleets.show', $id);
        // } catch (\Exception $e) {
        //     return redirect()->route('master.fleets.show', $id);
        // }
    }

    private function storeFleetFromExcel(string $filePath, string $fileName, int $id)
    {
        $spreadsheet = new Spreadsheet();
        $reader = new Xlsx();
        $spreadsheet = $reader->load($filePath);

        dd($spreadsheet);

        $sheets = $spreadsheet->getSheetNames();

        $tankPayloads = [];
        foreach ($sheets as $sheetIndex => $sheet) {
            
            /** Split Tank Name */
            $tank = $this->getTankInfo($sheet);
            if (!empty($tank) && is_array($tank)) {
                $tank = array_merge([
                    'fleet_id' => $id,
                    'contents' => "OIL",
                    'capacity' => 0,
                    'locator' => null,
                    'current_load' => 0,
                    'type' => "bunker"
                ], $tank);
            }

            dd($tank);
            
            $worksheet = $spreadsheet->getSheet($sheetIndex);

            /** Update Tank */
            if (!$this->updateTank($tank)) {
                continue;
            }

            /** Create Tank Logs */
            $this->createTankLogsTable(sprintf('%s_%s', $id, $tank['tank_sensor_name']));
            
            $data = $worksheet->toArray();
            // $tankConversionPayload = [];
            // foreach ($data as $key => $row) {
            //     if ($key == 1) {
            //         $header = array_diff($row, [null]);
            //     }
            //     if ($key >= 2) {
            //         // data
            //         $row = array_diff($row, [null]);
            //         if (!isset($row[0])) {
            //             continue;
            //         }
            //         foreach ($header as $khdr => $hdr) {
            //             $tankConversionPayload[] = [
            //                 'tank_id' => $tank->id,
            //                 'trim_index' => $hdr,
            //                 'height' => $row[0],
            //                 'volume_m3' => $row[$khdr],
            //                 'created_at' => Carbon::now(),
            //                 'updated_at' => Carbon::now(),
            //             ];
            //         }
            //     }
            // }
            // // delete old tank_load_conversions
            // TankLoadConversion::where('tank_id', $tank->id)->delete();
            // // insert into tank_load_conversions
            // TankLoadConversion::insert($tankConversionPayload);
        }
    }
}
