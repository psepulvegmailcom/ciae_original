<?php
	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion();	 
	 			 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/banner/'; 
	$ControlGeneralBanner = new ControlGeneralBanner($path_admin,$ControlHtml); 	
	$ControlGeneralBanner->setObjetos(new ControlBanner(),new Banner()); 
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	 
	if($lastAction[0] == 'view_comunicaciones_banner')
	{ 	 
		switch($lastAction[1])
		{	 
			case 'guardar': 				 
                $ControlGeneralBanner->objetoGuardar();
			break;
			case 'eliminar':  
				$ControlGeneralBanner->eliminarObjeto();	
			break;
		}	 
		switch($lastAction[1])
		{	
			default:
				$e = $ControlGeneralBanner->mostrarListado();                
			break; 
			case 'modificar':
				$e = $ControlGeneralBanner->mostrarFormulario();
			break;  
		}			
	}	 
	
	 echo $e->toHtml();
?>