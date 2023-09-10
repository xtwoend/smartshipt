<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alarm extends Model
{
    /**
     * The table associated with the model.
     */
    protected  $table = 'alarm';

    /**
     *
     */
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";

        return $model->setTable($tableName);
    }

    /**
     * get duration attribute
     */
    public function getDurationAttribute()
    {
        $duration = (isset($this->finished_at) && isset($this->started_at)) ? Carbon::parse($this->finished_at)->diffInSeconds(Carbon::parse($this->started_at)): 0;
        if($duration > 0) {
            return gmdate("H:i:s", $duration);
        }
        return 0;
    }

    /**
     * get duration in hours
     */
    public function getDurationInHourAttribute()
    {
        $duration = (isset($this->finished_at) && isset($this->started_at)) ? Carbon::parse($this->finished_at)->diffInSeconds(Carbon::parse($this->started_at)): 0;
        if($duration > 0) {
            return (float) $duration / (60 * 60);
        }
        return 0;
    }

    /**
     * get duration in hours
     */
    public function getDurationInMinuteAttribute()
    {
        $duration = (isset($this->finished_at) && isset($this->started_at)) ? Carbon::parse($this->finished_at)->diffInSeconds(Carbon::parse($this->started_at)): 0;
        if($duration > 0) {
            return (float) $duration / 60;
        }
        return 0;
    }
}
