<?php
namespace App\MyClasses\Management;

class SourceManagementView
{
    function __construct()
    {

    }

    function roomRender() //部屋ソーステーブルの出力
    {
        $html = [];
		$html[] = '<div class="room-source-management">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th scope="col">部屋名</th>';
		$html[] = '<th scope="col">価格</th>';
		$html[] = '<th scope="col">編集/削除</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
        $html[] = '<tbody　class="table table-striped">';		

        $reservations = $this->getReservation();
        foreach($reservations as $reservation)
        {
            $html[] = '<tr>';
            $html[] = '<td>';
            $html[] = ''; //部屋名
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = ''; //価格
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $reservation->customer->name; //編集/削除のaタグ生成
            $html[] = '</td>';
            $html[] = '</tr>';
        }
        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }

    function planRender() //プランソーステーブルの出力
    {
        $html = [];
		$html[] = '<div class="paran-source-management">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th scope="col">プラン名</th>';
		$html[] = '<th scope="col">価格</th>';
		$html[] = '<th scope="col">開始時期</th>';
		$html[] = '<th scope="col">終了時期</th>';
		$html[] = '<th scope="col">編集/削除</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
        $html[] = '<tbody　class="table table-striped">';		

        $reservations = $this->getReservation();
        foreach($reservations as $reservation)
        {
            $html[] = '<tr>';
            $html[] = '<td>';
            $html[] = ''; //プラン名
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = ''; //価格
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = ''; //開始時期
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = ''; //終了時期
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = ''; //編集/削除のaタグ生成
            $html[] = '</td>';
            $html[] = '</tr>';
        }
        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }

}