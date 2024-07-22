<?

class resultSet {

	var $data;
	var $numTuples;
	var $currentRow;
	var $dbDriver;

	function resultSet($dbDriver){

		$this->dbDriver			 = $dbDriver;
		$this->data			 = $dbDriver->getRows();
		$this->numTuples		 = $dbDriver->numRows();
		$this->currentRow		 = 0;

	}

	function rowCount() {
		return($this->numTuples);
	}

	function getCurrentRow() {
		if (($this->numTuples)>0) {
			return($this->data[$this->currentRow]);
		}
	}

	function nextRow() {
		if (($this->currentRow) < ($this->numTuples)) {
			$this->currentRow++;
		}
	}

	function prevRow() {
		if (($this->currentRow)>0) {
			$this->currentRow--;
		}
	}

	function first() {
		$this->currentRow=0;
	}

	function last() {
		$this->currentRow=$this->numTuples;
	}

	function toArray() {
		return($this->data);
	}
}
?>
