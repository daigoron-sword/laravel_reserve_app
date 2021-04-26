<?php
namespace App\Myclasses\Type;

use App\Models\type;
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
			$html[] = Session::get($type->type);
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

}