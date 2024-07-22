<?php		
  	 
	include_once 'include.php';
 
	$ControlHtml = new ControlHtmlIntranet();
	$ControlHtml->setSitio(VarConfig::sitio_www.'_intranet');   
	$ControlHtml->setLang(VarSystem::getVariable('lang'));  
	$ControlHtml->prepareHtml(); 
	$ControlHtml->showIndex(); 	

	include_once 'include_close.php';	
?>