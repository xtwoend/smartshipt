<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoDensity extends Model
{
    protected $table = 'cargo_density';

    protected $fillable = [
        'product',
        'density',
        'created_at',
        'updated_at'
    ];
    
    public function tank()
    {
        return $this->belongsTo(Tank::class, 'content_type', 'product');
    }
}
