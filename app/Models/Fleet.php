<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fleet extends Model
{
    use HasFactory;

    protected $table = 'fleets';

    protected $fillable = [
        'active', 'name', 'imo_number', 'owner', 'ship_manager', 'cargo', 'type', 'email', 'telp', 'call_sign', 'builder', 'year', 'flag', 'home_port', 'class', 'mmsi', 'length', 'breadth', 'death', 'dwt', 'grt', 'nrt', 'lwt', 'draft', 'swl'
    ];

    public function rules(){
        return [
            'name' => 'required',
            'imo_number' => 'required',
            'owner' => 'required',
            'ship_manager' => 'required',
            'cargo' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'telp' => 'required',
            'call_sign' => 'required',
            'builder' => 'required',
            'year' => 'required',
            'flag' => 'required',
            'home_port' => 'required',
            'class' => 'required',
            'mmsi' => 'required',
            'length' => 'required',
            'breadth' => 'required',
            'death' => 'required',
            'dwt' => 'required',
            'grt' => 'required',
            'nrt' => 'required',
            'lwt' => 'required',
            'draft' => 'required',
            'swl' => 'required',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'fleet_id');
    }

    public function engine()
    {
        $model =  Engine::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo_data()
    {
        $model = Cargo::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo_pump()
    {
        $model = CargoPump::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo_information()
    {
        return $this->hasOne(CargoInformation::class, 'fleet_id');
    }

    public function bunker_information()
    {
        return $this->hasOne(BunkerInformation::class, 'fleet_id');
    }
}
