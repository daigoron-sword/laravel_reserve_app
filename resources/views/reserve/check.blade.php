<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>check</title>
</head>
<body>
  <h1>入力情報の確認</h1>
  <form action="{{url('/reserve/thanks')}}" method='post'>
    <dl>
      <dt><label for="date">予約日時</label></dt>
        <dd><p>{{ Session::get('date') }}</p></dd>

      <dt><label for="name">氏名</label></dt>
        <dd><p>{{ Session::get('name') }}</p></dd>

      <dt><label for="hurigana">氏名（ふりがな）</label></dt>
        <dd><p>{{ Session::get('hurigana') }}</p></dd>

      <dt><label for="gender">性別</label></dt>
        <dd><p>{{ Session::get('gender') }}</p></dd>

      <dt><label for="email">メールアドレス</label></dt>
        <dd><p>{{ Session::get('email') }}</p></dd>

      <dt><label for="dob">生年月日</label></dt>
        <dd><p>{{ Session::get('dob') }}</p></dd>

      <dt><label for="postal">郵便番号</label></dt>
        <dd><p>{{ Session::get('postal') }}</p></dd>

      <dt><label for="prefectures">都道府県</label></dt>
        <dd><p>{{ Session::get('prefectures') }}</p></dd>

      <dt><label for="city">市区町村郡/番地</label></dt>
        <dd><p>{{ Session::get('city') }}</p></dd>

      <dt><label for="building">建物・アパート名など</label></dt>
        <dd><p>{{ Session::get('building') }}</p></dd>

      <dt><label for="tel">連絡先</label></dt>
        <dd><p>{{ Session::get('tel') }}</p></dd>

      <dt><label for="transportation">当日の交通手段</label></dt>
        <dd><p>{{ Session::get('transportation') }}</p></dd>

      <dt><label for="check_in">チェックイン予定時間</label></dt>
        <dd><p>{{ Session::get('check_in') }}</p></dd>

      <dt><label for="past">過去のご宿泊</label></dt>
        <dd><p>{{ Session::get('past') }}</p></dd>

      <dt><label for="anniversary">記念日など</label></dt>
        <dd><p>{{ Session::get('anniversary') }}</p></dd>

      <dt><label for="requests">その他ご要望など</label></dt>
        <dd><p>{{ Session::get('requests') }}</p></dd>

      <dt><label for="dinner_start_time">夕食の開始時刻</label></dt>
        <dd><p>{{ Session::get('dinner_start_time') }}</p></dd>
    </dl>
    <input type="submit" value="確認">
  </form>
</body>
</html>