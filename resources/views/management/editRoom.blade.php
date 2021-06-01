<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>部屋の変更</title>
</head>
<body>
    <h1>部屋の変更</h1>
        @if(session('status'))
            <div class="alert aler-saccsess">
                {{session('status')}}
            </div>
        @endif
        <p>現在の部屋は{{$reservation->room->name}}です。</p>
        <p><a href="{{route('management')}}">予約管理画面へ戻る</a></p>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                {{ Form::open(['url' => '/management/editRoom/$reservation->id', 'method' => 'post', 'files' => false]) }}
                {{ Form::token() }}
                {{Form::hidden('id', $reservation->id)}}
                    <!-- お部屋選択 -->
                    <div class="form-group pb-3">
                        {{ Form::label('room_id','お部屋選択') }}
                        @error('room_id')
                            <p>{{$message}}</p> 
                        @enderror
                        {{ Form::select('room_id', App\Models\Room::select_room_list($reservation->reserved_on), '選択してください', ['class' => 'form-control','id' => 'room']) }}
                    </div>
                    <!-- /お部屋選択 -->
                    <!-- 送信ブロック -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{ Form::submit('変更', ['class'=>'btn btn-primary btn-block']) }}
                        </div>
                    <!-- /送信ブロック -->
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
</html>