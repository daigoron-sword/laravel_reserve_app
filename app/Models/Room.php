<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function select_room_list($date)
    {
        $reservation_dts = Reservation::where(function ($query) use ($date) {
            $query->where('reserved_on', $date);
        })->get();
        // return dump($reservation_dts);
        $i = 1;
        foreach($reservation_dts as $reservation_dt)
        {
            $room_id[$i] = $reservation_dt->room_id;
            $i++;
        }

        $rooms = Room::all();
        $room_list = [];
        $room_list[""] = "選択してください";
        foreach ($rooms as $room) 
        {
            if (!array_search($room->id, $room_id)){
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
