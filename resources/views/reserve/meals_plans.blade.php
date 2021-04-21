<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<title>お食事</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                {{ Form::open(['url' => '/reserve/fill', 'method' => 'get', 'files' => false]) }}
                {{ Form::token() }}
                    {{ Session::get('date') }}
                    <!-- お食事選択 -->
                    <div class="form-group pb-3">
                        {{ Form::label('meal_plan','お食事選択') }}
                        {{ Form::select('meal_plan', App\Models\MealPlan::selectlist(), '選択してください', ['class' => 'form-control','id' => 'meal_plan']) }}
                    </div>
                    <!-- /お食事選択 -->
                    <!-- 送信ブロック -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{ Form::submit('人数選択', ['class'=>'btn btn-primary btn-block']) }}
                        </div>
                    <!-- /送信ブロック -->
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
</html>

