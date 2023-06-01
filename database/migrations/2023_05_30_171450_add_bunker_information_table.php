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
        Schema::create('bunker_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_id');
            $table->index('fleet_id');
            $table->double('speed_service', 10, 3)->default(0);
            $table->double('pumping_rate', 10, 3)->default(0);
            $table->double('presure_discharge', 10, 3)->default(0);
            $table->double('loading_rate', 10, 3)->default(0);
            $table->double('commision_days', 10, 3)->default(0);
            $table->double('transport_loss', 10, 3)->default(0);
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
        Schema::dropIfExists('bunker_information');
    }
};
