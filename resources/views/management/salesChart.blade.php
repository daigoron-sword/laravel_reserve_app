<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    <title>売上グラフ</title>
</head>
<body>
    <h1>売上グラフ</h1>
    <canvas id="salesChart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <!-- グラフを描画 -->
        <script>
            // ラベル
            var labels = @json($label);

            // 売上
            var sale_log = @json($sale_log);

            // // ラベル
            // var labels = [
            //     "2021年1月",
            //     "2021年2月",
            //     "2021年3月",
            //     "2021年4月",
            //     "2021年5月",
            //     "2021年6月",
            // ];
            // //平均体重ログ
            // var average_weight_log = [
            //     50.0,	//1月のデータ
            //     51.0,	//2月のデータ
            //     52.0,	//3月のデータ
            //     53.0,	//4月のデータ
            //     54.0,	//5月のデータ
            //     49.0	//6月のデータ
            // ];
            // //最大体重ログ
            // var max_weight_log = [
            //     52.0,	//1月のデータ
            //     54.0,	//2月のデータ
            //     55.0,	//3月のデータ
            //     51.0,	//4月のデータ
            //     57.0,	//5月のデータ
            //     48.0	//6月のデータ
            // ];
            // //最小体重ログ
            // var min_weight_log = [
            //     48.0,	//1月のデータ
            //     47.0,	//2月のデータ
            //     45.0,	//3月のデータ
            //     44.0,	//4月のデータ
            //     43.0,	//5月のデータ
            //     49.0	//6月のデータ
            // ];
            //グラフを描画
            var ctx = document.getElementById("salesChart");   
            var salesChart = new Chart(ctx, {
                type: 'line' ,
                data : {
                    labels: labels,
                    datasets: [
                        {
                            label: '売上',
                            data: sale_log,
                            borderColor: "rgba(0,0,255,1)",
                            backgroundColor: "rgba(0,0,0,0)"
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: '売上（5か月）'
                    }
                }
            });
        </script>
        <!-- グラフを描画ここまで -->
    </script>
</body>
</html>