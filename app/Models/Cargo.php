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
}
