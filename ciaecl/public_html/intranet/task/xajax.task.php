<?php 
/****************************************************************************\
* TaskFreak!                                                                 *
* multi user                                                                 *
******************************************************************************
* Version: 0.6.1                                                             *
* Authors: Stan Ozier <taskfreak@gmail.com>                                  *
* License:  http://www.gnu.org/licenses/gpl.txt (GPL)                        *
******************************************************************************
* This file is part of "TaskFreak! multi user" program.                      *
*                                                                            *
* TaskFreak! multi user is free software; you can redistribute it and/or     *
* modify it under the terms of the GNU General Public License as published   *
* by the Free Software Foundation; either version 2 of the License, or (at   *  
* your option) any later version.                                            *
*                                                                            *
* TaskFreak! multi user is distributed in the hope that it will be           *
* useful, but WITHOUT ANY WARRANTY; without even the implied warranty of     *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the              *
* GNU General Public License for more details.                               *
*                                                                            *
* You should have received a copy of the GNU General Public License          *
* along with this program; if not, write to the Free Software                *
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA *
\****************************************************************************/

include './_include.php';

define('FRK_LANGUAGE',FRK_DEFAULT_LANGUAGE);

include PRJ_CLASS_PATH.'tzn_generic.php';
include PRJ_CLASS_PATH.TZN_DB_CLASS;
include PRJ_CLASS_PATH.'tzn_user.php';
include PRJ_CLASS_PATH.'pkg_member.php';
include PRJ_CLASS_PATH.'pkg_project.php';
include PLG_EMAIL_DIR.'include/Notify.php';

function ajaxCheckSession(&$objResponse) {
    $objUser = new Member();
    if ($objUser->isLogged()) {
        // already logged in
    } else if ($objUser->checkAutoLogin()) {
        // session timeout but auto logged in
    } else {
        include PRJ_INCLUDE_PATH.'language/'.FRK_LANGUAGE.'/freak.php';
        $_SESSION['tznMessage'] = $GLOBALS['langMessage']['session_expired'];
        $objResponse->addRedirect('login.php');
        return false;
    }
    include PRJ_INCLUDE_PATH.'language/'.FRK_LANGUAGE.'/common.php';
    include PRJ_INCLUDE_PATH.'language/'.FRK_LANGUAGE.'/freak.php';
    include PRJ_INCLUDE_PATH.'language/'.FRK_LANGUAGE.'/options.php';
    define('FRK_SKIN_FOLDER',FRK_DEFAULT_SKIN_FOLDER);
    return $objUser;
}

function ajaxLoadTask($id,$level,$userCanToo,&$objUser,&$objResponse) {
    $objResponse = new xajaxResponse();
    if (!($objUser = ajaxCheckSession($objResponse))) {
        return false;
    }

    $objTask = new ItemStats();
	$objTask->setUid($id);
	if ($objTask->load($objUser->id)) {
		//error_log('task loaded:'.$id.', user '.$objUser->id.' has position '.$objTask->position);
        if ($objUser->checkLevel(13) || $objUser->checkLevel(14) || $objTask->checkRights($objUser->id,$level,$userCanToo)) {
            return $objTask;
        }
    }
    $objResponse->addScriptCall('freak_error',$GLOBALS['langMessage']['not_found_or_denied']);
    return false;
}

function ajaxLoadTaskComment($id,$level,&$objUser,&$objTask,&$objResponse) {
	$objResponse = new xajaxResponse();
	if (!($objUser = ajaxCheckSession($objResponse))) {
        return false;
	}
	$objComment = new ItemComment();
	$objComment->setUid($id);
	if ($objComment->load()) {
		$objTask = new ItemStats();
		$objTask->setUid($objComment->itemId);
		if ($objTask->load($objUser->id)) {
			if ($objComment->checkRights($objUser->id,$level,$objTask)
				|| $objUser->checkLevel(14)
				|| $objTask->checkRights($objUser->id,0)) 
			{
				return $objComment;
			}
		}
	}
	return false;
}

