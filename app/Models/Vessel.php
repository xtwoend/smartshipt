<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $table = 'vessels';

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'vessel_id');
    }
}
