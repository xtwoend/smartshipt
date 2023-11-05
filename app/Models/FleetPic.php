<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetPic extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic_level', 'pic_name', 'pic_email', 'primary', 'pic_phone'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
