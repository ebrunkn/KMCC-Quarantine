<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('nationality')->default('India');
            $table->string('mobile');
            $table->text('address')->nullable();
            $table->tinyInteger('residence_type')->default(0);
            $table->string('contact_time')->nullable();
            $table->string('follow_up_status')->nullable();
            $table->tinyInteger('covid_tested')->nullable()->default(0);
            $table->tinyInteger('emirate');
            $table->text('remarks')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_logs');
    }
}
