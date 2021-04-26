<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MealsPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'plan_a',
            'price' => '5000',
            'start_period' => '20210401',
            'end_period' => '20211231',
        ];
        DB::table('meals_plans')->insert($param);

        $param = [
            'name' => 'plan_b',
            'price' => '10000',
            'start_period' => '20210401',
            'end_period' => '20211231',
        ];
        DB::table('meals_plans')->insert($param);

        $param = [
            'name' => 'plan_c',
            'price' => '15000',
            'start_period' => '20210601',
            'end_period' => '20211231',
        ];
        DB::table('meals_plans')->insert($param);

        $param = [
            'name' => 'plan_d',
            'price' => '20000',
            'start_period' => '20210601',
            'end_period' => '20211231',
        ];
        DB::table('meals_plans')->insert($param);

    }
}
