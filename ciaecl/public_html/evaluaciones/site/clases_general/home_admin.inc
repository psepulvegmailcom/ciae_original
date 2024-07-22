<?
 
	global $ControlHtml;  	 
	global 	$sistema_error_logeo;
	//Funciones::mostrarArreglo($sistema_error_logeo,true);
	if((bool)$ControlHtml->theSession->autenticate)
	{ 
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_admin').'admin_home.tpl');
		
		 
		
	 	Funciones::mostrarArreglo($ControlGeneralEvaluaciones);
	}
	else
	{ 
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_admin').'login.tpl');
		global $sistema_error_logeo;
		if($ControlHtml->theSession->error_login != 4)
		{
			$e->setVariable('error',"ERROR: ".$sistema_error_logeo[$ControlHtml->theSession->error_login]);
		}
	}    
	//Funciones::mostrarArreglo($ControlHtml,true);
	echo $e->toHtml();
?>	