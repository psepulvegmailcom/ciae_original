---[find]---
			$this->query('DELETE FROM '.$this->gTable('itemFile').' WHERE itemId='.$this->id);
			return true;
		}
		return false;
	}
---[replace]---
			$this->query('DELETE FROM '.$this->gTable('itemFile').' WHERE itemId='.$this->id);
//--> begin Time Clock addition
			$this->query('DELETE FROM '.$this->gTable('itemTimeClock').' WHERE itemId='.$this->id);
//<-- end Time Clock addition
			return true;
		}
		return false;
	}
	
//--> begin Time Clock addition
	function delete_time() {
	 	$table = "itemTimeClock";
		if (parent::delete("",$table)) {
			$this->query('DELETE FROM '.$this->gTable($table).' WHERE itemId='.$this->id);
			return true;
		}
		return false;
	}
//<-- end Time Clock addition	
---[find]---
            'position'          => 'NUM'
---[replace]---
//--> begin Time Clock edit
            'position'          => 'NUM',
            'itemTotalTime'		=> 'STR',
            'itemTotalTimeSec'	=> 'NUM',            
            'itemClockId'		=> 'NUM',
            'itemClockRunning'  => 'NUM'
//<-- end Time Clock edit            
---[find]---
    function pDeadline() {
---[replace]---
//--> begin Time Clock addition
    function getTimeStats($itemId,$memberId) {
     
     	// will this query work for mysql < 4.1 ?
        $sql = 'SELECT MAX(itc.itemTimeClockId) as itemClockId, MAX(itc.isClockRunning) as itemClockRunning '
	   		.'FROM '.$this->gTable('itemTimeClock').' AS itc '
			.'WHERE itc.itemId = '.$itemId.' AND itc.memberId = '.$memberId.' GROUP BY itc.itemId LIMIT 1';
		$this->getConnection();
		if ($result = $this->query($sql)) {
			if ($data = $result->rNext()) {
				$this->setNum('itemClockId',$data->itemClockId);
				$this->setNum('itemClockRunning',$data->itemClockRunning);			 	
			}   
        }
		unset($sql,$result,$data);
		
		// get total time
        $sql = 'SELECT SUM(itc.subtotalTime) as itemTotalTime '
	   		.'FROM '.$this->gTable('itemTimeClock').' AS itc '
			.'WHERE itc.itemId = '.$itemId.' GROUP BY itc.itemId LIMIT 1';
		$this->getConnection();
		if ($result = $this->query($sql)) {
			if ($data = $result->rNext()) {
				$this->setStr('itemTotalTime',$this->formatTime($data->itemTotalTime));
				$this->setStr('itemTotalTimeSec',$data->itemTotalTime);
			}   
        }
 	}
 	
//<-- end Time Clock addition

    function pDeadline() {
---[find]---
        unset($this->_properties['itemStatus']);
---[replace]---
        unset($this->_properties['itemStatus']);
//--> begin Time Clock addition
		unset($this->_properties['itemTotalTime']);
		unset($this->_properties['itemTotalTimeSec']);		
		unset($this->_properties['itemClockId']);		
		unset($this->_properties['itemClockRunning']);
//<-- end Time Clock addition
---[find]---
				$this->setAuto($data);
---[replace]---
				$this->setAuto($data);
//--> begin Time Clock addition
				$this->getTimeStats($this->id,$this->member->id);	
//<-- end Time Clock addition
---[find]---
?>
---[replace]---
//--> begin Time Clock addition
class ItemTimeClock extends TznDb
{
	function ItemTimeClock()
	{
		parent::TznDb('itemTimeClock');
		$this->addProperties(array(
			'id'				=> 'UID',
			'itemId'			=> 'NUM',
			'startTime'			=> 'DTM',
			'stopTime'			=> 'DTM',
			'subtotalTime'		=> 'NUM',
			'isClockRunning'	=> 'NUM',
			'member'			=> 'OBJ'
		));
	}
	
	function checkRights($userId, $level=0, $objTask) {
		error_log('checkin #'.$this->id.'/'.$level.' : '.$userId.' = '.$this->member->id);
        if ($userId == $this->member->id) {
            return true;
        } else if ($level) {
            $level--;
            return ($GLOBALS['confProjectRights'][$objTask->position]{$level} == '1');
		} else {
			return false;
		}
    }
    
    // begins new logged time in db
	function add() {
		$this->setDtm('startTime','NOW');
		$this->setNum('isClockRunning','1');
		return parent::add();
	}

	// inserts changed time to db
	function addChange($subtotalTime) {
		$this->setDtm('startTime','NOW');
		$this->setDtm('stopTime','NOW');
		$this->setNum('subtotalTime',$subtotalTime,1);
		$this->setNum('isClockRunning','0');
		return parent::add();
	}
	
	// stops time in db
	function update() {
		$this->setDtm('stopTime','NOW');
		$this->setNum('isClockRunning','0');

		// get values from db
		$startTime = strtotime(Tzn::_value('startTime'));
		$stopTime = strtotime(Tzn::_value('stopTime'));
	
		if ($stopTime > $startTime) {
			$subtotalTime = $stopTime - $startTime;
			$this->setNum('subtotalTime',$subtotalTime);
		}

		return parent::update();
	}
	
}
//<-- end Time Clock addition

?>