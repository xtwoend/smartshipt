<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FleetOilLube extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];
    /**
     *
     */
    public static function table($fleetId)
    {
        $model = new self;
        $tableName = $model->getTable() . "_{$fleetId}";

        if(! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('fleet_id')->index();
                $table->date('sample_date')->index();
                $table->string('component')->index();
                $table->string('lube')->nullable();
                $table->string('manufacture')->nullable();
                $table->string('application')->nullable();
                $table->string('model')->nullable();
                $table->string('Equipment_Description')->nullable();
                $table->string('Equipment_Number')->nullable();

                $table->float('RH_Oil', 10, 3)->default(0);
                $table->float('RH_Engine', 10, 3)->default(0);
                $table->float('P', 10, 3)->default(0);
                $table->float('TAN', 10, 3)->default(0);
                $table->float('Vk_40', 10, 3)->default(0);
                $table->float('Ca', 10, 3)->default(0);
                $table->float('Zn', 10, 3)->default(0);
                $table->float('Mg', 10, 3)->default(0);
                $table->float('TBN_D4739', 10, 3)->default(0);
                $table->float('TBN', 10, 3)->default(0);
                $table->float('Wt', 10, 3)->default(0);
                $table->float('Soot', 10, 3)->default(0);
                $table->float('Fu', 10, 3)->default(0);
                $table->float('Oxi', 10, 3)->default(0);
                $table->float('Nit', 10, 3)->default(0);
                $table->float('Ag', 10, 3)->default(0);
                $table->float('Sn', 10, 3)->default(0);
                $table->float('Pb', 10, 3)->default(0);
                $table->float('Fe', 10, 3)->default(0);
                $table->float('Cu', 10, 3)->default(0);
                $table->float('Cr', 10, 3)->default(0);
                $table->float('Al', 10, 3)->default(0);
                $table->float('Vk_100', 10, 3)->default(0);
                $table->float('ISO_4406', 10, 3)->default(0);
                $table->float('NAS_1638', 10, 3)->default(0);
                $table->float('Colour', 10, 3)->default(0);
                $table->float('Si', 10, 3)->default(0);
                $table->float('Na', 10, 3)->default(0);
                $table->float('V', 10, 3)->default(0);
                $table->float('CSC', 10, 3)->default(0);
                $table->float('Density', 10, 3)->default(0);
                $table->float('FP_COC', 10, 3)->default(0);
                $table->float('Sq_I', 10, 3)->default(0);
                $table->float('Sq_II', 10, 3)->default(0);
                $table->float('Sq_III', 10, 3)->default(0);
                $table->float('PI', 10, 3)->default(0);

                $table->float('TI', 10, 3)->default(0);
                $table->float('PP', 10, 3)->default(0);
                $table->float('Sulf_Ash', 10, 3)->default(0);
                $table->float('Wt_D_95', 10, 3)->default(0);
                $table->float('Wt_KF', 10, 3)->default(0);
                $table->float('Gly', 10, 3)->default(0);
                $table->float('Sulf', 10, 3)->default(0);
                $table->float('Mo', 10, 3)->default(0);
                $table->float('wt_Karl_Fi', 10, 3)->default(0);
                $table->float('Ni', 10, 3)->default(0);
                $table->float('B', 10, 3)->default(0);
                $table->float('VI', 10, 3)->default(0);

                $table->float('PI_D4055', 10, 3)->default(0);
                $table->float('RBOT', 10, 3)->default(0);
                $table->float('Air_Release', 10, 3)->default(0);
                $table->float('Ba', 10, 3)->default(0);
                $table->float('PQ_Index', 10, 3)->default(0);

                $table->string('Status')->nullable();
                $table->text('Recomendation')->nullable();

                // $table->timestamps();
            });
        }

        return $model->setTable($tableName);
    }
}
