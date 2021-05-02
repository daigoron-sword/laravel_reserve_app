<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<title>お部屋</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                {{ Form::open(['url' => '/reserve/meals_plans', 'method' => 'get', 'files' => false]) }}
                {{ Form::token() }}
                    <!-- お部屋選択 -->
                    <div class="form-group pb-3">
                        {{ Form::label('room_id','お部屋選択') }}
                        {{ Form::select('room_id', App\Models\Room::select_room_list(), '選択してください', ['class' => 'form-control','id' => 'room']) }}
                    </div>
                    <!-- /お部屋選択 -->
                    <!-- 送信ブロック -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{ Form::submit('食事プランの選択へ', ['class'=>'btn btn-primary btn-block']) }}
                        </div>
                    <!-- /送信ブロック -->
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
</html>

