---[find]---
    /* -- Query Generator Methods  -------------------------------------- */
---[replace]---
//--> begin Time Clock addition
	// convert seconds to time format Dd HH:MM:SS
	// $inHours parameter displays time in total hours - not days
   	function formatTime($time,$in_hours=0) {
   	 
		$neg = "";
		$output = "";
     	$oneDay = 86400; //seconds
     	$oneHour = 3600;
     	$oneMin = 60;
   	 
		// if time is negative...
   	 	if ($time<0) { 
			$time = abs($time);
			$neg = "- ";
		}
   	 
		// if display in days...
		if (!$in_hours) {
			$days = floor($time / $oneDay);
			$daysInSec = $days * $oneDay;
			$time -= $daysInSec;

			$dayAbbr = $GLOBALS['langDateMore']['day'][0];
			if ($days > 0) {
				$output = $days.$dayAbbr." ";
			}
		}
		
		$hours = floor($time / $oneHour);
		$hoursInSec = $hours * $oneHour;
		$time -= $hoursInSec;
		if ($hours<10) {
			$hours = "0".$hours;
		}
		
		$mins = floor($time / $oneMin);
		$minsInSec = $mins * $oneMin;
		if ($mins<10) {
			$mins = "0".$mins;
		}
		
		$secs = $time - $minsInSec;
		if ($secs<10) {
			$secs = "0".$secs;
		}
	 	
		return $neg.$output." ".$hours.":".$mins.":".$secs;
	}
//<-- end Time Clock addition

    /* -- Query Generator Methods  -------------------------------------- */
---[find]---
    function delete($filter = null) {
    	// remove from Database
		$strSql = "DELETE FROM ".$this->gTable()." WHERE ";
		if (!empty($filter)) {
			$strSql .= $filter;
		} else if ($this->id) {
	        $strSql .= $this->getIdKey()."='".$this->id."'";
		} else {
			return false;
		}
        $this->getConnection();
        return $this->query($strSql);
    }
---[replace]---
//--> begin Time Clock edit
    function delete($filter = null,$table = null) {
    	// remove from Database
		$strSql = "DELETE FROM ".$this->gTable($table)." WHERE ";
		if (!empty($filter)) {
			$strSql .= $filter;
		} else if ($this->id) {
	        $strSql .= $this->getIdKey()."='".$this->id."'";
		} else {
			return false;
		}
        $this->getConnection();
        return $this->query($strSql);
    }
//<-- end Time Clock edit