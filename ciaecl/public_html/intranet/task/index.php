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

 
					 
$pPageIsPublic = false;
include '_common.php';

$objEditItem = new Item();
$pUserCanEdit = false;

// --- LOAD TASKS -----------------------------------------------

$pLink = 'index.php';

$objItemList = new ItemStats();
$objUrgencyList = new ItemUrgencyList();
$objComplexList = new ItemComplexList();

$arrFilters = array();

// --- filter: project ---
if ($pProject) {
    // load tasks for specific project
	$sqlFilter = 'ii.projectId = \''.$pProject.'\'';
    $pLink=Tzn::concatUrl($pLink,'sProject='.$pProject);
} else if (!$objUser->checkLevel(6)) {
    // user can only access his own projects
    if ($objUserProjectList->rMore()) {
        $arrProject = array();
        while($objTmp = $objUserProjectList->rNext()) {
            $arrProject[] = $objTmp->id;
        }
        if ($objUser->checkLevel(13)) {
        	$arrProject[] = '0';
        }
        $sqlFilter = 'ii.projectId IN ('.implode(',',$arrProject).')';
        
        unset($arrProject);
        $objUserProjectList->rReset();
    }
}

$objItemList->addWhere($sqlFilter);

// --- filter: user ---
$pUser = intval($_REQUEST['sUser']);


if (!isset($_REQUEST['sUser']) && @constant('FRK_DEFAULT_VIEW_OWN_TASKS')) {
	// default view is own tasks only
	$pUser = $objUser->id;
}

if ($pUser) {
	$objItemList->addWhere('ii.memberId = \''.$pUser.'\'');
    $_SESSION['selUser'] = $pUser;
    $pDefaultUserId = $pUser;
} else {
    unset($_SESSION['selUser']);
    session_unregister('selUser');
    $pDefaultUserId = $objUser->id;
    // by default, show own tasks
    /*
    if (!$objUser->checkLevel(1)) { // admin can see all
	    $objItemList->addWhere('(ii.memberId='.$objUser->id
    		.' OR ii.authorId='.$objUser->id.')');
    }
    */
}

$pLink=Tzn::concatUrl($pLink,'sUser='.$pUser);

// --- private tasks --------------------------------------------------------

$arrFilter[] = 'showPrivate=0';

if ($objUser->checkLevel(12)) {
	// show internal tasks
	$arrFilter[] = 'showPrivate=1';
}

$arrFilter[] = '(showPrivate=2 AND (ii.memberId='.$objUser->id
	.' OR ii.authorId='.$objUser->id.'))';

$objItemList->addWhere('('.implode(' OR ',$arrFilter).')');

// --- filter: context ---

if ($_REQUEST['sContext']) {
	$pContext = $_REQUEST['sContext'];
	$objItemList->addWhere('context = \''.$pContext.'\'');
    $pLink=Tzn::concatUrl($pLink,'sContext='.$pContext);
}

$sqlFilter = '';
$pShow = ($_REQUEST['show'])?$_REQUEST['show']:'today';
$pLink=Tzn::concatUrl($pLink,'show='.$pShow);

$pKeepNoDead = intval(@constant('FRK_NO_DEADLINE_KEEP') -1) * 86400;

// --- Filter per date -----------------------------------------------------

