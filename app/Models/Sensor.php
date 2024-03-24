<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sensor extends Model
{
    use HasFactory;
    use Compoships;

    protected $guarded = ['id'];

    public function fleet() 
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }

    public function doc() {
        return $this->belongsTo(SensorDoc::class, ['fleet_id', 'sensor_name'], ['fleet_id', 'sensor_name']);
    }
}
