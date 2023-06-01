<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BunkerInformation extends Model
{
    use HasFactory;

    protected $table = 'bunker_information';

    protected $fillable = [
        'fleet_id', 'speed_service' ,'pumping_rate' ,'presure_discharge' ,'loading_rate' ,'commision_days' ,'transport_loss'
    ];
}
