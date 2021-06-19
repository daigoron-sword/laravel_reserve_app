以下の通りご予約依頼を承りましたので、ご確認ください。

プラン名　：{{$reservation_dt->mealPlan->name}}
部屋タイプ：{{$reservation_dt->room->name}}
宿泊日　　：{{$reservation_dt->reserved_on}}
▼ご利用人数 =============================================
@foreach ($number_of_user_dt as $number_of_user)
　{{$number_of_user->type->type}}　　　：{{$number_of_user->number_of_person}}    
@endforeach
▼予約者基本情報 =========================================
氏名　　　：{{$reservation_dt->customer->name}}
生年月日　：{{$reservation_dt->customer->dob}}
性別　　　：{{$reservation_dt->customer->gender}}
Ｅメール　：{{$reservation_dt->customer->mail}}
郵便番号　：{{$reservation_dt->customer->postal}} ：{{$reservation_dt->customer->prefectures}}
ご住所　　：{{$reservation_dt->customer->city}} {{$reservation_dt->customer->building}}
ご連絡先：{{$reservation_dt->customer->tel}}
交通手段　：{{$reservation_dt->transportation}}
チェックイン予定時間　：{{$reservation_dt->check_in_time}}
夕食の開始時刻：{{$reservation_dt->dinner_start_time}}
@isset($reservation_dt->request)
その他ご要望など：
{{$reservation_dt->request}}
@endisset
▼ご利用料金 =============================================
@foreach ($type_dt as $type)
    {{$type['type']}}  {{$type['price']}} × {{$type['number']}}　＝　{{$type['sum']}} 円
@endforeach
----------------------------------------------------------
　　　　　　合計：{{$reservation_dt->sum}}円

