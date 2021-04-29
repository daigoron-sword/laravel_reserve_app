<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = 
    [
        'id',
    ];
    // 従テーブル側のリレーション
    public function customer()
    {
        return $this->belongsTo('App\Models\Csutomer');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Room');
    }
    public function mealPlan()
    {
        return $this->belongsTo('App\Models\MealPlan');
    }
    // 主テーブルのリレーション
    public function numberOfUsers()
    {
        return $this->hasmany('App\Models\NumberOfUser');
    }

}
