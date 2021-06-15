<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;
use App\Myclasses\Chart\SalesChartDay;
use App\Myclasses\Chart\SalesChartMonth;
use App\Models\Reservation;
use App\Models\Customer;


class ManagementController extends Controller
{
   /**
    * 予約管理画面
    */
   public function reserveManagement(Request $request)
   {
      $management = new ManagementView();
      return view('management.index', ['management' => $management]);
   }
   /**
    * 部屋変更
    */
   public function editRoom(Request $request)
   {
      $reservation = Reservation::find($request->id);
      return view('management.editRoom', ['reservation' => $reservation]);
   }
   /**
    * 部屋変更処理
    */
   public function finishRoom(Request $request)
   {
      $validate_rule =['room_id' => 'required']; //；部屋選択のバリデーションルール
      $this->validate($request, $validate_rule);
      $reservation = Reservation::find($request->id);
      $reservation->room_id = $request->room_id;
      $reservation->save();
      $id = $reservation->id;
      return redirect()->route('editRoom', ['id' => $id])->with('status', 'お部屋を変更しました！');
   }
   /**
    * プラン変更
    */
   public function editPlan(Request $request)
   {
      $reservation = Reservation::find($request->id);
      return view('management.editPlan', ['reservation' => $reservation]);
   }
   /**
    * プラン変更処理
    */
   public function finishPlan(Request $request)
   {
      $validate_rule =['meal_plan_id' => 'required']; //；部屋選択のバリデーションルール
      $this->validate($request, $validate_rule);
      $reservation = Reservation::find($request->id);
      $reservation->meal_plan_id = $request->meal_plan_id;
      $reservation->save();
      $id = $reservation->id;
      return redirect()->route('editPlan', ['id' => $id])->with('status', 'お部屋を変更しました！');
   }
   /**
    * 予約消去画面
    */
   public function deleteReserve(Request $request)
   {
      $reservation = Reservation::with('customer')->find($request->id);
      return view('management.deleteReserve', ['reservation' => $reservation]);
   }
   /**
    * 予約消去処理
    */
   public function removeReserve(Request $request)
   {
      $reservation = Reservation::with('customer')->find($request->id);
      Customer::find($reservation->customer->id)->delete();
      return redirect()->route('management')->with('status', '予約を削除しました。');
   }
   /**
    * 売上チャート表示
    */
   public function salesChart(Request $request)
   {
      $date = $request->input('date');

      if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
         $date = strtotime($date . "-01");
      }else{
         $date = null;
      }
      // 取得できないときは現在のｎ1日を指定
      if(!$date)$date = date('Y-m-01');

      /**
       * 月別及び日別クラスの取得
       */
      $graph = $request->input('graph');
      // return dump($graph)
      if($graph == 'day')
      {
         $sales_chart = new SalesChartDay($date);
      }elseif($graph == 'month')
      {
         $sales_chart = new SalesChartMonth($date);
      }else
      {
         $graph = null;
      }
      if(!$graph)$sales_chart = new SalesChartMonth($date);

      return view('management.salesChart', ['sales_chart' =>  $sales_chart]);
   }



}
