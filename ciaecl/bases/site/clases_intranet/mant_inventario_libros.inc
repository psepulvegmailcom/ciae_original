<?php

	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	$valores 			= VarSystem::getPost();	
	//	 Funciones::mostrarArreglo($valores,true);
	$ControlHtml->revisionSesion();	 
	
	switch($lastAction[0])
	{
		case 'view_biblioteca_libros_prestamos': 
			 
			$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/inventario_libros_prestamos/';
			 	
			$ControlGeneralInventarioLibrosPrestamos = new ControlGeneralInventarioLibrosPrestamos($path_admin,$ControlHtml); 
			//Funciones::mostrarArreglo(array($ControlGeneralInventarioLibrosPrestamos),true);
			switch($lastAction[1])
			{	 
				case 'guardar':  
		            $ControlGeneralInventarioLibrosPrestamos->objetoGuardarPrestamo();
		            $lastAction[1] = 'modificar';
				break;  
			}	 
			switch($lastAction[1])
			{	
				default: 
					$e = $ControlGeneralInventarioLibrosPrestamos->mostrarListadoPrestamo();                
				break;   
				case 'modificar':
					$e = $ControlGeneralInventarioLibrosPrestamos->mostrarFormularioPrestamo(); 
				break;  
			} 			
		break;
		case 'view_biblioteca_libros':  
			$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/inventario_libros/';  
			$ControlGeneralInventarioLibros = new ControlGeneralInventarioLibros($path_admin,$ControlHtml); 
		 
			$valores 		= VarSystem::getPost();	
			 	 
			switch($lastAction[1])
			{	 
				case 'guardar':  
		            $ControlGeneralInventarioLibros->objetoGuardar();
				break; 
			}	 
			switch($lastAction[1])
			{	
				default:
					$e = $ControlGeneralInventarioLibros->mostrarListado();                
				break;   
				case 'modificar':
					$e = $ControlGeneralInventarioLibros->mostrarFormulario();
				break;  
			} 	 		
		break; 
	} 
	
	echo $e->toHtml();
?>