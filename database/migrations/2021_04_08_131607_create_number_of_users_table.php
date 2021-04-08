<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberOfUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_of_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserve_id')->unsigned()->unique();
            $table->integer('type_id')->unsigned();
            $table->foreign('reserve_id')->references('id')->on('reservations');
            $table->foreign('type_id')->references('id')->on('types');
            $table->integer('number_of_person');
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
        Schema::dropIfExists('number_of_users');
    }
}
