<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Reservation::class, function (Faker $faker) {
    return [
        'customer_id' => factory(App\Models\Customer::class)->create(),
        'room_id' => $faker->numberBetween(1,4),
        'meal_plan_id' => $faker->numberBetween(1,4),
        'reserved_on' => $faker->dateTimeBetween('-6 months', 'now', date_default_timezone_get()),
        'transportation' => '車',
        'check_in_time' => '16:00:00',
        'request' => $faker->realText(50, 2),
        'dinner_start_time' => '17:00:00',
        'sum' => $faker->numberBetween(20000, 50000),
        'created_at' => $faker->date('Y-m-d H:i:s', 'now'),
        'updated_at' => $faker->date('Y-m-d H:i:s', 'now'),
    ];
});
