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
            'start_period' => '20210601',
            'end_period' => '20221201',
            
        ];
        DB::table('rooms')->insert($param);

        $param = [
            'name' => 'room_b',
            'price' => '10000',
            'start_period' => '20210601',
            'end_period' => '20221201',
        ];
        DB::table('rooms')->insert($param);

        $param = [
            'name' => 'room_c',
            'price' => '15000',
            'start_period' => '20210601',
            'end_period' => '20221201',
        ];
        DB::table('rooms')->insert($param);

        $param = [
            'name' => 'room_d',
            'price' => '20000',
            'start_period' => '20210601',
            'end_period' => '20221201',
        ];
        DB::table('rooms')->insert($param);


    }
}
