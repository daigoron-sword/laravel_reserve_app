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
        session(['room' => $request->room ]);
        $types = new TypeView();
        return view('reserve.meals_plans', ['types' => $types]);
    }

    public function fill(Request $request)
    {
        // Typeモデルで作ったtype_listメソッド呼び出す
        $type_lists = \App\Models\Type::type_lists();
        // タイプテーブルの名前をあるだけ繰り返し
        foreach($type_lists as $type_list)
        {
            // input()で$requestの中の名前を取得してsessionに格納
            session([$type_list => $request->input($type_list)]);
        }
        //選択された食事プランをsessionに格納
        session(['meal_plan' => $request->meal_plan]);
        return view('reserve.fill');
    }

    public function check(Request $request)
    {
        // fillフォームの配列を作る
        $fill_items = [
            'name',
            'hurigana',
            'gender',
            'mail',
            'dob',
            'postal',
            'prefectures',
            'city',
            'building',
            'tel',
            'reserved_on',
            'number_of_stay',
            'transpotation',
            'check_in_time',
            'request',
            'dinner_start_time'
        ];
        // $reqからフォームを抽出
        $fill_input = $request->only($fill_items);
        // sessionにfill_inputというキーで格納
        $request->session()->put('fill_input', $fill_input);

        // session(
        // [
        //     'name' => $request->name,
        //     'hurigana' => $request->hurigana,
        //     'gender' => $request->gender,
        //     'mail' => $request->mail,
        //     'dob' => $request->dob,
        //     'postal' => $request->postal,
        //     'prefectures' => $request->prefectures,
        //     'city' => $request->city,
        //     'building' => $request->building,
        //     'tel' => $request->tel,
        //     'reserved_on' => $request->reserved_on,
        //     'number_of_stay' => $request->number_of_stay,
        //     'transpotation' => $request->transpotation,
        //     'check_in_time' => $request->check_in_time,
        //     'request' => $request->request,
        //     'dinner_start_time' => $request->dinner_start_time,
        // ]);

        // セッションデータを取得
        $sesdate = [];
        $sesdata['date'] = $request->session()->get('date');
        $sesdata['room'] = $request->session()->get('room');
        $sesdata['meal_plan'] = $request->session()->get('meal_plan');
        // セッションに値がない場合はリダイレクトする
		// if(!$sesdata){
		// 	return redirect()->action("ReserveController@index");
		// }
        // check_renderメソッドを使うためにタイプビュー作成
        $type_view = new TypeView();
        return view('reserve.check', ['type_view' => $type_view, 'request' => $request, 'sesdata' => $sesdata]);
        // return var_dump($sesdate['date']);
    }


    public function thanks(Request $request)
    {
        return view('reserve.thanks');
    }
}
