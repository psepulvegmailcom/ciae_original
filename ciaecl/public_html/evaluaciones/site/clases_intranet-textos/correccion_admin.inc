<?php
 
	global $ControlHtml;  	  
  
	//$ControlHtml->revisionSesion(); 
	
	$path_admin		= VarSystem::getPathVariables('dir_template').'intranet_textos/admin/'; 
	 
	 $e = new miniTemplate($path_admin.'admin_tiempos.tpl');

	switch($lastAction[0])
	{
		case 'view_correccion_admin_tiempos':
			$e = new miniTemplate($path_admin.'admin_tiempos.tpl');
		break;  
		default:
		break;
	}
	 
	echo $e->toHtml();
?>	