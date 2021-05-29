<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;


/**
 * 試験
 */
use App\Models\NumberOfUser;
use App\Models\Reservation;



class ManagementController extends Controller
{
   public function reserve_management(Request $request)
   {
      /**
       * 試験
      */
      $reservation = Reservation::with(['mealPlan', 'room'])->find(3);

      $results = NumberOfUser::with('type')->where('reserve_id', 3)->get();
      foreach($results as $result)
      {
         //合計金額の計算
         if($result->type_id == 1 || $result->type_id == 2 || $result->type_id == 3) //もしtype_idが1,2,3なら
         {
            if($result->type_id == 1 || $result->type_id == 2 ) //もしtype_idが1,2なら
            {
               $sum[] = ($reservation->room->price + $reservation->mealPlan->price) * $result->number_of_person; //（部屋の値段＋食事プランの値段）×人数
            }
            //もしtype_idが３なら
            //（部屋の値段＋食事プランの値段）* 人数 - （typeのprice * 人数）
         
         } else{ //もしtype_idが1,2,3以外なら
         //人数 * typeの値段
         }
         
         
      }


      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }
}
