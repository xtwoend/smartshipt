<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Logger extends Model
{
    protected $table = 'loggers';

    protected $casts = [
        'data' => 'array',
        'terminal_time' => 'datetime:Y-m-d H:i:s'
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
        
        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->unsignedBigInteger('fleet_id')->index();
                $table->datetime('terminal_time')->unique();
                $table->string('group'); // engine, navigation, cargo, dll
                $table->json('data')->nullable();
                $table->timestamps();
            });
        }
        
        return $model->setTable($tableName);
    }
}
