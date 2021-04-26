<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'room_a',
            'price' => '5000',
            'capacity' => '2'
        ];
        DB::table('rooms')->insert($param);

        $param = [
            'name' => 'room_b',
            'price' => '10000',
            'capacity' => '2'
        ];
        DB::table('rooms')->insert($param);

        $param = [
            'name' => 'room_c',
            'price' => '15000',
            'capacity' => '3'
        ];
        DB::table('rooms')->insert($param);

        $param = [
            'name' => 'room_d',
            'price' => '20000',
            'capacity' => '4'
        ];
        DB::table('rooms')->insert($param);


    }
}
