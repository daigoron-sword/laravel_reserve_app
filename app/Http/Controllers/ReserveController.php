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
use App\Models\Reservation;
use App\Models\NumberOfuser;
use Session;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\PlanTypeRequest;
use Carbon\Carbon;
use App\Mail\ConfirmMail;
use Illuminate\Support\Facades\Mail;


class ReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //クエリーのdateを受け取る
        $date = $request->input("date");

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
        // 予約日不可の日はカレンダーにリダイレクト
        $date = new Carbon($request->date);
        session(['date' => $date->format('Y-m-d') ]);
        $now = Carbon::now(); 
        $rooms = Room::where('start_period', '<=', $date)->where('end_period', '>=', $date)->get();
        $meal_plans = MealPlan::where('start_period', '<=', $date)->where('end_period', '>=', $date)->get();
        if($rooms->isEmpty() || $meal_plans->isEmpty() || $date->lt($now))
        {
            return redirect()->action('ReserveController@index')->with('error', '予約できない日付です');
        }
        return view('reserve.rooms');
    }

    public function room_session(Request $request)
    {
        $validate_rule =['room_id' => 'required']; //；部屋選択のバリデーションルール
        $this->validate($request, $validate_rule);
        $room_dt = Room::find($request->room_id);
        session(['room_dt' => $room_dt ]);
        return redirect()->action('ReserveController@select_meal_plan');
    }

    public function select_meal_plan(Request $request)
    {
        $types = new TypeView();
        return view('reserve.meals_plans', ['types' => $types]);
    }

    public function meal_plan_session(PlanTypeRequest $request)
    {
        $meal_plan_dt = MealPlan::find($request->meal_plan_id);
        session(['meal_plan_dt' => $meal_plan_dt ]);

        // idを繰り返すためのfor文
        for($i = 1; $i <= 11; $i++)
        {
            session(['type_id_' . $i .'' => $request->type_id[$i]]); // type_id配列にしてそれぞれに値をsessionに保存
        }

        $dt = new TypeView();
        $sum_render = $dt->sum_render($request);
        $types_dt = $sum_render['types_dt']; //金額テーブルの値
        $total_sum = $sum_render['total_sum'];//総合計金額
        session([
            'types_dt' => $types_dt,
            'total_sum' => $total_sum
        ]);
        return redirect()->action('ReserveController@fill');

    }

    public function fill(Request $request)
    {
        $sesdata = session()->all();
        return view('reserve.fill', ['sesdata' => $sesdata]);
    }

    public function customer_session(ReserveRequest $request)
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
                'transportation' => $request->transportation,
                'check_in_time' => $request->check_in_time,
                'requests' => $request->requests,
                'dinner_start_time' => $request->dinner_start_time,
            ]);
        return redirect()->action('ReserveController@check');
    }

    public function check(Request $request) //バリデーションルール使用
    {
        $sesdata = session()->all();
        $type_view = new TypeView(); //check_renderメソッドを使うためにタイプビュー作成
        return view('reserve.check', ['type_view' => $type_view, 'sesdata' => $sesdata]);
    }

    public function send(Request $request)
    {
        $sesdata = session()->all();
        if($request->has('back'))
        {
            return redirect()->action('ReserveController@fill')->withInput($sesdata);
        }
        $customer = new \App\Models\Customer; // 顧客テーブルデータの新規作成
        // 挿入
        $customer->fill
        ([
            'name' => $sesdata['name'],
            'hurigana' => $sesdata['hurigana'],
            'gender' => $sesdata['gender'],
            'mail' => $sesdata['mail'],
            'dob' => $sesdata['dob'],
            'postal' => $sesdata['postal'],
            'prefectures' => $sesdata['prefectures'],
            'city' => $sesdata['city'],
            'building' => $sesdata['building'],
            'tel' => $sesdata['tel']
        ])->save();

        $reservation = new \App\Models\reservation; // reservationsテーブルデータ新規作成
        // 部屋と食事プランだけ配列の為取得
        $room_dt = session()->get('room_dt');
        $meal_plan_dt = session()->get('meal_plan_dt');
        // 挿入
        $reservation->fill
        ([
            'customer_id' => $customer->id,
            'room_id' => $room_dt->id,
            'meal_plan_id' => $meal_plan_dt->id,
            'reserved_on' => $sesdata['date'],
            'number_of_stay' => '1', //未開発
            'transportation' => $sesdata['transportation'],
            'check_in_time' => $sesdata['check_in_time'],
            'request' => $sesdata['requests'],
            'dinner_start_time' => $sesdata['dinner_start_time'],
            'sum' => $sesdata['total_sum'],
        ])->save();

        for($i = 1; $i <= 11; $i++)
        {
            if($sesdata['type_id_'.$i.''] >= 1)
            {
                $number_of_user = new \App\Models\NumberOfUser;// 人数内訳テーブルの新規作成
                $number_of_user->fill(
                    [
                        'reserve_id' => $reservation->id,
                        'type_id' => $i,
                        'number_of_person' =>session()->get('type_id_'.$i.'')
                    ])->save();    
            }
        }
        // メール送信
        $reservation_dt = Reservation::with(['mealPlan', 'room', 'customer'])->find($reservation->id);
        $number_of_user_dt = NumberOfUser::with('type')->where('reserve_id', $reservation->id)->get();
        Mail::to($reservation_dt->customer->mail)->send(new ConfirmMail($reservation_dt, $number_of_user_dt));  
        // セッションデータ全削除
        session()->flush();
        session()->flash('flash_message', '予約が完了しました。登録いただいたメールアドレス宛にご予約情報をお送りしました。');
        return redirect()->action('ReserveController@index');
    }
}
