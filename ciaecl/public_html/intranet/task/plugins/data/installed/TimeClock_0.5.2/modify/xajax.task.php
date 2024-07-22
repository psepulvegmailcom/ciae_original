---[find]---
	case 'hist':
---[replace]---
//--> begin Time Clock addition
	case 'time': // time tab
		$str = '<table id="vhist"><tr>'
			.'<th>'.$GLOBALS['langTaskDetails']['time_user'].'</th>'
			.'<th>'.$GLOBALS['langTaskDetails']['time_days'].'</th>'			
			.'<th>'.$GLOBALS['langTaskDetails']['time_hours'].'</th></tr>';
		$objClockList = new ItemTimeClock();
		$objClockList->addWhere('itemId='.$objTask->id);
		$objClockList->addGroup('memberId');
		$objClockList->loadList();
		while ($objClock = $objClockList->rNext()) {
		 	if (!$objClock->subtotalTime==0) {
				$user_time[$objClock->member->id]['total'] += $objClock->subtotalTime;
				$user_time[$objClock->member->id]['output'] = '<tr>'
					.'<td>'.$objClock->member->getName().'</td>'
					.'<td>'.$objClock->formatTime($user_time[$objClock->member->id]['total']).'</td>'
					.'<td>'.$objClock->formatTime($user_time[$objClock->member->id]['total'],1).'</td></tr>';
			}
		}
		if (count($user_time)!=0) {
			arsort($user_time);
			foreach ($user_time as $key => $val) {
				$str .= $val['output'];
			}
		}
		else {
			$str .= "<tr><td>-</td><td>-</td><td>-</td></tr>";
		}
		$str .= '</table>';
		$objResponse->addAssign('vmore','innerHTML', $str);
		break;		
//<-- end Time Clock addition 		
	case 'hist':
---[find]---
	case 'hist':
		$objStatusList = new ItemStatus();
		$objStatusList->addWhere('itemId='.$objTask->id);
		$objStatusList->addOrder('statusDate ASC');
		$objStatusList->loadList();
		$str = '<table id="vhist"><tr>'
			.'<th>'.$GLOBALS['langTaskDetails']['history_date'].'</th>'
			.'<th>'.$GLOBALS['langTaskDetails']['history_user'].'</th>'
			.'<th>'.$GLOBALS['langTaskDetails']['history_what'].'</th></tr>';
		while ($objStatus = $objStatusList->rNext()) {
			$str .= '<tr><td>'.$objStatus->getDtm('statusDate','SHT',$objUser->timeZone).'</td>'
				.'<td>'.$objStatus->member->getName().'</td>'
				.'<td>'.$GLOBALS['langItemStatus'][$objStatus->statusKey].'</td></tr>';
		}
---[replace]---
	case 'hist':
		$objStatusList = new ItemStatus();
		$objStatusList->addWhere('itemId='.$objTask->id);
		$objStatusList->addOrder('statusDate ASC');
		$objStatusList->loadList();
//--> begin Time Clock edit		
		$str = '<table id="vhist"><tr>'
			.'<th>'.$GLOBALS['langTaskDetails']['history_date'].'</th>'
			.'<th>'.$GLOBALS['langTaskDetails']['history_user'].'</th>'
			.'<th>'.$GLOBALS['langTaskDetails']['history_what'].'</th></tr>';
		while ($objStatus = $objStatusList->rNext()) {
			$hist[$objStatus->statusDate] .= '<tr><td>'.$objStatus->getDtm('statusDate','SHT',$objUser->timeZone).'</td>'
				.'<td>'.$objStatus->member->getName().'</td>'
				.'<td>'.$GLOBALS['langItemStatus'][$objStatus->statusKey].'</td></tr>';
		}
		//get logged time
		$objClockList = new ItemTimeClock();
		$objClockList->addWhere('itemId='.$objTask->id);
		$objClockList->addOrder('startTime ASC');
		$objClockList->loadList();
		while ($objClock = $objClockList->rNext()) {
		 	if (!$objClock->subtotalTime==0) {
				$hist[$objClock->startTime] .= '<tr><td>'.$objClock->getDtm('startTime','SHT',$objUser->timeZone).'</td>'
					.'<td>'.$objClock->member->getName().'</td>'
					.'<td>'.$objClock->formatTime($objClock->subtotalTime).'</td></tr>';
			}
		}
		// sort history by date
		ksort($hist);
		foreach ($hist as $key => $val) {
			$str .= $val;
		}
