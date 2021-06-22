<?php
namespace App\MyClasses\Calendar;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Reservation;


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
    
	function reservedOn() //残りの部屋数を出力
    {
        $date = $this->carbon->copy()->format('Y-m-d'); //カレンダーの日付の出力
        $date_encrypt = encrypt($date); // aタグ用に暗号化させる
        $now = Carbon::now(); //現在
        if($this->carbon ->lt($now)) //出力する日が現在よりも前なら
        {
            return '-';
        }
        $room_dts = Room::all();
        $room_c = 0; //適用期間中の部屋カウント変数
        $str_date = strtotime($date);
        
        foreach($room_dts as $room_dt) //部屋データの繰り返し
        {
            // 部屋の開始日
            $start_period = new Carbon($room_dt->start_period);
            // 部屋の終了日
            $end_period = new Carbon($room_dt->end_period);
            // 開始日以上終了日以下の場合
            if (Carbon::parse($date)->between($start_period, $end_period)) 
            {
                    // 部屋をカウントする
                    $room_c++;
            }
        }
        
        $reserved_on_c = Reservation::where('reserved_on', $date)->count();// その日の予約数
        $room_remaining = $room_c - $reserved_on_c; //残りの部屋数
        if($room_remaining == 0) return '満室';
        return '<a href="/reserve/rooms?date=' . $date_encrypt . ' ">残り' . $room_remaining . '部屋</a>' ;
    }
}	