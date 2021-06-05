<?php
namespace App\Myclasses\Calendar;
use Carbon\Carbon;
use App\Models\Room;


class CalendarWeekDay {
	protected $carbon;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}

	function getClassName(){
		return "day-" . strtolower($this->carbon->format("D"));
	}

	/**
	 * @return 
	 */
	function render(){
		return '<p class="day">' . $this->carbon->format("j"). '</p>';
    }
    
	function ReservedOn() //残りの部屋数を出力
    {
		$day_r = $this->carbon->format('Y-m-d'); //カレンダーの日にちの出力
        $day_r_encrypt = encrypt($day_r); // aタグ用に暗号化させる
        $day = $this->carbon; //カレンダー日付
        $now = Carbon::now(); //現在
        if($day ->lt($now)) //出力する日が現在よりも前なら
        {
            return '-';
        }
        // $nowt = $now->getTimestamp();
		$room_dts = Room::all();
        $room_c = count($room_dts); //全ての部屋数
		
        foreach($room_dts as $room_dt) //部屋データの繰り返し
        {
			$reservations = $room_dt->reservations; //リレーションでreservationsのデータを取り出し
            foreach($reservations as $reservation)
            {
				$dates[] = $reservation['reserved_on'];//全ての予約日を取得
            }    
        }
        if(isset($dates)) //予約テーブルに一つもデータがない場合の対処
        {
            $date_c = array_count_values($dates); //それぞれの予約日をキーに、日にちのカウントを値にする
            if(array_key_exists($day_r, $date_c))  //指定した日にちが、$date_cのキーに存在していたら
            {
                if($date_c[$day_r] == $room_c) //予約日の数と全部屋数が一緒なら
                {
                    return '満室';
                } else
                {
                    $sum = $room_c - $date_c[$day_r];
                    return '<a href="/reserve/rooms?date=' . $day_r_encrypt . ' ">残り' . $sum . '部屋</a>' ; //残りの部屋数を出力
                }
            }else //存在していなければ
            {
                // return '残り'.$room_c.'部屋'; //全ての部屋数を出力
                return '<a href="/reserve/rooms?date=' . $day_r_encrypt . ' ">残り' . $room_c . '部屋</a>' ;//全ての部屋数を出力
            }
        }else //存在していなければ
        {
            // return '残り'.$room_c.'部屋'; //全ての部屋数を出力
            return '<a href="/reserve/rooms?date=' . $day_r_encrypt . ' ">残り' . $room_c . '部屋</a>' ;//全ての部屋数を出力
        }
    }
}	