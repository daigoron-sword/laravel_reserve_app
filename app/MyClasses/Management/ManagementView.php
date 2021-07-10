<?php
namespace App\MyClasses\Management;

use App\Models\Reservation;
use App\Models\NumberOfUser;


class ManagementView
{
    function __construct()
    {

    }

    function render() //予約管理テーブルの出力
    {
        $html = [];
		$html[] = '<div class="table-responsive-lg">';
		$html[] = '<table class="table table-striped">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th scope="col" class="text-nowrap">予約日</th>';
		$html[] = '<th scope="col" class="text-nowrap">利用人数</th>';
		$html[] = '<th scope="col" class="text-nowrap">代表者名</th>';
		$html[] = '<th scope="col" class="text-nowrap">電話番号</th>';
		$html[] = '<th scope="col" class="text-nowrap">部屋</th>';
		$html[] = '<th scope="col" class="text-nowrap">プラン</th>';
		$html[] = '<th scope="col" class="text-nowrap">合計金額</th>';
		$html[] = '<th scope="col" class="text-nowrap">削除</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
        $html[] = '<tbody>';		

        $reservations = $this->getReservation();
        foreach($reservations as $reservation)
        {
            $html[] = '<tr>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $reservation->reserved_on; //予約日
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $this->getSumUsers($reservation); //利用人数
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $reservation->customer->name; //代表者名
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $reservation->customer->tel; //電話番号
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $this->editRoomA($reservation); //部屋
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $this->editPlanA($reservation); //プラン
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $reservation->sum; //合計金額
            $html[] = '</td>';
            $html[] = '<td class="text-nowrap">';
            $html[] = $this->deleteReserveA($reservation); //削除できるようにaタグを生成
            $html[] = '</td>';
            $html[] = '</tr>';
        }
        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';
        // 何も入れない文字列連結
        return implode("", $html);
    }
    /**
     * 合計人数の計算
     */
    protected function getSumUsers($reservation)
    {
        $number_of_users = NumberOfUser::where('reserve_id', $reservation->id)->get();
        foreach($number_of_users as $number_of_user)
        {
            $user[] = $number_of_user->number_of_person;
        }
        $sum = array_sum($user);
        return $sum;
    }
    /**
     * aタグ出力
     */
    protected function editRoomA($reservation)
    {
        return '<a href="'.route('editRoom', ['id' => $reservation->id]).' ">'.$reservation->room->name.'</a>';
    }

    protected function editPlanA($reservation)
    {
        return '<a href="'.route('editPlan', ['id' => $reservation->id]).' ">'.$reservation->mealPlan->name.'</a>';
    }

    protected function deleteReserveA($reservation)
    {
        return '<a class="btn btn-outline-danger btn-sm" href="'.route('deleteReserve', ['id' => $reservation->id]).' ">削除</a>';
    }
    /**
     * 今日以上の予約を抽出
     */
    public function getReservation()
    {
        $today = date('Y-m-d');
        return Reservation::with(['mealPlan', 'room'])->where('reserved_on', '>=', $today)->orderBy('reserved_on', 'asc')->Paginate(5);
    }

}