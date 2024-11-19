<?php

namespace App\Http\Controllers\Master;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DieselGenerator;
use Aspera\Spreadsheet\XLSX\Reader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DGFromController extends Controller
{
    public function form(Request $request)
    {
        return view('form.351_form', ['data' => null, 'label' => null, 'fleets' => []]);
    }

    public function formUpload(Request $request)
    {
        if(! $request->file('file')->isValid()) return redirect()->route('master.oils.index');

        $file = $request->file;
        $rand = Str::random(10);
        $file->storeAs('temp', $rand.'form-350.xlsx');

        $reader = new Reader();
        $reader->open(Storage::path("temp/{$rand}form-350.xlsx"));

        $sheets = $reader->getSheets();
        $raw = [];
        $data = [];
        foreach ($sheets as $index => $sheet_data) {
            // change sheets
            $reader->changeSheet($index);

            $raw[$index] = [];
            foreach($reader as $row) {
                $raw[$index][] = $row;
            }
            
            $cell = $raw[$index];

            try {
                $date = Carbon::createFromFormat('d/m/Y', $cell[7][8] ?: 0)->format('Y-m-d 05:00:00');
            } catch (\Throwable $th) {
                $date = null;
            }
            
            $lub_oil_cooler = explode('/', $cell[47][6]);
            $fresh_water_cooler = explode('/', $cell[48][6]);

            $data[$index] = [
                'fleet_name' => $cell[5][2],
                'dg_no' => $cell[5][9],
                'terminal_time' => $date,
                'report_no' => $cell[7][3],
                'voyage_no' => $cell[8][3],
                'place' => $cell[8][8],
                'maker' => $cell[10][3],
                'type' =>  $cell[11][3],
                'turbo_charger' =>  $cell[12][3],
                'stroke_bore' =>  $cell[13][3],
                'kw_diesel' =>  $cell[10][10],
                'rpm' =>  $cell[11][10],
                'volt' =>  $cell[12][10],
                'kw' =>  $cell[13][10],
                'hz' =>  $cell[14][10],
                'name_of_lub_oil_grade' => $cell[16][9],
                'sump_capacity_ltrs' => $cell[17][9],
                'lub_oil_consumption_ltrs_day' => $cell[18][9],
                'd_g_lo_purification_sys_instal' =>  $cell[19][9],
                'purification_carried_out' =>  $cell[20][10],
                'frequency_of_purification' =>  $cell[21][9],
                'date_of_last_analysis_of_lub_oil' =>  $cell[22][9],
                'quantity_of_oil_renewed_at' =>  $cell[23][9],
                'last_change_ltrs' =>  $cell[24][9],

                'rh_installation' =>  $cell[17][4],
                'rh_last_complete_overhaul' =>  $cell[18][4],
                'rh_last_cylinder_heads_overhaul' =>  $cell[19][4],
                'rh_last_turbocharger_overhaul' => $cell[20][4],
                'rh_last_governor_serviced' =>  $cell[21][4],
                'rh_last_air_cooler_fw_side_cleaned' =>  $cell[22][4],
                'rh_last_air_cooler_air_side_cleaned' =>  $cell[23][4],
                'rh_last_lub_oil_changed' =>  $cell[24][4],
                
                'type_of_fuel_used' =>  $cell[26][4],
                'hfo_viscosity_cst_50' =>  $cell[27][4],
                'mdo_viscosity_cst_50' =>  $cell[28][4],
                'ratio_of_blend' =>  $cell[29][4],
                
                'consumption' =>  $cell[26][9],
                'mt_day' =>  $cell[27][9],
                'operating' =>  $cell[28][9],
                'power' =>  $cell[29][9],
                
                'pu_pmax_kgf_cm2_c1' =>  $cell[32][3],
                'pu_exhaust_gas_temp_c1' =>  $cell[33][3],
                'pu_fuel_rack_position_c1' =>  $cell[34][3],
                'pu_jcw_outlet_temp_c1' =>  $cell[35][3],

                'pu_pmax_kgf_cm2_c2' =>  $cell[32][4],
                'pu_exhaust_gas_temp_c2' =>  $cell[33][4],
                'pu_fuel_rack_position_c2' =>  $cell[34][4],
                'pu_jcw_outlet_temp_c2' =>  $cell[35][4],

                'pu_pmax_kgf_cm2_c3' =>  $cell[32][5],
                'pu_exhaust_gas_temp_c3' =>  $cell[33][5],
                'pu_fuel_rack_position_c3' =>  $cell[34][5],
                'pu_jcw_outlet_temp_c3' =>  $cell[35][5],

                'pu_pmax_kgf_cm2_c4' =>  $cell[32][6],
                'pu_exhaust_gas_temp_c4' =>  $cell[33][6],
                'pu_fuel_rack_position_c4' =>  $cell[34][6],
                'pu_jcw_outlet_temp_c4' =>  $cell[35][6],

                'pu_pmax_kgf_cm2_c5' =>  $cell[32][7],
                'pu_exhaust_gas_temp_c5' =>  $cell[33][7],
                'pu_fuel_rack_position_c5' =>  $cell[34][7],
                'pu_jcw_outlet_temp_c5' =>  $cell[35][7],

                'pu_pmax_kgf_cm2_c6' =>  $cell[32][8],
                'pu_exhaust_gas_temp_c6' =>  $cell[33][8],
                'pu_fuel_rack_position_c6' =>  $cell[34][8],
                'pu_jcw_outlet_temp_c6' =>  $cell[35][8],
                
                'tc_gas_inlet_temp_group_1' =>  $cell[38][2],
                'tc_gas_inlet_temp_group_2' =>  $cell[38][4],
                'tc_gas_outlet_temp' =>  $cell[38][6],

                'engine_boost_air_pressure' =>  $cell[41][5],
                'engine_boost_air_temp' =>  $cell[41][6],
                'engine_fuel_oil_inlet_pressure' =>  $cell[42][5],
                'engine_fuel_oil_inlet_temp' =>  $cell[42][6],
                'engine_bearing_lub_oil_inlet_pressure' =>  $cell[43][5],
                'engine_bearing_lub_oil_inlet_temp' =>  $cell[43][6],
                'engine_rocker_arm_lub_oil_inlet_pressure' =>  $cell[44][5],
                'engine_rocker_arm_lub_oil_inlet_temp' =>  $cell[44][6],
                'engine_fresh_water_inlet_pressure' =>  $cell[45][5],
                'engine_fresh_water_inlet_temp' =>  $cell[45][6],
                'engine_injector_cooling_inlet_pressure' =>  $cell[46][5],
                'engine_injector_cooling_inlet_temp' =>  $cell[46][6],
                'lub_oil_cooler_inlet_outlet_pressure' =>  $cell[47][5],

                'lub_oil_cooler_inlet_temp' =>  $lub_oil_cooler[0] ?? 0,
                'lub_oil_cooler_outlet_temp' =>  $lub_oil_cooler[1] ?? 0,
                'fresh_water_cooler_inlet_outlet_pressure' =>  $cell[48][5],
                'fresh_water_cooler_inlet_temp' =>  $fresh_water_cooler[0] ?? 0,
                'fresh_water_cooler_outlet_temp' =>  $fresh_water_cooler[1] ?? 0,
            ];
        }    
        
        $label = $this->label();
        $fleets = Fleet::active()->get()->pluck('name', 'id')->toArray();

        return view('form.351_form', compact('data', 'label', 'fleets'));
    }

    public function store(Request $request)
    {
        if($request->has('fleet_id') && $request->fleet_id == null) {
            return redirect()->route('master.form.dg')->withError('fleet wajib dipilih');
        }

        $fleetId = $request->fleet_id;
        $data = $request->data;
        $fdata = [
            'terminal_time' => $request->terminal_time,
            'fleet_id' => $fleetId,
        ];

        foreach($data as $no => $val) {
            $n = $no + 1;
            foreach($val as $key => $v ) {
                $v = ($v == 'N/A' || $v == '-') ? null: $v;
                $fdata["{$key}_dg_{$n}"] = $v ?: 0;
            }
        }

        DieselGenerator::table($fleetId, count($data))->updateOrCreate([
            'fleet_id' => $fleetId,
        ], $fdata);

        return redirect()->route('fleet.generator', $fleetId);
    }

    protected function label() {
        return (array) [
            'dg_no'  => 'D/G NO.',
            // 'terminal_time' => 'DATE OF RECORD (format exp: 2020-01-01 08:09:00)',
            'report_no' => 'REPORT NO.',
            'voyage_no' => 'VOYAGE NO.',
            'place' => 'PLACE (PORT/SEA)',
            'maker' => 'D/G MAKER',
            'type' => 'TYPE/ MODEL',
            'turbo_charger' => 'TURBO CHARGER',
            'stroke_bore' => 'STROKE & BORE',
            'kw_diesel' => 'KW(DIESEL)',
            'rpm' => 'RPM',
            'volt' => 'VOLT',
            'kw' => 'KW',
            'hz' => 'HZ',
            'name_of_lub_oil_grade' => 'NAME OF LUB OIL GRADE',
            'sump_capacity_ltrs' => 'SUMP CAPACITY   (Ltrs)',
            'lub_oil_consumption_ltrs_day' => 'LUB OIL CONSUMPTION   (Ltrs/Day)',
            'd_g_lo_purification_sys_instal' => 'D/G LO PURIFICATION SYS. INSTAL',
            'purification_carried_out' => 'PURIFICATION CARRIED OUT',
            'frequency_of_purification' => 'FREQUENCY OF PURIFICATION',
            'date_of_last_analysis_of_lub_oil' => 'DATE OF LAST ANALYSIS OF LUB OIL',
            'quantity_of_oil_renewed_at' => 'QUANTITY OF OIL RENEWED AT',
            'last_change_ltrs' => 'LAST CHANGE   (Ltrs)',

            'rh_installation' => 'INSTALLATION',
            'rh_last_complete_overhaul' => 'LAST COMPLETE OVERHAUL',
            'rh_last_cylinder_heads_overhaul' => 'LAST CYLINDER HEADS OVERHAUL',
            'rh_last_turbocharger_overhaul' => 'LAST TURBOCHARGER OVERHAUL',
            'rh_last_governor_serviced' => 'LAST GOVERNOR SERVICED',
            'rh_last_air_cooler_fw_side_cleaned' => 'LAST AIR COOLER FW SIDE CLEANED',
            'rh_last_air_cooler_air_side_cleaned' => 'LAST AIR COOLER AIR SIDE CLEANED',
            'rh_last_lub_oil_changed' => 'LAST LUB. OIL CHANGED',
            
            'type_of_fuel_used' => 'TYPE OF FUEL USED',
            'hfo_viscosity_cst_50' => 'HFO  VISCOSITY CSt @50 oC',
            'mdo_viscosity_cst_50' => 'MDO VISCOSITY    cSt @ 50 oC',
            'ratio_of_blend' => 'RATIO OF BLEND',
            
            'consumption' => 'CONSUMPTION',
            'mt_day' => 'MT / DAY',
            'operating' => 'OPERATING',
            'power' => 'POWER',
            
            'pu_pmax_kgf_cm2_c1' => 'Pmax kgf/cm2 No. 1',
            'pu_exhaust_gas_temp_c1' => 'Exhaust Gas Temp. oC  No. 1',
            'pu_fuel_rack_position_c1' => 'Fuel Rack Position  No. 1',
            'pu_jcw_outlet_temp_c1' => 'JCW Outlet Temp. oC  No. 1',

            'pu_pmax_kgf_cm2_c2' => 'Pmax kgf/cm2 No. 2',
            'pu_exhaust_gas_temp_c2' => 'Exhaust Gas Temp. oC  No. 2',
            'pu_fuel_rack_position_c2' => 'Fuel Rack Position  No. 2',
            'pu_jcw_outlet_temp_c2' => 'JCW Outlet Temp. oC  No. 2',

            'pu_pmax_kgf_cm2_c3' => 'Pmax kgf/cm2 No. 3',
            'pu_exhaust_gas_temp_c3' => 'Exhaust Gas Temp. oC  No. 3',
            'pu_fuel_rack_position_c3' => 'Fuel Rack Position  No. 3',
            'pu_jcw_outlet_temp_c3' => 'JCW Outlet Temp. oC  No. 3',

            'pu_pmax_kgf_cm2_c4' => 'Pmax kgf/cm2 No. 4',
            'pu_exhaust_gas_temp_c4' => 'Exhaust Gas Temp. oC  No. 4',
            'pu_fuel_rack_position_c4' => 'Fuel Rack Position  No. 4',
            'pu_jcw_outlet_temp_c4' => 'JCW Outlet Temp. oC  No. 4',

            'pu_pmax_kgf_cm2_c5' => 'Pmax kgf/cm2 No. 5',
            'pu_exhaust_gas_temp_c5' => 'Exhaust Gas Temp. oC  No. 5',
            'pu_fuel_rack_position_c5' => 'Fuel Rack Position  No. 5',
            'pu_jcw_outlet_temp_c5' => 'JCW Outlet Temp. oC  No. 5',

            'pu_pmax_kgf_cm2_c6' => 'Pmax kgf/cm2 No. 6',
            'pu_exhaust_gas_temp_c6' => 'Exhaust Gas Temp. oC  No. 6',
            'pu_fuel_rack_position_c6' => 'Fuel Rack Position  No. 6',
            'pu_jcw_outlet_temp_c6' => 'JCW Outlet Temp. oC  No. 6',
            
            'tc_gas_inlet_temp_400' => 'TC GAS INLET TEMP 400',
            'tc_gas_inlet_temp_420' => 'TC GAS INLET TEMP 420',
            'tc_gas_outlet_temp' => 'TC GAS_OUTLET TEMP',

            'engine_boost_air_pressure' => 'ENGINE BOOST AIR PRESSURE',
            'engine_boost_air_temp' => 'ENGINE BOOST AIR TEMPERATURE',
            'engine_fuel_oil_inlet_pressure' => 'ENGINE FUEL OIL INLET PRESSURE',
            'engine_fuel_oil_inlet_temp' => 'ENGINE FUEL OIL INLET TEMPERATURE',
            'engine_bearing_lub_oil_inlet_pressure' => 'ENGINE BEARING LUB OIL INLET PRESSURE',
            'engine_bearing_lub_oil_inlet_temp' => 'ENGINE BEARING LUB OIL INLET TEMPERATURE',
            'engine_rocker_arm_lub_oil_inlet_pressure' => 'ENGINE ROCKER ARM LUB OIL INLET PRESSURE',
            'engine_rocker_arm_lub_oil_inlet_temp' => 'ENGINE ROCKER ARM LUB OIL INLET TEMPERATURE',
            'engine_fresh_water_inlet_pressure' => 'ENGINE FRESH WATER  INLET PRESSURE',
            'engine_fresh_water_inlet_temp' => 'ENGINE FRESH WATER  INLET TEMPERATURE',
            'engine_injector_cooling_inlet_pressure' => 'ENGINE INJECTOR COOLING INLET PRESSURE',
            'engine_injector_cooling_inlet_temp' => 'ENGINE INJECTOR COOLING INLET TEMPERATURE',
            'lub_oil_cooler_inlet_outlet_pressure' => 'LUB OIL COOLER  INLET / OUTLET PRESSURE',

            'lub_oil_cooler_inlet_temp' => 'LUB OIL COOLER  INLET TEMPERATURE',
            'lub_oil_cooler_outlet_temp' => 'LUB OIL COOLER  OUTLET TEMPERATURE',
            'fresh_water_cooler_inlet_outlet_pressure' => 'FRESH WATER COOLER  INLET / OUTLET PRESSURE',
            'fresh_water_cooler_inlet_temp' => 'FRESH WATER COOLER  INLET TEMPERATURE',
            'fresh_water_cooler_outlet_temp' => 'FRESH WATER COOLER OUTLET TEMPERATURE',
        ];
    }
}
