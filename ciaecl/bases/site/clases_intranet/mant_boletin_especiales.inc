<?
	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion();	 
	 			 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/boletin_especiales/'; 
	$ControlGeneralBoletinEspeciales = new ControlGeneralBoletinEspeciales($path_admin,$ControlHtml); 	
	$ControlGeneralBoletinEspeciales->setObjetos(new ControlBoletinEspeciales(),new BoletinEspeciales()); 
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	 
	if($lastAction[0] == 'view_comunicaciones_boletin_especiales')
	{ 	 
		switch($lastAction[1])
		{	 
			case 'guardar': 				 
                $ControlGeneralBoletinEspeciales->objetoGuardar();
			break;
			case 'eliminar':  
				$ControlGeneralBoletinEspeciales->eliminarObjeto();	
			break;
		}	 
		switch($lastAction[1])
		{	
			default:
				$e = $ControlGeneralBoletinEspeciales->mostrarListado();                
			break; 
			case 'modificar':
				$e = $ControlGeneralBoletinEspeciales->mostrarFormulario();
			break;  
		}			
	}	 
	
	 echo $e->toHtml();
?>