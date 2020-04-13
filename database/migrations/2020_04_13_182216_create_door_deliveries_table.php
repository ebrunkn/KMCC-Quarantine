<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoorDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('request_id')->unsigned();
            $table->bigInteger('warehouse_item_id')->unsigned()->nullable();
            $table->bigInteger('building_id')->unsigned()->nullable();
            $table->integer('room_no')->unsigned()->nullable();
            $table->tinyInteger('quantity')->unsigned()->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('requirements')->onDelete('cascade');
            $table->foreign('warehouse_item_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('door_deliveries', function(Blueprint $table) {
			$table->dropForeign(['user_id']);
			$table->dropForeign(['request_id']);
			$table->dropForeign(['warehouse_item_id']);
			$table->dropForeign(['building_id']);
		});
        Schema::dropIfExists('door_deliveries');
    }
}
