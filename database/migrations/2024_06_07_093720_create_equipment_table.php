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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_id');
            $table->string('name')->nullable();
            $table->string('group')->nullable();
            $table->date('last_maintenance')->nullable();
            $table->date('schedule_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->tinyInteger('score')->default(0);
            $table->string('condition')->nullable();
            $table->float('degradation_factor', 6, 4)->default(0);
            $table->integer('lifetime_hours')->nullable();
            $table->integer('predicted_time_repair')->nullable();
            $table->integer('difference_lifetime')->nullable();
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
        Schema::dropIfExists('equipments');
    }
};
