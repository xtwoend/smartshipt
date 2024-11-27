<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sensor extends Model
{
    use HasFactory;
    use Compoships;
    use Cachable;

    protected $cachePrefix = "cache";

    protected $cacheCooldownSeconds = 300;

    protected $guarded = ['id'];

    public function fleet() 
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }

    public function doc() {
        return $this->belongsTo(SensorDoc::class, ['fleet_id', 'sensor_name'], ['fleet_id', 'sensor_name']);
    }
}
