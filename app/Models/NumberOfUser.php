<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberOfUser extends Model
{
    // どのテーブルか指定する
    protected $table = 'number_of_users';

    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    protected $primaryKey = ['reserve_id', 'type_id'];

    public $incrementing  = false;

    // 従テーブル側のリレーション
    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }


}
