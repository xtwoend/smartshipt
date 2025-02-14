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
        Schema::table('fleets', function(Blueprint $table){
            // $table->double('swl', 10, 3)->default(0)->after('flag');
            // $table->double('draft', 10, 3)->default(0)->after('flag');
            // $table->double('lwt', 10, 3)->default(0)->after('flag');
            // $table->double('nrt', 10, 3)->default(0)->after('flag');
            // $table->double('grt', 10, 3)->default(0)->after('flag');
            // $table->double('dwt', 10, 3)->default(0)->after('flag');
            // $table->double('death', 10, 3)->default(0)->after('flag');
            // $table->double('breadth', 10, 3)->default(0)->after('flag');
            // $table->double('length', 10, 3)->default(0)->after('flag');
            // $table->string('mmsi', 255)->nullable()->after('flag');
            // $table->string('class', 255)->nullable()->after('flag');
            // $table->string('home_port', 255)->nullable()->after('flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fleets', function(Blueprint $table){
            // $table->dropColumn([
            //     'swl',
            //     'draft',
            //     'lwt',
            //     'nrt',
            //     'grt',
            //     'dwt',
            //     'death',
            //     'breadth',
            //     'length',
            //     'mmsi',
            //     'class',
            //     'home_port'
            // ]);
        });
    }
};
