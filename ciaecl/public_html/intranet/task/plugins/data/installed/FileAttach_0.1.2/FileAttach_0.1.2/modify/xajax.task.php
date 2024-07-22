---[find]---
	switch ($what) {
---[replace]---
	switch ($what) {
	// File Attachement Plugin 
	case 'file':
		// security same as comments
		if (!$objUser->checkLevel('1')) {
			$objResponse->addAssign('vmore','innerHTML','<div id="vempty">-files are confidential-</div>');
			break;
		}
		// header design
		$str = '<table id="vfile" width="100%"><tr>'
			.'<th style="width:15px">#</th>'
			.'<th style="width:80px">filename</th>' 
			.'<th>description</th>'
			.'<th style="width:85px">upload time</th>'
			.'<th style="width:40px">size</th>'
			.'<th style="width:60px">author</th>'
			.'<th style="width:15px">x</th></tr>';
		// entry
		$objFileList = new ItemFile();
		$objFileList->addWhere('itemId='.$objTask->id);
		$objFileList->addGroup('memberId');
		$objFileList->loadList();
		if ($objFileList->rMore()) {
			while ($objFile = $objFileList->rNext()) {
				$counter++;
				$objFile->convFileSize();
				$objFile->convFileTime();
				$str .= '<tr id="vfile'.$objFile->id.'">'
					.'<td style="text-align:center; font-size:10px; padding-top:2px">'.$counter.'</td>'
					.'<td><div class="vnewaction" style="font-size:11px"><a onClick="this.blur()" href="javascript:freak_file_download('.$objFile->id.')">'
					.$objFile->filename.'</a></div></td>'
					.'<td style="font-size:10px">'.$objFile->filedesc.'</td>'
					.'<td style="text-align:center; font-size:11px">'.$objFile->postDate.'</td>'
					.'<td style="text-align:right; font-size:11px">'.$objFile->filesize.'K</td>'
					.'<td style="text-align:center; font-size:11px">'.$objFile->member->getShortName().'</div></td>'
					.'<td><div class="vaction">'
					// delete
					.'<a style="text-align:center" href="javascript:freak_file_delete('.$objFile->id.')" '
					.'onClick="this.blur(); return confirm(\'Are you sure?\')">del</a>' 
					.'</div></td></tr>';
			}
		}

		$objResponse->addAssign('vmore','innerHTML', $str);
		// add new file
		$str .= '<tr><td colspan=8><div id="vempty"><div class="vnewaction">'
			.'<a href="javascript:freak_file_add()" style="font-size:12px">'
			.'upload new file'
			.'</a></div></div></td></tr></table>';
		$objResponse->addAssign('vmore','innerHTML', $str);
		break;
---[find]---
session_start();
---[replace]---
function ajaxLoadFile($fileId,$level,&$objUser,&$objTask,&$objResponse) {
	$objResponse = new xajaxResponse();
	if (!($objUser = ajaxCheckSession($objResponse))) {
        return false;
	}
	$objFile = new ItemFile();
	$objFile->setUid($fileId);
	if ($objFile->load()) {
		$objTask = new ItemStats();
		$objTask->setUid($objFile->itemId);
		if ($objTask->load($objUser->id)) {
			if ($objFile->checkRights($objUser->id,$level,$objTask)) {
				if ($objUser->checkLevel(14) || $objTask->checkRights($objUser->id,0)) {
					return $objFile;
				}
			}
		}
	}
	return false;
}

function task_file_delete($fileId) {
	$objResponse = new xajaxResponse();
	if ($objFile = ajaxLoadFile($fileId,4,$objUser,$objTask,$objResponse)) {
		$objFile->deleteFile();
		$objResponse->addRemove('vfile'.$fileId);
		$objResponse->addScriptCall('freak_message','file deleted');
		// update icon on main panel
		$objFileList = new ItemFile();
		$objFileList->addWhere('itemId='.$objTask->id);
		$objFileList->loadList();
		if (!$objFileList->rMore()) { 
			$objResponse->addScript('hE(gE(\'fileIcon'.$objTask->id.'\'))');
		}
		else {
			$objResponse->addScript('gE(\'fileIcon'.$objTask->id.'\').title=\''.$objFileList->rTotal().' file(s)\'');
		}
	}
	else {
		$objResponse->addScriptCall('freak_message','sorry, you are not allowed to delete this file');
	}
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

function task_file_upload($taskId,$file,$desc,$tempfile) {
	$objResponse = new xajaxResponse();
	if ($objTask = ajaxLoadTask($taskId,2,true,$objUser,$objResponse)) {
		// add new file
		$objFile = new ItemFile();
		$objFile->set('filename',$file);
		$objFile->set('filedesc',$desc);
		$objFile->set('filesize',filesize(FRK_ATTACHMENT_FOLDER.$tempfile));
		$objFile->itemId = $objTask->id;
		$objFile->member->id = $objUser->id;
		// db entry
		if ($objFile->uploadFile()) {
			$objResponse->addScriptCall('freak_message','new file added');
			// rename file and remove temp
			copy(FRK_ATTACHMENT_FOLDER.$tempfile, FRK_ATTACHMENT_FOLDER.$objFile->id.".frk");
			@unlink(FRK_ATTACHMENT_FOLDER.$tempfile);
		}
	}
	ajaxLoadDetails($objTask,'file',$objResponse,$objUser);
	$objResponse->addScript('freak_body_edit()');
	$objResponse->addScript('hD(gE(\'vfedit\'))');
	// update icon on main panel
	$objResponse->addScript('sE(gE(\'fileIcon'.$taskId.'\'))');
	$objFileList = new ItemFile();
	$objFileList->addWhere('itemId='.$taskId);
	$objFileList->loadList();
	if ($objFileList->rMore()) { 
		$objResponse->addScript('gE(\'fileIcon'.$taskId.'\').title=\''.$objFileList->rTotal().' file(s)\'');
	}
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

function task_file_download($fileId) {
	$objResponse = new xajaxResponse();
	if ($objFile = ajaxLoadFile($fileId,4,$objUser,$objTask,$objResponse)) {
		$_SESSION['fp_fileId'] = $fileId;
		$objResponse->addScriptCall('freak_message','loading file');
		$objResponse->addScript('gE(\'vfdownload\').src = \'files.php\'');
	}
	else {
		$objResponse->addScriptCall('freak_message','sorry, you are not allowed to download this file');
	}
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

session_start();
---[find]---
$xajax->registerFunction("task_update_comment");
---[replace]---
$xajax->registerFunction("task_update_comment");
$xajax->registerFunction("task_file_upload");
$xajax->registerFunction("task_file_delete");
$xajax->registerFunction("task_file_download");