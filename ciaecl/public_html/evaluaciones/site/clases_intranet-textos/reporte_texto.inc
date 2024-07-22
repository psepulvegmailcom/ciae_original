<?php
 
	global $ControlHtml;  	  
  
	$ControlHtml->revisionSesion(); 
	
	$path_admin		= VarSystem::getPathVariables('dir_template').'intranet_textos/'; 
	$e = new miniTemplate($path_admin.'home.tpl');
	 
	echo $e->toHtml();
?>