<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->unique();
            $table->integer('room_id')->unsigned()->unique();
            $table->integer('meal_plan_id')->unsigned()->unique();
            $table->integer('extra_price_id')->unsigned()->unique();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('meal_plan_id')->references('id')->on('meals_plans');
            $table->foreign('extra_price_id')->references('id')->on('extra_prices');
            $table->date('reserved_on');
            $table->integer('number_of_stay');
            $table->string('transportation');
            $table->time('check_in_time');
            $table->text('request')->nullable();
            $table->time('dinner_start_time');
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
        Schema::dropIfExists('reservations');
    }
}
