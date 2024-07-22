---[find]---
                <li id="tcomm"><a href="javascript:freak_more('comm')"><?php echo $GLOBALS['langTaskDetails']['tab_comments']; ?></a></li>
---[replace]---
                <li id="tcomm"><a href="javascript:freak_more('comm')"><?php echo $GLOBALS['langTaskDetails']['tab_comments']; ?></a></li>
<!-- begin Time Clock addition -->
                <li id="ttime"><a href="javascript:freak_more('time')"><?php echo $GLOBALS['langTaskDetails']['tab_time']; ?></a></li>
<!-- end Time Clock addition -->
---[find]---
				echo $GLOBALS['langItemStatus'][$objTask->itemStatus->statusKey]
			?></div>
        </div>
---[replace]---
				echo $GLOBALS['langItemStatus'][$objTask->itemStatus->statusKey]
			?></div>
        </div>
<!-- begin Time Clock addition -->
        <div id="ftime">
            <div class="flabel2"><?php echo $GLOBALS['langForm']['time']; ?></div>
    	    <div id="vtime">
				<?php echo $objTask->itemTotalTime; ?>
			</div>
        </div>
<!-- end Time Clock addition -->