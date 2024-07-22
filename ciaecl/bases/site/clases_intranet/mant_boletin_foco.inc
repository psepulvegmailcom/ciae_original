<?
	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion();	 
	 			 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/boletin_foco/'; 
	$ControlGeneralBoletinFoco = new ControlGeneralBoletinFoco($path_admin,$ControlHtml); 	
	$ControlGeneralBoletinFoco->setObjetos(new ControlBoletinFoco(),new BoletinFoco()); 
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	 
	if($lastAction[0] == 'view_comunicaciones_boletin_foco')
	{ 	 
		switch($lastAction[1])
		{	 
			case 'guardar': 				 
                $ControlGeneralBoletinFoco->objetoGuardar();
			break;
			case 'eliminar':  
				$ControlGeneralBoletinFoco->eliminarObjeto();	
			break;
		}	 
		switch($lastAction[1])
		{	
			default:
				$e = $ControlGeneralBoletinFoco->mostrarListado();                
			break; 
			case 'modificar':
				$e = $ControlGeneralBoletinFoco->mostrarFormulario();
			break;  
		}			
	}	 
	
	 echo $e->toHtml();
?>