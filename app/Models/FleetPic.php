<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FleetPic extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'pic_level', 'pic_name', 'pic_email', 'primary', 'pic_phone'
    ];

    /**
     * log record
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['pic_level', 'pic_name', 'pic_email', 'primary', 'pic_phone']);
    }
    
    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
