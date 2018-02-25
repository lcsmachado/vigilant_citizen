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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('provider')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('deleted')->default(0);
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->unique()->nullable();;
            $table->string('token')->nullable();;
            $table->text('credentials')->nullable();;
            $table->integer('admin_id_updated')->unsigned()->nullable();;
            $table->foreign('admin_id_updated')->references('id')->on('admins');
            $table->rememberToken()->nullable();;
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
