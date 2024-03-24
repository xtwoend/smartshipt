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
        Schema::create('sensor_docs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_id')->index();
            $table->string('sensor_name')->index();
            $table->text('low_desc')->nullable();
            $table->text('high_desc')->nullable();
            $table->string('image')->nullable();
            $table->string('diagram')->nullable();
            $table->timestamps();

            $table->unique(['fleet_id', 'sensor_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_docs');
    }
};
