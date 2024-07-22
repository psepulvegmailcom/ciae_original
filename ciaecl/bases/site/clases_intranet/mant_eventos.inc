<?php

	global $ControlHtml;  	
	$theSession 	    = $ControlHtml->theSession;
    $theSessionPersona 	= $ControlHtml->elUsuarioPersona;   
	$lastAction 	    = $ControlHtml->lastActionArray; 
	 
	$ControlHtml->revisionSesion();	 
	
	$path_admin	           	= VarSystem::getPathVariables('dir_template').'site/admin/eventos/'; 	 		 
	$valores 		        = VarSystem::getPost();	
	$archivos		        = VarSystem::getFile();

	$e = null;	

	$ControlGeneralMantenedorEventos = new ControlGeneralEvento($path_admin,$ControlHtml);
    $ControlGeneralMantenedorEventos->setObjetos(new ControlEvento(),new Evento());   		
	
	
	
	switch($lastAction[1])
	{ 
		case 'guardar': 	
			$ControlGeneralMantenedorEventos->objetoGuardar();			
		break;
		case 'eliminar':  
			$ControlGeneralMantenedorEventos->eliminarObjeto();	
		break;
	}
	 
	switch($lastAction[1])
	{	
		default: 			
			$e = $ControlGeneralMantenedorEventos->mostrarListado();
			//die($path_admin.'mant.tpl');
		break;	
		case 'modificar':			
			$e = $ControlGeneralMantenedorEventos->mostrarFormulario();			 
		break;
	}

	echo $e->toHtml();
?>