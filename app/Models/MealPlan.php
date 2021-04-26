<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{   
    // どのテーブルか指定する
    protected $table = 'meals_plans';
    // 割り当てをさせないようにする
    protected $guarded = ['id'];
    // format()を使うために$datesに代入
    protected $dates = ['start_period', 'end_period'];

    public static function select_meal_plan_list($date)
    {
        $meals_plans = MealPlan::all();
        // $dateをフォーマット
        $date_f = date('Ymd',  strtotime($date));
        $meal_plan_list = [];
        $meal_plan_list[""] = '選択してください';
        // 食事プランをあるだけ繰り返し
        foreach ($meals_plans as $meal_plan) 
        {
            // プラン開始日
            $start_period = $meal_plan->start_period->format('Ymd');
            // プラン終了日
            $end_period = $meal_plan->end_period->format('Ymd');
            // 開始日以上終了日以下の場合
            if ($date_f >= $start_period and $date_f <= $end_period) 
            {
                // プランを表示する
                $meal_plan_list[$meal_plan->name] = $meal_plan->name;
            }
        }
        return $meal_plan_list;
    }

}
