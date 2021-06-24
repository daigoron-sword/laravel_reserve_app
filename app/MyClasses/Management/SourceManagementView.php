<?php
namespace App\MyClasses\Management;

use App\Models\Room;
use App\Models\MealPlan;
use App\Models\Type;

class SourceManagementView
{
    protected $rooms;
    protected $plans;
    protected $types;
    function __construct()
    {
        $this->rooms = Room::all();
        $this->plans = MealPlan::all();
        $this->types = Type::all();
    }

    /**
     * 部屋ソーステーブルの出力
     */
    function roomRender() 
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

        foreach($this->rooms as $room)
        {
            $html[] = '<tr>';
            $html[] = '<td>';
            $html[] = $room->name; //部屋名
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $room->price; //価格
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $room->start_period; //開始時期
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $room->end_period; //終了時期
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = '<a href="'.route('editRoomSource', ['id' => $room->id, 'separate' => 'edit']).' ">編集</a>/<a href="'.route('deleteRoomSource', ['id' => $room->id, 'separate' => 'delete']).' ">削除</a>'; //編集/削除のaタグ生成
            $html[] = '</td>';
            $html[] = '</tr>';
        }
        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }

    /**
     * プランソーステーブルの出力
     */
    function planRender()
    {
        $html = [];
		$html[] = '<div class="plan-source-management">';
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

        foreach($this->plans as $plan)
        {
            $html[] = '<tr>';
            $html[] = '<td>';
            $html[] = $plan->name; //プラン名
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $plan->price; //価格
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $plan->start_period; //開始時期
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $plan->end_period; //終了時期
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = '制作中'; //編集/削除のaタグ生成
            $html[] = '</td>';
            $html[] = '</tr>';
        }
        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }
}