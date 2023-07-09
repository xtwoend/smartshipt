<?php

namespace App\Models;

use App\Models\Fleet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupData extends Model
{
    use HasFactory;
    
    protected array $groups = ['engine', 'cargo', 'cargo_pump', 'bunker', 'ballast'];

    protected $table = 'group_data';

    protected $fillable = ['fleet_id', 'group', 'class_handler', 'table_name'];

    function fleet() : BelongsTo {
        return $this->belongsTo(Fleet::class, 'fleet_id');
    }
}
