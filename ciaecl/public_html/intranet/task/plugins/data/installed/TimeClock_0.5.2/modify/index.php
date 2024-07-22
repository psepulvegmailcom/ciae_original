---[find]---
	.'task_update_status,task_update_full,task_delete,'
	.'task_comment_edit,task_comment_delete,task_update_comment' ;
---[replace]---
	.'task_update_status,task_update_full,task_delete,'
//--> begin Time clock edit
	.'task_comment_edit,task_comment_delete,task_update_comment,'
	.'task_clock_start,task_clock_stop,task_clock_timer_restart,task_delete_time,task_clock_change' ; 
//<-- end Time Clock edit
---[find]---
                    <th width="<?php echo 25-(FRK_STATUS_LEVELS * 2) ?>%" onclick="freak_sort('name')" class="sortable"><?php echo $langForm['project']; ?></th>
                    <th width="<?php echo 43-$titleWidth; ?>%" onclick="freak_sort('title')" class="sortable"><?php echo $langForm['title']; ?></th>
                    <th width="10%" onclick="freak_sort('mm.username')" class="sortable"><?php echo $langForm['user']; ?></th>
					<th width="10%" onclick="freak_sort('deadlineDate')" class="sortable"><?php echo $langForm['deadline']; ?></th>
---[replace]---
                    <th width="<?php echo 25-(FRK_STATUS_LEVELS * 2) ?>%" onclick="freak_sort('name')" class="sortable"><?php echo $langForm['project']; ?></th>
<!-- begin Time Clock edit -->
                    <th width="<?php echo 33-$titleWidth; ?>%" onclick="freak_sort('title')" class="sortable"><?php echo $langForm['title']; ?></th>
                    <th width="10%" onclick="freak_sort('mm.username')" class="sortable"><?php echo $langForm['user']; ?></th>
					<th width="9%" onclick="freak_sort('deadlineDate')" class="sortable"><?php echo $langForm['deadline']; ?></th>
					<th width="11%"><?php echo $langForm['time_clock']; ?></th>
<!-- end Time Clock edit -->
---[find]---
<?php

// ----------- TASK LIST (CONTENT) -------------------------------------------
---[replace]---
<!-- begin Time Clock addition -->
            <input type="hidden" id="skin" value="<?php echo FRK_SKIN_FOLDER; ?>">
<!-- end Time Clock addition -->
<?php

// ----------- TASK LIST (CONTENT) -------------------------------------------
---[find]---
if ($objItemList->rMore()) {
    while ($objItem = $objItemList->rNext()) {
        $priority = $objItem->priority;
---[replace]---
if ($objItemList->rMore()) {
    while ($objItem = $objItemList->rNext()) {
        $priority = $objItem->priority;
//--> begin Time Clock addition
        $objItem->getTimeStats($objItem->id,$objUser->id);
//<-- end Time Clock addition
---[find]---
					<td><div style="float:right" id="ecomm<?php echo $objItem->id; ?>"><?php echo $objItem->p('itemCommentCount','0'); ?></div><a href="javascript:freak_view(<?php echo $objItem->id; ?>,'comm');"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_disc.png" width="14" height="16" alt="commentaires" border="0" /></a></td>
                <?php
                    $s = $objItem->itemStatus->statusKey;
                    for ($i = 0; $i < FRK_STATUS_LEVELS; $i++) {
                        $j = ($i < $s)?(FRK_STATUS_LEVELS - $i):0;
                ?>
                    <td id="est<?php echo ($i+1).$objItem->id; ?>" class="sts<?php echo $j; ?>"<?php
                        if ($objUser->checkLevel(14) || $objItem->checkRights($objUser->id,8,true))  {
---[replace]---
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
<!-- end Time Clock addition -->
					<td><div style="float:right" id="ecomm<?php echo $objItem->id; ?>"><?php echo $objItem->p('itemCommentCount','0'); ?></div><a href="javascript:freak_view(<?php echo $objItem->id; ?>,'comm');"><img src="skins/<?php echo FRK_SKIN_FOLDER; ?>/images/b_disc.png" width="14" height="16" alt="commentaires" border="0" /></a></td>
                <?php
                    $s = $objItem->itemStatus->statusKey;
                    for ($i = 0; $i < FRK_STATUS_LEVELS; $i++) {
                        $j = ($i < $s)?(FRK_STATUS_LEVELS - $i):0;
                ?>
                    <td id="est<?php echo ($i+1).$objItem->id; ?>" class="sts<?php echo $j; ?>"<?php
                        if ($objUser->checkLevel(14) || $objItem->checkRights($objUser->id,8,true))  {
---[find]---
                    <td colspan="<?php echo (@constant('FRK_CONTEXT_ENABLE'))?'13':'12'; ?>">
---[replace]---
<!-- begin Time Clock edit -->
                    <td colspan="<?php echo (@constant('FRK_CONTEXT_ENABLE'))?'14':'13'; ?>">
<!-- end Time Clock edit -->