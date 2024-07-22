<?
	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion();	 
	 			 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/boletin/'; 
	$ControlGeneralBoletin = new ControlGeneralBoletin($path_admin,$ControlHtml); 	
	$ControlGeneralBoletin->setObjetos(new ControlBoletin(),new Boletin()); 
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	 
	if($lastAction[0] == 'view_comunicaciones_boletin')
	{ 	 
		switch($lastAction[1])
		{	 
			case 'guardar':  
                $ControlGeneralBoletin->objetoGuardar();
			break; 
		}	 
		switch($lastAction[1])
		{	
			default:
				$e = $ControlGeneralBoletin->mostrarListado();                
			break; 
			case 'modificar':
				$e = $ControlGeneralBoletin->mostrarFormulario();
			break;  
		}			
	}	 
	
	 echo $e->toHtml();
?>