function ajaxLoadDetails($objTask,$what,&$objResponse,$objUser=null) {
	$str = '';
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
			.'<th style="width:160px">filename</th>' 
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
	case 'desc':
		if ($objTask->description) {
			$str = $objTask->getDescription();	
		} else {
			$str = '<div id="vempty">-'.$GLOBALS['langTaskDetails']['description_none'].'-</div>';
		}
		$objResponse->addAssign('vmore','innerHTML', $str);
		break;
	case 'comm':
		if (!$objTask->checkRights($objUser->id,1,true)) {
			$objResponse->addAssign('vmore','innerHTML','<div id="vempty">-'.$GLOBALS['langTaskDetails']['comments_no_access'].'-</div>');
			break;
		}
		$objCommentList = new ItemComment();
		$objCommentList->addWhere('itemId='.$objTask->id);
		$objCommentList->addOrder('postDate '.(@defined('FRK_DEFAULT_COMMENT_ORDER')?FRK_DEFAULT_COMMENT_ORDER:'ASC'));
		$objCommentList->loadList();
		if ($objCommentList->rMore()) {
			while ($objComment = $objCommentList->rNext()) {
				$str .= '<div id="vcomm'.$objComment->id.'">'
					.'<div class="vheader">'
					.'<div class="vaction">';
				if ($objTask->checkRights($objUser->id,2,true)) {
					$str .= '<a href="javascript:freak_comment_reply()">'
						.$GLOBALS['langTaskDetails']['comments_reply'].'</a>';
				} else {
					$str .= $GLOBALS['langTaskDetails']['comments_reply'].'</a>';
				}
				$str .= ' | ';
				if ($objComment->checkRights($objUser->id,3,$objTask)) {
					$str .= '<a href="javascript:freak_comment_edit('.$objComment->id.')">'
						.$GLOBALS['langTaskDetails']['comments_edit'].'</a>';
				} else {
					$str .= $GLOBALS['langTaskDetails']['comments_edit'];
				}
				$str .= ' | ';
				if ($objComment->checkRights($objUser->id,4,$objTask)) {
					$str .='<a href="javascript:freak_comment_delete('.$objComment->id.')" '
					.'onClick="return confirm(\''.$GLOBALS['langTaskDetails']['comments_delete_confirm'].'\')">'
					.$GLOBALS['langTaskDetails']['comments_delete'].'</a>';
				} else {
					$str .= $GLOBALS['langTaskDetails']['comments_delete'];
				}
				$str .= '</div>'
					.$objComment->getDtm('postDate','SHT').' '
					.$GLOBALS['langTaskDetails']['comments_by']
					.' '.$objComment->member->getName().'</div>'
					.'<div class="vbody">'.$objComment->f('body').'</div></div>';
			}
			$objResponse->addAssign('vmore','innerHTML', $str);
			$objResponse->addAssign('ecomm'.$objTask->id,'innerHTML',"<b><font style=' font-size:15px;background-color:#8F9BA1; padding:3px'> ".$objCommentList->rTotal()." </font></b>");
			if ((!defined('FRK_DEFAULT_COMMENT_ORDER')) || (@constant('FRK_DEFAULT_COMMENT_ORDER') == 'ASC')) {
				$objResponse->addScript('freak_more_scroll()');
			}
		} else {
			$str .= '<div id="vempty">-'.$GLOBALS['langTaskDetails']['comments_none'].'-';
			if ($objTask->checkRights($objUser->id,2,true)) {
				$str .= '<div class="vnewaction"><a href="javascript:freak_body_edit(true)">'
					.$GLOBALS['langTaskDetails']['comments_new'].'</a></div></div>';
			}
			$objResponse->addAssign('vmore','innerHTML', $str);
			$objResponse->addAssign('ecomm'.$objTask->id,'innerHTML','0');
		}
		break;
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
		$str .= '</table>';
		$objResponse->addAssign('vmore','innerHTML', $str);
		break;
	}
}


