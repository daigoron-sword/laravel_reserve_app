<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(App\Models\NumberOfUser::class, function (Faker $faker) {
    return [
        'number_of_person' => $faker->numberBetween(1,2),
        'created_at' => $faker->date('Y-m-d H:i:s', 'now'),
        'updated_at' => $faker->date('Y-m-d H:i:s', 'now'),
    ];
});