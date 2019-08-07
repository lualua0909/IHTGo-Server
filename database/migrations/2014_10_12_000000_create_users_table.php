<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('phone', 20);
            $table->string('code', 80)->nullable()->unique();;
            $table->string('email')->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->tinyInteger('level')->default(3);
            $table->boolean('activated')->default(false);
            $table->boolean('baned')->default(false);
            $table->string('activated_phone', 7)->nullable();
            $table->string('device_token', 200)->nullable();
            $table->string('password');
            $table->date('birthday');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
