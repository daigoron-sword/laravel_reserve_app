<?php
namespace App\Myclasses\Calendar;
use Carbon\Carbon;

class CalendarWeekDay {
	protected $carbon;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}

	function getClassName(){
		return "day-" . strtolower($this->carbon->format("D"));
	}

	/**
	 * @return 
	 */
	function render(){
		return '<p class="day">' . $this->carbon->format("j"). '</p>';
    }

    //aタグ挿入用の年月
	public function date()
	{
		return $this->carbon->format('Y-n-d');
    }
    
}