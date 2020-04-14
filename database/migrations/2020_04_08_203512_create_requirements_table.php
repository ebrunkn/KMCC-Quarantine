<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('building_id')->unsigned()->nullable();
            $table->bigInteger('room_no')->unsigned()->nullable();
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('food_time_id')->unsigned()->nullable();
            $table->bigInteger('food_cuisine_id')->unsigned()->nullable();
            $table->bigInteger('warehouse_item_id')->unsigned()->nullable();
            $table->integer('requested_qty')->default(0);
            $table->integer('fulfilled_qty')->default(0);
            $table->boolean('status')->default(0);
            $table->text('info')->nullable();
            $table->boolean('visited')->default(0);
            $table->bigInteger('assigned_user')->unsigned()->nullable();
            $table->dateTime('assigned_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('request_types')->onDelete('cascade');
            $table->foreign('warehouse_item_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('food_time_id')->references('id')->on('food_times')->onDelete('cascade');
            $table->foreign('food_cuisine_id')->references('id')->on('food_cuisines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requirements', function(Blueprint $table) {
			$table->dropForeign(['user_id']);
			$table->dropForeign(['assigned_user']);
			$table->dropForeign(['building_id']);
			$table->dropForeign(['type_id']);
			$table->dropForeign(['food_time_id']);
			$table->dropForeign(['food_cuisine_id']);
			$table->dropForeign(['warehouse_item_id']);
		});
        Schema::dropIfExists('requirements');
    }
}
