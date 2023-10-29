<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetMimic extends Model
{
    use HasFactory;

    protected $fillable = [
        'fleet_id', 'path', 'group', 'source', 'sample_data'
    ];

    protected $casts = [
        'sample_data' => 'array'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
