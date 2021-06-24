<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{$title_dt['name']}}情報削除</title>
</head>
<body>
    <h1>{{$title_dt['name']}}情報の削除</h1>
        <p><a href="{{route('sourceManagemet')}}">ソース管理へ戻る</a></p>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                {{ Form::open(['url' => '/management/source/delete/$source_dt->id', 'method' => 'post', 'files' => false]) }}
                {{ Form::token() }}
                {{Form::hidden('id', $source_dt->id)}}
                {{Form::hidden('branch', $title_dt['branch'])}}
                <dl clss="row">
                    <dt class="col-md-2">{{$title_dt['name']}}名</dt>
                        <dd class="col-md-10">{{$source_dt->name}}</dd>
                    <dt class="col-md-2">価格</dt>
                        <dd class="col-md-10">{{$source_dt->price}}</dd>
                    <dt class="col-md-2">適用開始時期</dt>
                        <dd class="col-md-10">{{$source_dt->start_period}}</dd>
                    <dt class="col-md-2">価格</dt>
                        <dd class="col-md-10">{{$source_dt->end_period}}</dd>
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