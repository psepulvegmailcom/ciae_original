<?php
	global $ControlHtml;  
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion(); 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/viajes/'; 
	$ControlGeneral = new ControlGeneralSolicitudesGestion($path_admin,$ControlHtml);  
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	
	if($lastAction[0] == 'view_administracion_viajes')
	{ 
		switch($lastAction[1])
		{	
			case 'consultar_email':				
				$e = $ControlGeneral->formularioSolicitudViajes();
			break;
			case 'guardar': 
				$ControlGeneral->guardarFormularioViajes();
				//$e = $ControlGeneral->formularioSolicitudViajes();
				$f = $ControlGeneral->mostrarEstadosViajes();
				$e = new miniTemplate($path_admin.'alerta_ingreso_correcto.tpl');
				$e->setVariable('contenido',$f->toHtml());
				 //$e = $f;
			break;
			default:
				$e = $ControlGeneral->formularioSolicitudViajesInicio();
			break; 
		}			
	}	
	if($lastAction[0] == 'view_administracion_viajes_revision')
	{
		switch($lastAction[1])
		{	
			case 'guardar': 
				$ControlGeneral->guardarFormularioViajes();
				//$e = $ControlGeneral->formularioSolicitudViajes();
				$f = $ControlGeneral->mostrarEstadosViajes();
				$e = new miniTemplate($path_admin.'alerta_edicion_correcta.tpl');
				$e->setVariable('contenido',$f->toHtml());
				// $e = $f;
			break; 
			default:
				$e = $ControlGeneral->mostrarEstadosViajes();
			break;
			case 'ficha':
				$e = $ControlGeneral->mostrarFichaEstadoViajes();
			break;	
			case 'guardar_estado':				
				$ControlGeneral->guardarEstadoViajes();
				$e = $ControlGeneral->mostrarEstadosViajes();
			break;
		}			
	}	
	
	echo $e->toHtml();
?>