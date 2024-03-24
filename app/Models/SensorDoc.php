<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorDoc extends Model
{
    use HasFactory;

    protected $fillable = ['fleet_id', 'sensor_name', 'low_desc', 'high_desc', 'image', 'diagram'];

    public function sensor() {
        return $this->belongsTo(Sensor::class, ['fleet_id', 'sensor_name'], ['fleet_id', 'sensor_name']);
    }
}
