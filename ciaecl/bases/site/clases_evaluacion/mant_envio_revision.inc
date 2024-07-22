<?php 
		 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	  
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray;   
	$valores 					= VarSystem::getPost(); 	
	
	$MantenedoresGeneral 		= new MantenedoresGeneral();
	$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction ); 
	$path_admin					= VarSystem::getPathVariables('dir_template').'evaluaciones/revision/';
	$valores 					= VarSystem::getPost(); 	
	$user_permiso				= $ControlHtml->theSession->userObject->permiso;
	$seminario					= $ControlHtml->theSession->userObject->seminario;
	$username		 			= $ControlHtml->theSession->userObject->username;
	$id_evaluacion				= $ControlGeneralEvaluaciones->datos['evaluacion']['id_evaluacion'];
	$id_etapa					= $ControlGeneralEvaluaciones->datos['etapas']['activo']['id_etapa'];	
	$path_doc  					= VarSystem::getPathVariables('dir_repositorio').'doc/envios/'.$id_evaluacion."/";   

	if($ControlGeneralEvaluaciones->revisionSiPuedeSeguirEtapas())
	{  	
	 	if($ControlGeneralEvaluaciones->etapaRevisionEstaActiva())
	 	{  
	 		if($lastAction[2] == 'guardar')
	 		{
				$ControlGeneralEvaluaciones->guardarRevisiones($valores);
 				$ControlGeneralEvaluaciones->completarEtapas($ControlGeneralEvaluaciones->datos['etapas']['activo']['id_etapa']);		
			}
			if($lastAction[2] == 'guardar_final')
			{ 
				$ControlGeneralEvaluaciones->cierreEvaluacionFinal(); 
			}
		 	switch($lastAction[1])
		 	{
				case 'revisarFinal':
					$e = $ControlGeneralEvaluaciones->cierreFormularioEvaluacionFinal();
				break;
				case 'revisar':
					$e = new miniTemplate($path_admin.'form.tpl'); 
					$e = $ControlGeneralEvaluaciones->mostrarFormularioGenericoRevision($e,'revision'); 
				break;
				default:
				
					$ControlGeneralEvaluaciones->ajusteAsignacionRevision();
				
					$asignacionesPendientes = $ControlGeneralEvaluaciones->obtenerAsignacionesRevision('pendiente');
					$asignacionesCerrados 	= $ControlGeneralEvaluaciones->obtenerAsignacionesRevision('cerrado'); 
					
					$ControlGeneralEvaluaciones->revisarEstadoCierreRevisiones($asignacionesPendientes,$asignacionesCerrados);
		
					$e = new miniTemplate($path_admin.'mant_'.$ControlGeneralEvaluaciones->datos['etapas']['activo']['tipo_revision'].'.tpl'); 
					$e->setVariable('opcion_modulo',$lastAction[0]); 
					$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e); 
					
					$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$asignacionesPendientes,'bloque_lista_item_pendiente');
					$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$asignacionesCerrados,'bloque_lista_item_cerrado');
					
					/** REVISAR CASO ULTIMO **/
					if($ControlGeneralEvaluaciones->datos['etapas']['activo']['etapa_ultima'] == 'si' )
					{
						$ControlEvaluacionEnvioFinal = new ControlEvaluacionEnvioFinal();
						$salida = $ControlEvaluacionEnvioFinal->revisionEvaluacionFinal($ControlGeneralEvaluaciones->datos['etapas']['activo']['id_evaluacion'],$ControlGeneralEvaluaciones->datos['usuario']['user_id']);
						 
						$e->addTemplate('bloque_evaluacion_final_'.$salida[0]['estado']); 
					}	 
				break;
			}
		}
		else
		{
			$e = new miniTemplate($path_admin.'cerrada.tpl'); 
			
			$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
			$e->setVariable('orden',$ControlGeneralEvaluaciones->datos['etapas']['activo']['orden']);
			$e->setVariable('nombre_etapa','Retroalimentaci&oacute;n');
			$e->setVariable('descripcion',$ControlGeneralEvaluaciones->datos['evaluacion']['descripcion']);
		} 
	 	Funciones::mostrarArreglo($ControlGeneralEvaluaciones); 
		echo $e->toHtml();
	}
	else
	{
		$e = new miniTemplate($path_admin.'incumplimiento_etapa.tpl'); 
		
		$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
		echo $e->toHtml(); 
	}	 
?>