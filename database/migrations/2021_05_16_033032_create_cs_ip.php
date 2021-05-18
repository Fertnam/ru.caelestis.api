<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsIp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_ip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cs_user_id')->nullable(false);
            $table->string('ip');

//            $table->foreign('cs_user_id')->references('id')->on('cs_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_ip');
    }
}
