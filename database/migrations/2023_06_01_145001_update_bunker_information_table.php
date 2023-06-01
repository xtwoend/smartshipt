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
        Schema::table('bunker_information', function(Blueprint $table){
            $table->double('tank_capacity_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('tank_capacity_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('tank_capacity_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('deballasting_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('deballasting_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('deballasting_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('ballasting_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('ballasting_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('ballasting_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('heating_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('heating_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('heating_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('cleaning_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('cleaning_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('cleaning_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('manovering_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('manovering_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('manovering_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('idle_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('idle_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('idle_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('loading_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('loading_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('loading_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('discharge_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('discharge_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('discharge_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_ballast_day',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_ballast_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_ballast_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_ballast_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_laden_day',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_laden_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_laden_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('sea_laden_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_ballast_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_ballast_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_ballast_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_ballast',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_laden_hsd',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_laden_mdo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_laden_mfo',10, 3)->default(0)->nullable()->after('transport_loss');
            $table->double('max_speed_laden',10, 3)->default(0)->nullable()->after('transport_loss');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bunker_information', function(Blueprint $table){
            $table->dropColumn([
                'max_speed_laden',
                'max_speed_laden_mfo',
                'max_speed_laden_mdo',
                'max_speed_laden_hsd',
                'max_speed_ballast',
                'max_speed_ballast_mfo',
                'max_speed_ballast_mdo',
                'max_speed_ballast_hsd',
                'sea_laden_mfo',
                'sea_laden_mdo',
                'sea_laden_hsd',
                'sea_laden_day',
                'sea_ballast_mfo',
                'sea_ballast_mdo',
                'sea_ballast_hsd',
                'sea_ballast_day',
                'discharge_mfo',
                'discharge_mdo',
                'discharge_hsd',
                'loading_mfo',
                'loading_mdo',
                'loading_hsd',
                'idle_mfo',
                'idle_mdo',
                'idle_hsd',
                'manovering_mfo',
                'manovering_mdo',
                'manovering_hsd',
                'cleaning_mfo',
                'cleaning_mdo',
                'cleaning_hsd',
                'heating_mfo',
                'heating_mdo',
                'heating_hsd',
                'ballasting_mfo',
                'ballasting_mdo',
                'ballasting_hsd',
                'deballasting_mfo',
                'deballasting_mdo',
                'deballasting_hsd',
                'tank_capacity_mfo',
                'tank_capacity_mdo',
                'tank_capacity_hsd',
            ]);
        });
    }
};
