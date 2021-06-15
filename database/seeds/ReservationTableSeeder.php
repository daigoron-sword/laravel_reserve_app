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
        factory(App\Models\Reservation::class, 10)
            ->create()
            ->each(function($reservation){
                $reservation->NumberOfUser()->createMany(factory(App\Models\NumberOfUser::class, 2)->make()->toArray());
            });
    }
}
