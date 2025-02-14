<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class CargoTankSounding extends Model
{
    /**
     * disable timestamps.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'cargo_tank_sounding';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [];

    public static function table($fleetId)
    {
        $model = new self();
        $tableName = $model->getTable() . "_{$fleetId}";

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id');
                $table->unsignedBigInteger('tank_id')->index();
                $table->integer('trim_index')->index();
                $table->unsignedInteger('sounding_cm')->index();
                $table->float('volume', 10, 3);
                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }
}
