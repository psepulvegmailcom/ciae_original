---[find]---
class ProjectStatsFull extends ProjectStats
{

	function ProjectStatsFull() {
		parent::ProjectStats();
		$this->addProperties(array(
			'memberCount'	=> 'NUM',
			'itemCount'		=> 'NUM'
		));
	}

    function pStatus() {
		print $this->projectStatus->getStatus();
	}
---[replace]---
class ProjectStatsFull extends ProjectStats
{

	function ProjectStatsFull() {
		parent::ProjectStats();
		$this->addProperties(array(
			'memberCount'	=> 'NUM',
			'itemCount'		=> 'NUM'
		));
	}

    function pStatus() {
		print $this->projectStatus->getStatus();
	}

//--> begin Time Clock addition	
	function pFormatTime($sec) {
	 	if ($sec > 0) {
			print $this->formatTime($sec,1);	
		}
	 	else {
			print "-";
		}
	}
	
	function pGetTime($projectId) {
		// get total time
        $sql = 'SELECT SUM(itc.subtotalTime) as itemTotalTime '
	   		.'FROM '.$this->gTable('itemTimeClock').' AS itc, '.$this->gTable('item').' as it '
			.'WHERE it.projectId = '.$projectId.' AND itc.itemId = it.itemId LIMIT 1';
		$this->getConnection();
		if ($result = $this->query($sql)) {
			if ($data = $result->rNext()) {
				$totalTime = $this->pFormatTime($data->itemTotalTime);
			}   
        }
        return $totalTime;
	}
//<-- end Time Clock addition