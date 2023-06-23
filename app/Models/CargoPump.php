<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        foreach(CargoPumpLimit::where('fleet_id', $this->fleet_id)->get() as $limit) {
            $informations[$limit->name] = [
                'value' => $this->{$limit->sensor_name} ?: 0,
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
