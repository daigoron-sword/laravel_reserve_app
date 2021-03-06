<?php
namespace App\MyClasses\Calendar;

use Carbon\Carbon;

class CalendarView
{
    private $carbon;
	// クラスが生成されたときにtime関数を使って引数を＄dateに渡す
	function __construct($date){
		// 現在の日付をもとにカーボンを作成
		$this->carbon = new Carbon($date);
	}
	/**
	 * タイトル
	 */
	// 現在の年月を表示させる
	public function getTitle(){
		return $this->carbon->format('Y年n月');
	}

	/**
	 * 次の月
	 */
	public function getNextMonth(){
		return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
	}
	/**
	 * 前の月
	 */
	public function getPreviousMonth(){
		return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
	}



	/**
	 * カレンダーを出力する
	 */
	function render(){
		$html = [];
		$html[] = '<div class="calendar table-responsive-lg">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th scope="col" class="text-nowrap">月</th>';
		$html[] = '<th scope="col" class="text-nowrap">火</th>';
		$html[] = '<th scope="col" class="text-nowrap">水</th>';
		$html[] = '<th scope="col" class="text-nowrap">木</th>';
		$html[] = '<th scope="col" class="text-nowrap">金</th>';
		$html[] = '<th scope="col" class="text-nowrap">土</th>';
        $html[] = '<th scope="col" class="text-nowrap">日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
		
		$html[] = '<tbody>';
		
		$weeks = $this->getWeeks();
		foreach($weeks as $week){
			$html[] = '<tr class="'.$week->getClassName().'">';
			$days = $week->getDays();
			foreach($days as $day){
				$html[] = '<td class="'.$day->getClassName().' text-nowrap">';
				$html[] = $day->render();
				$html[] = $day->reservedOn();
				$html[] = '</td>';
				$date = '';
			}	
			$html[] = '</tr>';
		}
		
		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
    }
    
    protected function getWeeks(){
		$weeks = [];

		//初日
		$firstDay = $this->carbon->copy()->firstOfMonth();

		//月末まで
		$lastDay = $this->carbon->copy()->lastOfMonth();

		//1週目
		$week = new CalendarWeek($firstDay->copy());
		$weeks[] = $week;

		//作業用の日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			//週カレンダーViewを作成する
			$week = new CalendarWeek($tmpDay, count($weeks));
			$weeks[] = $week;
			
            //次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;
	}
}