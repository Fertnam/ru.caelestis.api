<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsItemsBaskets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_items_baskets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cs_user_id')->nullable(false);
            $table->unsignedBigInteger('cs_server_id')->nullable(false);
            $table->unsignedBigInteger('cs_item_id')->nullable(false);
            $table->integer('count');
            $table->dateTime('purchase_time');
            $table->boolean('is_received');

//            $table->foreign('cs_user_id')->references('id')->on('cs_user');
//            $table->foreign('cs_server_id')->references('id')->on('cs_server');
//            $table->foreign('cs_item_id')->references('id')->on('cs_server');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_items_baskets');
    }
}
