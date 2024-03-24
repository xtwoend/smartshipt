<?php

namespace App\Models;

use App\Models\Sensor;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorDoc extends Model
{
    use HasFactory;
    use Compoships;

    protected $fillable = ['fleet_id', 'sensor_name', 'low_desc', 'high_desc', 'image', 'diagram'];

    public function sensor() {
        return $this->belongsTo(Sensor::class, ['fleet_id', 'sensor_name'], ['fleet_id', 'sensor_name']);
    }
}
