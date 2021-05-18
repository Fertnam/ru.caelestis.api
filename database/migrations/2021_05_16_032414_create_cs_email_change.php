<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsEmailChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cs_email_change', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cs_user_id')->nullable(false);
            $table->string('email')->unique();
            $table->string('activation_code')->unique();
            $table->boolean('is_success');
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
        Schema::dropIfExists('cs_email_change');
    }
}
