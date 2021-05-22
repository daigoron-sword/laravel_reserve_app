<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function select_room_list($date)
    {
        $rooms = Room::all();
        $room_list = [];
        $room_list[""] = "選択してください";
        foreach ($rooms as $room) 
        {
            // $reservations = $room->reservations; //リレーションでreservationsのデータを取り出し
            // if($reservations['room_id'] != $room->id )
            {
                // バリュー属性にID、表示はroom_nameを表示
                $room_list[$room->id] = $room->name;
            }
        }
        return $room_list;
    }
    // 主テーブルのリレーション
    public function reservations()
    {
        return $this->hasmany('App\Models\Reservation');
    }
}
