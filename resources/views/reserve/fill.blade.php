<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>test</title>
</head>
<body>
  <div class="container">
    <h1>入力フォーム</h1>
      <h2>予約内容の確認</h2>
        <dl class="row">
          <dt class="col-sm-2">プラン</dt>
            <dd class="col-sm-10">{{$sesdata['meal_plan_dt']['name']}} </dd>   
          <dt class="col-sm-2">お部屋</dt>
            <dd class="col-sm-10">{{$sesdata['room_dt']['name']}} </dd>
          <dt class="col-sm-2">宿泊日</dt>
            <dd class="col-sm-10">{{$sesdata['date']}} </dd>   
        </dl>
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
        <p><a href="{{route('reserve.meals_plans')}}" class="btn btn-outline-primary roll=button">プラン選択に戻る</a></p>
      {{ Form::open(['url' => route('reserve.customer_session'), 'method' => 'post', 'files' => false,]) }}
      {{ Form::token() }}
        <!-- 名前 -->
        <div class="row">
          <div class="col-sm-5">
            {{Form::label('name', '氏名',)}}<small>（必須）</small>
            @error('name')
              <div class="alert alert-danger">{{$message}}</div> 
            @enderror
            {{Form::text('name', old('name'), ['class' => 'form-control'])}}
          </div>
          <!-- ふりがな -->
          <div class="col-sm-7">
            {{Form::label('hurigana', '氏名（ふりがな）')}}<small>（必須）</small>
            @error('hurigana')
              <div class="alert alert-danger">{{$message}}</div> 
            @enderror
            {{Form::text('hurigana', old('hurigana'), ['class' => 'form-control'])}}          
          </div>
        </div>
        <!-- 性別 -->
        @error('gender')
          <div class="alert alert-danger">{{$message}}</div> 
        @enderror
        {{Form::label('gender', '性別')}}<small>（必須）</small>
        <div class="form-check form-check-inline">
          {{Form::radio('gender', '男性', false, ['class' => 'form-check-input'])}}
          {{Form::label('gender', '男性', ['class' => 'form-check-label'])}}
        </div>
        <div class="form-check form-check-inline">
          {{Form::radio('gender', '女性', false, ['class' => 'form-check-input'])}}
          {{Form::label('gender', '女性', ['class' => 'form-check-label'])}}
        </div>
        <!-- メールアドレス -->
        <div class="form-group">
          {{Form::label('mail', 'メールアドレス')}}<small>（必須）</small>
        @error('mail')
          <div class="alert alert-danger">{{$message}}</div> 
        @enderror
          {{Form::email('mail', old('mail'), ['class' => 'form-control'])}}
        </div>
        <!-- 生年月日 -->
        <div class="form-group">
          {{Form::label('dob', '生年月日')}}<small>（必須）</small>
          @error('dob')
            <div class="alert alert-danger">{{$message}}</div> 
          @enderror
          {{Form::date('dob', old('date'), ['class' => 'form-control'])}}
        </div>
        <!-- 郵便番号 -->
        <div class="row">
          <div class="form-group col-sm-6">
              {{Form::label('postal', '郵便番号')}}<small>（必須）</small>
              @error('postal')
                <div class="alert alert-danger">{{$message}}</div> 
              @enderror
              {{Form::text('postal', old('postal'), ['class' => 'form-control','placeholder' => '（例）1234567'])}}
          </div>
          <!-- 都道府県 -->
          <div class="form-group col-sm-6">
            {{Form::label('prefectures', '都道府県')}}<small>（必須）</small>
            @error('prefectures')
              <div class="alert alert-danger">{{$message}}</div> 
            @enderror
            {{Form::select('prefectures', 
              [
              '北海道' => '北海道',
              '青森県' => '青森県',
              '岩手県' => '岩手県',
              '宮城県' => '宮城県',
              '秋田県' => '秋田県',
              '山形県' => '山形県',
              '福島県' => '福島県',
              '茨城県' => '茨城県',
              '栃木県' => '栃木県',
              '群馬県' => '群馬県',
              '埼玉県' => '埼玉県',
              '千葉県' => '千葉県',
              '東京都' => '東京都',
              '神奈川県' => '神奈川県',
              '新潟県' => '新潟県',
              '富山県' => '富山県',
              '石川県' => '石川県',
              '福井県' => '福井県',
              '山梨県' => '山梨県',
              '長野県' => '長野県',
              '岐阜県' => '岐阜県',
              '静岡県' => '静岡県',
              '愛知県' => '愛知県',
              '三重県' => '三重県',
              '滋賀県' => '滋賀県',
              '京都府' => '京都府',
              '大阪府' => '大阪府',
              '兵庫県' => '兵庫県',
              '奈良県' => '奈良県',
              '和歌山県' => '和歌山県',
              '鳥取県' => '鳥取県',
              '島根県' => '島根県',
              '岡山県' => '岡山県',
              '広島県' => '広島県',
              '山口県' => '山口県',
              '徳島県' => '徳島県',
              '香川県' => '香川県',
              '愛媛県' => '愛媛県',
              '高知県' => '高知県',
              '福岡県' => '福岡県',
              '佐賀県' => '佐賀県',
              '長崎県' => '長崎県',
              '熊本県' => '熊本県',
              '大分県' => '大分県',
              '宮崎県' => '宮崎県',
              '鹿児島県' => '鹿児島県',
              '沖縄県' => '沖縄県'
              ], old('prefectures'), ['class' => 'form-control', 'placeholder' => '選択してください'])}}
          </div>
        </div>
        <!-- 市区町村 -->
        <div class="row">
        <div class="form-group col-sm-6">
            {{Form::label('city', '市区町村郡/番地')}}<small>（必須）</small>
            @error('city')
              <div class="alert alert-danger">{{$message}}</div> 
            @enderror
            {{Form::text('city', old('city'), ['class' => 'form-control'])}}
          </div>
          <!-- 建物名 -->
          <div class="form-group col-sm-6">
            {{Form::label('building', '建物・アパート名など')}}
            @error('building')
              <div class="alert alert-danger">{{$message}}</div> 
            @enderror
            {{Form::text('building', old('building'), ['class' => 'form-control'])}}
        </div>        
        </div>
        <!-- 電話番号 -->
        <div class="form-group">
          {{Form::label('tel', '電話番号')}}<small>（必須）</small>
        @error('tel')
          <div class="alert alert-danger">{{$message}}</div> 
        @enderror
          {{Form::tel('tel', old('tel'), ['placeholder' => '（例）12345678900', 'min' => 0, 'class' => 'form-control'])}}
        </div>
        <!-- 交通手段 -->
        <div class="form-group">
          {{Form::label('transportation', '交通手段')}}<small>（必須）</small>
        @error('transportation')
          <div class="alert alert-danger">{{$message}}</div> 
        @enderror
          {{Form::select('transportation', ['車' => '車', '電車・バス' => '電車・バス', '徒歩' => '徒歩'], old('transportation'), ['class' => 'form-control', 'placeholder' => '選択してください'])}}
        </div>
        <!-- チェックイン時間 -->
        <div class="form-group">
          {{Form::label('check_in_time', 'チェックイン時間')}}
        @error('check_in_time')
          <div class="alert alert-danger">{{$message}}</div> 
        @enderror
          {{Form::select('check_in_time', 
            [
              '15:00' => '15:00',
              '15:30' => '15:30',
              '16:00' => '16:00',
              '16:30' => '16:30',
              '17:00' => '17:00',
              '17:30' => '17:30',
              '18:00' => '18:00',
            ], old('check_in_time'), ['class' => 'form-control', 'placeholder' => '選択してください'])}}
        </div>
        <!-- 夕食開始時間 -->
        <div class="form-group">
          {{Form::label('dinner_start_time', 'ご夕食の時間')}}<small>（必須）</small>
        @error('dinner_start_time')
          <div class="alert alert-danger">{{$message}}</div> 
        @enderror
          {{Form::select('dinner_start_time', 
            [
              '17:00' => '17:00',
              '18:00' => '18:00',
              '19:00' => '19:00',
            ], old('dinner_start_time'), ['class' => 'form-control', 'placeholder' => '選択してください'])}}
        </div>
        <!-- ご要望 -->
        <div class="form-group">
        {{Form::label('requests', 'ご要望')}}
        {{Form::textarea('requests', old('requests'), ['class' => 'form-control', 'placeholder' => 'その他、質問などありましたらお願いします。', 'rows' => '3'])}}
        </div>
        <!-- 確認ボタン -->
        {{ Form::submit('最終確認', ['class'=>'btn btn-primary btn-block']) }}
      {{ Form::close() }}
  </div>
</body>
</html>