//--> begin Time Clock addition
function ajaxLoadTaskClock($id,$level,&$objUser,&$objTask,&$objResponse) {
	$objResponse = new xajaxResponse();
	if (!($objUser = ajaxCheckSession($objResponse))) {
        return false;
	}
	$objClock = new ItemTimeClock();
	
	$objClock->setUid(str_replace(',','',$id)); 
	
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
	$objResponse = new xajaxResponse();

	if ($id) {
		// loading task
		if ($objTask = ajaxLoadTask($id,7,false,$objUser,$objResponse)) {
			ob_start();
			include PRJ_INCLUDE_PATH.'html/xajax_panel_edit.php';
			$str = ob_get_contents(); 
			ob_clean();
			$objResponse->addScriptCall('freak_edit_text','id',$objTask->id);
			$objResponse->addAssign('fviewcontent','innerHTML',$str);
			/*
			$objResponse->addScriptCall('freak_edit_select','priority',$objTask->priority);
			if (@constant('FRK_CONTEXT_ENABLE')) {
			}
			$objResponse->addScriptCall('freak_edit_text','deadlineDate',$objTask->getDte('deadlineDate',SHT));
			$objResponse->addScriptCall('freak_edit_text','title',$objTask->title);
			$objResponse->addScriptCall('freak_edit_text','description',$objTask->description);
			$objResponse->addScriptCall('freak_edit_select','project',$objTask->project->id);
			$objResponse->addScriptCall('freak_edit_privacy',$objTask->showPrivate);
			task_load_users_inside($objTask->project->id,$objUser,$objResponse);
			$objResponse->addScriptCall('freak_edit_select','user',$objTask->member->id);
			$objResponse->addScriptCall('freak_edit_select','status',$objTask->itemStatus->statusKey);
			 */
			task_load_users_inside($objTask->project->id,$objUser,$objResponse);  
			$objResponse->addScriptCall('freak_edit_select','user',$objTask->member->id);
//--> begin Time Clock addition
			$dayAbbr = $GLOBALS['langDateMore']['day'][0];
			$objResponse->addScriptCall('freak_edit_time','time[]',$objTask->itemTotalTime,$dayAbbr);
//<-- end Time Clock addition
			$objResponse->addScript('Calendar.setup({});');
			$objResponse->addScript('hD(gE("fviewload"))');
			$objResponse->addScript('sD(gE("fviewcontent"))');
		} else {
			$objResponse->addScriptCall('freak_message',$GLOBALS['langMessage']['not_found_or_denied']);
		}
	} else if ($objUser = ajaxCheckSession($objResponse)) {
		// form to create new task
		$objTask = new Item();
		if ($_SESSION['linkItems']) {
			preg_match('/sProject=([0-9]+)&/',$_SESSION['linkItems'],$matches);
			$objTask->project->id = $matches[1];
		}
		ob_start();
		include PRJ_INCLUDE_PATH.'html/xajax_panel_edit.php';
		$str = ob_get_contents(); 
		ob_clean();
		$objResponse->addScriptCall('freak_edit_text','id','0');
		$objResponse->addAssign('fviewcontent','innerHTML',$str);
		task_load_users_inside(0,$objUser,$objResponse);
		$objResponse->addScriptCall('freak_edit_select','user',$objUser->id);
		$objResponse->addScript('Calendar.setup({});');
		$objResponse->addScript('hD(gE("fviewload"))');
		$objResponse->addScript('sD(gE("fviewcontent"))');
	}
	$objResponse->addScript('freak_label()');
	$objResponse->addScript('freak_stop()');
	$objResponse->addScript('document.forms[0].priority.focus()');

    return $objResponse->getXML();
}

function task_load_view($id,$tab='desc') {

    $objResponse = new xajaxResponse();

    if ($objTask = ajaxLoadTask($id,0,false,$objUser,$objResponse)) {
		// -todo- show private status
		ob_start();
		include PRJ_INCLUDE_PATH.'html/xajax_panel_view.php';
		$str = ob_get_contents();
		ob_clean();
		$objResponse->addScriptCall('freak_edit_text','id',$objTask->id);
		$objResponse->addAssign('fviewcontent','innerHTML',$str);
		$tab = ($tab)?$tab:'desc';
		$objResponse->addScriptCall('freak_tab',$tab);
		ajaxLoadDetails($objTask,$tab,$objResponse,$objUser);


        if ($objUser->checkLevel(14) || $objTask->checkRights($objUser->id,7)) {
            // can edit
            $objResponse->addScript('sD(gE("fviewedit"))');
        } else {
            $objResponse->addScript('hD(gE("fviewedit"))');
        }
        if ($objUser->checkLevel(14) || $objTask->checkRights($objUser->id,9)) {
            // can delete
            $objResponse->addScript('sD(gE("fviewdelete"))');
        } else {
            $objResponse->addScript('hD(gE("fviewdelete"))');
        }
	}
	$objResponse->addScript('hD(gE("fviewload"))');
	$objResponse->addScript('sD(gE("fviewcontent"))');
	$objResponse->addScript('freak_stop()');
    
    return $objResponse->getXML();

}

