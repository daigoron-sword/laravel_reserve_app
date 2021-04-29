<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function select_room_list()
    {
        $rooms = Room::all();
        $room_list = [];
        $room_list[""] = "選択してください";
        foreach ($rooms as $room) 
        {
            $room_list[$room->name] = $room->name;
        }
        return $room_list;
    }
    // 主テーブルのリレーション
    public function reservations()
    {
        return $this->hasmany('App\Models\Reservation');
    }
}
