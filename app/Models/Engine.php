<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Fleet;
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
        foreach(Sensor::where('fleet_id', $this->fleet_id)->whereGroup('engine')->orderBy('id')->get() as $limit) {
            $diff = Carbon::parse($this->updated_at)->diffInMinutes(Carbon::now());
            $value = $diff < 5 ?  $this->{$limit->sensor_name} : 0;
            $informations[$limit->id] = [
                'title' => $limit->name,
                'value' => $value,
                'unit' => $limit->unit,
                'min' => $limit->min,
                'normal' => $limit->normal,
                'danger' => $limit->danger,
                'max' => $limit->max,
            ];
        }

        return (array) $informations;
    }

    public function getRpmAttribute()
    {
        return (int) $this->attributes['engine_speed'];
    }
}