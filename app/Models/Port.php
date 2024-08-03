<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Port extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'location', 'lat', 'lng'];

    /**
     * log record
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'location', 'lat', 'lng']);
    }

    public function rules(){
        return [
            'name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ];
    }

}
