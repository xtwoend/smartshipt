<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    /**
     * The table associated with the model.
     */
    protected  $table = 'cargo';

    /**
     *
     */
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";

        return $model->setTable($tableName);
    }

    public function information() 
    {
        $informations = [];
        foreach(Sensor::where('fleet_id', $this->fleet_id)->whereGroup('cargo')->orderBy('id')->get() as $limit) {
            $diff = Carbon::parse($this->updated_at)->diffInMinutes(Carbon::now());
            $value = $diff < 10 ?  $this->{$limit->sensor_name} : 0;
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
}
