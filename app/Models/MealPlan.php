<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{   
    // どのテーブルか指定する
    protected $table = 'meals_plans';
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function selectlist()
    {
        $meals_plans = MealPlan::all();
        $list = array();
        $list += array("" => "選択してください");
        foreach ($meals_plans as $meal_plan) 
        {
            $list += array($meal_plan->name => $meal_plan->name);
        }
        return $list;
    }

}
