<?php
namespace App\MyClasses\Management;

use App\Models\Room;
use App\Models\MealPlan;
use App\Models\Reservation;

class SourceManagementView
{
    protected $rooms;
    protected $plans;
    function __construct()
    {
        $this->rooms = Room::all();
        $this->plans = MealPlan::all();
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
        $html[] = '<th scope="col">開始時期</th>';
		$html[] = '<th scope="col">終了時期</th>';
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
            $html[] = $this->operableOrInoperable($room->id);
            $html[] = '</td>';
            $html[] = '</tr>';
        }
        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }

    /**
     * 適用中は操作負荷、適用がなければ操作可能なaタグ
     */
    function operableOrInoperable($room_id)
    {
        $today = date('Y-m-d', time());
        // 現在よりも後の予約日かつ、roomのidが適用されている予約が存在するか
        $rooms = Reservation::where('reserved_on', '>=', $today)->where('room_id', $room_id)->exists();
        if($rooms)
        {
            // 適用中の予約があれば操作負荷
            return '予約適用中の為、操作不可';
        }else
        {
            // 適用中の予約がなければリンク生成
            return '<a href="'.route('editRoomSource', ['id' => $room_id, 'separate' => 'edit']).' ">編集</a>/<a href="'.route('deleteRoomSource', ['id' => $room_id, 'separate' => 'delete']).' ">削除</a>';
        }
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