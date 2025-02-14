<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    const DENSITY_HFO = 0.95;
    const DENSITY_MDO = 0.85;
    const POSITION_PORT = 'PORT';
    const POSITION_STARBOARD = 'STB';

    protected $fillable = [
        'fleet_id',
        'tank_position',
        'tank_locator', // P or L
        'contents',
        'content_type',
        'capacity',
        'type'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }
    
    public function conversions()
    {
        return $this->hasMany(TankLoadConversion::class, 'tank_id');
    }
}
