<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_engines', function (Blueprint $table) {
            $table->id();
            $table->datetime('date')->nullable();
            $table->integer('propeller_speed')->default(0);
            $table->integer('rpm')->default(0);
            $table->float('me_ht_weater_cooling', 5, 2)->default(0);
            $table->float('me_lt_weater_cooling', 5, 2)->default(0);
            $table->float('me_sea_weater_cooling', 5, 2)->default(0);
            $table->float('me_load_engine', 5, 2)->default(0);
            $table->float('me_pressure_lo_inlet_turbocharge', 5, 2)->default(0);
            $table->float('me_temp_lo_inlet_turbocharge', 5, 2)->default(0);
            $table->float('me_pressure_lo_inlet_engine', 5, 2)->default(0);
            $table->float('me_temp_lo_inlet_engine', 5, 2)->default(0);
            $table->float('me_starting_air_inlet_engine', 5, 2)->default(0);
            $table->float('me_pressure_fo_inlet_engine', 5, 2)->default(0);
            $table->float('me_fo_engine_inlet_temp', 5, 2)->default(0);

            $table->float('tc_turbo_brower_speed', 5, 2)->default(0);
            $table->float('tc_brower_filter_pressure', 5, 2)->default(0);
            $table->float('tc_air_cooler_back_pressure', 5, 2)->default(0);
            $table->float('tc_scavenge_manifold_pressure', 5, 2)->default(0);
            $table->float('tc_exh_gas_pressure_aft', 5, 2)->default(0);

            $table->float('scaving_air_inlet_cooler', 5, 2)->default(0);
            $table->float('scaving_air_outlet_cooler', 5, 2)->default(0);
            $table->float('exh_gas_turbin_inlet', 5, 2)->default(0);
            $table->float('exh_gas_turbin_outlet', 5, 2)->default(0);

            $table->float('fo_specific_grafity', 5, 2)->default(0);
            $table->float('fo_viscosity_at_118', 5, 2)->default(0);

            $table->float('me_cyl1_', 5, 2)->default(0);
            $table->float('s1_fuel_pump', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_engines');
    }
};
