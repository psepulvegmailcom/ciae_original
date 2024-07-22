<?php
 
	global $ControlHtml;  	  
  
	//$ControlHtml->revisionSesion(); 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_admin').'admin_home.tpl');
	 
	echo $e->toHtml();
?>	