<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

/**
 */
class CargoTankCorrection extends Model
{
    /**
     * disable timestamps.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'cargo_tank_correction';

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
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('fleet_id')->index();
                $table->float('temp', 3, 1)->nullable();
                $table->float('correction', 8, 7)->default(0);
            });
        }

        return $model->setTable($tableName);
    }
}
