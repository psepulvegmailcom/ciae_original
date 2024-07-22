<?php
class Calendar extends HtmlElement {

	var $className = "Calendar";
	var $name      = "";
	var $value     = "";
	var $date      = "";
	var $process   = "";
	var $level     = "";

	function Calendar($date="",$process,$level) {
		$this->date    = $date;
		$this->process = $process;
		$this->level   = $level;
	}

	function toHtml() {

		$year = date('Y', $this->date);
		$month = date('m', $this->date);
		$day = date('j', $this->date);

		$first_of_month = gmmktime(0,0,0,$month,1,$year);
		list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));

		$weekday = ($weekday + 6) % 7;

		$calendar = 
			'<table class="minicalendar">'."\n".
			'<caption class="calendar-month">'.
			'<a href="javascript:selectMonth('.mktime(0, 0, 0, $month-1, $day, $year).')"> << </a>&nbsp;&nbsp;'.
			htmlentities(ucfirst($month_name)).'&nbsp;'.$year.
			'&nbsp;&nbsp;<a href="javascript:selectMonth('.mktime(0, 0, 0, $month+1, $day, $year).')"> >> </a>'.
			'</span></caption>'."\n".'<tr class="calendar-header">'.
			'<th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th><th>S</th>'.
			"</tr>\n<tr>";
	
		if ($weekday > 0) $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>';
	
		for ($dd=1,$days_in_month=gmdate('t',$first_of_month); $dd<=$days_in_month; $dd++,$weekday++){
	
			if ($weekday == 7){
				$weekday   = 0; #start a new week
				$calendar .= "</tr>\n<tr>";
			}
	
			if ($weekday > 4) $day_class ='weekend-day';
			else $day_class = 'normal-day';
	
			if ($dd == $day)
				$calendar .= '<td class="selected-day">'.$dd.'</td>';
			else
				$calendar .= 
				  '<td class="'.$day_class.'">'.
				  '<a href="javascript:selectDay('.mktime(0, 0, 0, $month, $dd, $year).',\''.$this->process.'\','.$this->level.')">'.$dd.'</a>'.
				  '</td>';
		}

		if ($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>';
	
			$calendar .= '</tr>';

		$year_today = date('Y', time());
		$month_today = date('m', time());
		$day_today = date('j', time());

		$calendar .= '<tr><td colspan=7 align=center class=calendar-footer><a href="javascript:selectDay('.mktime(0, 0, 0, $month_today, $day_today, $year_today).',\''.$this->process.'\','.$this->level.')">TODAY</a></td></tr>';
		$calendar .= "</table><input type=hidden name='CalendarDate' value='$this->date'>\n";
	
		return($calendar);
	}
}
?>
