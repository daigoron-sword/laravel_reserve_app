<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Customer::class, function (Faker $faker) {

    return [
        'name' => $faker->name(),
        'hurigana' => 'てすと',
        'gender' => '男',
        'mail' => $faker->email(),
        'dob' => $faker->date(),
        'postal' => $faker->postcode(),
        'prefectures' => '大阪',
        'city' => '大阪市浪速区1－1－1',
        'building' => 'ほにゃらら',
        'tel' => $faker->phoneNumber,
        'created_at' => $faker->date('Y-m-d H:i:s', 'now'),
        'updated_at' => $faker->date('Y-m-d H:i:s', 'now'),
    ];
});
