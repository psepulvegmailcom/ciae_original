CREATE TABLE prefix_itemTimeClock (
  itemTimeClockId bigint(20) unsigned NOT NULL auto_increment,
  itemId int(10) unsigned NOT NULL,
  startTime datetime NOT NULL default '0000-00-00 00:00:00',
  stopTime datetime NOT NULL default '0000-00-00 00:00:00',
  subtotalTime int(11) NOT NULL default '0',
  isClockRunning tinyint(1) unsigned NOT NULL default '0',
  memberId mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (itemTimeClockId)
)
