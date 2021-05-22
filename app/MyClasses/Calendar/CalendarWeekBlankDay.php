<?php
namespace App\Myclasses\Calendar;

/**
* 余白を出力するためのクラス
*/
class CalendarWeekBlankDay extends CalendarWeekDay {
	
    function getClassName(){
		return "day-blank";
	}

	/**
	 * @return 
	 */
	function render(){
		return '';
	}

	function ReservedOn()
	{
		return '';
	}

}