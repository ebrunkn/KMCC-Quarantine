<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('qty')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_stocks', function(Blueprint $table) {
			$table->dropForeign(['item_id']);
		});
        Schema::dropIfExists('warehouse_stocks');
    }
}
