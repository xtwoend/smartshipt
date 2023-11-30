<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FleetStatusDuration extends Model
{
    use HasFactory;
    
    protected $table = 'fleet_status_duration';

    function fleet() : BelongsTo {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
