<?php 

	class Date {
	function is_date($datestr) {

		if (is_string($datestr)) {

			if (substr($datestr,0,1)=="D") {

				$day 	= strtok(substr($datestr,1,strlen($datestr)),"/");
				$month 	= strtok("/");
				$year	= strtok("/");

				if (checkdate((int)$month,(int)$day,(int)$year)) {
					return(true);
				}
				return(false);
			}
			return(false);
		}
		return(false);
	}

	function datetostr($datestr) {

		if (is_date($datestr)) {
			return(substr($datestr,1,strlen($datestr)));
		}
		return(0);
	}

	function dateToWords($month, $year) {

		$string ="";

		switch ($month) {

			case 1:
				$string = $string . "Enero";
				break;
			case 2:
				$string = $string . "Febrero";
				break;
			case 3:
				$string = $string . "Marzo";
				break;
			case 4:
				$string = $string . "Abril";
				break;
			case 5:
				$string = $string . "Mayo";
				break;
			case 6:
				$string = $string . "Junio";
				break;
			case 7:
				$string = $string . "Julio";
				break;
			case 8:
				$string = $string . "Agosto";
				break;
			case 9:
				$string = $string . "Septiembre";
				break;
			case 10:
				$string = $string . "Obtubre";
				break;
			case 11:
				$string = $string . "Noviembre";
				break;
			case 12:
				$string = $string . "Diciembre";
				break;
		}

		$string = $string . ", ".$year;

		return($string);
	}

	function is_null_date($datestr) {
		if (($datestr=="D//") || ($datestr=="D00/00/0000")) {
			return(true);
		} else {
			return(false);
		}
	}

	function getYear($datestr) {
		$year 	= strtok(substr($datestr,0,strlen($datestr)),"-");
		return(strval($year));
	}
	function getMonth($datestr) {
		$month 	= strtok(substr($datestr,0,strlen($datestr)),"-");
		$day 	= strtok("-");
		return(strval($day));
	}
	function getDay($datestr) {
		$year 	= strtok(substr($datestr,0,strlen($datestr)),"-");
		$month 	= strtok("-");
		$day	= strtok("-");
		return(strval($day));
	}

	function lastDayofMonth() {

		$month 		= date("m");
		$lastDay	= 30;

		if (	$month == "01" || 
			$month == "03" || 
			$month == "05" || 
			$month == "07" || 
			$month == "08" || 
			$month == "10" || 
			$month == "12") {
				$lastDay = 31;
		}

		return($lastDay);
	}
 }
?>