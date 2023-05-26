<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

/**
 */
class NavigationLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'navigation_log';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'terminal_time' => 'datetime'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
    
    public static function table($fleetId, $date = null)
    {
        $date = is_null($date) ? date('Ym'): Carbon::parse($date)->format('Ym');
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}_{$date}";
    
        return $model->setTable($tableName);
    }
}
