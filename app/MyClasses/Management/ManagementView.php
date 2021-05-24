<?php
namespace App\Myclasses\Management;

class ManagementView
{
    function __construct()
    {

    }

    function render() //予約管理テーブルの出力
    {
        $html = [];
		$html[] = '<div class="management">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th scope="col">予約日</th>';
		$html[] = '<th scope="col">利用人数</th>';
		$html[] = '<th scope="col">代表者名</th>';
		$html[] = '<th scope="col">電話番号</th>';
		$html[] = '<th scope="col">部屋</th>';
		$html[] = '<th scope="col">合計金額</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
		
		$html[] = '<tbody　class="table table-striped">';
        $html[] = '<tr>';
        $html[] = '<td>';
        $html[] = ''; //予約日
        $html[] = '</td>';
        $html[] = '<td>';
        $html[] = ''; //利用人数
        $html[] = '</td>';
        $html[] = '<td>';
        $html[] = ''; //代表者名
        $html[] = '</td>';
        $html[] = '<td>';
        $html[] = ''; //電話番号
        $html[] = '</td>';
        $html[] = '<td>';
        $html[] = ''; //部屋
        $html[] = '</td>';
        $html[] = '<td>';
        $html[] = ''; //合計金額
        $html[] = '</td>';
        $html[] = '</tr>';
		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		// 何も入れない文字列連結
		return implode("", $html);
    }
}