switch ($pShow) {
	case 'all':
		break;
	case 'future':
		// show coming tasks and late tasks (undone only)
		$sqlFilter = '((deadlineDate >= \''
			.strftime(TZN_DATE_SQL,PRJ_DTE_NOW).'\' AND statusKey < '
			.FRK_STATUS_LEVELS.')'.' OR statusKey < '.FRK_STATUS_LEVELS.')';
        // show uncompleted tasks with no deadline
		$sqlFilter .= ' OR (deadlineDate = \'9999-00-00\' AND statusKey < '
			.FRK_STATUS_LEVELS.')';
		break;
	case 'past':
		// show past tasks and already done
		$sqlFilter = '(deadlineDate < \''
			.strftime(TZN_DATE_SQL,PRJ_DTE_NOW).'\' OR statusKey = '
			.FRK_STATUS_LEVELS.')';
		break;
	case 'today':
		// show all future tasks (done + undone) and late tasks
		$pKeepNoDead = intval(@constant('FRK_NO_DEADLINE_KEEP') -1) * 86400;
		$sqlFilter = '(statusKey = '.FRK_STATUS_LEVELS.' AND statusDate > \''
			.gmdate('Y-m-d 00:00:00',time()-$pKeepNoDead).'\') ';
			
		// hide far future tasks ?
		$tmpFilter = '';
		if (@constant('FRK_DEFAULT_FAR_FUTURE_HIDE')) {
			$tmp = intval(FRK_DEFAULT_FAR_FUTURE_HIDE) * 86400;
			$tmpFilter .= 'deadlineDate < \''
				.gmdate('Y-m-d 00:00:00',time()+$tmp).'\'';
		}
		
		// show tasks with no deadline ?
		if (@constant('FRK_NO_DEADLINE_TOO')) {
			// yes
			if ($tmpFilter) {
				$sqlFilter .= 'OR ('.$tmpFilter
					.' OR deadlineDate = \'9999-00-00\')'
					. ' AND statusKey < '.FRK_STATUS_LEVELS;
			} else {
				$sqlFilter .= ' OR statusKey < '.FRK_STATUS_LEVELS;
			}
		} else {
			// don't show uncompleted non planned tasks
			if ($tmpFilter) {
				$sqlFilter .= ' OR ('.$tmpFilter.' AND statusKey < '
    	        	.FRK_STATUS_LEVELS.')';
			} else {
	            $sqlFilter .= ' OR (deadlineDate <> \'9999-00-00\' AND statusKey < '
    	        	.FRK_STATUS_LEVELS.')';
			}
		}
		
        if (@constant('FRK_DEFAULT_CURRENT_TASKS')) {
            $objItemList->setPagination(FRK_DEFAULT_CURRENT_TASKS);
        }
		break;
	default:
		break;
}

// -TODO- Add filter current project only (no completed, no cancelled)

// echo '<p>&</p><p>-</p><p>-</p>'.$sqlFilter;

if ($sqlFilter) {
	$objItemList->addDateFilter($sqlFilter);
} 
// --- Task order ---------------------------------------------------------

$pSort = ($_REQUEST['sort'])?$_REQUEST['sort']:((defined('FRK_SORT_COLUMN'))?FRK_SORT_COLUMN:'deadlineDate');
$pDir = ($_REQUEST['dir'])?$_REQUEST['dir']:
	((defined('FRK_SORT_ORDER'))?FRK_SORT_ORDER:1);
//if ($pShow == 'past' && (!$_REQUEST['dir']) && $pDir == 1) $pDir = -$pDir;


$objItemList->setOrder($pSort,$pDir);

$pLink=Tzn::concatUrl($pLink,'sort='.$pSort);
$pLink=Tzn::concatUrl($pLink,'dir='.$pDir);

$_SESSION['linkItems'] = $pLink;

// --- load ---
$objItemList->loadList($objUser->id);
 
// === HTML ===================================================================

$pJScalendar=true; //'freak_cal';
$pJSonLoad='freak_highlist();';
$pJSonDown='listenClick(event);';
$pJSxajax='task_load_view,task_load_more,task_load_edit,task_load_users,'
	.'task_update_status,task_update_full,task_delete,'
	.'task_file_delete,task_file_upload,task_file_download,'
//--> begin Time clock edit
	.'task_comment_edit,task_comment_delete,task_update_comment,'
	.'task_clock_start,task_clock_stop,task_clock_timer_restart,task_delete_time,task_clock_change' ; 
//<-- end Time Clock edit
	
// open task directly
if ($rssId = intval($_REQUEST['rssId'])) {
	$pJSonLoad .= 'freak_view('.$rssId
		.(($_REQUEST['tab'])?',\''.$_REQUEST['tab'].'\'':'')
		.');';
}

$pAutoReload = (@constant('FRK_RELOAD_FOR_REAL'))?FRK_RELOAD_FOR_REAL:0;
	
include PRJ_INCLUDE_PATH.'html/header.php';

// -------------- TASK LIST (HEADER) ------------------------------------------

