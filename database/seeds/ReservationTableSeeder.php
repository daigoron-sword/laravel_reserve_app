<?php

use Illuminate\Database\Seeder;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Reservation::class, 5)
            ->create()
            ->each(function($reservation){
                $reservation->NumberOfUser()->createMany(factory(App\Models\NumberOfUser::class, 2)->make()->toArray());
                // $number_of_users = factory(App\Models\NumberOfUser::class, 2)->make();
                // $reservation->NumberOfUser()->saveMany($number_of_users);
            });
    }
}
