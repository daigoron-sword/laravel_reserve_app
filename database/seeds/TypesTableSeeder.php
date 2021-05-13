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
            'type' => '男性',
            'description' => '基準料金（男性）',
            'bedding' => 'あり',
            'price' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '女性',
            'description' => '基準料金（女性）',
            'bedding' => 'あり',
            'price' => '0',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（6～12才）',
            'description' => '食事：大人に準ずる',
            'bedding' => 'あり',
            'price' => '-3300',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（6～12才）',
            'description' => '食事：子供用の食事',
            'bedding' => 'あり',
            'price' => '13750',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（6～12才）',
            'description' => '食事：なし',
            'bedding' => 'あり',
            'price' => '4400',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（3～5才）',
            'description' => '食事：子供用の食事',
            'bedding' => 'あり',
            'price' => '8250',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（3～5才）',
            'description' => '食事：子供用の食事',
            'bedding' => 'なし',
            'price' => '6050',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（3～5才）',
            'description' => '食事：なし',
            'bedding' => 'あり',
            'price' => '4400',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（3～5才）',
            'description' => '食事：なし',
            'bedding' => 'なし',
            'price' => '2200',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（3才未満）',
            'description' => '食事：なし',
            'bedding' => 'あり',
            'price' => '4400',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);

        $param = [
            'type' => '子供（3才未満）',
            'description' => '食事：なし',
            'bedding' => 'なし',
            'price' => '2200',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ];
        DB::table('types')->insert($param);
    }
}
