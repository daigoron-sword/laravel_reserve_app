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
        return $this->belongsTo('App\Models\Customer');
    }
    public function mealPlan()
    {
        return $this->belongsTo('App\Models\MealPlan');
    }
    // 主テーブルのリレーション
    public function NumberOfUser()
    {
        return $this->hasmany('App\Models\NumberOfUser', 'reserve_id');
    }
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }


}
