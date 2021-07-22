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
        factory(App\Models\Reservation::class, 10000)
            ->create()
            ->each(function($reservation){
                $reservation->NumberOfUser()->create(factory(App\Models\NumberOfUser::class)->make(['reserve_id' => $reservation->id, 'type_id' => 1])->toArray());
            });
    }
}
