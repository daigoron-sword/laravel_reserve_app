<?php
namespace App\Myclasses\Management;

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
		$html[] = '<div class="management">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th scope="col">予約日</th>';
		$html[] = '<th scope="col">利用人数</th>';
		$html[] = '<th scope="col">代表者名</th>';
		$html[] = '<th scope="col">電話番号</th>';
		$html[] = '<th scope="col">部屋</th>';
		$html[] = '<th scope="col">プラン</th>';
		$html[] = '<th scope="col">合計金額</th>';
		$html[] = '<th scope="col">削除</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
        $html[] = '<tbody　class="table table-striped">';		

        $reservations = Reservation::with(['mealPlan', 'room'])->get();
        foreach($reservations as $reservation)
        {
            $html[] = '<tr>';
            $html[] = '<td>';
            $html[] = $reservation->reserved_on; //予約日
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $this->getSumUsers($reservation); //利用人数
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $reservation->customer->name; //代表者名
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $reservation->customer->tel; //電話番号
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $this->editRoomA($reservation); //部屋
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $this->editPlanA($reservation); //プラン
            $html[] = '</td>';
            $html[] = '<td>';
            $html[] = $this->getSumPrice($reservation); //合計金額
            $html[] = '</td>';
            $html[] = '<td>';
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
     * 合計金額の計算
     */
    protected function getSumPrice($reservation)
    {
        $number_of_users = NumberOfUser::with('type')->where('reserve_id', $reservation->id)->get();
        foreach($number_of_users as $number_of_user)
        {
           //合計金額の計算
           if($number_of_user->type_id == 1 || $number_of_user->type_id == 2 || $number_of_user->type_id == 3) //もしtype_idが1,2,3なら
            {
                if($number_of_user->type_id == 1 || $number_of_user->type_id == 2 ) //もしtype_idが1,2なら
                {
                    $price[] = ($reservation->room->price + $reservation->mealPlan->price) * $number_of_user->number_of_person; //（部屋の値段＋食事プランの値段）×人数
                }
                if($number_of_user->type_id == 3)//もしtype_idが３なら
                {
                    $price[] = ($reservation->room->price + $reservation->mealPlan->price) * $number_of_user->numeber_of_person - ($number_of_user->type->price * $number_of_user->number_of_person); //（部屋の値段＋食事プランの値段）* 人数 - （typeのprice * 人数）
                }
            
            } else //もしtype_idが1,2,3以外なら
            {
                $price[] = $number_of_user->type->price * $number_of_user->number_of_person; //人数 * typeの値段
            }
        }
        $sum = array_sum($price);// 配列の中の数値を合計
        return $sum . '円';
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
        return '<a href="'.route('deleteReserve', ['id' => $reservation->id]).' ">削除</a>';
    }

}