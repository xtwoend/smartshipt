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
        Schema::table('sensors', function(Blueprint $table){
            $table->string('condition')->nullable()->after('sensor_name');
            $table->float('value', 10, 3)->nullable()->after('condition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensors', function(Blueprint $table){
            $table->dropColumn('condition', 'value');
        });
    }
};
