<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Fleet;
use App\Models\EngineLimit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Engine extends Model
{
    /**
     * The table associated with the model.
     */
    protected  $table = 'engines';

    /**
     * 
     */
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";

        return $model->setTable($tableName);
    }
    
    public function fleet() 
    {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }

    public function information() 
    {
        $informations = [];
        foreach(EngineLimit::where('fleet_id', $this->fleet_id)->orderBy('id')->get() as $limit) {
            $diff = Carbon::parse($this->updated_at)->diffInMinutes(Carbon::now());
            $value = $diff < 15 ?  $this->{$limit->sensor_name} : 0;
            $informations[$limit->id] = [
                'title' => $limit->name,
                'value' => $value,
                'unit' => $limit->unit,
                'min' => 0,
                'normal' => $limit->normal_limit,
                'warning' => $limit->warning_limit,
                'danger' => $limit->danger_limit,
                'max' => $limit->max_limit,
            ];
        }

        return (array) $informations;
    }
}