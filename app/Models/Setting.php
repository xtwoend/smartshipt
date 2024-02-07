<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';


    public function getByGroup($group)
    {
        $settings = $this->where('group', $group)->get()->pluck('value', 'key');
        
        return $settings->toArray();
    }

    public function get($key)
    {
        $value = $this->where('key', $key)->first();

        return $value->value ?? null;
    }
}
