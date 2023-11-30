<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetDailyReport extends Model
{
    use HasFactory;

    protected $table = 'fleet_daily_reports';

    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";
        
        return $model->setTable($tableName);
    }
}
