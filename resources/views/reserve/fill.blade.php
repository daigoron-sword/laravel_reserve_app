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
<h1>入力フォーム</h1>
  {{ Form::open(['url' => '/reserve/check', 'method' => 'post', 'files' => false]) }}
  {{ Form::token() }}
    <!-- 名前 -->
    {{Form::label('name', '名前' )}}<small>（必須）</small>
    {{Form::text('name', null)}}
    <!-- ふりがな -->
    {{Form::label('hurigana', 'ふりがな')}}<small>（必須）</small>
    {{Form::text('hurigna', null)}}
    <!-- 性別 -->
    {{Form::label('gneder', '性別')}}<small>（必須）</small>
    {{Form::radio('gender', '男性', false)}}
    {{Form::radio('gender', '女性', false)}}
    <!-- メールアドレス -->
    {{Form::label('mail', 'メールアドレス')}}<small>（必須）</small>
    {{Form::text('mail', null)}}
    <!-- 生年月日 -->
    

    



  {{ Form::submit('最終確認', ['class'=>'btn btn-primary btn-block']) }}
  {{ Form::close() }}
</body>
</html>
