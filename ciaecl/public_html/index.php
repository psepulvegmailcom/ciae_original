<?php 
  	
  	include_once 'config.cfg';  
	include_once 'include.php';
 
	$ControlHtml = new ControlHtml();
	$ControlHtml->setSitio(VarConfig::sitio_www);   
	$ControlHtml->setLang(VarSystem::getVariable('lang'));  
	$ControlHtml->prepareHtml(); 
	$ControlHtml->showIndex(); 	
 
	include_once 'include_close.php';	
?>


