<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ExtraPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'normal_season',
            'price' => '0'
        ];
        DB::table('extra_prices')->insert($param);

        $param = [
            'name' => 'busy_season',
            'price' => '5000'
        ];
        DB::table('extra_prices')->insert($param);

        $param = [
            'name' => 'off_season',
            'price' => '-5000'
        ];
        DB::table('extra_prices')->insert($param);

        $param = [
            'name' => 'birthday',
            'price' => '-3000'
        ];
        DB::table('extra_prices')->insert($param);

    }
}
