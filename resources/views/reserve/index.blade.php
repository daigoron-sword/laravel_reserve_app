<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    <title>予約</title>
</head>
<body>
<div class="container">
    @if (session('flash_message'))
        <div class="flash_message">
            {{session('flash_message')}}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
                <p><a href="{{route('management')}}">管理画面</a></p>
            <div class="card">
                <div class="card-header text-center">
                    <a class="btn btn-outline-secondary float-left" href="{{ url('/reserve?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
                    <!-- 現在の年月を表示するメソッド -->
                    <span>{{ $calendar->getTitle() }}</span>
                    <a class="btn btn-outline-secondary float-right" href="{{ url('/reserve?date=' . $calendar->getNextMonth()) }}">次の月</a>
                </div>
                <div class="card-body">
                    <!-- カレンダーを出力 -->
                    {!! $calendar->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>  
</body>
</html>