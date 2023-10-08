<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fleet() 
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
