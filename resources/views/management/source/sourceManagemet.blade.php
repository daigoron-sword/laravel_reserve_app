<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ソース管理</title>
</head>
<body>
    <h1>ソース管理</h1>
    @if(session('status'))
        <div class="alert aler-saccsess">
            {{session('status')}}
        </div>
    @endif
        <p><a href="{{route('createSource', ['branch' => 'room'])}}">お部屋の新規作成</a></p>
        {!! $source_management_dt->roomRender() !!} 
        <p><a href="{{route('createSource', ['branch' => 'plan'])}}">プランの新規作成</a></p>
        {!! $source_management_dt->planRender() !!} 
</body>
</html>