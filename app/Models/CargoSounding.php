<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class CargoSounding extends Model
{
    /**
     * disable timestamps.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'tank_sounding_cargo';

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
                $table->float('trim_index', 10, 3)->index();
                $table->unsignedInteger('ullage')->index();
                $table->float('mt', 10, 3)->nullable();
                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }
}
