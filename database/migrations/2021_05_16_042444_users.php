<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('activation_code')->unique();;
            $table->mediumInteger('balance')->nullable();
            $table->integer('xf_user_id')->nullable();
            $table->unsignedBigInteger('cs_group_id')->nullable(false);;
            $table->string('ban_reason')->nullable();
            $table->rememberToken();
            $table->timestamps();

//            $table->foreign('cs_group_id')->references('id')->on('cs_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cs_user');
    }
}
