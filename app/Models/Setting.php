<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['group', 'key', 'value'];

    public function getByGroup($group)
    {
        $settings = $this->where('group', $group)->get()->pluck('value', 'key');
        
        return $settings->toArray();
    }

    public function get($key, $default = null)
    {
        $value = $this->where('key', $key)->first();

        return $value->value ?? $default;
    }
}
