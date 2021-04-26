<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\MyServiceInterface;
use App\Myclasses\Calendar\CalendarView;
use App\Myclasses\Type\TypeView;
use App\Models\Type;


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
            'tel' => $request->tel
        ]);
        $type_view = new TypeView();
        return view('reserve.check', ['type_view' => $type_view]);
        // return var_dump($request);
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

    public function thanks(Request $request)
    {
        return view('reserve.thanks');
    }
}
