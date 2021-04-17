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
            'price' => '5000'
        ];
        DB::table('meals_plans')->insert($param);

        $param = [
            'name' => 'plan_b',
            'price' => '10000'
        ];
        DB::table('meals_plans')->insert($param);

        $param = [
            'name' => 'plan_c',
            'price' => '15000'
        ];
        DB::table('meals_plans')->insert($param);

        $param = [
            'name' => 'plan_d',
            'price' => '20000'
        ];
        DB::table('meals_plans')->insert($param);

    }
}