function task_load_more($id,$what) {
    $objResponse = new xajaxResponse();

	if ($objTask = ajaxLoadTask($id,0,false,$objUser,$objResponse)) {
		ajaxLoadDetails($objTask,$what,$objResponse,$objUser);
	}

    $objResponse->addScript('freak_stop()');
    
    return $objResponse->getXML();
}

function task_load_users($projectId) {

	$objResponse = new xajaxResponse();

    if ($objUser = ajaxCheckSession($objResponse)) {

        task_load_users_inside($projectId,$objUser,$objResponse);
        $objResponse->addScriptCall('freak_mp_default','');

    }
	$objResponse->addScript('freak_stop()');
    
    return $objResponse->getXML();
}

function task_load_users_inside($projectId,$objUser,&$objResponse) 
{
    $objResponse->addScript('freak_mp_reset()');
    if ($projectId) {
        $objMemberList = new MemberProject();
        $objMemberList->addWhere($objMemberList->gTable().".projectId='".intval($projectId)."'");
        $objMemberList->addOrder('level DESC, firstName ASC');
        $objMemberList->loadList();

        if ($objMemberList->rMore()) {
            while ($objItem = $objMemberList->rNext()) {
                $objResponse->addScriptCall('freak_mp_add',$objItem->member->id,$objItem->member->getName());
            }	
        }
    } else {
        $objMemberList = new Member();
        if (!$objUser->checkLevel(1)) {
            $objMemberList->addWhere($objMemberList->gTable().'.memberId='.$objUser->id);
        }
        $objMemberList->loadList();
        if ($objMemberList->rMore()) {
            while ($objItem = $objMemberList->rNext()) {
                $objResponse->addScriptCall('freak_mp_add',$objItem->id,$objItem->getName());
            }
        }
    }
    
}

function task_update_status($id,$status) 
{
    $objResponse = new xajaxResponse();
    if ($objTask = ajaxLoadTask($id,8,true,$objUser,$objResponse)) {
        $newStatus = intval($status);
        if ($newStatus != $objTask->itemStatus->statusKey) {
            $objTask->setStatus($newStatus,$objUser->id);
			if ($newStatus == FRK_STATUS_LEVELS) {
				// task is completed
				if (@constant('FRK_COMPLETE_DEADLINE') == TRUE) {
					// update deadline to current date
					$objTask->setDte('deadlineDate','NOW');
					$objTask->update('deadlineDate');
				}
			}
			if (!@constant('FRK_DEFAULT_NO_DEADLINE_KEEP') && ($newStatus == FRK_STATUS_LEVELS)) {
				// completed task should disapear from task list view
	        	$objResponse->addScriptCall('freak_del_remove',$id);
            } else {
                // show new status
                for ($i = 0; $i < FRK_STATUS_LEVELS; $i++) {
                    $j = ($i < $newStatus)?(FRK_STATUS_LEVELS - $i):0;
                    $objResponse->addAssign('est'.($i+1).$objTask->id,'className','sts'.$j);
                }
                // update date?
                if (($newStatus == FRK_STATUS_LEVELS) && (@constant('FRK_COMPLETE_DEADLINE') == TRUE)) {
                	$objResponse->addAssign('edead'.$objTask->id,'innerHTML',$objTask->getDeadline(true));
                }
            }

            $objResponse->addScriptCall('freak_message',$GLOBALS['langMessage']['done_status']);
        }
    }
    $objResponse->addScript('freak_stop()');
		# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
		Send_Email_Notify($objTask,$objUser,1,$newStatus,$objTask->itemStatus->statusKey);
		# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
    return $objResponse->getXML();
}

