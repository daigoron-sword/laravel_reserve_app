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
        $date = $this->carbon->copy()->format('Y-m-d'); //カレンダーの日付
        $date_encrypt = encrypt($date); // aタグ用に暗号化させる
        //適用期間中の部屋数をカウント
        $room_c = Room::where('start_period', '<=', $date)->where('end_period', '>=', $date)->count();

        $now = Carbon::now(); //現在
        if($this->carbon ->lt($now)) return '-'; //出力する日が現在よりも前なら

        $room = Room::orderBy('end_period', 'desc')->first();
        if($date > $room->end_period) return '-'; //一番最後の終了期間以降の日付の場合

        
        $reserved_on_c = Reservation::where('reserved_on', $date)->count();// その日の予約数
        $room_remaining = $room_c - $reserved_on_c; //残りの部屋数
        if($room_remaining == 0) return '満室';
        return '<a href="/reserve/rooms?date=' . $date_encrypt . ' ">残り' . $room_remaining . '部屋</a>' ;
    }
}	