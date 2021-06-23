<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 割り当てをさせないようにする
    protected $guarded = ['id'];

    public static function select_room_list($date)
    {
        // 予約予定日に予約されている部屋のidを取得
        $reservations = Reservation::where('reserved_on', $date)->get()->pluck('room_id')->toArray();
        
        $room_list = [];
        $room_list[''] = '選択してください';

        // 適用期間中の部屋を抽出
        $rooms = Room::where('start_period', '<=', $date)->where('end_period', '>=', $date)->get();
        foreach($rooms as $room)
        {
            if(!empty($reservations)) 
            {
                // 部屋のIDと配列の中身を照らし合わせて予約していない
                if(!in_array($room->id, $reservations))$room_list[$room->id] = $room->name;
            }else
            {
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
