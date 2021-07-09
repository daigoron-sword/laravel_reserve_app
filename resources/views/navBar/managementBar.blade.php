<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="{{route('management')}}" class="navbar-brand">管理</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="ナビゲーション切り替え">
        <span class="navbar-toggler-icon"></span>    
    </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="{{route('management')}}" class="nav-link">予約管理</a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{route('salesChart')}}" class="nav-link dropdown-toggle" id="navbarDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">売上チャート</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                        <a href="{{route('salesChart', ['graph' => 'month'])}}" class="dropdown-item">月間</a>
                        <a href="{{route('salesChart', ['graph' => 'day'])}}" class="dropdown-item">日間</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{route('sourceManagemet')}}" class="nav-link dropdown-toggle" id="navbarDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">部屋/プラン管理</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                        <a href="{{route('sourceManagemet')}}" class="dropdown-item">管理</a>
                        <a href="{{route('createSource', ['branch' => 'room'])}}" class="dropdown-item">部屋新規作成</a>
                        <a href="{{route('createSource', ['branch' => 'plan'])}}" class="dropdown-item">プラン新規作成</a>
                    </div>
                </li>
            </ul>
        </div>
</nav>