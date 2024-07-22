---[find]---
?>
---[replace]---
class ItemFile extends TznDb
{
	function ItemFile()
	{
		parent::TznDb('itemFile');
		$this->addProperties(array(
			'id'					=> 'UID',
			'itemId'			=> 'NUM',
			'member'			=> 'OBJ',
			'filename'		=> 'STR',
			'filedesc'		=> 'BBS',
			'filesize'		=> 'NUM',
			'postDate'		=> 'DTM',
		));
	}

	function convFileSize() {
		$calc = $this->filesize / 1024;
		$calc = number_format($calc, 0, '', ' ');
		$this->filesize = $calc;
	}
	
	function convFileTime() {
		$time = $this->getDtm('postDate','SHT',$objUser->timeZone);
		$this->postDate = $time;
	}

	function deleteFile() {
	 	$table = "itemFile";
		if (parent::delete("",$table)) {
			$this->query('DELETE FROM '.$this->gTable($table).' WHERE itemFileId='.$this->id);
			@unlink(FRK_ATTACHMENT_FOLDER.$this->id.".frk");
			return true;
		}
		return false;
	}

	function uploadFile() {
		$this->setDtm('postDate','NOW');
		return parent::add();
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

}
?>