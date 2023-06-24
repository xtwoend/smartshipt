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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_id');
            $table->string('group');
            $table->string('name');
            $table->string('sensor_name');
            $table->string('unit')->nullable();
            $table->float('min', 15, 5)->default(0);
            $table->float('max', 15, 5)->default(0);
            $table->float('normal', 15, 5)->default(0);
            $table->float('danger', 15, 5)->default(0);
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
        Schema::dropIfExists('sensors');
    }
};
