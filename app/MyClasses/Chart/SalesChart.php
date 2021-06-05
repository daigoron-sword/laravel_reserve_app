<?php
namespace App\Myclasses\Chart;

use App\Models\Reservation;

class SalesChart
{
    function __construct()
    {

    }

    function getSalesChartLogData($date)
    {
        $logs = Reservation::where('reserved_on', 'like', $date . '%')->get();

        foreach($logs as $log)
        {
            // ここから。$saleが未定義とみなされエラーが解消されない。
            // if($log->sum == Null){
            //     $sale = 0;
            }
            $sale = $log->sum;
        }

        return $sale;
    }

}