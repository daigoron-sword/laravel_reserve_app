<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>部屋情報変更</title>
</head>
<body>
    <h1>部屋情報の変更画面</h1>
        @if(session('status'))
            <div class="alert aler-saccsess">
                {{session('status')}}
            </div>
        @endif
        <p>現在{{$room_source_dt->name}}を編集中です。</p>
        <p><a href="{{route('sourceManagemet')}}">ソース管理画面へ戻る</a></p>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                {{ Form::open(['url' => '/management/source/editRoom/$room_source_dt->id', 'method' => 'post', 'files' => false]) }}
                {{ Form::token() }}
                {{Form::hidden('id', $room_source_dt->id)}}
                {{Form::hidden('base_name', $room_source_dt->name)}}
                    <!-- 部屋名編集 -->
                    <div class="form-group pb-3">
                        {{ Form::label('name','お部屋名') }}
                        @error('name')
                            <p>{{$message}}</p> 
                        @enderror
                        {{ $room_source_dt->name }}->{{ Form::text('name', $room_source_dt->name, ['class' => 'form-control', 'id' => 'name']) }}
                    </div>
                    <!-- /部屋名編集 -->

                    <!-- 価格編集 -->
                    <div class="form-group pb-3">
                        {{ Form::label('price','価格') }}
                        @error('price')
                            <p>{{$message}}</p> 
                        @enderror
                        {{ $room_source_dt->price }}->{{ Form::text('price', $room_source_dt->price, ['class' => 'form-control', 'id' => 'price']) }}
                    </div>
                    <!-- /価格編集 -->
                    <!-- 適用開始時期 -->
                    {{ Form::label('start_period','開始時期') }}
                        @error('start_period')
                            <p>{{$message}}</p> 
                        @enderror
                        {{ $room_source_dt->start_period }}->{{ Form::date('start_period', $room_source_dt->start_period, ['class' => 'form-control', 'id' => 'start_period']) }}
                    <!-- /適用開始時期 -->
                    <!-- 適用終了時期 -->
                    {{ Form::label('end_period','終了時期') }}
                        @error('end_period')
                            <p>{{$message}}</p> 
                        @enderror
                        {{ $room_source_dt->end_period }}->{{ Form::date('end_period', $room_source_dt->end_period, ['class' => 'form-control', 'id' => 'end_period']) }}
                    <!-- /適用終了時期 -->
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