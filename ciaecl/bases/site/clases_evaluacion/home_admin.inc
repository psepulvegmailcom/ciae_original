<?php
 
	global $ControlHtml;  	 
	global 	$sistema_error_logeo; 
	//Funciones::mostrarArreglo($sistema_error_logeo,true);
	if((bool)$ControlHtml->theSession->autenticate)
	{ 
		$ControlHtml->setSeminarioUsuario();		
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_admin').'admin_home.tpl');  
 
		$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction ); 
	 
		$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
		$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction ); 
		$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e,false);
		$e->setVariable('bienvenida',$ControlGeneralEvaluaciones->datos['evaluacion']['bienvenida']); 
		
	 	Funciones::mostrarArreglo($ControlGeneralEvaluaciones); 
	}
	else
	{ 
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_admin').'login.tpl'); 
		
		$f = new miniTemplate(VarSystem::getPathVariables('dir_template').'evaluaciones/ayuda_home.tpl'); 
		$e->setVariable('informacion_extra',$f->toHtml());
		global $sistema_error_logeo;
		if($ControlHtml->theSession->error_login != 4)
		{
			$e->setVariable('error',"ERROR: ".$sistema_error_logeo[$ControlHtml->theSession->error_login]);
		}
	}    
	//Funciones::mostrarArreglo($ControlHtml,true);
	echo $e->toHtml();
?>	