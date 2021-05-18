<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsCabinetLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_cabinet_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cs_user_id')->nullable(false);
            $table->unsignedBigInteger('cs_server_id')->nullable(false);
            $table->unsignedBigInteger('cs_server_status_id')->nullable(false);
            $table->dateTime('purchase_time');
            $table->dateTime('end_action_time');

//            $table->foreign('cs_user_id')->references('id')->on('cs_user');
//            $table->foreign('cs_server_status_id')->references('id')->on('cs_server_status');
//            $table->foreign('cs_server_id')->references('id')->on('cs_server');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_cabinet_logs');
    }
}
