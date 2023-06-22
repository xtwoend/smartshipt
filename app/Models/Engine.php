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
                'ME Control Air Inlet Press (Bar)' => 'control_air_inlet',
                'ME AC Cooling Water Inlet Cooler Press' => 'me_ac_cw_inlet_cooler',
                'ME Jacket Cooling Water Press' => 'jcw_inlet',
                'ME LO Inlet to T/C Press' => 'me_lo_inlet_to_turb',
                'Scav Air Receiver Oress' => 'scav_air_receiver',
                'Start Air Inlet Press' => 'start_air_inlet',
                'ME LO Inlet Press' => 'main_lub_oil',
                'ME FO Inlet Press' => 'me_fo_inlet_engine',
                'ME RPM Turbocharge' => 'tachometer_turbocharge',
                'DG No.1 RPM Turbocharge' => 'no1_dg_turbo_charger_speed',
                'DG No.2 RPM Turbocharge' => 'no2_dg_turbo_charger_speed',
                'DG No.3 RPM Turbocharge' => 'no3_dg_turbo_charger_speed'
            ];
            
            foreach($attributes as $key => $val) {
                $informations[$key] = $this->{$val};
            }
        }

        return (array) $informations;
    }
}