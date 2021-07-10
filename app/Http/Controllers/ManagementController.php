<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\Management\ManagementView;
use App\Myclasses\Management\SourceManagementView;
use App\Myclasses\Chart\SalesChartDay;
use App\Myclasses\Chart\SalesChartMonth;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Room;
use App\Models\MealPlan;
use App\Models\Type;
use App\Http\Requests\SourceRequest;


class ManagementController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }

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

   /**
    * 部屋とプランと利用タイプの管理画面
    */
   public function sourceManagemet(Request $request)
   {
      $source_management_dt = new SourceManagementView();
      return view('management.source.sourceManagemet',['source_management_dt' => $source_management_dt]);
   }

   /**
    * ソースの新規作成画面
    */
   public function createSource(Request $request)
   {
      if($request->branch == 'room')
      {
         $title_dt = [
            'name' => 'お部屋',
            'branch' => $request->branch,
         ];
      }
      elseif($request->branch == 'plan')
      {
         $title_dt = [
            'name' => 'プラン',
            'branch' => $request->branch,
         ];
      }
      return view('management.source.create', ['title_dt' => $title_dt]);
   }

   /**
    * ソースの新規作成処理
    */
   public function creatingSource(SourceRequest $request)
   {
      if($request->branch == 'room')
      {
         $model = new Room;
      }
      elseif($request->branch == 'plan')
      {
         $model = new MealPlan;
      }
      $form = $request->all();
      unset($form['_token'], $form['branch']);
      $model->fill($form)->save();
      return redirect()->route('sourceManagemet')->with('status', '新規作成できました。');      
   }

   /**
    * ソースの編集および削除画面
    */
   public function editSource(Request $request)
   {
      if($request->branch == 'room')
      {
         $source_dt = Room::find($request->id);
         $title_dt = [
            'name' => 'お部屋',
            'branch' => $request->branch,
         ];
      }
      elseif($request->branch == 'plan')
      {
         $source_dt = mealPlan::find($request->id);
         $title_dt = [
            'name' => 'プラン',
            'branch' => $request->branch,
         ];
      }
      if($request->separate == 'edit') return view('management.source.edit',['source_dt' => $source_dt, 'title_dt' => $title_dt]);
      if($request->separate == 'delete') return view('management.source.delete',['source_dt' => $source_dt, 'title_dt' => $title_dt]);
   }

   /**
    * 部屋ソース編集処理
    */
   public function finishSource(EditSourceRequest $request)
   {
      if($request->branch == 'room')
      {
         $source_dt = Room::find($request->id);

      }
      elseif($request->branch == 'plan')
      {
         $source_dt = mealPlan::find($request->id);
      }
      $source_dt->name = $request->name;
      $source_dt->price = $request->price;
      $source_dt->start_period = $request->start_period;
      $source_dt->end_period = $request->end_period;
      $source_dt->save();
      return redirect()->route('editSource', ['id' => $source_dt->id, 'separate' => 'edit', 'branch' => $request->branch])->with('status', '部屋ソースを編集しました。');
   }

   /**
    * 部屋ソース削除処理
    */
   public function removeSource(Request $request)
   {
      if($request->branch == 'room')
      {
         $room = Room::find($request->id)->delete();

      }
      elseif($request->branch == 'plan')
      {
         $source_dt = mealPlan::find($request->id)->delete();
      }
      return redirect()->route('sourceManagemet')->with('status', 'ソースを削除しました。');
   }


}
