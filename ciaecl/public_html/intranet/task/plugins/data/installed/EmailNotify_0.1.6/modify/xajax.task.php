---[find]---
include PRJ_CLASS_PATH.'pkg_project.php';
---[replace]---
include PRJ_CLASS_PATH.'pkg_project.php';
include PLG_EMAIL_DIR.'include/Notify.php';
---[find]---
    return $objResponse->getXML();
}

function task_update_full($data) {
---[replace]---
		# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
		Send_Email_Notify($objTask,$objUser,1,$newStatus,$objTask->itemStatus->statusKey);
		# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
    return $objResponse->getXML();
}

function task_update_full($data) {
---[find]---
    return $objResponse->getXML();
}

function task_delete($id) {
---[replace]---
		# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
		($objTask->sameSame($objOldTask)) ? $Type = 3 : $Type = 4;
		Send_Email_Notify($objTask,$objUser,$Type,$objProject);
		# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
    return $objResponse->getXML();
}

function task_delete($id) {
---[find]---
	$objResponse->addScript('freak_body_edit()');
    $objResponse->addScriptCall('freak_message',$str);
	$objResponse->addScript('freak_stop()');
---[replace]---
	$objResponse->addScript('freak_body_edit()');
    $objResponse->addScriptCall('freak_message',$str);
	$objResponse->addScript('freak_stop()');
	# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
	Send_Email_Notify($objTask,$objUser,2,$body);
	# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
---[find]---
	return $objResponse->getXML();
}

function task_file_download($fileId) {
---[replace]---
	# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
	Send_Email_Notify($objTask,$objUser,5,$file." (".$objFile->get('filesize').")",$desc);
	# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
	return $objResponse->getXML();
}

function task_file_download($fileId) {	