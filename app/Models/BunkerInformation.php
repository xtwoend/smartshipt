<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BunkerInformation extends Model
{
    use HasFactory;

    protected $table = 'bunker_information';

    protected $fillable = [
        'fleet_id', 'speed_service' ,'pumping_rate' ,'presure_discharge' ,'loading_rate' ,'commision_days' ,'transport_loss', 'max_speed_laden', 'max_speed_laden_mfo', 'max_speed_laden_mdo', 'max_speed_laden_hsd', 'max_speed_ballast', 'max_speed_ballast_mfo', 'max_speed_ballast_mdo', 'max_speed_ballast_hsd', 'sea_laden_mfo', 'sea_laden_mdo', 'sea_laden_hsd', 'sea_laden_day', 'sea_ballast_mfo', 'sea_ballast_mdo', 'sea_ballast_hsd', 'sea_ballast_day', 'discharge_mfo', 'discharge_mdo', 'discharge_hsd', 'loading_mfo', 'loading_mdo', 'loading_hsd', 'idle_mfo', 'idle_mdo', 'idle_hsd', 'manovering_mfo', 'manovering_mdo', 'manovering_hsd', 'cleaning_mfo', 'cleaning_mdo', 'cleaning_hsd', 'heating_mfo', 'heating_mdo', 'heating_hsd', 'ballasting_mfo', 'ballasting_mdo', 'ballasting_hsd', 'deballasting_mfo', 'deballasting_mdo', 'deballasting_hsd', 'tank_capacity_mfo', 'tank_capacity_mdo', 'tank_capacity_hsd'
    ];
}
