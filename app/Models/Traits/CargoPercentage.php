<?php

namespace App\Models\Traits;

use App\Models\Sensor;


trait CargoPercentage
{
    
    public static function boot()
    {
        parent::boot();
        static::retrieved(function($model){
            $model->ullageCalculate($model);
            $model->levelCalculate($model);
        });
    }

    /**
     * cargo calculate
     */
    public  function ullageCalculate($model)
    { 
        $data = $model->toArray();
        $fields = Sensor::where('fleet_id', $data['fleet_id'])->where('is_percentage', 1)->get();
        foreach($fields as $field) {
            
            if(isset($data[$field->sensor_name])) {
                $max = $field->normal > 0 ? $field->normal : 1;
                $current = $data[$field->sensor_name];
                $level = $max - $current;

                $percentage = ($level * 100) / $max;
                
                // masukan ke attributes model
                $field_name = $field->sensor_name . '_percentage';

                $model->setAttribute($field_name, round($percentage, 0));
            }
        }
    }
    
    /**
     * fuel calculate
     */
    public function levelCalculate($model)
    {
        $data = $model->toArray();
        $fields = Sensor::where('fleet_id', $data['fleet_id'])->where('is_percentage', 2)->get();
        foreach($fields as $field) {
            
            if(isset($data[$field->sensor_name])) {
                $max = $field->danger > 0 ? $field->danger : 1;
                $level = $data[$field->sensor_name];
               
                $percentage = ($level * 100) / $max;
                
                // masukan ke attributes model
                $field_name = $field->sensor_name . '_percentage';

                $model->setAttribute($field_name, round($percentage, 0));
            }
        }
    }
}