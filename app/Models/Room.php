<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function selectlist()
    {
        $rooms = Room::all();
        $list = array();
        $list += array("" => "選択してください");
        foreach ($rooms as $room) 
        {
            $list += array($room->name => $room->name);
        }
        return $list;
    }
}