function task_update_full($data) 
{

    $objResponse = new xajaxResponse();

    if (!($objUser = ajaxCheckSession($objResponse))) {
        return false;
    }

    $objTask = new ItemStats();
	$objTask->setUid($data['id']);
	if ($objTask->load($objUser->id)) {
        $objOldTask = $objTask->cloneme();
        $pUserCanEdit = ($objUser->checkLevel(14) || $objTask->checkRights($objUser->id,7));
    }

    $objTask->setAuto($data,null,'_setDirect');

    // project
    $objProject = new Project();

    if ($objUser->checkLevel(7) && $data['project2']) {
        
        // create new project on the fly
        $objProject->set('name',$data['project2']);
        $objProject->add(0,$objUser->id);
        //$objResponse->addScript('freak_rld()');
        
        // update project list
        $link = Tzn::concatUrl($_SESSION['linkItems'],'sProject='.$objProject->id);
        $link = Tzn::concatUrl($link,'show=');
        if ($objTask->isLoaded() && $pUserCanEdit) {
            $objResponse->addScriptCall('freak_edit_add_project',
                $objProject->id,$objProject->name,$link,$GLOBALS['langMenu']['future_tasks'],
                $GLOBALS['langMenu']['past_tasks'],$GLOBALS['langMenu']['all_tasks']);
        }

        // associate task to new project
        $objTask->project =& $objProject;


    } else if ($tmpId = intval($data['project'])) {

        $pCanAddTask = false;
        if ($objUser->checkLevel(8)) {
            // user is administrator
            $objProject->setUid($tmpId);
            if ($objProject->load()) {
                $pCanAddTask = true;
            }
        } else {
            // user is not administrator
            // need to check rights to access project
            $objMemberProject = new MemberProject();
            if ($objMemberProject->loadPosition($tmpId,$objUser->id))
            {
                $pCanAddTask = $objMemberProject->checkRights(6);
                $objProject =& $objMemberProject->project;
            }
        }

        if ($pCanAddTask) {
            // associate to existing project
            $objTask->project =& $objProject;
        }

    } else {

        // no project
        $objTask->project->name = '-';
        $objTask->project->id = 0;
    }

    // user(s)
    $objMember = new Member();
    $objTask->member =& $objMember;
    if ($tmpId = intval($data['user'])) {
        $objMember->setUid($tmpId);
        $objMember->load();
    }
	//time
	if(isset($data['time'][0]))
	{
		if($data['time'][0] == 'time_change')
		{
			$objTime = new Item();
			$objTime->setUid($data['id']);	
			$objTime->delete_time();
			
			$objTime = new ItemTimeClock();
			$objTime->setNum('itemId',$data['id']);
			
			$objTime->setObj('member',$data['user']);
			$subtotalTime = 60*($data['t_mins']+60*($data['t_hours']+$data['t_days']*24))+$data['t_secs'];			
			$objTime->addChange($subtotalTime);			
		}
		else
			if($data['time'][0] == 'time_delete')
			{
				$objTime = new Item();
				$objTime->setUid($data['id']);	
				$objTime->delete_time();
			}
	}
	
    // status
	$newStatus = intval($data['status']);
    $oldStatus = -1;
    
    // update DB (if compulsory fields ok)
    if ($objTask->check()) {

        if ($objTask->isLoaded() && $pUserCanEdit) {
            
            // update database
            $objTask->update();
            $pMessage = $langMessage['done_updated'];
            
            // check status changes
            $oldStatus = intval($objOldTask->itemStatus->statusKey);

            if ($objTask->sameSame($objOldTask)) {
                // update list (dynamic)
                /*
                $objResponse->addAssign('eprio'.$objTask->id,'innerHTML','<span class="pr'.$objTask->priority
                    .'" title="'.$_GLOBALS['arrPriorities'][$objItem->priority].'">'.$objTask->priority.'</span>');
                if (@constant('FRK_CONTEXT_ENABLE')) {
                    $objResponse->addAssign('ectxt'.$objTask->id,'innerHTML',$objTask->getContext(@constant('FRK_CONTEXT_LONG')));
                }
                */
                $objResponse->addAssign('eproj'.$objTask->id,'innerHTML',$objTask->project->get('name','-'));
                $strTitle = $objTask->get('title');
                if ($objTask->description) {
                    $strTitle .= '<img src="skins/'.FRK_SKIN_FOLDER
                        .'/images/desc.png" width="16" height="16" align="absmiddle" border="0" alt="" />';
                }
                switch ($objTask->showPrivate) {
                    case 1:
                        $strTitle .= '<img src="skins/'.FRK_SKIN_FOLDER
                            .'/images/priv1.png" width="12" height="16" align="absmiddle" border="0" alt="" />';
                        break;
                    case 2:
                        $strTitle .= '<img src="skins/'.FRK_SKIN_FOLDER
                            .'/images/priv2.png" width="12" height="16" align="absmiddle" border="0" alt="" />';
                        break;
                }
                $objResponse->addAssign('ectxt'.$objTask->id,'innerHTML',$objTask->getContext(@constant('FRK_CONTEXT_LONG')));
                $objResponse->addAssign('etitl'.$objTask->id,'innerHTML',$strTitle);
                $objResponse->addAssign('euser'.$objTask->id,'innerHTML',$objTask->member->getShortName('-'));
                /*
                $objResponse->addAssign('edead'.$objTask->id,'innerHTML',$objTask->member->getDeadline());
                */

                for ($i = 0; $i < FRK_STATUS_LEVELS; $i++) {
                    $j = ($i < $newStatus)?(FRK_STATUS_LEVELS - $i):0;
                    $objResponse->addAssign('est'.($i+1).$objTask->id,'className','sts'.$j);
                }

                // -TODO- remove task if not in context or project
                // -TODO- resort list

                $objResponse->addScriptCall('freak_message',$GLOBALS['langMessage']['done_updated']);

            } else {
                // reload page
                $_SESSION['tznMessage'] = $GLOBALS['langMessage']['done_updated'];
                $objResponse->addScript('freak_rld()');
            }

        } else if ($objUser->checkLevel(11)) {

            $objTask->authorId = $objUser->id;

            // add item to DB (if user has rights to do it)
            $objTask->add();

            // reload page
            $_SESSION['tznMessage'] = $GLOBALS['langMessage']['done_added'];
            $objResponse->addScript('freak_rld()');

        } else {
            $oldStatus = $newStatus;
        }

        // update status
        if ($oldStatus != $newStatus) {
			$objTask->setStatus($newStatus,$objUser->id);

			if ($newStatus == FRK_STATUS_LEVELS) {
				// task is completed
				if (@constant('FRK_COMPLETE_DEADLINE') == TRUE) {
					// update deadline to current date
					$objTask->setDte('deadlineDate','NOW');
					$objTask->update('deadlineDate');
				}
				if (!@constant('FRK_DEFAULT_NO_DEADLINE_KEEP')) {
					// task should disapear from task list view
	                $objResponse->addScriptCall('freak_del_remove',$data['id']);
				}
            }
        }
    }

    $objResponse->addScript('freak_stop()');

		# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
		($objTask->sameSame($objOldTask)) ? $Type = 3 : $Type = 4;
		Send_Email_Notify($objTask,$objUser,$Type,$objProject);
		# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
    return $objResponse->getXML();
}

