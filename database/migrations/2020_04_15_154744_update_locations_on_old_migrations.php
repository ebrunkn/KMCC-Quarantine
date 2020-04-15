<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLocationsOnOldMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->tinyInteger('role_id')->unsigned()->after('password');
            $table->tinyInteger('emirate_id')->unsigned()->nullable()->after('role_id');
            $table->tinyInteger('state_id')->unsigned()->nullable()->after('emirate_id');
            $table->bigInteger('district_id')->unsigned()->nullable()->after('state_id');
            $table->bigInteger('constituency_id')->unsigned()->nullable()->after('district_id');
            
            $table->foreign('emirate_id')->references('id')->on('emirates')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('cascade');
        });
        
        Schema::table('buildings', function(Blueprint $table) {
            $table->tinyInteger('emirate_id')->unsigned()->after('building_name');

            $table->foreign('emirate_id')->references('id')->on('emirates')->onDelete('cascade');
        });

        Schema::table('requirements', function(Blueprint $table) {
            $table->tinyInteger('emirate_id')->unsigned()->after('user_id');

            $table->foreign('emirate_id')->references('id')->on('emirates')->onDelete('cascade');
        });

        Schema::table('warehouses', function(Blueprint $table) {
            $table->tinyInteger('emirate_id')->unsigned()->after('item_name');

            $table->foreign('emirate_id')->references('id')->on('emirates')->onDelete('cascade');
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['emirate_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['constituency_id']);
        });
        
        Schema::table('buildings', function(Blueprint $table) {
            $table->dropForeign(['emirate_id']);
        });
        
        Schema::table('requirements', function(Blueprint $table) {
            $table->dropForeign(['emirate_id']);
        });
        
        Schema::table('warehouses', function(Blueprint $table) {
            $table->dropForeign(['emirate_id']);
		});
    }
}
