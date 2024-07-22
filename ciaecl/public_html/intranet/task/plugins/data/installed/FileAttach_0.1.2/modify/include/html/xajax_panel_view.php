---[find]---
                <li id="tcomm"><a href="javascript:freak_more('comm')"><?php echo $GLOBALS['langTaskDetails']['tab_comments']; ?></a></li>
---[replace]---
                <li id="tcomm"><a href="javascript:freak_more('comm')"><?php echo $GLOBALS['langTaskDetails']['tab_comments']; ?></a></li>
                <li id="tfile"><a href="javascript:freak_more('file')" onclick="this.blur()">files</a></li>
---[find]---
			<div id="vmore"></div>
---[replace]---
			<div id="vmore"></div>
			<div id="vfedit" align="center">
				<iframe id="vfframe" frameborder="0" width="400" height="170" src="files.php"></iframe>
				<iframe id="vfdownload" frameborder="0" width="0" height="0"></iframe>
			</div>