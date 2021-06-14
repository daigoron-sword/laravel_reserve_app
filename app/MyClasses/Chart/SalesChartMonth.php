<?php
namespace App\MyClasses\Chart;

use App\Models\Reservation;

use Carbon\Carbon;


class SalesChartMonth
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
     * 過去1年分の年月ラベルの取得
     */
    public function getLabels()
    {
        for ($i = 1; $i <= 12; $i++) //取得した日付のひと月前から過去1年分の年月を繰り返す
        {
            $lavels[] = $this->carbon->copy()->subMonthsNoOverflow($i)->format('Y年m月');
        }
        sort($lavels);
        return $lavels;
    }
    /**
     * 過去1年分のデータを取得
     */
    public function getSalesChartLogData()
    {
        for ($i = 1; $i <= 12; $i++) //取得した日付のひと月前から過去1年分の年月を繰り返す
        {
            $target_days[] = $this->carbon->copy()->subMonthsNoOverflow($i)->format('Y-m');
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
        $logs = Reservation::where('reserved_on', 'like', $date . '%')->get();
            foreach($logs as $log)
            {
                $sale = $log->sum;
            }
        if(!isset($sale)) $sale = 0;
        return $sale;
    }

    public function getGraph()
    {
        return 'month';
    }
    public function toggleDate()
    {
        return 'day';
    }

    public function toggleTitle()
    {
        return '日別売上に切り替える';
    }


    public function getTitleLabel()
    {
        $labels = $this->getLabels();
        $start_month = $labels[0];
        $end_month = $labels[11];
        return $start_month .'～'. $end_month;
    }

    public function getSuggestedMax()
    {
        return 3000000;
    }

    public function getSuggestedMin()
    {
        return 0;
    }

    public function getStepSize()
    {
        return 500000;
    }


}