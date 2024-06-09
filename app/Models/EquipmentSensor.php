<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentSensor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'equipment_sensors';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'equipment_id', 'sensor_id', 'mode', 'avg_value', 'performance', 'abnormal_count', 'total_value', 'count_value', 'sensor_trigger', 'sensor_trigger_value'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [];

    /**
     * 
     */
    public function sensor() 
    {
        return $this->hasOne(Sensor::class, 'id', 'sensor_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
