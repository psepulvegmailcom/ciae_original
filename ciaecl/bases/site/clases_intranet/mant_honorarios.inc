<?php

	global $ControlHtml;  	
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion();  
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	
	//Funciones::mostrarArreglo($lastAction,true);
	
	switch($lastAction[0])
	{
		case 'view_administracion_honorarios':
			$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/honorarios/'; 
			$ControlGeneralMantenedor = new ControlGeneralHonorarios($path_admin,$ControlHtml);  
			switch($lastAction[1])
			{  
				case 'consultar_email':	
					$e = $ControlGeneralMantenedor->mostrarFormulario(); 
				break;
				case 'guardar': 
					$ControlGeneralMantenedor->objetoGuardar();	 
					$e = $ControlGeneralMantenedor->mostrarListado();
				break;
				case 'modificar':			 
				 	$e = $ControlGeneralMantenedor->mostrarFormulario(); 
				break;
				default: 			 
					$e = $ControlGeneralMantenedor->mostrarListado();
				break;	
			} 
		break;
		case 'view_administracion_boletas':
			$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/honorarios_boletas/'; 
			$ControlGeneralMantenedor = new ControlGeneralHonorarios($path_admin,$ControlHtml); 
			switch($lastAction[1])
			{ 
				case 'importar':			 
				 	$e = $ControlGeneralMantenedor->importarReporte(); 
				break;
				case 'boletas':
					$e = new miniTemplate($path_admin.'enviar_boletas.tpl');
				 	$e = $ControlGeneralMantenedor->enviarBoletas($e);
				break;
				case 'envio_boletas':			 
				
					$e = new miniTemplate($path_admin.'enviar_boletas.tpl');
				 	$e = $ControlGeneralMantenedor->enviarEmailBoletas($e);
				 	$e->refreshTemplate();
				 	$e = $ControlGeneralMantenedor->enviarBoletas($e);
				break;
				default: 			 
					$e = $ControlGeneralMantenedor->mostrarListado();
				break;	
			}
		break;			
	}
		 
	echo $e->toHtml();
?>