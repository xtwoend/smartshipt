<?php

namespace App\Http\Controllers\Master;

use Carbon\Carbon;
use App\Models\Fleet;
use App\Models\MainEngine;
use Illuminate\Http\Request;
use Aspera\Spreadsheet\XLSX\Reader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function me(Request $request)
    {
        return view('form.main_egine', ['data' => null, 'label' => null, 'fleets' => []]);
    }

    public function meUpload(Request $request)
    {
        if(! $request->file('file')->isValid()) return redirect()->route('master.oils.index');

        $file = $request->file;
        $file->storeAs('temp', 'form-350.xlsx');

        $reader = new Reader();
        $reader->open(Storage::path('temp/form-350.xlsx'));

        $raw = [];
        foreach($reader as $row) {
            $raw[] = $row;
        }

        $data = [
            'fleet_name' => $raw[4][2] ?: 0,
            'date' => Carbon::createFromFormat('d/m/Y', $raw[5][2] ?: 0)->format('Y-m-d 12:00:00'),
            'engine_type'  => $raw[6][2] ?: 0,
            'voyage_number' => $raw[5][6] ?: 0,
            'from_port' => $raw[4][5] ?: 0,
            'to_port' => $raw[4][8] ?: 0,
            'engine_output' => $raw[6][7] ?: 0,
            'cyl_bore' => $raw[6][10] ?: 0,
            'mep' => $raw[7][7] ?: 0,
            'engine_rpm' => $raw[7][5] ?: 0,
            'piston_stroke' => $raw[7][10] ?: 0,
            'temp_engine_room' => $raw[8][2] ?: 0,
            'speed' => $raw[10][2] ?: 0,
            'propeller_speed' => $raw[10][6] ?: 0,
            'me_rpm' => $raw[13][3] ?: 0,
            'me_running_hours' => $raw[14][3] ?: 0,
            'me_ht_water_cooling' => $raw[15][3] ?: 0,
            'me_lt_water_cooling' => $raw[16][3] ?: 0,
            'me_sea_water_cooling' => $raw[17][3] ?: 0,
            'me_engine_load' => $raw[18][3] ?: 0,
            'me_pressure_lo_inlet_tc' => $raw[19][3] ?: 0,
            'me_temp_lo_outlet_tc' => $raw[20][3] ?: 0,
            'me_pressure_lo_inlet_engine' => $raw[21][3] ?: 0,
            'me_temp_lo_inlet_engine' => $raw[22][3] ?: 0,
            'me_starting_air_engine_inlet' => $raw[23][3] ?: 0,
            'me_pressure_fo_engine_inlet' => $raw[24][3] ?: 0,
            'me_fo_engine_inlet_temp' => $raw[25][3] ?: 0,
            'tc_turbo_blower_speed' => $raw[13][10] ?: 0,
            'tc_blower_filter_pressure' => $raw[14][10] ?: 0,
            'tc_air_cooler_back_pressure' => $raw[15][10] ?: 0,
            'tc_scavenge_manifold_pressure' => $raw[16][10] ?: 0,
            'tc_exh_gas_pressure_aft_tc' => $raw[17][10] ?: 0,
            'temp_scaving_air_inlet_cooler' => $raw[19][10] ?: 0,
            'temp_scaving_air_outlet_cooler' => $raw[20][10] ?: 0,
            'temp_exh_gas_turbin_inlet' => $raw[21][10] ?: 0,
            'temp_exh_gas_turbin_outlet' => $raw[22][10] ?: 0,
            'temp_fo_specific_grafity' => $raw[24][10] ?: 0,
            'temp_fo_viscosity_118' => $raw[25][10] ?: 0,
            'gb_operating_pressure' => $raw[27][10] ?: 0,
            'gb_shaftbrake_pressure' => $raw[28][10] ?: 0,
            'gb_temp_after_oil_cooler' => $raw[29][10] ?: 0,
            'gb_temp_thrust_bearing' => $raw[30][10] ?: 0,
            'cr_fuel_command' => $raw[27][3] ?: 0,
            'cr_injection_time' => $raw[28][3] ?: 0,
            'cr_qty_piston_return' => $raw[29][3] ?: 0,
            'cr_exh_valve_oc_angel' => $raw[30][3] ?: 0,
            'cr_exh_valve_oc_dead_t' => $raw[31][3] ?: 0,
            'cr_servo_oil_pressure_sp' => $raw[32][3] ?: 0,
            'cr_fuel_rail_pressure_act' => $raw[33][3] ?: 0,
            'cr_vit' => $raw[34][3] ?: 0,
            // silinder
            'cyl_pressure_max_c1' => $raw[36][4] ?: 0,
            'cyl_pressure_max_c2' => $raw[36][5] ?: 0,
            'cyl_pressure_max_c3' => $raw[36][6] ?: 0,
            'cyl_pressure_max_c4' => $raw[36][7] ?: 0,
            'cyl_pressure_max_c5' => $raw[36][8] ?: 0,
            'cyl_pressure_max_c6' => $raw[36][9] ?: 0,
            'cyl_pressure_max_c7' => $raw[36][10] ?: 0,
            'cyl_fuel_pump_index_c1' => $raw[37][4] ?: 0,
            'cyl_fuel_pump_index_c2' => $raw[37][5] ?: 0,
            'cyl_fuel_pump_index_c3' => $raw[37][6] ?: 0,
            'cyl_fuel_pump_index_c4' => $raw[37][7] ?: 0,
            'cyl_fuel_pump_index_c5' => $raw[37][8] ?: 0,
            'cyl_fuel_pump_index_c6' => $raw[37][9] ?: 0,
            'cyl_fuel_pump_index_c7' => $raw[37][10] ?: 0,

            'cyl_temp_exh_c1' => $raw[38][4] ?: 0,
            'cyl_temp_exh_c2' => $raw[38][5] ?: 0,
            'cyl_temp_exh_c3' => $raw[38][6] ?: 0,
            'cyl_temp_exh_c4' => $raw[38][7] ?: 0,
            'cyl_temp_exh_c5' => $raw[38][8] ?: 0,
            'cyl_temp_exh_c6' => $raw[38][9] ?: 0,
            'cyl_temp_exh_c7' => $raw[38][10] ?: 0,

            'cyl_temp_jacket_fw_out_c1' => $raw[39][4] ?: 0,
            'cyl_temp_jacket_fw_out_c2' => $raw[39][5] ?: 0,
            'cyl_temp_jacket_fw_out_c3' => $raw[39][6] ?: 0,
            'cyl_temp_jacket_fw_out_c4' => $raw[39][7] ?: 0,
            'cyl_temp_jacket_fw_out_c5' => $raw[39][8] ?: 0,
            'cyl_temp_jacket_fw_out_c6' => $raw[39][9] ?: 0,
            'cyl_temp_jacket_fw_out_c7' => $raw[39][10] ?: 0,

            'cyl_temp_crankcase_c1' => $raw[40][4] ?: 0,
            'cyl_temp_crankcase_c2' => $raw[40][5] ?: 0,
            'cyl_temp_crankcase_c3' => $raw[40][6] ?: 0,
            'cyl_temp_crankcase_c4' => $raw[40][7] ?: 0,
            'cyl_temp_crankcase_c5' => $raw[40][8] ?: 0,
            'cyl_temp_crankcase_c6' => $raw[40][9] ?: 0,
            'cyl_temp_crankcase_c7' => $raw[40][10] ?: 0,

            'fo_comsumtion' => $raw[42][7] ?: 0,
            'fo_grade' => $raw[42][5] ?: null,
            'lubricant_lo_system' => $raw[43][7] ?: 0,
            'lubricant_lo_system_grade' => $raw[43][5] ?: null,
            'lubricant_gearbox' => $raw[44][7] ?: 0,
            'lubricant_gearbox_grade' => $raw[44][5] ?: null,
        ];
        
        $label = $this->label();
        $fleets = Fleet::active()->get()->pluck('name', 'id')->toArray();

        return view('form.main_egine', compact('data', 'label', 'fleets'));
    }

    public function store(Request $request)
    {
        if($request->has('fleet_id') && $request->fleet_id == null) {
            return redirect()->route('master.form.main-engine')->withError('fleet wajib dipilih');
        }

        $fleetId = $request->fleet_id;
        $myTable = MainEngine::table($fleetId)->getTable();
        
        if (! Schema::hasColumn($myTable, 'engine_type')) {
            return redirect()->route('master.form.main-engine')->withError('fleet wajib dipilih');
        }

        MainEngine::table($fleetId)->updateOrCreate([
            'fleet_id' => $fleetId,
            'terminal_time' => $request->date,
        ], $request->all());

        return redirect()->route('fleet.engine', $fleetId);
    }

    protected function label() {
        return (array) [
            // 'fleet_name' => 'Nama Kapal',
            'date' => 'Tanggal',
            'engine_type'  => 'Engine type',
            'voyage_number' => 'Voyage No',
            'from_port' => 'Dari',
            'to_port' => 'Menuju',
            'engine_output' => 'Output',
            'cyl_bore' => 'Cyl.Bore',
            'mep' => 'm.e.p',
            'engine_rpm' => 'Rpm',
            'piston_stroke' => 'Piston Stroke',
            'temp_engine_room' => 'Suhu Kamar Mesin',
            'speed' => 'Kecepatan kapal',
            'propeller_speed' => 'Propeller Speed',
            'me_rpm' => 'Rpm',
            'me_running_hours' => 'Total jam kerja Mesin',
            'me_ht_water_cooling' => 'HT water Cooling',
            'me_lt_water_cooling' => 'LT water Cooling',
            'me_sea_water_cooling' => 'Sea Water Cooling',
            'me_engine_load' => 'Beban mesin',
            'me_pressure_lo_inlet_tc' => 'Pressure LO inlet Turbocharge',
            'me_temp_lo_outlet_tc' => 'Temp. LO outlet Turbocharge',
            'me_pressure_lo_inlet_engine' => 'Pressure LO inlet Engine',
            'me_temp_lo_inlet_engine' => 'Temp. LO inlet Engine',
            'me_starting_air_engine_inlet' => 'Starting air, Engine inlet',
            'me_pressure_fo_engine_inlet' => 'Pressure F.O, Engine inlet',
            'me_fo_engine_inlet_temp' => 'FO Engine Inlet temperature',
            'tc_turbo_blower_speed' => 'Turbo Blower Speed 1/2',
            'tc_blower_filter_pressure' => 'Blower Filter Pressure',
            'tc_air_cooler_back_pressure' => 'Air Cooler Back Pressure',
            'tc_scavenge_manifold_pressure' => 'Scavenge Manifold Pressure',
            'tc_exh_gas_pressure_aft_tc' => 'Exh Gas Pressure Aft TC',
            'temp_scaving_air_inlet_cooler' => 'Scaving Air Inlet Cooler',
            'temp_scaving_air_outlet_cooler' => 'Scaving Air Outlet Cooler',
            'temp_exh_gas_turbin_inlet' => 'Exh Gas Turbin Inlet',
            'temp_exh_gas_turbin_outlet' => 'Exh Gas Turbin Outlet',
            'temp_fo_specific_grafity' => 'F.O Specific Grafity',
            'temp_fo_viscosity_118' => 'F.O Viscosity at 118 0C',
            'gb_operating_pressure' => 'Operating pressure',
            'gb_shaftbrake_pressure' => 'Shaftbrake pressure',
            'gb_temp_after_oil_cooler' => 'Temperature after oil cooler',
            'gb_temp_thrust_bearing' => 'Temperature Thrust Bearing',
            'cr_fuel_command' => 'Fuel command / scaled in %',
            'cr_injection_time' => 'Injection time / begin dead',
            'cr_qty_piston_return' => 'Quantity piston return / Inject',
            'cr_exh_valve_oc_angel' => 'Exhaust valve opening/closing angle',
            'cr_exh_valve_oc_dead_t' => 'Exhaust valve opening/closing dead T',
            'cr_servo_oil_pressure_sp' => 'Servo oil pressure/press set point',
            'cr_fuel_rail_pressure_act' => 'Fuel rail pressure/press.cont. act %',
            'cr_vit' => 'VIT',
            // silinder
            'cyl_pressure_max_c1' => 'Tekanan PMax. Silinder 1',
            'cyl_pressure_max_c2' => 'Tekanan PMax. Silinder 2',
            'cyl_pressure_max_c3' => 'Tekanan PMax. Silinder 3',
            'cyl_pressure_max_c4' => 'Tekanan PMax. Silinder 4',
            'cyl_pressure_max_c5' => 'Tekanan PMax. Silinder 5',
            'cyl_pressure_max_c6' => 'Tekanan PMax. Silinder 6',
            'cyl_pressure_max_c7' => 'Tekanan PMax. Silinder 7',

            'cyl_fuel_pump_index_c1' => 'Indeks Pompa Bahan Bakar Silinder 1',
            'cyl_fuel_pump_index_c2' => 'Indeks Pompa Bahan Bakar Silinder 2',
            'cyl_fuel_pump_index_c3' => 'Indeks Pompa Bahan Bakar Silinder 3',
            'cyl_fuel_pump_index_c4' => 'Indeks Pompa Bahan Bakar Silinder 4',
            'cyl_fuel_pump_index_c5' => 'Indeks Pompa Bahan Bakar Silinder 5',
            'cyl_fuel_pump_index_c6' => 'Indeks Pompa Bahan Bakar Silinder 6',
            'cyl_fuel_pump_index_c7' => 'Indeks Pompa Bahan Bakar Silinder 7',

            'cyl_temp_exh_c1' => 'Suhu Gas buang Silinder 1',
            'cyl_temp_exh_c2' => 'Suhu Gas buang Silinder 2',
            'cyl_temp_exh_c3' => 'Suhu Gas buang Silinder 3',
            'cyl_temp_exh_c4' => 'Suhu Gas buang Silinder 4',
            'cyl_temp_exh_c5' => 'Suhu Gas buang Silinder 5',
            'cyl_temp_exh_c6' => 'Suhu Gas buang Silinder 6',
            'cyl_temp_exh_c7' => 'Suhu Gas buang Silinder 7',

            'cyl_temp_jacket_fw_out_c1' => 'Suhu Jacket FW Out Silinder 1',
            'cyl_temp_jacket_fw_out_c2' => 'Suhu Jacket FW Out Silinder 2',
            'cyl_temp_jacket_fw_out_c3' => 'Suhu Jacket FW Out Silinder 3',
            'cyl_temp_jacket_fw_out_c4' => 'Suhu Jacket FW Out Silinder 4',
            'cyl_temp_jacket_fw_out_c5' => 'Suhu Jacket FW Out Silinder 5',
            'cyl_temp_jacket_fw_out_c6' => 'Suhu Jacket FW Out Silinder 6',
            'cyl_temp_jacket_fw_out_c7' => 'Suhu Jacket FW Out Silinder 7',

            'cyl_temp_crankcase_c1' => 'Suhu Crankcase Silinder 1',
            'cyl_temp_crankcase_c2' => 'Suhu Crankcase Silinder 2',
            'cyl_temp_crankcase_c3' => 'Suhu Crankcase Silinder 3',
            'cyl_temp_crankcase_c4' => 'Suhu Crankcase Silinder 4',
            'cyl_temp_crankcase_c5' => 'Suhu Crankcase Silinder 5',
            'cyl_temp_crankcase_c6' => 'Suhu Crankcase Silinder 6',
            'cyl_temp_crankcase_c7' => 'Suhu Crankcase Silinder 7',

            'fo_comsumtion' => 'Konsumsi Minyak Bakar (F.O)',
            'fo_grade' => 'FO Grade',
            'lubricant_lo_system' => 'Konsumsi Pelumas (LO system)',
            'lubricant_lo_system_grade' => 'Grade Pelumas (LO system)',
            'lubricant_gearbox' => 'Konsumsi Pelumas (LO GEARBOX)',
            'lubricant_gearbox_grade' => 'Grade Pelumas (LO GEARBOX)',
        ];
    }
}
