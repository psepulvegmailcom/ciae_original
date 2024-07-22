<?php

	global $ControlHtml;  	
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/enlaprensa/'; 
	 		 
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	
	$MantenedoresGeneral 		= new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto 	= new MantenedoresGeneralObjeto(); 
 	
 	
	$ControlGeneralMantenedor = new ControlGeneralMantenedorEnLaPrensa($path_admin,$ControlHtml); 
	  
	$ControlClase = new ControlNoticiasPrensa(); 
	$ObjetoClase  = new EnLaPrensaObjeto();
	$FormGeneral  = new FormGeneral();  
	
	switch($lastAction[1])
	{ 
		case 'guardar': 
			$ControlGeneralMantenedor->objetoGuardar();	 	
		break;
		case 'eliminar':
			$MantenedoresGeneralObjeto->eliminarObjetoSimple($ObjetoClase,$valores);
		break;
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