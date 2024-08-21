<?php

namespace App\Models;

use App\Models\Alarm;
use App\Models\Navigation;
use App\Models\NavigationLog;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fleet extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'fleets';

    protected $fillable = [
        'active', 'image', 'name', 'imo_number', 'owner', 'ship_manager', 'cargo', 'type', 'email', 'telp', 'call_sign', 'engine_maker', 'engine_type', 'builder', 'year', 'flag', 'home_port', 'class', 'mmsi', 'length', 'breadth', 'death', 'dwt', 'grt', 'nrt', 'lwt', 'draft', 'swl'
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

    /**
     * log record
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['active', 'image', 'name', 'imo_number', 'owner', 'ship_manager', 'cargo', 'type', 'email', 'telp', 'call_sign', 'engine_maker', 'engine_type', 'builder', 'year', 'flag', 'home_port', 'class', 'mmsi', 'length', 'breadth', 'death', 'dwt', 'grt', 'nrt', 'lwt', 'draft', 'swl'])
            ->logOnlyDirty();
    }

    /**
     * fleets
     */
    public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class, 'fleet_user_accesses', 'fleet_id', 'user_id')->withTimestamps();
    }

    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function submenu()
    {
        return $this->hasMany(FleetMenu::class, 'fleet_id');
    }

    public function sensors()
    {
        return $this->hasMany(Sensor::class, 'fleet_id');
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'fleet_id');
    }

    public function mimic()
    {
        return $this->hasMany(FleetMimic::class, 'fleet_id');
    }

    public function pic()
    {
        return $this->hasMany(FleetPic::class, 'fleet_id');
    }
    
    public function alarms()
    {
        $model = Alarm::table($this->id);
        if(Schema::hasTable($model->getTable())) {
            return $model;
        }
        return null;
    }

    public function trendOptions($group) 
    {
        $rows = $this->sensors()->where('group', $group)->get();
        $options = [];

        foreach($rows as $row) {
            $options[] = [
                'id' => $row->id,
                'fleet_id' => $row->fleet_id,
                'data' => $row->sensor_name,
                'text' => $row->name,
                'unit' => $row->unit,
                'min' => $row->min,
                'max' => $row->max,
                'normal' => $row->normal,
                'max_normal' => $row->max_normal,
                'danger' => $row->danger,
                'condition' => $row->condition,
                'is_ams' => (bool) $row->is_ams,
                'reverse' => (bool) $row->reverse,
            ];
        }

        return $options;
    }

    function group_data() : HasMany {
        return $this->hasMany(GroupData::class, 'fleet_id');
    }


    public function navigation()
    {
        return $this->hasOne(Navigation::class, 'fleet_id');
    }

    public function navigation_logs()
    {
        return (new NavigationLog);
    }

    public function navigationColumns() 
    {   
        $model = (new Navigation);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function engine()
    {
        $group = $this->group_data()->where('group', 'engine')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function engine_logs()
    {
        $group = $this->group_data()->where('group', 'engine_logs')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        return (new $classModel);
    }

    public function engineColumns() 
    {   
        $group = $this->group_data()->where('group', 'engine')->first();
        if(is_null($group)) return [];

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function generatorColumns() 
    {   
        $group = $this->group_data()->where('group', 'generator')->first();
        if(is_null($group)) return [];

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function cargo()
    {
        $group = $this->group_data()->where('group', 'cargo')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo_logs()
    {
        $group = $this->group_data()->where('group', 'cargo_logs')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        return (new $classModel);
    }

    public function cargoColumns() 
    {   
        $group = $this->group_data()->where('group', 'cargo')->first();
        if(is_null($group)) return [];

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return [];
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function cargo_pump()
    {
        $group = $this->group_data()->where('group', 'cargo_pump')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function cargo_pump_logs()
    {
        $group = $this->group_data()->where('group', 'cargo_pump_logs')->first();
        if(is_null($group)) return null;
        
        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        return (new $classModel);
    }
    
    public function cargoPumpColumns() 
    {   
        $group = $this->group_data()->where('group', 'cargo_pump')->first();
        if(is_null($group)) return [];
        
        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return [];
        }
        
        $model = (new $classModel)->table($this->id);
       
        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function fuel()
    {
        $group = $this->group_data()->where('group', 'fuel')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function fuel_logs()
    {
        $group = $this->group_data()->where('group', 'fuel_logs')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        return (new $classModel);
    }
    
    public function fuelColumns() 
    {   
        $group = $this->group_data()->where('group', 'fuel')->first();
        if(is_null($group)) return [];

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return [];
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function ballast()
    {
        $group = $this->group_data()->where('group', 'ballast')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function ballast_logs()
    {
        $group = $this->group_data()->where('group', 'ballast_logs')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        return (new $classModel);
    }
    
    public function ballastColumns() 
    {   
        $group = $this->group_data()->where('group', 'ballast')->first();
        if(is_null($group)) return [];

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return [];
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
    }

    public function draft()
    {
        $group = $this->group_data()->where('group', 'draft')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            return $model->where('fleet_id', $this->id)->first();
        }
        return null;
    }

    public function draft_logs()
    {
        $group = $this->group_data()->where('group', 'draft_logs')->first();
        if(is_null($group)) return null;

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return null;
        }

        return (new $classModel);
    }
    
    public function draftColumns() 
    {   
        $group = $this->group_data()->where('group', 'draft')->first();
        if(is_null($group)) return [];

        $classModel  = $group->class_handler;
        if(! class_exists($classModel)) {
            return [];
        }
        
        $model = (new $classModel)->table($this->id);

        if(Schema::hasTable($model->getTable())) {
            $columns = Schema::getColumnListing($model->getTable());
            return array_diff($columns, ['id', 'created_at', 'updated_at', 'terminal_time', 'fleet_id']);
        }
        return [];
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
