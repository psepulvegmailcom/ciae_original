---[find]---
	function setNum($key, $value)
	{
		$value = preg_replace(array('/[a-zA-Z]/','/ /','/,/'),'',$value);
		$this->$key = abs(intval($value));
	}
---[replace]---
//--> begin Time Clock edit
	function setNum($key, $value, $negatives = 0)
	{
		$value = preg_replace(array('/[a-zA-Z]/','/ /','/,/'),'',$value);
		if (!$negatives) {
			$this->$key = abs(intval($value));	
		}
		else { // allow for negatives
			$this->$key = intval($value);
		}
	}
//<-- end Time Clock edit