<?php
 
	global $ControlHtml;  	  
  
	//$ControlHtml->revisionSesion(); 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_admin').'admin_home.tpl'); 
	if((bool)$ControlHtml->theSession->autenticate)
	{
		$e->addTemplate('bloque_texto_home');
	}
	else
	{
		$e->addTemplate('bloque_texto_home_login');
	}
	 
	echo $e->toHtml();
?>	