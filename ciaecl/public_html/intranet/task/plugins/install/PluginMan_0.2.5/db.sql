CREATE TABLE prefix_plugins (
  pluginId int(10) NOT NULL auto_increment,
  title varchar(200) default NULL,
  description text default NULL,
  icon varchar(50) default NULL,
  version varchar(30) default NULL,
  author varchar(100) default NULL,
  released datetime default NULL,
  readme varchar(50) default NULL,
  changelog varchar(50) default NULL,
  size varchar(50) default NULL,
  sqlfile varchar(50) default NULL,
  folder varchar(100) default NULL,
  status int(3) NOT NULL default '0',
  PRIMARY KEY (pluginId)
) 
