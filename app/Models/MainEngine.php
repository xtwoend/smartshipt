<?php

namespace App\Models;

use App\Events\EngineUpdated;
use App\Models\MainEngineLog;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class MainEngine extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'engines';

    /**
     * all.
     */
    protected $fillable = [
        'fleet_id',
        'terminal_time',
        'engine_type' ,
        'voyage_number',
        'from_port',
        'to_port',
        'engine_output',
        'cyl_bore',
        'mep',
        'engine_rpm',
        'piston_stroke',
        'temp_engine_room',
        'speed',
        'propeller_speed',
        'me_rpm',
        'me_running_hours',
        'me_ht_water_cooling',
        'me_lt_water_cooling',
        'me_sea_water_cooling',
        'me_engine_load',
        'me_pressure_lo_inlet_tc',
        'me_temp_lo_outlet_tc',
        'me_pressure_lo_inlet_engine',
        'me_temp_lo_inlet_engine',
        'me_starting_air_engine_inlet',
        'me_pressure_fo_engine_inlet',
        'me_fo_engine_inlet_temp',
        'tc_turbo_blower_speed',
        'tc_blower_filter_pressure',
        'tc_air_cooler_back_pressure',
        'tc_scavenge_manifold_pressure',
        'tc_exh_gas_pressure_aft_tc',
        'temp_scaving_air_inlet_cooler',
        'temp_scaving_air_outlet_cooler',
        'temp_exh_gas_turbin_inlet',
        'temp_exh_gas_turbin_outlet',
        'temp_fo_specific_grafity',
        'temp_fo_viscosity_118',
        'gb_operating_pressure',
        'gb_shaftbrake_pressure',
        'gb_temp_after_oil_cooler',
        'gb_temp_thrust_bearing',
        'cr_fuel_command',
        'cr_injection_time',
        'cr_qty_piston_return',
        'cr_exh_valve_oc_angel',
        'cr_exh_valve_oc_dead_t',
        'cr_servo_oil_pressure_sp',
        'cr_fuel_rail_pressure_act',
        'cr_vit',
        'cyl_pressure_max_c1',
        'cyl_pressure_max_c2',
        'cyl_pressure_max_c3',
        'cyl_pressure_max_c4',
        'cyl_pressure_max_c5',
        'cyl_pressure_max_c6',
        'cyl_pressure_max_c7',
        'cyl_fuel_pump_index_c1',
        'cyl_fuel_pump_index_c2',
        'cyl_fuel_pump_index_c3',
        'cyl_fuel_pump_index_c4',
        'cyl_fuel_pump_index_c5',
        'cyl_fuel_pump_index_c6',
        'cyl_fuel_pump_index_c7',
        'cyl_temp_exh_c1',
        'cyl_temp_exh_c2',
        'cyl_temp_exh_c3',
        'cyl_temp_exh_c4',
        'cyl_temp_exh_c5',
        'cyl_temp_exh_c6',
        'cyl_temp_exh_c7',
        'cyl_temp_jacket_fw_out_c1',
        'cyl_temp_jacket_fw_out_c2',
        'cyl_temp_jacket_fw_out_c3',
        'cyl_temp_jacket_fw_out_c4',
        'cyl_temp_jacket_fw_out_c5',
        'cyl_temp_jacket_fw_out_c6',
        'cyl_temp_jacket_fw_out_c7',
        'cyl_temp_crankcase_c1',
        'cyl_temp_crankcase_c2',
        'cyl_temp_crankcase_c3',
        'cyl_temp_crankcase_c4',
        'cyl_temp_crankcase_c5',
        'cyl_temp_crankcase_c6',
        'cyl_temp_crankcase_c7',
        'fo_comsumtion',
        'fo_grade',
        'lubricant_lo_system',
        'lubricant_lo_system_grade',
        'lubricant_gearbox',
        'lubricant_gearbox_grade',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        'updated' => EngineUpdated::class,
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'terminal_time' => 'datetime',
    ];

    // create table cargo if not found table
    public static function table($fleetId)
    {
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                $table->string('engine_type')->nullable();
                $table->string('voyage_number')->nullable();
                $table->string('from_port')->nullable();
                $table->string('to_port')->nullable();
                $table->string('engine_output')->nullable();
                $table->string('cyl_bore')->nullable();
                $table->string('mep')->nullable();
                $table->string('engine_rpm')->nullable();
                $table->string('piston_stroke')->nullable();
                $table->float('temp_engine_room', 10, 3)->default(0);
                $table->float('speed', 10, 3)->default(0);
                $table->float('propeller_speed', 10, 3)->default(0);
                $table->float('me_rpm', 10, 3)->default(0);
                $table->float('me_running_hours', 10, 3)->default(0);
                $table->float('me_ht_water_cooling', 10, 3)->default(0);
                $table->float('me_lt_water_cooling', 10, 3)->default(0);
                $table->float('me_sea_water_cooling', 10, 3)->default(0);
                $table->float('me_engine_load', 10, 3)->default(0);
                $table->float('me_pressure_lo_inlet_tc', 10, 3)->default(0);
                $table->float('me_temp_lo_outlet_tc', 10, 3)->default(0);
                $table->float('me_pressure_lo_inlet_engine', 10, 3)->default(0);
                $table->float('me_temp_lo_inlet_engine', 10, 3)->default(0);
                $table->float('me_starting_air_engine_inlet', 10, 3)->default(0);
                $table->float('me_pressure_fo_engine_inlet', 10, 3)->default(0);
                $table->float('me_fo_engine_inlet_temp', 10, 3)->default(0);
                $table->float('tc_turbo_blower_speed', 10, 3)->default(0);
                $table->float('tc_blower_filter_pressure', 10, 3)->default(0);
                $table->float('tc_air_cooler_back_pressure', 10, 3)->default(0);
                $table->float('tc_scavenge_manifold_pressure', 10, 3)->default(0);
                $table->float('tc_exh_gas_pressure_aft_tc', 10, 3)->default(0);
                $table->float('temp_scaving_air_inlet_cooler', 10, 3)->default(0);
                $table->float('temp_scaving_air_outlet_cooler', 10, 3)->default(0);
                $table->float('temp_exh_gas_turbin_inlet', 10, 3)->default(0);
                $table->float('temp_exh_gas_turbin_outlet', 10, 3)->default(0);
                $table->float('temp_fo_specific_grafity', 10, 3)->default(0);
                $table->float('temp_fo_viscosity_118', 10, 3)->default(0);
                $table->float('gb_operating_pressure', 10, 3)->default(0);
                $table->float('gb_shaftbrake_pressure', 10, 3)->default(0);
                $table->float('gb_temp_after_oil_cooler', 10, 3)->default(0);
                $table->float('gb_temp_thrust_bearing', 10, 3)->default(0);
                $table->float('cr_fuel_command', 10, 3)->default(0);
                $table->float('cr_injection_time', 10, 3)->default(0);
                $table->float('cr_qty_piston_return', 10, 3)->default(0);
                $table->float('cr_exh_valve_oc_angel', 10, 3)->default(0);
                $table->float('cr_exh_valve_oc_dead_t', 10, 3)->default(0);
                $table->float('cr_servo_oil_pressure_sp', 10, 3)->default(0);
                $table->float('cr_fuel_rail_pressure_act', 10, 3)->default(0);
                $table->float('cr_vit', 10, 3)->default(0);

                $table->float('cyl_pressure_max_c1', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c2', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c3', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c4', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c5', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c6', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c7', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c8', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c1', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c2', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c3', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c4', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c5', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c6', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c7', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c8', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c1', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c2', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c3', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c4', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c5', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c6', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c7', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c8', 10, 3)->default(0);

                $table->float('cyl_temp_jacket_fw_out_c1', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c2', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c3', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c4', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c5', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c6', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c7', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c8', 10, 3)->default(0);

                $table->float('cyl_temp_crankcase_c1', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c2', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c3', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c4', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c5', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c6', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c7', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c8', 10, 3)->default(0);

                $table->float('fo_comsumtion', 10, 3)->default(0);
                $table->string('fo_grade')->nullable();
                $table->float('lubricant_lo_system', 10, 3)->nullable();
                $table->string('lubricant_lo_system_grade')->nullable();
                $table->float('lubricant_gearbox', 10, 3)->nullable();
                $table->string('lubricant_gearbox_grade')->nullable();

                $table->timestamps();
            });
        }

        if(Schema::hasTable($tableName) && ! Schema::hasColumn($tableName, 'engine_type'))
        {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('engine_type')->nullable();
                $table->string('voyage_number')->nullable();
                $table->string('from_port')->nullable();
                $table->string('to_port')->nullable();
                $table->string('engine_output')->nullable();
                $table->string('cyl_bore')->nullable();
                $table->string('mep')->nullable();
                $table->string('engine_rpm')->nullable();
                $table->string('piston_stroke')->nullable();
                $table->float('temp_engine_room', 10, 3)->default(0);
                $table->float('speed', 10, 3)->default(0);
                $table->float('propeller_speed', 10, 3)->default(0);
                $table->float('me_rpm', 10, 3)->default(0);
                $table->float('me_running_hours', 10, 3)->default(0);
                $table->float('me_ht_water_cooling', 10, 3)->default(0);
                $table->float('me_lt_water_cooling', 10, 3)->default(0);
                $table->float('me_sea_water_cooling', 10, 3)->default(0);
                $table->float('me_engine_load', 10, 3)->default(0);
                $table->float('me_pressure_lo_inlet_tc', 10, 3)->default(0);
                $table->float('me_temp_lo_outlet_tc', 10, 3)->default(0);
                $table->float('me_pressure_lo_inlet_engine', 10, 3)->default(0);
                $table->float('me_temp_lo_inlet_engine', 10, 3)->default(0);
                $table->float('me_starting_air_engine_inlet', 10, 3)->default(0);
                $table->float('me_pressure_fo_engine_inlet', 10, 3)->default(0);
                $table->float('me_fo_engine_inlet_temp', 10, 3)->default(0);
                $table->float('tc_turbo_blower_speed', 10, 3)->default(0);
                $table->float('tc_blower_filter_pressure', 10, 3)->default(0);
                $table->float('tc_air_cooler_back_pressure', 10, 3)->default(0);
                $table->float('tc_scavenge_manifold_pressure', 10, 3)->default(0);
                $table->float('tc_exh_gas_pressure_aft_tc', 10, 3)->default(0);
                $table->float('temp_scaving_air_inlet_cooler', 10, 3)->default(0);
                $table->float('temp_scaving_air_outlet_cooler', 10, 3)->default(0);
                $table->float('temp_exh_gas_turbin_inlet', 10, 3)->default(0);
                $table->float('temp_exh_gas_turbin_outlet', 10, 3)->default(0);
                $table->float('temp_fo_specific_grafity', 10, 3)->default(0);
                $table->float('temp_fo_viscosity_118', 10, 3)->default(0);
                $table->float('gb_operating_pressure', 10, 3)->default(0);
                $table->float('gb_shaftbrake_pressure', 10, 3)->default(0);
                $table->float('gb_temp_after_oil_cooler', 10, 3)->default(0);
                $table->float('gb_temp_thrust_bearing', 10, 3)->default(0);
                $table->float('cr_fuel_command', 10, 3)->default(0);
                $table->float('cr_injection_time', 10, 3)->default(0);
                $table->float('cr_qty_piston_return', 10, 3)->default(0);
                $table->float('cr_exh_valve_oc_angel', 10, 3)->default(0);
                $table->float('cr_exh_valve_oc_dead_t', 10, 3)->default(0);
                $table->float('cr_servo_oil_pressure_sp', 10, 3)->default(0);
                $table->float('cr_fuel_rail_pressure_act', 10, 3)->default(0);
                $table->float('cr_vit', 10, 3)->default(0);

                $table->float('cyl_pressure_max_c1', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c2', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c3', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c4', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c5', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c6', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c7', 10, 3)->default(0);
                $table->float('cyl_pressure_max_c8', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c1', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c2', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c3', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c4', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c5', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c6', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c7', 10, 3)->default(0);
                $table->float('cyl_fuel_pump_index_c8', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c1', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c2', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c3', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c4', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c5', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c6', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c7', 10, 3)->default(0);
                $table->float('cyl_temp_exh_c8', 10, 3)->default(0);

                $table->float('cyl_temp_jacket_fw_out_c1', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c2', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c3', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c4', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c5', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c6', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c7', 10, 3)->default(0);
                $table->float('cyl_temp_jacket_fw_out_c8', 10, 3)->default(0);

                $table->float('cyl_temp_crankcase_c1', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c2', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c3', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c4', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c5', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c6', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c7', 10, 3)->default(0);
                $table->float('cyl_temp_crankcase_c8', 10, 3)->default(0);

                $table->float('fo_comsumtion', 10, 3)->default(0);
                $table->string('fo_grade')->nullable();
                $table->float('lubricant_lo_system', 10, 3)->nullable();
                $table->string('lubricant_lo_system_grade')->nullable();
                $table->float('lubricant_gearbox', 10, 3)->nullable();
                $table->string('lubricant_gearbox_grade')->nullable();
            });
        }

        return $model->setTable($tableName);
    }
}
