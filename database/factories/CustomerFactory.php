<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    $gender = ['男','女'];

    return [
        'name' => $faker->name(),
        'hurigana' => 'てすと',
        'gender' => $faker->shuffle($gender),
        'mail' => $faker->email(),
        'dob' => $faker->date(),
        'postal' => $faker->postcode(),
        'prefectures' => '大阪',
        'city' => '大阪市浪速区1－1－1',
        'building' => 'ほにゃらら',
        'tel' => $faker->randomNumber(11),
        'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
