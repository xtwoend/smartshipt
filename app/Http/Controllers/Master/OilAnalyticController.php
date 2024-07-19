<?php

namespace App\Http\Controllers\Master;

use Carbon\Carbon;
use App\Models\Fleet;
use App\Models\OilLube;
use Illuminate\Http\Request;
use App\Events\OilUploadProcessed;
use Illuminate\Support\Facades\DB;
use Aspera\Spreadsheet\XLSX\Reader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OilAnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oilVessels = OilLube::select('Area')->whereNull('fleet_id')->groupBy('Area')->orderBy('Area')->get()->pluck('Area')->toArray();
        $fleets = Fleet::where('active', 1)->orderBy('name')->get()->pluck('name', 'id')->toArray();

        return view('master.oils.index', compact('oilVessels', 'fleets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fleets' => 'required|array'
        ]);

        $fleets = $request->fleets;
        foreach($fleets as $key => $val) 
        {
            if($val == '' || empty($val)) continue;

            OilLube::where('Area', $key)->update([
                'fleet_id' => $val
            ]);
        }

        event(new OilUploadProcessed());
        
        return redirect()->route('master.oils.index');
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
        //
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
        //
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

    /**
     * upload file & processed
     */
    public function upload(Request $request)
    {
        if(! $request->file('file')->isValid()) return redirect()->route('master.oils.index');

        $file = $request->file;
        $file->storeAs('temp', 'oil-result.xlsx');

        $reader = new Reader();
        $reader->open(Storage::path('temp/oil-result.xlsx'));
        
        $data = [];
        $isheader = 0;
        foreach ($reader as $row) {
            if($isheader > 0){
                $data = [
                    'Lube' => (string) $row[0],
                    'pertamina_international_shipping' => (string) $row[1],
                    'Area' => (string) $row[2],
                    'Manufacture' => (string) $row[3],
                    'Component' => (string) $row[4],
                    'Application' => (string) $row[5],
                    'Model' => (string) $row[6],
                    'Equipment_Description' => (string) $row[7],
                    'Equipment_Number' => (string) $row[8],
                    'Sample_Date' => Carbon::createFromFormat('d-m-y', $row[9])->format('Y-m-d'),
                    'RH_Oil' => (float) $row[10],
                    'RH_Engine' => (float) $row[11],
                    'P' => (float) $row[12],
                    'TAN' => (float) $row[13],
                    'Vk_40' => (float) $row[14],
                    'Ca' => (float) $row[15],
                    'Zn' => (float) $row[16],
                    'Mg' => (float) $row[17],
                    'TBN_D4739' => (float) $row[18],
                    'TBN' => (float) $row[19],
                    'Wt' => (float) $row[20],
                    'Soot' => (float) $row[21],
                    'Fu' => (float) $row[22],
                    'Oxi' => (float) $row[23],
                    'Nit' => (float) $row[24],
                    'Ag' => (float) $row[25],
                    'Sn' => (float) $row[26],
                    'Pb' => (float) $row[27],
                    'Fe' => (float) $row[28],
                    'Cu' => (float) $row[29],
                    'Cr' => (float) $row[30],
                    'Al' => (float) $row[31],
                    'Vk_100' => (float) $row[32],
                    'ISO_4406' => (float) $row[33],
                    'NAS_1638' => (float) $row[34],
                    'Colour' => (float) $row[35],
                    'Si' => (float) $row[36],
                    'Na' => (float) $row[37],
                    'V' => (float) $row[38],
                    'CSC' => (float) $row[39],
                    'Density' => (float) $row[40],
                    'FP_COC' => (float) $row[41],
                    'Sq_I' => (float) $row[42],
                    'Sq_II' => (float) $row[43],
                    'Sq_III' => (float) $row[44],
                    'PI' => (float) $row[45],
                    'TI' => (float) $row[46],
                    'PP' => (float) $row[47],
                    'Sulf_Ash' => (float) $row[48],
                    'Wt_D_95' => (float) $row[49],
                    'Wt_KF' => (float) $row[50],
                    'Gly' => (float) $row[51],
                    'Sulf' => (float) $row[52],
                    'Mo' => (float) $row[53],
                    'wt_Karl_Fi' => (float) $row[54],
                    'Ni' => (float) $row[55],
                    'B' => (float) $row[56],
                    'VI' => (float) $row[57],
                    'PI_D4055' => (float) $row[58],
                    'RBOT' => (float) $row[59],
                    'Air_Release' => (float) $row[60],
                    'Ba' => (float) $row[61],
                    'PQ_Index' => (float) $row[62],
                    'Status' => (string) $row[63],
                    'Recomendation' => (string) $row[64],
                ];
                OilLube::insert($data);
            }else{
                $isheader = 1;
            }
        }
        $reader->close();

        return redirect()->route('master.oils.index');
    }

    public function process(Request $request)
    {
        $fleets = OilLube::select('Area')->groupBy('Area')->get()->pluck('Area')->toArray();

        
    }

    public function clearData(Request $request)
    {
        OilLube::truncate();

        return redirect()->route('master.oils.index');
    }
    
}