function task_delete($id) {

    $objResponse = new xajaxResponse();
    if ($objTask = ajaxLoadTask($id,9,false,$objUser,$objResponse)) {
        $objTask->delete();
        $objResponse->addScriptCall('freak_del_remove',$id);
        $objResponse->addScriptCall('freak_message',$GLOBALS['langMessage']['done_deleted']);
    } else {
        $objResponse->addScriptCall('freak_error',$GLOBALS['langMessage']['not_found_or_denied']);
    }
    $objResponse->addScript('freak_stop()');
    return $objResponse->getXML();

}

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
	$objResponse = new xajaxResponse();
	if ($objComment = ajaxLoadTaskComment($id,3,$objUser,$objTask,$objResponse)) {
		//$objResponse->addAssign('veditbody','value',$objComment->body);
		$objResponse->addScriptCall('freak_body_edit',$objComment->id,$objComment->body);
	}
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

function task_comment_delete($id) 
{
	$objResponse = new xajaxResponse();
	if ($objComment = ajaxLoadTaskComment($id,4,$objUser,$objTask,$objResponse)) {
		$objComment->delete();
		$objResponse->addRemove('vcomm'.$id);
		$objCommentList = new ItemComment();
		$objCommentList->addWhere('itemId='.$objComment->itemId);
		$objResponse->addAssign('ecomm'.$objTask->id,'innerHTML',$objCommentList->loadCount());
		$objResponse->addScriptCall('freak_message',$GLOBALS['langMessage']['done_comment_deleted']);
	}
	$objResponse->addScript('freak_stop()');
	return $objResponse->getXML();
}

