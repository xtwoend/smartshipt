<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'fleet_id', 'name', 'group', 'last_maintenance', 'schedule_maintenance', 'next_maintenance', 'score', 'condition', 'degradation_factor', 'lifetime_hours', 'predicted_time_repair', 'difference_lifetime'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [];

    /**
     * 
     */
    public function sensors() 
    {
        return $this->hasMany(EquipmentSensor::class, 'equipment_id');
    }
}
