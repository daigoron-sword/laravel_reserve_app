<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'type' => 'adult',
            'price' => '0'
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => 'senior',
            'price' => '-1000'
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => 'child',
            'price' => '-2000'
        ];
        DB::table('types')->insert($param);
    }
}
