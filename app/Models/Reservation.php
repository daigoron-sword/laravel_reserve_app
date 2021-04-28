<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // 従テーブル側のリレーション
    public function customer()
    {
        return $this->belongsTo('App/Models/Csutomer');
    }
    public function type()
    {
        return $this->belongsTo('App/Models/Room');
    }
    public function mealplan()
    {
        return $this->belongsTo('App/Models/MealPlan');
    }
}
