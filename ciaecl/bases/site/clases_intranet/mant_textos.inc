<?
	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
        
	$ControlHtml->revisionSesion();	 
	 			 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/textos/'; 
	$ControlGeneralTextos = new ControlGeneralTextos($path_admin,$ControlHtml); 	
	$ControlGeneralTextos->setObjetos(new ControlTextos(),new Textos()); 
    
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	 
	if($lastAction[0] == 'view_comunicaciones_textos')
	{ 	 
		switch($lastAction[1])
		{	 
			case 'guardar': 				 
                $ControlGeneralTextos->objetoGuardar();
			break;
		/*	case 'eliminar':  
				$ControlGeneralTextos->eliminarObjeto();	
			break;*/
		}	 
		switch($lastAction[1])
		{	
			default:
				$e = $ControlGeneralTextos->mostrarListado();                
			break; 
			case 'modificar':
				$e = $ControlGeneralTextos->mostrarFormulario();
			break;  
		}			
	}	 
	
	 echo $e->toHtml();
?>