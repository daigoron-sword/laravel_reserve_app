<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\MyServiceInterface;
use App\Myclasses\Calendar\CalendarView;
use App\Myclasses\Type\TypeView;
use App\Models\Csutomer;
use App\Models\Type;
use App\Models\MealPlan;
use App\Models\Room;
use App\Models\NumberOfuser;
use Session;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\PlanTypeRequest;



class ReserveController extends Controller
{
    public function index(Request $request)
    {
        //クエリーのdateを受け取る
        $date = $request->input('date');

        //dateがYYYY-MMの形式化どうか判定する
		if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
			$date = strtotime($date . "-01");
		}else{
			$date = null;
        }
        
        //取得できないときは現在（=今日）を指定
        if(!$date)$date = time();

        //カレンダーに渡す
        $calendar = new CalendarView($date);
		return view('reserve.index', [
			"calendar" => $calendar
		]);
    }

    public function select_room(Request $request)
    {
        session(['date' => $request->date ]);
        return view('reserve.rooms');
    }

    
    public function select_meal_plan(Request $request)
    {
        $validate_rule =['room_id' => 'required']; //；部屋選択のバリデーションルール
        $this->validate($request, $validate_rule);
        $room_dt = Room::find($request->room_id);
        session(['room_dt' => $room_dt ]);
        $types = new TypeView();
        return view('reserve.meals_plans', ['types' => $types]);
    }

    public function fill(PlanTypeRequest $request)
    {
        $types = Type::all();
        foreach($types as $type)
        {    
            session(['type_id['.$type->id.']' => $request->type_id[$type->id]]); // type_id配列にしてそれぞれに値をsessionに保存
        }
        //選択された食事プランをsessionに保存
        $meal_plan_dt = MealPlan::find($request->meal_plan_id);
        session(['meal_plan_dt' => $meal_plan_dt ]);
        return view('reserve.fill');
    }

    public function check(ReserveRequest $request) //バリデーションルール使用
    {
        // 個人情報をセッションに格納
        session(
        [
            'name' => $request->name,
            'hurigana' => $request->hurigana,
            'gender' => $request->gender,
            'mail' => $request->mail,
            'dob' => $request->dob,
            'postal' => $request->postal,
            'prefectures' => $request->prefectures,
            'city' => $request->city,
            'building' => $request->building,
            'tel' => $request->tel,
            'reserved_on' => $request->reserved_on,
            'number_of_stay' => $request->number_of_stay,
            'transportation' => $request->transportation,
            'check_in_time' => $request->check_in_time,
            'requests' => $request->requests,
            'dinner_start_time' => $request->dinner_start_time,
        ]);
        $sesdata = session()->all();
        $type_view = new TypeView(); //check_renderメソッドを使うためにタイプビュー作成
        return view('reserve.check', ['type_view' => $type_view, 'sesdata' => $sesdata]);
    }


    public function thanks(Request $request)
    {
        $customer = new \App\Models\Customer; // 顧客テーブルデータの新規作成
        // 挿入
        $customer->name = session()->get('name');
        $customer->hurigana = session()->get('hurigana');
        $customer->gender = session()->get('gender');
        $customer->mail = session()->get('mail');
        $customer->dob = session()->get('dob');
        $customer->postal = session()->get('postal');
        $customer->prefectures = session()->get('prefectures');
        $customer->city = session()->get('city');
        $customer->building = session()->get('building');
        $customer->tel = session()->get('tel');
        $customer->save(); // 保存
        $reservation = new \App\Models\reservation; // reservationsテーブルデータ新規作成
        // 部屋と食事プランだけ配列の為取得
        $room_dt = session()->get('room_dt');
        $meal_plan_dt = session()->get('meal_plan_dt');
        // 挿入
        $reservation->customer_id = $customer->id;
        $reservation->room_id = $room_dt->id;
        $reservation->meal_plan_id = $meal_plan_dt->id;
        $reservation->reserved_on = session()->get('date');
        $reservation->number_of_stay = '1'; //未開発
        $reservation->transportation = session()->get('transportation'); 
        $reservation->check_in_time = session()->get('check_in_time'); 
        $reservation->request = session()->get('requests'); 
        $reservation->dinner_start_time = session()->get('dinner_start_time'); 
        // 保存
        $reservation->save();

        $type_lists = \App\Models\Type::type_lists(); // Typeモデルで作ったtype_listメソッド呼び出す
        // タイプテーブルの名前をあるだけ繰り返し
        foreach($type_lists as $type_list)
        {
            $number_of_user = new \App\Models\NumberOfUser;// 人数内訳テーブルの新規作成
            $type_id = Type::where('type', $type_list)->value('id'); //タイプ名で検索してidのみを取得
            $number_of_user->fill(
                [
                    'reserve_id' => $reservation->id,
                    'type_id' => $type_id,
                    'number_of_person' =>session()->get($type_list)
                ])->save();
        }
        
        // セッションデータ全削除
        session()->flush();
        return view('reserve.thanks');
    }
}
