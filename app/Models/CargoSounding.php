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
                $table->float('trim_index', 10, 3)->index()->nullable()->default(NULL);
                $table->float('heel_index', 10, 3)->index()->nullable()->default(NULL); // (-) = port, 0 = no heel, (+) = stb
                $table->float('level', 10, 3)->nullable();
                $table->float('ullage', 10, 3)->nullable();
                $table->float('volume', 10, 3)->nullable(); // satuan m3
                $table->float('diff', 10, 3)->nullable()->default(NULL);
                $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }
}