//<-- end Time Clock edit
---[find]---
function task_load_edit($id) {
---[replace]---
//--> begin Time Clock addition
function ajaxLoadTaskClock($id,$level,&$objUser,&$objTask,&$objResponse) {
	$objResponse = new xajaxResponse();
	if (!($objUser = ajaxCheckSession($objResponse))) {
        return false;
	}
	$objClock = new ItemTimeClock();
	$objClock->setUid($id);
	if ($objClock->load()) {
		$objTask = new ItemStats();
		$objTask->setUid($objClock->itemId);
		if ($objTask->load($objUser->id)) {
			if ($objClock->checkRights($objUser->id,$level,$objTask)) {
				if ($objUser->checkLevel(14) || $objTask->checkRights($objUser->id,8,true)) {
					return $objClock;
				}
			}
		}
	}
	return false;
}
//<-- end Time Clock addition

function task_load_edit($id) {
---[find]---
			$objResponse->addScriptCall('freak_edit_select','status',$objTask->itemStatus->statusKey);
			 */
			task_load_users_inside($objTask->project->id,$objUser,$objResponse);
			$objResponse->addScriptCall('freak_edit_select','user',$objTask->member->id);
---[replace]---
			$objResponse->addScriptCall('freak_edit_select','status',$objTask->itemStatus->statusKey);
			 */
			task_load_users_inside($objTask->project->id,$objUser,$objResponse);
			$objResponse->addScriptCall('freak_edit_select','user',$objTask->member->id);
//--> begin Time Clock addition
			$dayAbbr = $GLOBALS['langDateMore']['day'][0];
			$objResponse->addScriptCall('freak_edit_time','time[]',$objTask->itemTotalTime,$dayAbbr);
//<-- end Time Clock addition
---[find]---
    $objResponse->addScript('freak_stop()');

    return $objResponse->getXML();
}

function task_delete($id) {
---[replace]---
//--> begin Time Clock addition
    // time
    $timeAction = $data['time'][0]; // time_delete or time_change
    if (strcmp($timeAction,"time_change")==0) {
		// get changed time from form, convert to seconds
		$newTime = $data['t_days'] * 86400;
		$newTime += $data['t_hours'] * 3600;
		$newTime += $data['t_mins'] * 60;
		$newTime += $data['t_secs'];
		
		// get current total time
		$currentTime = $objTask->itemTotalTimeSec;
		
		// compare new time to current time
		$difference = $newTime - $currentTime;
		
		if ($difference!=0) {
			// add difference to db
			task_clock_change($objTask->id,$difference);
			$newTotalTime = $difference + $currentTime; 
			// update total time
			$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML',$objTask->formatTime($newTotalTime));
			$objResponse->addAssign('itemTotalTimeSec'.$objTask->id,'value',$newTotalTime);
		}
	}
    elseif (strcmp($timeAction,"time_delete")==0) {
		// delete times from db
		task_delete_time($objTask->id);
		//update total time
		$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML',"-");
	}
//<-- end Time Clock addition     

    $objResponse->addScript('freak_stop()');

    return $objResponse->getXML();
}

function task_delete($id) {
---[find]---
function task_comment_edit($id) {
---[replace]---
//--> begin Time Clock addition
function task_delete_time($id) {
    $objResponse = new xajaxResponse();
    if ($objTask = ajaxLoadTask($id,9,false,$objUser,$objResponse)) {
       // $objTask->delete_time();     
     	if ($objTask->delete_time()) {
			$objResponse->addAssign('itemClockId'.$objTask->id,'value','0');
			$objResponse->addAssign('itemClockRunning'.$objTask->id,'value','0');
			$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML','-');			
			$objResponse->addAssign('itemTotalTimeSec'.$objTask->id,'value','0');
	        $objResponse->addScriptCall('freak_message',$GLOBALS['langMessage']['done_deleted']);
	    }
    } else {
        $objResponse->addScriptCall('freak_error',$GLOBALS['langMessage']['not_found_or_denied']);
    }
    $objResponse->addScript('freak_stop()');
    return $objResponse->getXML();
}
//<-- end Time Clock addition

function task_comment_edit($id) {
---[find]---
session_start();
---[replace]---
//--> begin Time Clock addition
function task_clock_start($taskId,$clockId=0,$timerStart) {
	$objResponse = new xajaxResponse();
	$str = $GLOBALS['langMessage']['operation_failed'];

	if ($objUser = ajaxCheckSession($objResponse)) {
		if ($objTask = ajaxLoadTask($taskId,2,true,$objUser,$objResponse)) {
			// add new clock
			$objClock = new ItemTimeClock();
			$objClock->itemId = $objTask->id;
			$objClock->member->id = $objUser->id;
			if ($objClock->add()) {
				$str = $GLOBALS['langMessage']['clock_start'];
				$dayAbbr = $GLOBALS['langDateMore']['day'][0];
				$objResponse->addAssign('itemClockId'.$objTask->id,'value',$objClock->id);
				$objResponse->addAssign('itemClockRunning'.$objTask->id,'value','1');
				$objResponse->addAssign('itemTotalTimeSec'.$objTask->id,'value',$timerStart);
				$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML',"<div id='etimer".$objTask->id."'>".$objStats->itemTotalTime."</div>");			
				$objResponse->addScript('freak_timer('.$timerStart.',"etimer'.$objTask->id.'","'.$dayAbbr.'")');				
			}
		}
	}
    $objResponse->addScriptCall('freak_message',$str);
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

function task_clock_stop($id,$clockId=0) {
	$objResponse = new xajaxResponse();
	$str = $GLOBALS['langMessage']['operation_failed'];

	if ($clockId && ($objClock = ajaxLoadTaskClock($clockId,3,$objUser,$objTask,$objResponse))) {
		if ($objClock->update()) {
			$str = $GLOBALS['langMessage']['clock_stop'];
			$objResponse->addAssign('itemClockId'.$objTask->id,'value',$objClock->id);
			$objResponse->addAssign('itemClockRunning'.$objTask->id,'value','0');
		    $objStats = new ItemStats();
			$objStats->setUid($id);
			if ($objStats->load($objUser->id)) {
				$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML',$objStats->itemTotalTime);			
				$objResponse->addAssign('itemTotalTimeSec'.$objTask->id,'value',$objStats->itemTotalTimeSec);
			}
		}
	} 
    $objResponse->addScriptCall('freak_message',$str);
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

function task_clock_timer_restart($id,$clockId,$totalTime) {
	$objResponse = new xajaxResponse();
	$str = $GLOBALS['langMessage']['clock_start'];

	if ($clockId && ($objClock = ajaxLoadTaskClock($clockId,3,$objUser,$objTask,$objResponse))) {
		$currentTime = gmdate("U"); 
		$offset = date("Z");
		$startTime = strtotime($objClock->startTime);
		$startTime += $offset;
		if ($currentTime > $startTime) {
			$approxSubtotal = $currentTime - $startTime;
			$approxTotal = $totalTime + $approxSubtotal;
			$dayAbbr = $GLOBALS['langDateMore']['day'][0];
			$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML',"<div id='etimer".$objTask->id."'></div>");			
			$objResponse->addScript('freak_timer('.$approxTotal.',"etimer'.$id.'","'.$dayAbbr.'")');				
		}
	} 
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

// function for manual time change
function task_clock_change($taskId,$subtotalTime) {
	$objResponse = new xajaxResponse();
	$str = $GLOBALS['langMessage']['operation_failed'];
	if ($objUser = ajaxCheckSession($objResponse)) {
		if ($objTask = ajaxLoadTask($taskId,2,true,$objUser,$objResponse)) {
			// add new clock
			$objClock = new ItemTimeClock();
			$objClock->itemId = $objTask->id;
			$objClock->member->id = $objUser->id;
			if ($objClock->addChange($subtotalTime)) {
				$str = $GLOBALS['langMessage']['clock_change'];
				$objResponse->addAssign('itemClockId'.$objTask->id,'value',$objClock->id);
				$objResponse->addAssign('itemClockRunning'.$objTask->id,'value','0');
			    $objStats = new ItemStats();
				$objStats->setUid($id);
				if ($objStats->load($objUser->id)) {
					$objResponse->addAssign('etimeTotal'.$objTask->id,'innerHTML',$objStats->itemTotalTime);			
					$objResponse->addAssign('itemTotalTimeSec'.$objTask->id,'value',$objStats->itemTotalTimeSec);
				}
			}
		} 
	}
    $objResponse->addScriptCall('freak_message',$str);
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

//<-- end Time Clock addition

session_start();
---[find]---
$xajax->registerFunction("task_update_comment");
---[replace]---
$xajax->registerFunction("task_update_comment");
//--> begin Time Clock addition
$xajax->registerFunction("task_clock_start");
$xajax->registerFunction("task_clock_stop");
$xajax->registerFunction("task_clock_timer_restart");
$xajax->registerFunction("task_delete_time");
$xajax->registerFunction("task_clock_change");
//<-- end Time Clock addition