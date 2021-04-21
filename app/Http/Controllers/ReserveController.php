<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\MyServiceInterface;
use App\Myclasses\Calendar\CalendarView;

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
        session(['meal_plan' => $request->meal_plan]);
        return view('reserve.fill');
    }

    public function check(Request $request)
    {
        $check_in = $request->check_in_hour. ':' . $request->check_in_minute;
        session([
            'name' => $request->name,
            'hurigana' => $request->hurigana,
            'gender' => $request->gender,
            'email' => $request->email,
            'dob' => $request->dob,
            'postal' => $request->postal,
            'prefectures' => $request->prefectures,
            'city' => $request->city,
            'building' => $request->building,
            'tel' => $request->tel,
            'transportation' => $request->transportation,
            'check_in' => $check_in,
            'past' => $request->past,
            'anniversary' => $request->anniversary,
            'request' => $request->requests,
            'dinner_start_time' => $request->dinner_start_time
        ]);
        return view('reserve.check');
    }

    public function select_room(Request $request)
    {
        session(['date' => $request->date ]);
        return view('reserve.rooms');
    }

    public function select_meal_plan(Request $request)
    {
        session(['room' => $request->room ]);
        return view('reserve.meals_plans');
    }




}
