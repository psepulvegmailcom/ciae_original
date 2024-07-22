<?php		
  	 
	include_once 'include.php';
 
	$ControlHtml = new ControlHtml();
	$ControlHtml->setSitio(VarConfig::sitio_www);
	$ControlHtml->esAdmin();  
	$ControlHtml->setLang('es');  
	$ControlHtml->prepareHtml(); 
	$ControlHtml->showIndex(); 	

	include_once 'include_close.php';	
?>