<?php 
		 
	global $ControlHtml; 
	$ControlHtml->revisionSesion(); 	 
	$theSession 				= $ControlHtml->theSession;   
	$lastAction 				= $ControlHtml->lastActionArray; 
	 
	$path_admin					= VarSystem::getPathVariables('dir_template').'evaluaciones/envio/';   

	$MantenedoresGeneral 		= new MantenedoresGeneral();
	$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction );
	
	$valores 					= VarSystem::getPost(); 	
	$user_permiso				= $ControlHtml->theSession->userObject->permiso;
	$seminario					= $ControlHtml->theSession->userObject->seminario;
	$username		 			= $ControlHtml->theSession->userObject->username;
	$user_id		 			= $ControlHtml->theSession->userObject->user_id;
	$id_evaluacion				= $ControlGeneralEvaluaciones->datos['evaluacion']['id_evaluacion'];
	$id_etapa					= $ControlGeneralEvaluaciones->datos['etapas']['activo']['id_etapa'];	
	$path_doc  					= VarSystem::getPathVariables('dir_repositorio').'doc/envios/'.$id_evaluacion."/";
	
	if($ControlGeneralEvaluaciones->revisionSiPuedeSeguirEtapas())
	{ 
	 	Funciones::mostrarArreglo($ControlGeneralEvaluaciones);
		if($ControlGeneralEvaluaciones->etapaEnvioEstaActiva())
		{
			switch($lastAction[2])
			{
				case 'guardar_final':
					$ControlGeneralEvaluaciones->cierreEvaluacionFinal();
				break;
				case 'eliminar':
					$EvaluacionEnvioActividad = new EvaluacionEnvioActividad();
					$EvaluacionEnvioActividad->buscarObjeto($valores['id_envio']);
					$DocumentFile  = new DocumentFile($path_doc); 
					$DocumentFile->fileName = $EvaluacionEnvioActividad->archivo;
					$DocumentFile->deleteFile();
					$EvaluacionEnvioActividad->eliminarObjeto($valores['id_envio']);			
				break;
				case 'guardar': 				
					if($valores['guardar_caso'] == 'guardar')
					{
						if($ControlGeneralEvaluaciones->datos['etapas']['activo']['estado_particular_envio'] != 'revision' )
						{
							$ControlGeneralEvaluaciones->guardarEnviosParticipante($user_id,$valores);
						}
					}
					else
					{
						if($ControlGeneralEvaluaciones->datos['etapas']['activo']['estado_particular_envio'] != 'envio' )
						{
							$ControlGeneralEvaluaciones->guardarRevisiones($valores);
						}
					} 
					$ControlGeneralEvaluaciones->completarEtapas($ControlGeneralEvaluaciones->datos['etapas']['activo']['id_etapa']);	  		
				break;
			}
		
	
			switch($lastAction[1])
			{
				case 'revisarFinal':
					$e = $ControlGeneralEvaluaciones->cierreFormularioEvaluacionFinal();
				break;
				case 'revisar':
					 
					$e = new miniTemplate($path_admin.'reevaluacion_formulario.tpl'); 		 	
					$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);  
					$e = $ControlGeneralEvaluaciones->mostrarRevisionesEnvioAnterior($e); 
					$e = $ControlGeneralEvaluaciones->mostrarFormularioGenericoRevision($e,'envio');
						 			
				break;
				default:
					/* 
					MOSTRAR FORMULARIO DE REEVALUACION DE LA EVALUACION ANTERIOR				
					*/		
					if($ControlGeneralEvaluaciones->datos['etapas']['activo']['estado_particular_envio'] != 'envio' )
					{
						$ControlGeneralEvaluaciones->asignarRevisionesAnterioresEnvio();
					} 
					
					/*  MOSTRAR FORMULARIO DE ENVIO DE ARCHIVOS NORMALES */
					$e 		= new miniTemplate($path_admin.'form.tpl'); 
					$e->setVariable('opcion_modulo',$lastAction[0]); 
					$e 		= $ControlGeneralEvaluaciones->baseValoresTemplate($e);
					if($ControlGeneralEvaluaciones->datos['etapas']['activo']['estado_particular_envio'] != 'revision' )
					{
						$e->addTemplate('bloque_evaluacion_envio_archivo');
						$envios = $ControlGeneralEvaluaciones->obtenerEnviosParticipante();
						
						if(!$ControlGeneralEvaluaciones->etapaEnvioEstaActiva())
						{ 
							$bloque_despliegue = 'bloque_lista_item_noborrar';
						}
						else
						{
							$bloque_despliegue = 'bloque_lista_item';
							if($ControlGeneralEvaluaciones->sePuedeEnviarMasTrabajos())
							{
								$e->addTemplate('bloque_formulario'); 
								$e->addTemplate('bloque_nuevo_trabajo'); 
								$ControlEvaluacionTipoEnvio = new ControlEvaluacionTipoEnvio();
								$tipos 	= $ControlEvaluacionTipoEnvio->obtenerTipoEnvioEvaluacion($id_evaluacion); 
								$e 		= $MantenedoresGeneral->mostrarSeleccion($e,'bloque_select_tipo_envio',$tipos);
							}
							else
							{
								$e->addTemplate('bloque_no_mas_nuevo_trabajo');
								$e->setVariable('fecha_cierre',$ControlGeneralEvaluaciones->datos['evaluacion']['fecha_cierre_html']);
							}
						} 
					
						$total_envios = count($envios);
						if(is_array($envios) && $total_envios > 0)
						{
							$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$envios,$bloque_despliegue);
						}
						else
						{
							$e->addTemplate('bloque_lista_no_item');
						} 
					}		
					/* 
					MOSTRAR FORMULARIO DE REEVALUACION DE LA EVALUACION ANTERIOR				
					*/		
					if($ControlGeneralEvaluaciones->datos['etapas']['activo']['estado_particular_envio'] != 'envio' )
					{ 
						if($ControlGeneralEvaluaciones->datos['etapas']['activo']['estado_asignacion'] == 'asignado')
						{ 
							$e->addTemplate('bloque_evaluacion_anterior');  
							$e 		= $ControlGeneralEvaluaciones->baseValoresTemplate($e);	
							$id_etapa_envio_anterior = $ControlGeneralEvaluaciones->obtenerEtapaEnvioAnterior();
							$envios_anteriores = $ControlGeneralEvaluaciones->obtenerEnviosParticipante($id_etapa_envio_anterior);
						 		
							$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$envios_anteriores,'bloque_lista_item_reevaluacion'); 
				
							$asignacionesPendientes = $ControlGeneralEvaluaciones->obtenerAsignacionesRevision('pendiente');
							$asignacionesCerrados 	= $ControlGeneralEvaluaciones->obtenerAsignacionesRevision('cerrado'); 

							$retroalimentaciones = $ControlGeneralEvaluaciones->buscarRetroalimentacionUsuario($ControlGeneralEvaluaciones->datos['evaluacion']['id_evaluacion'],2,$ControlGeneralEvaluaciones->datos['usuario']['user_id']);

							

				  			Funciones::mostrarArreglo($retroalimentaciones,true,"retroalimentaciones");


							$e->setVariable('opcion_modulo',$lastAction[0]); 
							$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);

							$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$retroalimentaciones,'bloque_lista_todas_retroalimentaciones');

							$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$asignacionesPendientes,'bloque_lista_item_pendiente');
							$e = $MantenedoresGeneral->mostrarListadoGenerico($e,$asignacionesCerrados,'bloque_lista_item_cerrado'); 
							Funciones::mostrarArreglo(array($envios_anteriores,$asignacionesPendientes,$asignacionesCerrados));  
						} 
					}
					
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
			$e = new miniTemplate($path_admin.'no_activo.tpl');  
			$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
		}
		echo $e->toHtml(); 
	}
	else
	{
		$e = new miniTemplate($path_admin.'incumplimiento_etapa.tpl'); 
		$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
		echo $e->toHtml(); 
	}
 	Funciones::mostrarArreglo(array('SALIDA FINAL',$ControlGeneralEvaluaciones));
	Funciones::mostrarArreglo($envios);
?>