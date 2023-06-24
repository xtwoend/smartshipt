<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CargoPump extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected  $table = 'cargo_pump';

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
        foreach(Sensor::where('fleet_id', $this->fleet_id)->whereGroup('cargo_pump')->orderBy('id')->get() as $limit) {
            $diff = Carbon::parse($this->updated_at)->diffInMinutes(Carbon::now());
            $value = $diff < 10 ?  $this->{$limit->sensor_name} : 0;
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
