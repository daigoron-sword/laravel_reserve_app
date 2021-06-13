<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberOfUser extends Model
{
    // どのテーブルか指定する
    protected $table = 'number_of_users';

    // 割り当て可能カラム
    protected $fillable = ['reserve_id', 'type_id', 'number_of_person', 'created_at', 'updated_at'];

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
