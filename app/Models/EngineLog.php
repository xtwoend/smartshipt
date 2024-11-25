<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Traits\CargoPercentage;
use Illuminate\Database\Eloquent\Model;

class EngineLog extends Model
{
    use CargoPercentage;
    
    /**
     * The table associated with the model.
     */
    protected  $table = 'engine_log';

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'terminal_time' => 'datetime'
    ];

    // create table cargo if not found table
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";

        return $model->setTable($tableName);
    }
}