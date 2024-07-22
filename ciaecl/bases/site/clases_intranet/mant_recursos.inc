<?php

	global $ControlHtml;  	
	$theSession 	= $ControlHtml->theSession;
    $theSessionPersona 	= $ControlHtml->elUsuarioPersona;   
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$ControlHtml->revisionSesion();	 
	
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/recursos/'; 	 		 
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	 
	$ControlGeneralMantenedorRecursos = new ControlGeneralMantenedorRecursos($path_admin,$ControlHtml); 		
	 
	switch($lastAction[1])
	{ 
		case 'guardar': 
			$ControlGeneralMantenedorRecursos->guardarRecurso();			
		break;
		case 'eliminar':  
			$ControlGeneralMantenedorRecursos->eliminarRecursos();	
		break;
	}
	 
	switch($lastAction[1])
	{	
		default: 			
			$e = $ControlGeneralMantenedorRecursos->mostrarListado();
		break;	
		case 'modificar':			
			$e = $ControlGeneralMantenedorRecursos->mostrarFormulario();			 
		break;
	} 
	echo $e->toHtml();
?>