<?php
namespace App\Myclasses\Type;

use App\Models\type;


class TypeView
{
	private $types;
	function __construct(){
		// インスタンスの生成と同時にモデルを呼び出す
		$this->types = Type::all();
	}
	function render(){
		$html = [];
		$html[] = '<div class="types">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th>タイプ</th>';
		$html[] = '<th>人数</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
		
		$html[] = '<tbody>';
		
		foreach($this->types as $type){
			$html[] = '<tr>';
			$html[] = '<td>';
			$html[] = $type->type;
			$html[] = '</td>';
			$html[] = '<td>';
			$html[] = '<select name="'. $type->type .'" size="1">';
			$html[] = '<option value"0">0</option>';
			$html[] = '<option value"1">1</option>';
			$html[] = '<option value"2">2</option>';
			$html[] = '<option value"3">3</option>';
			$html[] = '<option value"4">4</option>';
			$html[] = '</select>';
			$html[] = '</td>';
			$html[] = '</tr>';
		}
		
		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		// 何も入れない文字列連結
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