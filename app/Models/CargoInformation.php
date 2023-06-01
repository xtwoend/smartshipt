<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoInformation extends Model
{
    use HasFactory;

    protected $table = 'cargo_information';

    protected $fillable = [
        'fleet_id', 'group' ,'total' ,'grade' ,'capacity' ,'capacity_percentage' ,'capacity_sg' ,'max_capacity' ,'max_capacity_percentage' ,'max_capacity_sg'
    ];
}
