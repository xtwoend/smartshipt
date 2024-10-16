<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetDoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'size', 'mime_type', 'path'
    ];

    public function fleet() {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
