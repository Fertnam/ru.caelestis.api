<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_article', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cs_user_id')->nullable(false);
            $table->string('title');
            $table->text('content');
            $table->text('image');
            $table->timestamps();

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
        Schema::dropIfExists('cs_articles');
    }
}
