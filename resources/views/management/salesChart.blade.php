<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>売上グラフ</title>
</head>
<body>
    @include('navBar.managementBar')
    <h1>売上グラフ</h1>
        <div class="card">
            <div class="card-header text-center">
                <a class="col-sm-4 btn btn-outline-secondary float-left" href="{{url('/management/salesChart?date=' . $sales_chart->getPreviousMonth(). '&graph=' . $sales_chart->getGraph() )}}">前の月にずれる</a>
                <a class="col-sm-4 btn btn-outline-secondary" href="{{url('/management/salesChart?graph=' . $sales_chart->toggleDate() ) }}">{{$sales_chart->toggleTitle()}}</a>
                <a class="col-sm-4 btn btn-outline-secondary float-right" href="{{url('/management/salesChart?date=' . $sales_chart->getNextMonth(). '&graph=' . $sales_chart->getGraph() )}}">次の月にずれる</a>      
            </div>
            <div class="card-body">
                <div>
                
                </div>
                <canvas id="salesChart" width="100" height="125">
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
                <!-- グラフを描画 -->
                <script>
                    // ラベル
                    var labels = @json($sales_chart->getLabels());

                    // 売上
                    var sale_log = @json($sales_chart->getSalesChartLogData());

                    // タイトルラベル
                    var title_label = @json($sales_chart->getTitleLabel());

                    //　最大値
                    var suggestedMax = @json($sales_chart->getSuggestedMax());
                    //　最小値
                    var suggestedMin = @json($sales_chart->getSuggestedMin());
                    //　段階
                    var stepSize = @json($sales_chart->getStepSize());

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
                                maintainAspectRatio: false,
                                text: title_label
                            },
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        suggestedMax:suggestedMax,
                                        suggestedMin:suggestedMin,
                                        stepSize:stepSize,
                                        callback: function(value, index, values){
                                            return value + '円'
                                        }
                                    }
                                }]
                            },
                        }
                    });
                </script>
                </canvas>
                <!-- グラフを描画ここまで -->
            </div>
        </div>
</body>
</html>