<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(App\Models\NumberOfUser::class, function (Faker $faker) {
    $reserve_id = App\Models\Reservation::all()->pluck('id');
    $type_id = App\Models\Type::all()->pluck('id');
    // $matrix = Arr::crossJoin($reserve_id, $type_id);
    $matrix = $reserve_id->crossJoin($type_id);
    $keypair = $faker->unique()->randomElement($matrix);
    return [
        'reserve_id' => $keypair[0],
        'type_id'=> $keypair[1],
        'number_of_person' => $faker->numberBetween(1,2),
        'created_at' => $faker->date('Y-m-d H:i:s', 'now'),
        'updated_at' => $faker->date('Y-m-d H:i:s', 'now'),
    ];
});