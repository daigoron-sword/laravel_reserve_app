<?php
namespace App\MyClasses\Chart;

use App\Models\Reservation;

use Carbon\Carbon;


class SalesChartDay
{
    private $carbon;

    function __construct($date)
    {
        $this->carbon = new Carbon($date);
    }


    /**
     * 次の月
     */
    public function getNextMonth()
    {
        return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
    }
    // /**
    //  * 前の月
    //  */
    public function getPreviousMonth()
    {
        return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
    }
    /**
     * 日別のラベル
     */
    public function getLabels()
    {
        $day = $this->carbon->copy()->daysInMonth; //月の日数を取得
        for ($i = 0; $i <= $day-1; $i++) //月の日数分繰り返す
        {
            $lavels[] = $this->carbon->copy()->addDay($i)->format('m月d日');
        }
        sort($lavels);
        return $lavels;
    }
    /**
     * 過去1年分のデータを取得
     */
    public function getSalesChartLogData()
    {
        $day = $this->carbon->copy()->daysInMonth . '\n'; //月の日数を取得
        for ($i = 1; $i <= $day; $i++) //月の日数分繰り返す
        {
            $target_days[] = $this->carbon->copy()->addDay($i)->format('Y-m-d');
        }
        sort($target_days);
        foreach($target_days as $day)
        {
            $sale_log[] = $this->getSaleLogData($day);
        }
        return $sale_log;
    }

    protected function getSaleLogData($date)
    {
        $logs = Reservation::where('reserved_on', $date)->get();
            foreach($logs as $log)
            {
                $sale = $log->sum;
            }
        if(!isset($sale)) $sale = 0;
        return $sale;
    }

    public function getGraph()
    {
        return 'day';
    }

    public function toggleDate()
    {
        return 'month';
    }

    public function toggleTitle()
    {
        return '月別売上に切り替える';
    }

    public function getTitleLabel()
    {
        $date = $this->carbon->copy()->format('Y年m月');
        return $date;
    }

    public function getSuggestedMax()
    {
        return 500000;
    }

    public function getSuggestedMin()
    {
        return 0;
    }

    public function getStepSize()
    {
        return 100000;
    }

}