function task_update_comment($taskId,$commId,$body)
 {
	$objResponse = new xajaxResponse();
	$str = $GLOBALS['langMessage']['operation_failed'];
	
	//error_log('receiving... task='.$taskId.' comment='.$commId.' body='.$body);
	if ($commId && ($objComment = ajaxLoadTaskComment($commId,3,$objUser,$objTask,$objResponse))) {
		// update comment
		$objComment->set('body',$body);
		if ($objComment->update('body')) {
			$str = $GLOBALS['langMessage']['done_comment_updated'];
		}
	} else if ($objUser = ajaxCheckSession($objResponse)) {
		if ($body && ($objTask = ajaxLoadTask($taskId,2,true,$objUser,$objResponse))) {
			// add new comment
			$objComment = new ItemComment();
			$objComment->set('body',$body);
			$objComment->itemId = $objTask->id;
			$objComment->member->id = $objUser->id;
			if ($objComment->add()) {
				$str = $GLOBALS['langMessage']['done_comment_added'];
			}
		}
	}
	if ($objUser->id) {
		ajaxLoadDetails($objTask,'comm',$objResponse,$objUser);
	}
	$objResponse->addScript('freak_body_edit()');
    $objResponse->addScriptCall('freak_message',$str);
	$objResponse->addScript('freak_stop()');
	# --- Modified by Plugin Manager for Email Notification Plugin ---------- Start ---
	Send_Email_Notify($objTask,$objUser,2,$body);
	# --- Modified by Plugin Manager for Email Notification Plugin ----------- End ----
	return $objResponse->getXML();
}

function staying_alive() {
	$objResponse = new xajaxResponse();
    if ($objUser = ajaxCheckSession($objResponse)) {
		// you're cool
		$objResponse->addScript('freak_stop()');
    } else {
    	// user has been disconnected for some reason
    	$_SESSION['tznMessage'] = $GLOBALS['langMessage']['session_expired'];
        $objResponse->addRedirect('login.php');
    }
    
    return $objResponse->getXML();
}

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
	 
	if ((bool)$clockId && ($objClock = ajaxLoadTaskClock($clockId,3,$objUser,$objTask,$objResponse))) {
	 
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
	if ($objFile = ajaxLoadFile($fileId,4,$objUser,$objTask,$objResponse) || true) /*para que puedan bajar file*/
	{
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

require_once ('xajax/xajax.inc.php');

$xajax = new xajax('xajax.task.php');
$xajax->registerFunction("task_load_view");
$xajax->registerFunction("task_load_more");
$xajax->registerFunction("task_load_edit");
$xajax->registerFunction("task_load_users");
$xajax->registerFunction("task_update_status");
$xajax->registerFunction("task_update_full");
$xajax->registerFunction("task_delete");
$xajax->registerFunction("task_comment_edit");
$xajax->registerFunction("task_comment_delete");
$xajax->registerFunction("task_update_comment");
$xajax->registerFunction("task_file_upload");
$xajax->registerFunction("task_file_delete");
$xajax->registerFunction("task_file_download");
//--> begin Time Clock addition
$xajax->registerFunction("task_clock_start");
$xajax->registerFunction("task_clock_stop");
$xajax->registerFunction("task_clock_timer_restart");
$xajax->registerFunction("task_delete_time");
$xajax->registerFunction("task_clock_change");
//<-- end Time Clock addition
$xajax->registerFunction("staying_alive");

$xajax->processRequests();

?>
