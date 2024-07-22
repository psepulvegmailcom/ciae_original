<?php

	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion();	 
	 			 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/inventario_libros_ficha/'; 
	$ControlGeneralInventarioLibros = new ControlGeneralInventarioLibros($path_admin,$ControlHtml);  
	
	$valores 		= VarSystem::getPost();	
	 	  
	switch($lastAction[1])
	{	
		default:
			$e = $ControlGeneralInventarioLibros->mostrarListadoFicha();                
		break;   
		case 'modificar':
			$e = $ControlGeneralInventarioLibros->mostrarFormulario();
		break; 
		case 'guardar_palabras_claves':
			$ControlGeneralInventarioLibros->guardarPalabrasClaves();
			$e = $ControlGeneralInventarioLibros->mostrarFormulario();
		break; 
		case 'guardar_solicitud':
			$ControlGeneralInventarioLibros->guardarSolicitud();
			$e = $ControlGeneralInventarioLibros->mostrarListadoFicha(); 
		break; 
	} 	 
	
	echo $e->toHtml();
?>