<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    protected $table = 'fleets';

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'fleet_id');
    }

    public function engine()
    {
        return $this->hasOne(Engine::class, 'fleet_id');
    }
}
