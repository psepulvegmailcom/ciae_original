<?php

		global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;
    $theSessionPersona 	= $ControlHtml->elUsuarioPersona;   
	$lastAction 		= $ControlHtml->lastActionArray; 
	 
	$ControlHtml->revisionSesion();	 
	
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/noticias/'; 	 		 
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	 
	$ControlGeneralMantenedor = new ControlGeneralMantenedorNoticias($path_admin,$ControlHtml); 		
	 
	switch($lastAction[1])
	{ 
		case 'guardar': 
			$ControlGeneralMantenedor->objetoGuardar();	 
		break;
		/*case 'eliminar':  
		//	$ControlGeneralMantenedor->eliminarObjeto();	
		break;*/
	}	 
	switch($lastAction[1]) 
	{	
		default: 			 
			$e = $ControlGeneralMantenedor->mostrarListado();
		break;	
		case 'modificar':			 
		 	$e = $ControlGeneralMantenedor->mostrarFormulario(); 
		break;
	} 
	echo $e->toHtml();
?>