?>
 
	 
	<script>
	function trim(cadena)
	{
		for(i=0; i<cadena.length; )
		{
			if(cadena.charAt(i)==" ")
				cadena=cadena.substring(i+1, cadena.length);
			else
				break;
		}
	
		for(i=cadena.length-1; i>=0; i=cadena.length-1)
		{
			if(cadena.charAt(i)==" ")
				cadena=cadena.substring(0,i);
			else
				break;
		}
		return cadena;
	}
	 
	var valores_tareas = '';
	var valores_tareas_titulos = '';
	function showTabla()
	{ 
		 document.getElementById("ventana_impresion").innerHTML 	= valores_tareas/*+ '<br><br><hr><br><br>'+valores_tareas_titulos */ ;  			 
		 verPopup();
	}
	function verPopup()
	{
		var optionOpenW ="dependent=1,toolbar=0,status=0,menubar=0,personalbar=0,scrollbars=1,resizable=1,width=913,height=600";
	 	nombre = 'ventana_extra';
		var nuevo_ventana = window.open('imprimirLista.php',nombre,optionOpenW);
	
	}
	var num_item = 1;
	</script>
	
	<div id='ventana_impresion' style="	overflow:scroll;	position: fixed;   	top: 54px;  	background-color:#ffffff;	border:1px solid #000000; 	 	left: 0px;	padding: 10px; width:1205px;	z-index: 1000; visibility:hidden "></div>
	 
	  <div id="content">
 
	
        <table id="taskSheet" cellpadding="2" cellspacing="1" border="0" class="sheet" width="100%">
            <thead>
                <tr>
				
                    <th width="2%" onclick="freak_sort('priority')" class="sortable">&nbsp;</th>
                    <?php
                        $titleWidth = 0;
                        $titleLabel = '&nbsp;';
                        if (@constant('FRK_CONTEXT_ENABLE')) {
                            if (@constant('FRK_CONTEXT_LONG')) {
                                $titleWidth = 10;
                                $titleLabel = $GLOBALS['langForm']['context'];
                            } else {
                                $titleWidth = 2;
                            }
                    ?>
                    <th width="<?php echo $titleWidth; ?>%" onclick="freak_sort('context')" class="sortable"><?php echo $titleLabel; ?></th>
                    <?php
                        }

                    ?>
                    <th width="<?php echo 25-(FRK_STATUS_LEVELS * 2) ?>%" onclick="freak_sort('name')" class="sortable">
					<?php echo $langForm['project']; ?></th>
<!-- begin Time Clock edit -->
                    <th width="<?php echo 33-$titleWidth; ?>%" onclick="freak_sort('title')" class="sortable">
					<?php echo $langForm['title']; ?></th> 
					
                    <th width="2%" onclick="freak_sort('mm.username')" class="sortable">U<?php /*echo $langForm['user'];*/ ?></th>
					<th width="7%"   class="sortable"><?php echo $langForm['creation']; ?></th>
					<th width="7%" onclick="freak_sort('deadlineDate')" class="sortable"><?php echo $langForm['deadline']; ?></th>
					<th width="5%" onclick="freak_sort('expectedUrgency')" class="sortable">Urgencia</th>
					<th width="5%" onclick="freak_sort('expectedComplex')" class="sortable">Complejidad</th>
					<th width="4%" onclick="freak_sort('expectedDuration')" class="sortable">HH Est.</th>
					<?php
					if($objUser->level > 2)
					{
					?>
					<!--<th width="5%">Costo Estimado</th>-->
					<?php
					}
					?>
					<th width="13%"><?php echo $langForm['time_clock']; ?></th>
					<?php
					if($objUser->level > 2)
					{
					?>
					<!--<th width="5%">Costo Real</th>-->
					<?php
					}
					?>					
<!-- end Time Clock edit -->
					<th width="5%"><?php echo $langForm['list_comments']; ?></th>
                    <th width="<?php echo FRK_STATUS_LEVELS * 2; ?>%" onclick="freak_sort('statusKey')" colspan="<?php echo FRK_STATUS_LEVELS ?>" class="sortable"><?php echo (FRK_STATUS_LEVELS == 1)?'X':$langForm['status']; ?></th>
                    <th width="5%" class="act"><?php
                        if ($objUser->checkLevel(11)) {
                    ?><a href="javascript:freak_new()"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_new.png" width="39" height="16" border="0" hspace="3" alt="<?php echo $langForm['new']; ?>" /></a><?php 
                        } else { 
                    ?>&nbsp;<?php
                        }
                    ?></th>
                </tr>
            </thead>
            <tbody>
<!-- begin Time Clock addition -->
            <input type="hidden" id="skin" value="<?php echo FRK_SKIN_FOLDER; ?>">
<!-- end Time Clock addition -->
<?php

// ----------- TASK LIST (CONTENT) -------------------------------------------

