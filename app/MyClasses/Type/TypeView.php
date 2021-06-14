<?php
namespace App\MyClasses\Type;

use Illuminate\Http\Request;
use App\Models\type;
use App\Models\MealPlan;
use App\Http\Requests\PlanTypeRequest;
// セッションファサード
use Session;


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
		$html[] = '<th>説明</th>';
		$html[] = '<th>寝具</th>';
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
			$html[] = $type->description;
			$html[] = '</td>';
			$html[] = '<td>';
			$html[] = $type->bedding;
			$html[] = '</td>';
			$html[] = '<td>';
			$html[] = '<select name="type_id['. $type->id .']" size="1">';
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

	function check_render(){
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
			$html[] = Session::get('type_id_'.$type->id.'');
			$html[] = '</td>';
			$html[] = '<td>';
			$html[] = '';
			$html[] = '</td>';
			$html[] = '</tr>';
		}
		
		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		// 何も入れない文字列連結
		return implode("", $html);
    }

	function sum_render($request) //金額テーブルの値を渡す
	{
		$room_dt = session()->get('room_dt');
        $meal_plan_dt = MealPlan::find($request->meal_plan_id);

        $types_dt = [];
        $total_sum = 0;
        // idを繰り返すためのfor文
        for($i = 1; $i <= 11; $i++)
        {
            $type_num = $request->type_id[$i];
            if($type_num >= 1)
            {
                $type_dt = Type::find($i);
                if($type_dt->id == 1 || $type_dt->id == 2 || $type_dt->id == 3) //男性、女性、大人の食事を用意する子供だけの計算
                {
                    $unit_price = $type_dt->price + $room_dt->price + $meal_plan_dt->price;
                    $sum = $unit_price * $request->type_id[$i];
                    $total_sum += $sum;
                    $types_dt[$i] = [ 
                        'type' => $type_dt->type,
                        'price' => $unit_price,
                        'number' => $type_num,
                        'sum' => $sum
                    ];
                } else{// 食事やお部屋に影響されないタイプの計算
                    $unit_price = $type_dt->price;
                    $sum = $unit_price * $request->type_id[$i];
                    $total_sum += $sum;
                    $types_dt[$i] = [ 
                        'type' => $type_dt->type,
                        'price' => $unit_price,
                        'number' => $type_num,
                        'sum' => $sum
                    ];
                }
            }
        }
		return ['types_dt' => $types_dt, 'total_sum' => $total_sum];
	}

}