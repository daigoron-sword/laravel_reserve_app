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
                        {{ Form::label('meal_plan_id','お食事選択') }}
                        @error('meal_plan_id')
                            <p>{{$message}}</p> 
                        @enderror
                        {{ Form::select('meal_plan_id', App\Models\MealPlan::select_meal_plan_list(Session::get('date')), '選択してください', ['class' => 'form-control','id' => 'meal_plan']) }}
                    </div>
                    <!-- /お食事選択 -->
                    <!-- 人数選択 -->
                    {!! $types->render() !!}
                    <!-- /人数選択 -->
                    <!-- 送信ブロック -->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{ Form::submit('個人情報の入力へ', ['class'=>'btn btn-primary btn-block']) }}
                        </div>
                    </div>
                    <!-- /送信ブロック -->
                {{ Form::close() }}
            </div>
        </div>
    </div>
</body>
</html>

