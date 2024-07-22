README - TASK FREAK TIME CLOCK INSTALL

---------------------------------------------------

Author: Barbara Perez, bperez@albrookdata.com
Version: 0.5.2
Release Date: March 1, 2007
For: TaskFreak Multi User 0.5.7
Latest Version: http://www.albrookdata.com/portfolio.php

---------------------------------------------------

1. Create a new database table called frk_itemTimeClock. Use
the MySQL query below.

CREATE TABLE frk_itemTimeClock (
  itemTimeClockId bigint(20) unsigned NOT NULL auto_increment,
  itemId int(10) unsigned NOT NULL,
  startTime datetime NOT NULL default '0000-00-00 00:00:00',
  stopTime datetime NOT NULL default '0000-00-00 00:00:00',
  subtotalTime int(11) NOT NULL default '0',
  isClockRunning tinyint(1) unsigned NOT NULL default '0',
  memberId mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (itemTimeClockId)
)

2. Backup all TaskFreak files...just in case.

3. Copy all files from the TimeClock directory to the TaskFreak folder on your server.

index.php TO index.php
project_list.php TO project_list.php
xajax.task.php TO xajax.task.php
include/classes/pkg_project.php TO include/classes/pkg_project.php
include/classes/pkg_member.php TO include/classes/pkg_member.php
include/classes/tzn_mysql.php TO include/classes/tzn_mysql.php
include/classes/tzn_generic.php TO include/classes/tzn_generic.php
include/html/xajax_panel_edit.php TO include/html/xajax_panel_edit.php
include/html/xajax_panel_view.php TO include/html/xajax_panel_view.php
include/language/de/freak.php TO include/language/de/freak.php
include/language/en/freak.php TO include/language/en/freak.php
include/language/es/freak.php TO include/language/es/freak.php
include/language/fr/freak.php TO include/language/fr/freak.php
include/language/it/freak.php TO include/language/it/freak.php
include/language/nl/freak.php TO include/language/nl/freak.php
js/freak.js TO js/freak.js
skins/bluefreak/css/freak.css TO skins/bluefreak/css/freak.css
skins/bluefreak/images/b_start.png TO skins/bluefreak/images/b_start.png
skins/bluefreak/images/b_stop.png TO skins/bluefreak/images/b_stop.png
skins/bluefreak/images/spacer.gif TO skins/bluefreak/images/spacer.gif
skins/redfreak/css/freak.css TO skins/redfreak/css/freak.css
skins/redfreak/images/b_start.png TO skins/redfreak/images/b_start.png
skins/redfreak/images/b_stop.png TO skins/redfreak/images/b_stop.png
skins/redfreak/images/spacer.gif TO skins/redfreak/images/spacer.gif

---------------------------------------------------

Version 0.5.2 - March 02, 2007
- Fixed comment format in index.php

Version 0.5.1 - February 28, 2007
- Built for TaskFreak MultUser 0.5.7

Version 0.5.0 - February 2, 2007
- Built for TaskFreak MultUser 0.5.5
- Fixed bug in Project view. It was multiplying the total time by the number of members.
- Added German Translation (Thanks Nils!)

Version 0.4.0 - January 22, 2007
- Built for TaskFreak MultiUser 0.5.4
- Added "Total Time" column to Manage > Projects
- Added Portuguese Translation (Thanks fredcwbr!)
- Added comments to show Time Clock edits and additions in code

Version 0.3.1 - November 30, 2006
- Added Dutch Translation (Thanks Melle!)
- Added Spanish Translation (Thanks pablocostas!)

Version 0.3.0 - November 17, 2006
- Added ability to change time in edit panel
- Added total time in hours to time tab

Version 0.2.3 - October 28, 2006
- Built for TaskFreak MultiUser 0.5.2
- Fixed delete task so that it also deletes its time from database

Version 0.2.2 - October 21, 2006
- Added Polish Translation (Thanks eastman!)

Version 0.2.1 - October 18, 2006
- Fixed error in Time Tab when no time had been logged yet

Version 0.2.0 - October 17, 2006
- Built for TaskFreak MultiUser 0.5.1
- Added "time" tab to View Panel. It shows total time recorded for each user.
- Fixed date sort in History tab.

Version 0.1.2 - October 3, 2006
- Added "var" to line 531 and 532 of js/freak.js. Fixes Javascript error in IE.
- Added 'onclick="this.blur()"' to line 279 of index.php. Takes the focus from the button.

Version 0.1.1 - September 29, 2006
- Fixed 31 day limit for Javascript timer. Now it will show unlimited days logged.
- Replaced ALL commas "," from totalTime in freak_time() function.

Version 0.1.0 - September 26, 2006
- Time Clock built for TaskFreak MultiUser 0.4.2

