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
        Schema::create('equipment_sensors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('sensor_id');
            $table->string('mode')->nullable();
            $table->float('avg_value', 10, 2)->nullable();
            $table->integer('performance')->nullable();
            $table->integer('abnormal_count')->nullable();
            $table->float('total_value', 10, 2)->default(0);
            $table->integer('count_value')->default(0);
            $table->string('sensor_trigger')->nullable();
            $table->integer('sensor_trigger_value')->nullable();
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
        Schema::dropIfExists('equipment_sensors');
    }
};
