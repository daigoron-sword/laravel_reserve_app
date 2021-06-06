<?php
namespace App\Myclasses\Chart;

use App\Models\Reservation;

use Carbon\Carbon;


class SalesChart
{
    protected $carbon;

    function __construct($date)
    {
        $this->carbon = new Carbon($date);
    }

    public function getSalesChartLogData($date)
    {
        $logs = Reservation::where('reserved_on', 'like', $date . '%')->get();
            foreach($logs as $log)
            {
                $sale = $log->sum;
            }
        if(!isset($sale)) $sale = 0;
        return $sale;
    }

    /**
     * ここから試験運用
     */
    /**
     * 次の月
     */
    public function getNextMonth()
    {
        return $this->carvon->copy()->addMonthsNoOverflow()->format('Y-m');
    }
    /**
     * 前の月
     */
    public function getPrevioustMonth()
    {
        return $this->carvon->copy()->subMonthsNoOverflow()->format('Y-m');
    }

    public function getLabel()
    {
        
    }

}