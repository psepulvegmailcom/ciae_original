<?php		
  	 
	include_once 'include.php';
 
	$ControlHtml = new ControlHtml();
	$ControlHtml->setSitio('evaluacion');
	$ControlHtml->esAdmin();  
	$ControlHtml->setLang('es');  
	$ControlHtml->prepareHtml(); 
	$ControlHtml->showIndex(); 	

	include_once 'include_close.php';	
?>