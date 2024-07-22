<?php		
  
  	include_once 'config.cfg'; 
	include_once 'include.php';
	
	$ControlHtml = new ControlHtml();
	$ControlHtml->esAdmin();
	$ControlHtml->setSitio(VarConfig::sitio_www.'_admin');  
	$ControlHtml->setLang('es');  
	$ControlHtml->prepareHtml(); 
	$ControlHtml->showIndex();  	 
	
	include_once 'include_close.php';
?>