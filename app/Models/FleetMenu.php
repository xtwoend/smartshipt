<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetMenu extends Model
{
    use HasFactory;

    protected $casts = [
        'params' => 'array'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');    
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');    
    }

}
