<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>check</title>
</head>
<body>
<div class="container">
  <div class="row justify-content-left">
    <div class="col-md-12">
      <h1>入力情報の確認</h1>
        {{ Form::open(['url' => route('reserve.send'), 'method' => 'post', 'files' => false,]) }}
        {{ Form::token() }}
          <dl class='row'>
            <dt class="col-md-2">予約日</dt>
              <dd class="col-md-10"><p>{{ $sesdata['date'] }}</p></dd>
            <dt class="col-md-2">お部屋</dt>
              <dd class="col-md-10"><p>{{ $sesdata['room_dt']['name'] }}</p></dd>
            <dt class="col-md-2">食事プラン</dt>
              <dd class="col-md-10"><p>{{ $sesdata['meal_plan_dt']['name'] }}</p></dd>
            <dt class="col-md-2">氏名</dt>
              <dd class="col-md-10"><p>{{ $sesdata['name'] }}</p></dd>
            <dt class="col-md-2">氏名（ふりがな）</dt>
              <dd class="col-md-10"><p>{{ $sesdata['hurigana'] }}</p></dd>
            <dt class="col-md-2">性別</dt>
              <dd class="col-md-10"><p>{{ $sesdata['gender'] }}</p></dd>
            <dt class="col-md-2">メールアドレス</dt>
              <dd class="col-md-10"><p>{{ $sesdata['mail'] }}</p></dd>
            <dt class="col-md-2">生年月日</dt>
              <dd class="col-md-10"><p>{{ $sesdata['dob'] }}</p></dd>
            <dt class="col-md-2">郵便番号</dt>
              <dd class="col-md-10"><p>{{ $sesdata['postal'] }}</p></dd>
            <dt class="col-md-2">都道府県</dt>
              <dd class="col-md-10"><p>{{ $sesdata['prefectures'] }}</p></dd>
            <dt class="col-md-2">市区町村郡/番地</dt>
              <dd class="col-md-10"><p>{{ $sesdata['city'] }}</p></dd>
            @isset($sesdata['building'])
              <dt class="col-md-2">建物・アパート名など</dt>
                <dd class="col-md-10"><p>{{ $sesdata['building'] }}</p></dd>
            @endisset
            <dt class="col-md-2">電話番号</dt>
              <dd class="col-md-10"><p>{{ $sesdata['tel'] }}</p></dd>
            <dt class="col-md-2">交通手段</dt>
              <dd class="col-md-10"><p>{{ $sesdata['transportation'] }}</p></dd>
            <dt class="col-md-2">チェックイン時間</dt>
              <dd class="col-md-10"><p>{{ $sesdata['check_in_time'] }}</p></dd>
            <dt class="col-md-2">ご夕食の時間</dt>
              <dd class="col-md-10"><p>{{ $sesdata['dinner_start_time'] }}</p></dd>
            @isset($sesdata['requests'])
              <dt class="col-md-2">ご要望</dt>
                <dd class="col-md-10"><p>{{ $sesdata['requests'] }}</p></dd>
            @endisset
          </dl>
          <!-- 利用人数 -->
          <h2>金額の確認</h2>
            <table class="table table-hover table-bordered">  
              <thead>
                <tr>
                  <th scope="col">内訳</th>
                  <th scope="col">単価</th>
                  <th scope="col">人数</th>
                  <th scope="col"><div class="text-right">金額</div></th>
                </tr>
              </thead>
              <tbody>
                @foreach($sesdata['types_dt'] as $type_dt)
                <tr>
                  <td>{{$type_dt['type']}}</td>
                  <td>{{$type_dt['price']}}円</td>
                  <td>{{$type_dt['number']}}人</td>
                  <td><div class="text-right">{{$type_dt['sum']}}円</div></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <p class="text-right">合計金額　{{$sesdata['total_sum']}}円 </p>
          {{ Form::submit('戻る', ['class'=>'btn btn-primary btn-block', 'name' => 'back']) }}
          {{ Form::submit('予約する', ['class'=>'btn btn-primary btn-block']) }}
        {{ Form::close() }}
    </div>
  </div>
</div>
</body>
</html>