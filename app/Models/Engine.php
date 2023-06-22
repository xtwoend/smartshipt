<?php

namespace App\Models;

use App\Models\Fleet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Engine extends Model
{
    /**
     * The table associated with the model.
     */
    protected  $table = 'engines';

    /**
     * 
     */
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";

        return $model->setTable($tableName);
    }
    
    public function fleet() 
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }

    public function information() 
    {
        $informations = [];
        if(strtoupper($this->fleet?->type) == 'S') {
            $attributes = [
                'ME Control Air Inlet Press' => ['control_air_inlet', 'Bar', 0, 40],
                'ME AC CW Inlet Cooler Press' => ['me_ac_cw_inlet_cooler', 'Bar', 0, 100],
                'ME Jacket Cooling Water Press' => ['jcw_inlet', 'Bar', 0, 100],
                'ME LO Inlet to T/C Press' => ['me_lo_inlet_to_turb', 'Bar', 0, 100],
                'Scav Air Receiver Press' => ['scav_air_receiver', 'Bar', 0, 100],
                'Start Air Inlet Press' => ['start_air_inlet', 'Bar', 0, 100],
                'ME LO Inlet Press' => ['main_lub_oil', 'Bar', 0, 100],
                'ME FO Inlet Press' => ['me_fo_inlet_engine', 'Bar', 0, 100],
                'ME RPM Turbocharge' => ['tachometer_turbocharge', 'rpm', 0, 100],
                'DG No.1 RPM Turbocharge' => ['no1_dg_turbo_charger_speed', 'rpm', 0, 100],
                'DG No.2 RPM Turbocharge' => ['no2_dg_turbo_charger_speed', 'rpm', 0, 100],
                'DG No.3 RPM Turbocharge' => ['no3_dg_turbo_charger_speed', 'rpm', 0, 100],
            ];
            
            foreach($attributes as $key => $val) {
                $informations[$key] = [
                    'value' => $this->{$val[0]},
                    'unit' => $val[1],
                    'min' => $val[2],
                    'max' => $val[3],
                ];
            }
        }

        return (array) $informations;
    }
}