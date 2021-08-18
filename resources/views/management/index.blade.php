<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>予約管理</title>
</head>
<body>
    <div class="container-fuled">
        @include('navBar.managementBar')
        <p><a href="{{route('reserve')}}" class="btn btn-outline-primary roll=button">予約画面に移る</a></p>
        <h1>予約管理</h1>
        @if(session('status'))
            <div class="alert alert-saccsess">
                {{session('status')}}
            </div>
        @endif

            {!! $management->render() !!} 
            {!! $management->getReservation()->links() !!}    
    </div>
</body>
</html>