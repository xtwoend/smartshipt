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
        Schema::create('cargo_information', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('fleet_id')->constrained();
            $table->unsignedBigInteger('fleet_id');
            $table->index(['fleet_id']);
            $table->integer('group')->nullable();
            $table->integer('total')->default(0);
            $table->string('grade')->nullable();
            $table->double('capacity', 10, 3)->default(0);
            $table->double('capacity_percentage', 10, 3)->default(0);
            $table->double('capacity_sg', 10, 3)->default(0);
            $table->double('max_capacity', 10, 3)->default(0);
            $table->double('max_capacity_percentage', 10, 3)->default(0);
            $table->double('max_capacity_sg', 10, 3)->default(0);
            $table->timestamps();
        });
//        Schema::table('cargo_information', function(Blueprint $table) {
//            $table->foreign('fleet_id')->references('id')->on('fleets');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo_information');
    }
};
