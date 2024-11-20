<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class DieselGeneratorLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'engine_log';

    /**
     * all.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'terminal_time' => 'datetime',
    ];

    // create table cargo if not found table
    public static function table($fleetId, $date = null, $count = 1)
    {
        $date = is_null($date) ? date('Ym') : Carbon::parse($date)->format('Ym');
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($count, $model) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->index();
                for($i=1; $i <= $count; $i++) {
                    foreach($model->fields() as $key => $val) {
                        $field = "{$key}_dg_{$i}";
                        if($val == 'float') {
                            $table->{$val}($field, 8, 3)->default(0);
                        }else if($val == 'integer') {
                            $table->{$val}($field)->default(0);
                        }else {
                            $table->{$val}($field, 20)->nullable();
                        }
                    }
                }
                $table->timestamps();
            });
        }

    
        if(Schema::hasTable($tableName) && ! Schema::hasColumn($tableName, 'kw_diesel_dg_1')) {
            Schema::table($tableName, function (Blueprint $table) use ($count, $model) {
                for($i=1; $i <= $count; $i++) {
                    foreach($model->fields() as $key => $val) {
                        
                        $field = "{$key}_dg_{$i}";
                        if($val == 'float') {
                            $table->{$val}($field, 8, 3)->default(0);
                        }else if($val == 'integer') {
                            $table->{$val}($field)->default(0);
                        }else {
                            $table->{$val}($field, 20)->nullable();
                        }
                    }
                }
            });
        }

        return $model->setTable($tableName);
    }

    /**
     * fields
     */
    protected function fields() {
        return (array) [
            'dg_no'  => 'string',
            'report_no' => 'string',
            'voyage_no' => 'string',
            'place' => 'string',
            'maker' => 'string',
            'type' => 'string',
            'turbo_charger' => 'string',
            'stroke_bore' => 'string',
            'kw_diesel' => 'float',
            'rpm' => 'integer',
            'volt' => 'integer',
            'kw' => 'integer',
            'hz' => 'integer',
            'name_of_lub_oil_grade' => 'string',
            'sump_capacity_ltrs' => 'integer',
            'lub_oil_consumption_ltrs_day' => 'float',
            'd_g_lo_purification_sys_instal' => 'string',
            'purification_carried_out' => 'string',
            'frequency_of_purification' => 'string',
            'date_of_last_analysis_of_lub_oil' => 'string',
            'quantity_of_oil_renewed_at' => 'integer',
            'last_change_ltrs' => 'string',

            'rh_installation' => 'float',
            'rh_last_complete_overhaul' => 'float',
            'rh_last_cylinder_heads_overhaul' => 'float',
            'rh_last_turbocharger_overhaul' => 'float',
            'rh_last_governor_serviced' => 'float',
            'rh_last_air_cooler_fw_side_cleaned' => 'float',
            'rh_last_air_cooler_air_side_cleaned' => 'float',
            'rh_last_lub_oil_changed' => 'float',
            
            'type_of_fuel_used' => 'string',
            'hfo_viscosity_cst_50' => 'string',
            'mdo_viscosity_cst_50' => 'string',
            'ratio_of_blend' => 'string',
            
            'consumption' => 'float',
            'mt_day' => 'float',
            'operating' => 'float',
            'power' => 'float',
            
            'pu_pmax_kgf_cm2_c1' => 'float',
            'pu_exhaust_gas_temp_c1' => 'float',
            'pu_fuel_rack_position_c1' => 'float',
            'pu_jcw_outlet_temp_c1' => 'float',

            'pu_pmax_kgf_cm2_c2' => 'float',
            'pu_exhaust_gas_temp_c2' => 'float',
            'pu_fuel_rack_position_c2' => 'float',
            'pu_jcw_outlet_temp_c2' => 'float',

            'pu_pmax_kgf_cm2_c3' => 'float',
            'pu_exhaust_gas_temp_c3' => 'float',
            'pu_fuel_rack_position_c3' => 'float',
            'pu_jcw_outlet_temp_c3' => 'float',

            'pu_pmax_kgf_cm2_c4' => 'float',
            'pu_exhaust_gas_temp_c4' => 'float',
            'pu_fuel_rack_position_c4' => 'float',
            'pu_jcw_outlet_temp_c4' => 'float',

            'pu_pmax_kgf_cm2_c5' => 'float',
            'pu_exhaust_gas_temp_c5' => 'float',
            'pu_fuel_rack_position_c5' => 'float',
            'pu_jcw_outlet_temp_c5' => 'float',

            'pu_pmax_kgf_cm2_c6' => 'float',
            'pu_exhaust_gas_temp_c6' => 'float',
            'pu_fuel_rack_position_c6' => 'float',
            'pu_jcw_outlet_temp_c6' => 'float',
            
            'tc_gas_inlet_temp_400' => 'integer',
            'tc_gas_inlet_temp_420' => 'integer',
            'tc_gas_outlet_temp' => 'integer',

            'engine_boost_air_pressure' => 'float',
            'engine_boost_air_temp' => 'float',
            'engine_fuel_oil_inlet_pressure' => 'float',
            'engine_fuel_oil_inlet_temp' => 'float',
            'engine_bearing_lub_oil_inlet_pressure' => 'float',
            'engine_bearing_lub_oil_inlet_temp' => 'float',
            'engine_rocker_arm_lub_oil_inlet_pressure' => 'float',
            'engine_rocker_arm_lub_oil_inlet_temp' => 'float',
            'engine_fresh_water_inlet_pressure' => 'float',
            'engine_fresh_water_inlet_temp' => 'float',
            'engine_injector_cooling_inlet_pressure' => 'float',
            'engine_injector_cooling_inlet_temp' => 'float',
            'lub_oil_cooler_inlet_outlet_pressure' => 'float',
            
            'lub_oil_cooler_inlet_temp' => 'float',
            'lub_oil_cooler_outlet_temp' => 'float',
            'fresh_water_cooler_inlet_outlet_pressure' => 'float',
            'fresh_water_cooler_inlet_temp' => 'float',
            'fresh_water_cooler_outlet_temp' => 'float'
        ];
    }
}
