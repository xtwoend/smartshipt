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
        Schema::create('group_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_id');
            $table->string('group')->nullable();
            $table->string('class_handler')->nullable();
            $table->string('table_name')->nullable();
            $table->timestamps();

            $table->unique(['fleet_id', 'group']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_data');
    }
};
