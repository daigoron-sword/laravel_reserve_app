<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    // typeカラムを引き出すメソッド
    public static function type_lists()
    {
        $types = Type::all();
        $type_lists = [];
        foreach ($types as $type) 
        {
            $type_lists[] = $type->type;
        }
        return $type_lists;
    }
}
