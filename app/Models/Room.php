<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function select_room_list($date)
    {
        $reservation_dts = Reservation::where('reserved_on', $date)->get();//予約予定日の予約データを全権取得
        $i = 1;
        foreach($reservation_dts as $reservation_dt)
        {
                $room_id[$i] = $reservation_dt->room_id;// 各予約日のroom_idを連想配列で取得
                $i++;
        }
        $rooms = Room::all();
        $room_list = [];
        $room_list[""] = "選択してください";
        foreach ($rooms as $room) 
        {
            if(isset($room_id))
            {
                if (!array_search($room->id, $room_id)){ //各部屋に対して予約がされてなければ
                    // バリュー属性にID、表示はroom_nameを表示
                    $room_list[$room->id] = $room->name;
                }
            }else{// 予約がいっさいなければ全権表示
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
