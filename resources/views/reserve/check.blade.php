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
        {{ Form::open(['url' => '/reserve/thanks', 'method' => 'post', 'files' => false,]) }}
        {{ Form::token() }}
          <dl class='row'>
            <dt class="col-md-2">予約日</dt>
              <dd class="col-md-10"><p>{{ Session::get('date') }}</p></dd>
            <dt class="col-md-2">お部屋</dt>
              <dd class="col-md-10"><p>{{ Session::get('room') }}</p></dd>
            <dt class="col-md-2">食事プラン</dt>
              <dd class="col-md-10"><p>{{ Session::get('meal_plan') }}</p></dd>
            <dt class="col-md-2">氏名</dt>
              <dd class="col-md-10"><p>{{ Session::get('name') }}</p></dd>
            <dt class="col-md-2">氏名（ふりがな）</dt>
              <dd class="col-md-10"><p>{{ Session::get('hurigana') }}</p></dd>
            <dt class="col-md-2">性別</dt>
              <dd class="col-md-10"><p>{{ Session::get('gender') }}</p></dd>
            <dt class="col-md-2">メールアドレス</dt>
              <dd class="col-md-10"><p>{{ Session::get('mail') }}</p></dd>
            <dt class="col-md-2">生年月日</dt>
              <dd class="col-md-10"><p>{{ Session::get('dob') }}</p></dd>
            <dt class="col-md-2">郵便番号</dt>
              <dd class="col-md-10"><p>{{ Session::get('postal') }}</p></dd>
            <dt class="col-md-2">都道府県</dt>
              <dd class="col-md-10"><p>{{ Session::get('prefectures') }}</p></dd>
            <dt class="col-md-2">市区町村郡/番地</dt>
              <dd class="col-md-10"><p>{{ Session::get('city') }}</p></dd>
            <dt class="col-md-2">建物・アパート名など</dt>
              <dd class="col-md-10"><p>{{ Session::get('building') }}</p></dd>
            <dt class="col-md-2">電話番号</dt>
              <dd class="col-md-10"><p>{{ Session::get('tel') }}</p></dd>
          </dl>
          <!-- 利用人数 -->
          {!! $type_view->check_render() !!}
          {{ Form::submit('予約完了', ['class'=>'btn btn-primary btn-block']) }}
        {{ Form::close() }}
    </div>
  </div>
</div>
</body>
</html>