if ($objItemList->rMore()) {
    while ($objItem = $objItemList->rNext()) {

        $priority = $objItem->priority;
//--> begin Time Clock addition
        $objItem->getTimeStats($objItem->id,$objUser->id);
//<-- end Time Clock addition

?>
                <tr id="<?php echo $objItem->id; ?>" >
                    <td id="eprio<?php echo $objItem->id; ?>" class="prio"><span class="pr<?php echo $priority; ?>" title="<?php echo $_GLOBALS['arrPriorities'][$objItem->priority]; ?>"><?php echo $priority; ?></span></td>
                <?php
                    if (@constant('FRK_CONTEXT_ENABLE')) {
                ?>
                    <td id="ectxt<?php echo $objItem->id; ?>" class="<?php echo (@constant('FRK_CONTEXT_LONG'))?'ctlg':'ctsh'; ?>"><?php echo $objItem->getContext(@constant('FRK_CONTEXT_LONG')); ?></td>
                    <?php
                    }
                ?>
                    <td id="eproj<?php echo $objItem->id; ?>"><? 
						$objItem->project->load();
						$colorProject = trim($objItem->project->color);
						if($colorProject != '') { 
							echo "<div  style=\" background-color:#".$colorProject.";\" id=\"eproj_t".$objItem->id."\">"; 
							}
						 echo $objItem->project->p('name','-'); 
						 if($colorProject != '') { 
							echo "</div>";
							}
						?></td>
                    <td id="etitl<?php echo $objItem->id; ?>"><?php 
                        echo $objItem->p('title'); 
                        if ($objItem->description) {
                            echo '<img src="skins/'.FRK_SKIN_FOLDER.'/images/desc.png" width="16" height="16" align="absmiddle" border="0" alt="" />';
                        }
                        switch ($objItem->showPrivate) {
                            case 1:
                                echo '<img src="skins/'.FRK_SKIN_FOLDER.'/images/priv1.png" width="12" height="16" align="absmiddle" border="0" alt="" />';
                                break;
                            case 2:
                                echo '<img src="skins/'.FRK_SKIN_FOLDER.'/images/priv2.png" width="12" height="16" align="absmiddle" border="0" alt="" />';
                                break;
                        }
												// Check files and show icon
												?><a href="javascript:freak_view(<?php echo $objItem->id; ?>,'file');"><img id="fileIcon<?php echo $objItem->id; ?>" src="<?php echo PLG_FILE_DIR; ?>/images/files.png" width="12" height="11" alt="files" border="0" align="absmiddle" style="display:none" /></a><?php
												$objFileList = new ItemFile();
												$objFileList->addWhere('itemId='.$objItem->id);
												$objFileList->loadList();
												if ($objFileList->rMore()) { 
													echo '<script type="text/javascript">sE(gE(\'fileIcon'.$objItem->id.'\')); gE(\'fileIcon'.$objItem->id.'\').title=\''.$objFileList->rTotal().' file(s)\'</script>';
												}
                    ?></td>
					
				<td id="euser<?php echo $objItem->id; ?>"><?php echo substr($objItem->member->username,0,2); /*echo $objItem->member->getShortName('-');*/ ?></td> 
					<td id="ecreate<?php echo $objItem->id; ?>"><small><?php 
					$objStatusList = new ItemStatus();
					$objStatusList->addWhere('itemId='.$objItem->id);
					$objStatusList->addOrder('statusDate ASC');
					$objStatusList->loadList();
					$objStatus = $objStatusList->rNext();
					echo $objStatus->statusDate;
					 ?></small></td>
					<td id="edead<?php echo $objItem->id; ?>"><?php echo $objItem->pDeadline(); ?></td>
					<td id="eurgency<?php echo $objItem->id; ?>" align="center" ><? if($colorProject != '') { 
							echo "<div  style=\" background-color:#".$colorProject.";\">"; 
							}
						 $objUrgencyList->p($objItem->expectedUrgency); 
						 if($colorProject != '') { 
							echo "</div>";
							}
						?></td>
					<td id="ecomplex<?php echo $objItem->id; ?>" align="center" ><?php echo $objComplexList->p($objItem->expectedComplex);?></td>
					<td id="eexpect<?php echo $objItem->id; ?>" align="center" ><?php if($objItem->expectedDuration > 0) echo $objItem->expectedDuration; else echo '';?></td>
					<?php
					if($objUser->level > 2)
					{
					?> 
						
					<!--<td id="ecost<?php echo $objItem->id; ?>" align="center" ><?php echo $objItem->getItemCost('expected');?></td>-->
					<?php
					}
					?>
					
<!-- begin Time Clock addition -->
					<?php
						// check to see if clock is running and show appropriate button image
						$clockBtnImg = "";
						if ($objItem->f('itemClockRunning','0')) {
						   $clockBtnImg = "b_stop.png";
						}
						else {
						   $clockBtnImg = "b_start.png";
						}
					?>
					<td>
						<div style="float:right" id="etime<?php echo $objItem->id; ?>">
							<a href="javascript:freak_view(<?php echo $objItem->id; ?>,'time');">
								<div id="etimeTotal<?php echo $objItem->id; ?>">
									<?php 
										// if clock is already started on page load, show "running" javascript clock
										if ($objItem->itemClockRunning) {
											echo "<img src='skins/".FRK_SKIN_FOLDER."/images/spacer.gif' border=0 onLoad='freak_timer_restart(".$objItem->id.",".$objItem->itemClockId.",".$objItem->itemTotalTimeSec.");'>";
										}
										else {
											echo $objItem->p('itemTotalTime','-'); 
										}
									?>
								</div>
							</a>
						</div>
						<input type="hidden" id="itemClockId<?php echo $objItem->id; ?>" value="<?php echo $objItem->p('itemClockId','0');?>">
						<input type="hidden" id="itemClockRunning<?php echo $objItem->id; ?>" value="<?php echo $objItem->p('itemClockRunning','0');?>">
						<input type="hidden" id="itemTotalTimeSec<?php echo $objItem->id; ?>" value="<?php echo $objItem->p('itemTotalTimeSec','0');?>">
						<?php
							if ($objUser->checkLevel(14) || $objItem->checkRights($objUser->id,8,true)) {
						?>
						<a onclick="this.blur()" href="javascript:freak_time(<?php echo $objItem->id;?>,document.getElementById('itemClockId<?php echo $objItem->id; ?>').value,document.getElementById('itemClockRunning<?php echo $objItem->id; ?>').value,document.getElementById('itemTotalTimeSec<?php echo $objItem->id; ?>').value);">
							<img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/<?php echo $clockBtnImg; ?>" width="25" height="16" alt="time clock" border="0" id="etimeImg<?php echo $objItem->id; ?>" />
						</a>
						<?php
							}
						?>
					</td>
					<?php
					if($objUser->level > 2)
					{
					?>  

					<!--<td  id="ecostreal<?php echo $objItem->id; ?>" align="center" ><?php echo $objItem->getItemCost('real');?></td>-->
					<?php
					}
					?>					
<!-- end Time Clock addition -->
					<?php
					// get real number, don't mix it with files ;)
					$objCommentList = new ItemComment();
					$objCommentList->addWhere('itemId='.$objItem->id);
					$objCommentList->addOrder('postDate DESC');
					$objCommentList->loadList();
					 
					$objComment = $objCommentList->rNext(); 
					?>
					<td><div style="float:right" id="ecomm<?php echo $objItem->id; ?>"  >
					
					<?php if($objCommentList->rTotal() > 0) echo "<b><font style=' font-size:15px;background-color:#8F9BA1; padding:3px'> "; echo $objCommentList->rTotal(); if($objCommentList->rTotal() > 0)   echo " </font></b>";  ?></div>
					<a href="javascript:freak_view(<?php echo $objItem->id; ?>,'comm');">
					<img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_disc.png" width="14" height="16" alt="commentaires" border="0" /></a>
					<br />
					<?php if($objCommentList->rTotal() > 0) {?>
					<small><?php echo $objComment->postDate; ?></small>
					<? } ?>
					</td>
					<div id='ecomentario<?php echo $objItem->id; ?>'  style="visibility:hidden; height:0px;"  >
					<?php 
					$totalcomment = $objCommentList->rTotal();
					for($i=0;$i < $totalcomment ; $i++)
					{
						echo '<small>'.$objComment->postDate.'</small><br>'.nl2br(trim($objComment->body))."<br>\n"; 
						$objComment = $objCommentList->rNext();
					}
					
					?>
					</div>
                <?php
                    $s = $objItem->itemStatus->statusKey;
                    for ($i = 0; $i < FRK_STATUS_LEVELS; $i++) {
                        $j = ($i < $s)?(FRK_STATUS_LEVELS - $i):0;
                ?>
                    <td  width="2" id="est<?php echo ($i+1).$objItem->id; ?>" class="sts<?php echo $j; ?>"<?php
                        if ($objUser->checkLevel(14) || $objItem->checkRights($objUser->id,8,true))  {
                            echo ' onclick="freak_sts('.$objItem->id.','.($i+1).')" style="cursor:pointer"';
                        }
                    ?>>&nbsp;&nbsp;</td>
                <?php
                    }
                ?>
                    <td class="act">
                    <?php
                      // EDIT
                      if ($objUser->checkLevel(14) || $objItem->checkRights($objUser->id,7))  {
                    ?><a href="javascript:freak_edit(<?php echo $objItem->id; ?>)" title="<?php echo $GLOBALS['langMessage']['task_edit']; ?>"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_edit.png" width="20" height="16" alt="edit" border="0" /></a><?php
                      } else {
                    ?><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_edin.png" width="20" height="16" alt="del" border="0" /><?php
                      }
                      // DELETE
                      if ($objUser->checkLevel(14) || $objItem->checkRights($objUser->id,9))  {
                    ?><a href="javascript:freak_del(<?php echo $objItem->id; ?>)" onClick="return confirm('<?php echo $GLOBALS['langMessage']['task_delete_confirm']; ?>')" title="<?php echo $GLOBALS['langMessage']['task_delete']; ?>"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_dele.png" width="20" height="16" alt="del" border="0" /></a><?php
                      } else {
                    ?><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_deln.png" width="20" height="16" alt="del" border="0" /><?php
                      }
                    ?>
                    </td>
                </tr>
				<div style="visibility:hidden; height:0px;" id="edescrip<?php echo $objItem->id; ?>" ><? echo nl2br(trim($objItem->p('description'))); ?></div> 
				 
				 <script>
				 	valores_tareas = valores_tareas + "_________________________________________________________________________________________________________<br>";
					 valores_tareas = valores_tareas + "<b> Tarea ("+ num_item + "): </b>"+trim(document.getElementById("etitl<?php echo $objItem->id; ?>").innerHTML)+"  ";
					 
					 valores_tareas = valores_tareas + "<br><b>Proyecto:</b> "; 
					 if(document.getElementById("eproj_t<?php echo $objItem->id; ?>"))
					{	
						 valores_tareas = valores_tareas + trim(document.getElementById("eproj_t<?php echo $objItem->id; ?>").innerHTML)+""; 
					 valores_tareas_titulos = valores_tareas_titulos + ";"+ trim(document.getElementById("eproj_t<?php echo $objItem->id; ?>").innerHTML) + " - ";
					
					}
						 valores_tareas_titulos = valores_tareas_titulos + trim(document.getElementById("etitl<?php echo $objItem->id; ?>").innerHTML);
					 valores_tareas = valores_tareas + "<br><b>Creaci&oacute;n:</b> "+trim(document.getElementById("ecreate<?php echo $objItem->id; ?>").innerHTML)+"";
					 valores_tareas = valores_tareas + "<br><b>Finalizaci&oacute;n:</b> "+trim(document.getElementById("edead<?php echo $objItem->id; ?>").innerHTML)+"";
					 
					 
					 var aux = trim(document.getElementById("edescrip<?php echo $objItem->id; ?>").innerHTML);
					 if(aux.length > 0)
					 {					 
					 	valores_tareas = valores_tareas + "<br><b>Descripci&oacute;n:</b><br>"+aux+""; 
					 }
					 				 
					 	valores_tareas = valores_tareas + "<br><b>Comentarios:</b><br>"+trim(document.getElementById("ecomentario<?php echo $objItem->id; ?>").innerHTML)+"<br>	";
					  
					  num_item = num_item +1;
					 </script>
<?php
    }
} else {

// --------------- NO TASK FOUND ---------------------------------------------

?>
                <tr class="nothanks">
<!-- begin Time Clock edit -->
                    <td colspan="<?php echo (@constant('FRK_CONTEXT_ENABLE'))?'19':'18'; ?>">
<!-- end Time Clock edit -->
                        <p>&nbsp;</p>
                        <p align="center">- <?php echo $langMessage['no_task_found']; ?> -</p>
                        <?php
                            if ($objUser->checkLevel(11)) {
                        ?>
                        <p align="center"><a href="javascript:freak_new()"><?php echo $langMessage['create_task']; ?></a></p>
                        <?php
                            }
                        ?>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </td>
                </tr>
<?php
}
?>
            </tbody>
        </table>
    </div>
	 <a href="javascript:showTabla()">Versi&oacute;n Impresa</a>	
<?php
include PRJ_INCLUDE_PATH.'html/footer.php';
?>