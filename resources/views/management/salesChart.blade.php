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
    <div class="card">
        <div class="card-header text-center">
            <a class="btn btn-outline-secondary foloat-left" href="{{url('/management/salesChart?date=' . $sales_chart->getPreviousMonth()) }}">前の月にずれる</a>
            <a class="btn btn-outline-secondary foloat-right" href="{{url('/management/salesChart?date=' . $sales_chart->getNextMonth()) }}">次の月にずれる</a>      
        </div>
        <div class="card-body">
            <canvas id="salesChart"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
                <!-- グラフを描画 -->
                <script>
                    // ラベル
                    var labels = @json($sales_chart->getLabels());

                    // 売上
                    var sale_log = @json($sales_chart->getSalesChartLogData());

                    //グラフを描画
                    var ctx = document.getElementById("salesChart");   
                    var salesChart = new Chart(ctx, {
                        type: 'bar' ,
                        data : {
                            labels: labels,
                            datasets: [
                                {
                                    label: '売上',
                                    data: sale_log,
                                    backgroundColor: "rgba(130,201,169,0.5)"
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: '売上（1年）'
                            },
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        suggestedMax:3000000,
                                        suggestedMin:0,
                                        stepSize:500000,
                                        callback: function(value, index, values){
                                            return value + '円'
                                        }
                                    }
                                }]
                            },
                        }
                    });
                </script>
                <!-- グラフを描画ここまで -->
            </script>     
        </div>
    </div>
    

</body>
</html>