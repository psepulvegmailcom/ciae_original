<?php 
		 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	  
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'evaluaciones/evaluacion/';   

	$MantenedoresGeneral 		= new MantenedoresGeneral();
	$ControlGeneralCorreccion 	= new ControlGeneralCorreccion($ControlHtml->theSession->userObject,$lastAction );
	$valores 					= VarSystem::getPost(); 	
	$user_permiso				= $ControlHtml->theSession->userObject->permiso;
	$username		 			= $ControlHtml->theSession->userObject->username;
 
 	if($lastAction[2] == 'guardar')
	{
		
	}

	switch($lastAction[1])
	{ 
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
		break;
		case 'modificar':
		break;
	}

	echo $e->toHtml(); 
?>