<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{   
    // どのテーブルか指定する
    protected $table = 'meals_plans';
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function select_meal_plan_list($date)
    {
        $meal_plans = MealPlan::where('start_period', '<=', $date)->where('end_period', '>=', $date)->get();
        $meal_plan_list = [];
        $meal_plan_list[""] = '選択してください';
        
        foreach ($meal_plans as $meal_plan) 
        {
            $meal_plan_list[$meal_plan->id] = $meal_plan->name;
        }
        return $meal_plan_list;
    }

    // 従テーブルのリレーション
    public function reservations()
    {
        return $this->hasmany('App\Models\Reservation');
    }

}
