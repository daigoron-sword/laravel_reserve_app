<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>予約の削除</title>
</head>
<body>
    <h1>予約の削除</h1>
        @if(session('status'))
            <div class="alert aler-saccsess">
                {{session('status')}}
            </div>
        @endif
        <p><a href="{{route('management')}}">予約管理画面へ戻る</a></p>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                {{ Form::open(['url' => '/management/deleteReserve/$reservation->id', 'method' => 'post', 'files' => false]) }}
                {{ Form::token() }}
                {{Form::hidden('id', $reservation->id)}}
                <dl clss="row">
                    <dt class="col-md-2">予約日</dt>
                        <dd class="col-md-10">{{$reservation->reserved_on}}</dd>
                    <dt class="col-md-2">代表者名</dt>
                        <dd class="col-md-10">{{$reservation->customer->name}}</dd>
                </dl>
                    <!-- 送信ブロック -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{ Form::submit('削除', ['class'=>'btn btn-primary btn-block']) }}
                        </div>
                    <!-- /送信ブロック -->
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
</html>