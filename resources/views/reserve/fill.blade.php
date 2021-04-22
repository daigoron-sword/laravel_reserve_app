<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>test</title>
</head>
<body>
{{ Session::get('adult') }}
{{ Session::get('senior') }}
{{ Session::get('child') }}
  <h1>お客様入力フォーム</h1>
  <form action="{{url('/reserve/check')}}" method="post">
    @csrf
      <dl>
      <dt><label for="date">予約日時</label></dt>
        <dd>
          {{ Session::get('date') }}
        </dd>

      <dt><label for="name">氏名<small>（必須）</small></label></dt>
          <dd>
            <input type="text" name="name" id="name" value="#">
          </dd>

      <dt><label for="hurigana">氏名（ふりがな）<small>（必須）</small></label></dt>
          <dd>
            <input type="text" name="hurigana" id="hurigana" value="#">
          </dd>

      <dt><label for="gender">性別</label></dt>
        <dd>
          <input type="radio" name="gender" value="男性">男性
          <input type="radio" name="gender" value="女性">女性
        </dd>

      <dt><label for="email">メールアドレス<small>（必須）</small></label></dt>
          <dd>
            <input type="email" name="email" id="email" value="#">
          </dd>

      <dt><label for="email_re">メールアドレス（再入力）<small>（必須）</small></label></dt>
          <dd>
            <input type="email_re" name="email_re" id="email_re" value="#">
          </dd>

      <dt><label for="dob">生年月日</label></dt>
        <dd>
          <input type="text" name="dob" id="dob" value="#">
        </dd>

      <dt><label for="postal">郵便番号<small>（必須）</small></label></dt>
          <dd>
            〒<input type="text" name="postal" id="postal" value="#"><br>
            例:(1234567)
          </dd>

      <dt><label for="prefectures">都道府県<small>（必須）</small></label></dt>
          <dd>
            <input type="text" name="prefectures" id="prefectures" value="#">
          </dd>

      <dt><label for="city">市区町村郡/番地<small>（必須）</small></label></dt>
          <dd>
            <input type="text" name="city" id="city" value="#">
          </dd>

      <dt><label for="building">建物・アパート名など</label></dt>
        <dd>
          <input type="text" name="building" id="building" value="#">
        </dd>

      <dt><label for="tel">連絡先<small>（必須）</small></label></dt>
          <dd>
            <input type="text" name="tel" id="tel" value="#">
          </dd>

      <dt><label for="transportation">当日の交通手段<small>（必須）</small></label></dt>
        <dd>
          <select required="" name="transportation">
            <option value="" selected="selected">--</option>
            <option value="車">車</option>
            <option value="JR・電車">JR・電車</option>
            <option value="その他">その他</option>
          </select>
        </dd>

      <dt>チェックイン予定時間</dt>
      <dd>
        <select name="check_in_hour">
          <option value="" selected="selected">--</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
        </select>
          <span>:</span>
        <select name="check_in_minute">
          <option value="" selected="selected">--</option>
          <option value="00">00</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="30">30</option>
          <option value="40">40</option>
          <option value="50">50</option>
        </select><br>
        <p>15:00～18:00の範囲で入力してください。遅れる場合は事前にご連絡ください。</p>
      </dd>

      <dt><label for="past">過去のご宿泊<small>（必須）</small></label></dt>
      <dd>
        <input type="radio" name="past" value="今回が初めて">今回が初めてです。
        <input type="radio" name="past" value="今回が初めて(知人の紹介で)">今回が初めてです。(知人の紹介で)
        <input type="radio" name="past" value="過去に宿泊あり。">過去に宿泊しています。
      </dd>

      <dt><label for="anniversary">記念日など<small>（必須）</small></label></dt>
      <dd>
        <select name="anniversary" required="">
          <option value="" selected="selected">--</option>
          <option value="記念日ではない">記念日ではない</option>
          <option value="誕生日">誕生日</option>
          <option value="その他記念日">その他記念日</option>
        </select>
      </dd>

      <dt><label for="requests">その他ご要望など</label></dt>
      <dd>
        <textarea maxlength="200" name="requests" cols="50" rows="10"></textarea>
      </dd>

      <dt><label for="dinner_start_time">夕食の開始時刻<small>（必須）</small></label></dt>
      <dd>
        <input type="radio" name="dinner_start_time" value="17:30">17:30～
        <input type="radio" name="dinner_start_time" value="19:45">19:45～
      </dd>
    </dl>
    <input type="submit" value="確認">
  </form>
</body>
</html>
