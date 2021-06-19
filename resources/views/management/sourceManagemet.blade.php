<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ソース管理</title>
</head>
<body>
    <h1>ソース管理画面</h1>
    @if(session('status'))
        <div class="alert aler-saccsess">
            {{session('status')}}
        </div>
    @endif

        {!! $sourceManagement_dt->roomRender() !!} 
        <!-- {!! $sourceManagement_dt->getReservation()->links() !!} -->
</body>
</html>