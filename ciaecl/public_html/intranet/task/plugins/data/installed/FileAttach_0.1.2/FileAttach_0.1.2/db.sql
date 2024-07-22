/*
!!! Please DROP the original table or modify it accordingly !!!
*/

CREATE TABLE prefix_itemFile (
  itemFileId bigint(20) unsigned NOT NULL auto_increment,
  itemId int(10) unsigned NOT NULL default '0',
  memberId mediumint(8) unsigned NOT NULL default '0',
  fileTitle varchar(200) NOT NULL default '',
  filename varchar(100) NOT NULL default '',
  filetype varchar(30) NOT NULL default '',
  filedesc text NOT NULL,
  filesize bigint(20) NOT NULL default '0',
  postDate datetime NOT NULL default '0000-00-00 00:00:00',
  lastChangeDate datetime default '0000-00-00 00:00:00',
  fileTags varchar(255) default NULL,
  PRIMARY KEY  (itemFileId),
  KEY taskId (itemId)
)