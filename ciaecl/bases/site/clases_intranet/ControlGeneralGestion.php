<?php

	class ControlGeneralSolicitudesGestion extends ControlGeneral
	{
		function ControlGeneralSolicitudesGestion($path_admin,$ControlHtml)
		{
			parent::ControlGeneral($path_admin,$ControlHtml); 			
			$this->valores 		= VarSystem::getPost();
			//Funciones::mostrarArreglo($this,true);
		}
		
		function formularioSolicitudViajesInicio()
		{
			$e = new miniTemplate($this->path_admin.'form_inicio_simple.tpl'); 
			$e = $this->setearVariablesGenerales($e); 
			
			$e->addTemplate('bloque_autocomplete_email_personas_script');
			$PersonaControl = new PersonaControl();
			$personas = $PersonaControl->getListaEmailSimple();
			
			//Funciones::mostrarArreglo($personas,false,'ddddddddddddddddddddddddsssssssssssssssssssssssss');
			
			$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$personas,'bloque_autocomplete_email_personas');	
			return $e;
		}
		
		function formularioPersonas($e,$caso='viaticos')
		{
			//Funciones::mostrarArreglo($this->usuario,true); 
			if(trim($this->valores['form_id_persona']) != '')
			{ 
				$persona = array();
				$PersonaControl = new PersonaControl();
				$ControlPersonaObjeto = new ControlPersonaObjeto();
				//$ControlPersonaObjeto->sourceTable = $PersonaControl->sourceTable;
				//Funciones::mostrarArreglo($ControlPersonaObjeto ,true); 
				
				//$persona = $ControlPersonaObjeto->obtenerDatosId($this->valores['form_id_persona']);
				
				$ControlGestionPersonasVista = new ControlGestionPersonasVista(); 
				$persona = $ControlGestionPersonasVista->obtenerElemento($this->valores['form_id_persona']);  
				
			//	$persona = $ControlPersonaObjeto->obtenerDatosEmail($this->valores['form_email']);
				$persona[0]['email'] = $this->valores['form_email'];
				 //Funciones::mostrarArreglo($persona[0],true);
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$persona[0]); 
				
				$archivos = array('rut','pasaporte','cv');
				for($i=0; $i < count($archivos);$i++)
				{					 
					$e->addTemplate('bloque_archivo_'.$archivos[$i].'_form');
					 
					if(trim($persona[0]['archivo_'.$archivos[$i]]) != '')
					{
						$e->addTemplate('bloque_archivo_'.$archivos[$i].'_file');
						$e->setVariable('archivo',$persona[0]['archivo_'.$archivos[$i]]);
					}				
				}
				
				if($caso == 'honorarios')
				{
					$e->addTemplate('bloque_datos_ficha_honorarios');
					$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$persona[0]); 
				}
			} 			
			return $e;
		}
				
		function formularioSolicitudViajes()
		{  			 
			$e = new miniTemplate($this->path_admin.'form.tpl'); 
			$e = $this->setearVariablesGenerales($e); 

			if(isset($this->valores['id_item']) && trim($this->valores['id_item']) != '')
			{
				/* es edici&oacute;n del formulario */
				
				$ControlVistaGestionSolicitudesEstados = new ControlVistaGestionSolicitudesEstados();
				$solicitud = $ControlVistaGestionSolicitudesEstados->obtenerSolicitud($this->valores['id_item']); 
				$e->addTemplate('bloque_edicion_solicitud_devolucion_simple');
				$e->setVariable('observacion',str_replace("
"," ",$solicitud[0]['observacion']));
				//Funciones::mostrarArreglo($solicitud,true);
				//$ControlPersonaObjeto = new ControlPersonaObjeto();
				//$persona = $ControlPersonaObjeto->obtenerDatosId($solicitud[0]['id_persona_beneficiario']);
				
				$ControlPersonaObjeto = new PersonaControl();
				$persona = $ControlPersonaObjeto->getPersonaFicha($solicitud[0]['id_persona_beneficiario']);
				//Funciones::mostrarArreglo($persona,true); 
				$this->valores['form_email'] = $persona[0]['email'];
				
				$ControlGestionSolicitudesViaticos = new ControlGestionSolicitudesViaticos();
				$listado = $ControlGestionSolicitudesViaticos->obtenerDetalle($this->valores['id_item']);
				//Funciones::mostrarArreglo($listado,true); 
				for($i=0;$i < count($listado);$i++)
				{
					$aux_i = $i + 1;
					$e->addTemplate('bloque_edicion_solicitud_devolucion');
					$e->setVariable('aux_i',$aux_i);
					foreach($listado[$i] as $var => $val)
					{
						if($var == 'fecha_fin' || $var == 'fecha_inicio')
						{ 
							$val = ControladorFechas::invertirFecha($val); 
						}
						$e->setVariable($var,str_replace("
"," ",$val));
						
						if($var == 'publico_objetivo_texto')
						{
							$aux = explode(',',$val);
							for($k=0; $k < count($aux);$k++)
							{
								$e->addTemplate('bloque_edicion_solicitud_devolucion_objetivo');
								$e->setVariable('aux_i',$aux_i);
								$e->setVariable('publico_objetivo_texto',trim($aux[$k]));
							}
						} 
					}
				}
				$e->refreshTemplate();
			}
			 
			$e->setVariable('fecha', ControladorFechas::fechaActual(false,true));
			$e->setVariable('fecha_mostrar', ControladorFechas::fechaActual(false,true));			
			$e->setVariable('fecha_insert', ControladorFechas::fechaActual(true,true));	
			$e->setVariable('time_insert', time());
			
			//Funciones::mostrarArreglo($this,true);
		 				
			$ControlVistaCentroCostosResponsable = new ControlVistaCentroCostosResponsable();
			$ControladorPermisosParticulares = new ControladorPermisosParticulares();
			if($ControladorPermisosParticulares->PermisoHabilitadoModuloPermisoParticular($this->usuario->permiso,'viajes','lista_centros_costos_completo'))
			{ 
				$proyectos_responsable = $ControlVistaCentroCostosResponsable->buscarProyectosAdministracion();
			}
			else
			{		 			
				$proyectos_responsable = $ControlVistaCentroCostosResponsable->buscarProyectosResponsable($this->usuario->user_id);	
			} 		
			//Funciones::mostrarArreglo($proyectos_responsable,true); 
				 
			$e = $this->formularioPersonas($e); 
			
			$filas = 5;
			for($i=1; $i <= $filas ; $i++)
			{
				$e->addTemplate('bloque_fila_itinerario');
				//Funciones::mostrarArreglo($proyectos_responsable,true);
								
				$e->setVariable('fila',$i);
				$aux = $i + 1 ;
				if($aux < $filas)
				{
					$e->addTemplate('bloque_fila_itinerario_nuevo');
					$e->setVariable('fila_siguiente',$aux);
				}
				if(is_array($proyectos_responsable) && count($proyectos_responsable) >0 )
				{					 
					$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$proyectos_responsable,'bloque_proyectos_paga_viatico');		 
					$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$proyectos_responsable,'bloque_proyectos_paga_pasajes');		 
					$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$proyectos_responsable,'bloque_proyectos_paga_reembolsos');
				} 
			
				$ControlGestionDestinos = new ControlGestionDestinos();
				$destinos = $ControlGestionDestinos->obtenerListadoSimple();
				
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$destinos,'bloque_autocomplete_destino_origen');	 
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$destinos,'bloque_autocomplete_destino_destino');	
				//Funciones::mostrarArreglo($destinos,true);					
			} 				
			   
			return $e;			
		}
		
		function guardarFormularioViajes()
		{  
			$e_carta = new miniTemplate($this->path_admin.'carta/nueva_solicitud.tpl'); 
			
			
			/* SE GUARDAN LOS DATOS DE LA PERSONA BENEFICIARIA */
			$Persona = new PersonaObjeto();
			$Persona->buscarObjetoGenerico("email = '".$this->valores['form_email']."'"); 
			
			Funciones::mostrarArreglo($Persona,true);
			$Persona = $this->MantenedoresGeneralObjeto->setearVariablesGuardarObjetoSimple($Persona,$this->valores);
			 
			$e_carta = $this->MantenedoresGeneral->mostrarElementoValores($e_carta,$this->persona_datos);
			$e_carta = $this->MantenedoresGeneral->mostrarElementoValores($e_carta,$this->valores);
		
			if(trim($this->valores['archivo_rut_original']) != '' && trim($this->valores['form_archivo_rut']) == '')
			{
				$Persona->archivo_rut = $this->valores['archivo_rut_original'];
			}
			if(trim($this->valores['archivo_pasaporte_original']) != '' && trim($this->valores['form_archivo_pasaporte']) == '')
			{
				$Persona->archivo_pasaporte  = $this->valores['archivo_pasaporte_original'];
			}
			if(trim($this->valores['archivo_cv_original']) != '' && trim($this->valores['form_archivo_cv']) == '')
			{
				$Persona->archivo_cv = $this->valores['archivo_cv_original'];
			}
			 
			if($Persona->newObject)
			{
				$Persona->user_id = md5(time().$this->valores['form_email']);
			}
			$Persona->guardarObjeto();	
			if(!isset($Persona->id_persona))
			{
				$Persona->id_persona = $Persona->id;
			}
			
			// Funciones::mostrarArreglo($this,true);
			
			/* SE GUARDAN LOS DATOS DE LA SOLICITUD EN PARTICULAR, DE LA FICHA, YA SEA NUEVA O EDITARLA PARA SU ACTUALIZACION  */
			$GestionSolicitudes = new GestionSolicitudes(); 
			if(isset($this->valores['id_item']) && trim($this->valores['id_item']) != '') /* edici&oacute;n de solicitud anterior*/
			{
				$GestionSolicitudes->buscarObjeto($this->valores['id_item']);
				$this->valores['id_solicitud'] = $this->valores['id_item'];
				$this->valores['id_solicitud_estado'] = 'solicitud_devolucion';
			}

			$GestionSolicitudes->observacion 				= $this->valores['formviajeglobal_observacion'];
			$GestionSolicitudes->id_persona_solicitante 	= $this->usuario->user_id;
			$GestionSolicitudes->id_persona_beneficiario 	= $Persona->id_persona;
			$GestionSolicitudes->id_solicitud_estado 		= 'revision_presupuesto';
			$GestionSolicitudes->fecha_solicitud 			= $this->valores['formviajeglobal_fecha'];
			$GestionSolicitudes->id_tipo_solicitudes		= 'viajes_viaticos';
			$GestionSolicitudes->guardarObjeto();
			Funciones::mostrarArreglo(	$GestionSolicitudes,'false','actualizacion 00');
			
			
				
			 //Funciones::mostrarArreglo($GestionSolicitudes,true);
			 /* EDICI&oacute;N DE SOLICITUD ANTERIOR */
			if(isset($this->valores['id_item']) && trim($this->valores['id_item']) != '') 
			{
				$GestionSolicitudes->id 	= $GestionSolicitudes->id_solicitud;
				$GestionSolicitudesViaticos = new GestionSolicitudesViaticos(); 
				$GestionSolicitudesViaticos->eliminarObjeto($this->valores['id_item']);
			}			 
			$e_carta->setVariable('id_solicitud',$GestionSolicitudes->id);
			
			
			/* SE GUARDAN LOS DATOS PROPIOS DE CADA TRAMO DE LA SOLICITUD */
			$total = count($this->valores['formviaje_orden']);
			$this->valores['formviaje_archivo_reembolsos'] = array();
			$this->valores['formviaje_archivo_invitaciones'] = array();
			for($i=1; $i <= $total; $i++) /* acomodamos ingreso de las fechas para que soportara script de claendario */
			{
				$this->valores['formviaje_fecha_inicio'][$i] = $this->valores['formviaje_fecha_inicio_'.$i];
				$this->valores['formviaje_fecha_fin'][$i] = $this->valores['formviaje_fecha_fin_'.$i];
				unset($this->valores['formviaje_fecha_inicio_'.$i]);
				unset($this->valores['formviaje_fecha_fin_'.$i]);
				
				$this->valores['formviaje_archivo_reembolsos'][$i]   = $this->valores['formviaje_archivo_reembolsos_'.$i];
				$this->valores['formviaje_archivo_invitaciones'][$i] = $this->valores['formviaje_archivo_invitaciones_'.$i]; 
				unset($this->valores['formviaje_archivo_reembolsos_'.$i]);
				unset($this->valores['formviaje_archivo_invitaciones_'.$i]);				
			}
			//Funciones::mostrarArreglo($this->valores,true);
			for($i=1; $i <= $total; $i++)
			{
				if(trim($this->valores['formviaje_objetivo'][$i]) != '')
				{
					$GestionSolicitudesViaticos = new GestionSolicitudesViaticos(); 
					 
					$e_carta->addTemplate('bloque_envio_tramo');
					$e_carta->setVariable('tramo',$i);
					
					//Funciones::mostrarArreglo($GestionSolicitudesViaticos,true);
					// Funciones::mostrarArreglo($GestionSolicitudes,true);
					$GestionSolicitudesViaticos->id_solicitud = $GestionSolicitudes->id;
					$GestionSolicitudesViaticos->orden = $this->valores['formviaje_orden'][$i]; 
					
					$this->valores['formviaje_publico_objetivo_texto'][$i] = implode(', ',$this->valores['formviaje_publico_objetivo'][$i]); 
					
					$prefijo = 'formviaje';
					foreach($this->valores as $var => $arreglo)
					{
						$aux = explode('_',$var);
						if($aux[0] == $prefijo)
						{ 
							$aux = str_replace($prefijo.'_','',$var);
							// echo $aux.' '.$arreglo[$i].'<br>';
 							$GestionSolicitudesViaticos->$aux = $arreglo[$i]; 
							$e_carta->setVariable($aux,$arreglo[$i]);
						}
					}   
					$GestionSolicitudesViaticos->fecha_fin 		= ControladorFechas::invertirFecha($GestionSolicitudesViaticos->fecha_fin);
					$GestionSolicitudesViaticos->fecha_inicio 	= ControladorFechas::invertirFecha($GestionSolicitudesViaticos->fecha_inicio);
					$GestionSolicitudesViaticos->guardarObjeto();
					
					
					if($this->valores['formviaje_viatico_si_paga'][$i] == '110316024201256' || $this->valores['formviaje_pasajes_si_paga'][$i] == '110316024201256' || $this->valores['formviaje_reembolsos_si_paga'][$i] == '110316024201256')
					{			
						//Funciones::mostrarArreglo($GestionSolicitudes,true);			
						$GestionSolicitudes->id_solicitud_estado	= 'revision_presupuesto_direccion';
						$GestionSolicitudes->guardarObjeto($GestionSolicitudes->id); 
						Funciones::mostrarArreglo(	$GestionSolicitudes,'false','actualizacion 0');
					}									
				}
			} 
			 
			
			/** REGISTRO DEL CAMBIO DE ESTADO EN PARTICULAR */
			$asunto_email = 'Nueva solicitud';
			if(isset($this->valores['id_item']) && trim($this->valores['id_item']) != '') /* EDICI&oacute;N DE SOLICITUD ANTERIOR */
			{
				/* es un ingreso nuevo */ 
				$GestionSolicitudesEstados = new GestionSolicitudesEstados();
				$GestionSolicitudesEstados->buscarElementoEstado($this->valores['id_solicitud'],$this->valores['id_solicitud_estado']);
				$GestionSolicitudesEstados->user_id_responsable = $this->usuario->user_id;

				$GestionSolicitudesEstados->fecha_cierre 	= ControladorFechas::fechaActual();
				$GestionSolicitudesEstados->comentarios 	= "Edici&oacute;n de solicitante";
				$GestionSolicitudesEstados->guardarObjeto();				
				$asunto_email = 'Edici&oacute;n solicitud';
			}  

			$GestionSolicitudesEstados = new GestionSolicitudesEstados();
			$GestionSolicitudesEstados->id_solicitud 		= $GestionSolicitudes->id;
			$GestionSolicitudesEstados->id_solicitud_estado = 'solicitud';
			$GestionSolicitudesEstados->fecha 				= $GestionSolicitudes->fecha_solicitud;
			$GestionSolicitudesEstados->fecha_cierre		= $GestionSolicitudes->fecha_solicitud;		
			$GestionSolicitudesEstados->user_id_responsable = $this->usuario->user_id; 	
			$GestionSolicitudesEstados->comentarios			= nl2br($this->valores['formviajeglobal_observacion']);
			$GestionSolicitudesEstados->guardarObjeto();
			Funciones::mostrarArreglo($GestionSolicitudesEstados,'false','actualizacion 1');	

			$GestionSolicitudesEstados = new GestionSolicitudesEstados();
			$GestionSolicitudesEstados->id_solicitud 		= $GestionSolicitudes->id;
			$GestionSolicitudesEstados->id_solicitud_estado = $GestionSolicitudes->id_solicitud_estado;
			$GestionSolicitudesEstados->user_id_responsable = $this->usuario->user_id; 
			$GestionSolicitudesEstados->fecha 				= $GestionSolicitudes->fecha_solicitud; 
			$GestionSolicitudesEstados->guardarObjeto();   
			Funciones::mostrarArreglo($GestionSolicitudesEstados,'false','actualizacion 2');
			 
			$e_solicitante = $e_carta;
			$e_solicitante->addTemplate('bloque_envio_solicitante'); 
			Funciones::sendEmail($this->persona_datos['email'],'[INTRANET] '.$asunto_email.' de viajes y viaticos',$e_solicitante->toHtml());
			$ControlVistaGestionDatosEncargados = new ControlVistaGestionDatosEncargados();
			$e_responsable = $e_carta;
			$e_responsable->addTemplate('bloque_envio_responsable_comentario');			
			$e_responsable->setVariable('estado',$this->valores['aprobacion_solicitud']);
			$e_responsable->setVariable('comentario',nl2br($this->valores['comentario'])); 
			$e_responsable->addTemplate('bloque_envio_responsable');
			if($GestionSolicitudes->id_solicitud_estado == 'revision_presupuesto_direccion') 
			{					
 				Funciones::sendEmail($ControlVistaGestionDatosEncargados->obtenerEmailEstado('revision_presupuesto_direccion'),'[INTRANET] '.$asunto_email.' de viajes y viaticos ID '.$GestionSolicitudes->id,$e_responsable->toHtml());
 				
 				Funciones::sendEmail($ControlVistaGestionDatosEncargados->obtenerEmailEstado('revision_presupuesto'),'[INTRANET] '.$asunto_email.' de viajes y viaticos ID '.$GestionSolicitudes->id.'  (pendiente revisi&oacute;n direcci&oacute;n)',$e_responsable->toHtml());
			}
			if($GestionSolicitudes->id_solicitud_estado == 'revision_presupuesto') 
			{ 
 				Funciones::sendEmail($ControlVistaGestionDatosEncargados->obtenerEmailEstado('revision_presupuesto'),'[INTRANET] Nueva solicitud de viajes y viaticos ID '.$GestionSolicitudes->id,$e_responsable->toHtml());
			} 
			//echo $e_responsable->toHtml();		
		}
		
		function mostrarEstadosViajes($caso='gestion')
		{ 
			$e = new miniTemplate($this->path_admin.'mant.tpl');
			$ControlVistaGestionSolicitudesEstados = new ControlVistaGestionSolicitudesEstados();
		//	Funciones::mostrarArreglo($this->usuario,true);
		
			$listado_pendiente = $ControlVistaGestionSolicitudesEstados->obtenerListadoPendienteUsuario($this->usuario->user_id);
			$listado_no_pendiente = $ControlVistaGestionSolicitudesEstados->obtenerListadoSolicitudNoPendienteUsuario($this->usuario->user_id);
			switch($this->usuario->permiso)
			{
				case 'jefe_administracion':					
					$listado_no_pendiente = $ControlVistaGestionSolicitudesEstados->obtenerListadoSolicitudNoPendienteUsuario($this->usuario->user_id,TRUE);
				break;
				case 'superadministrador':				
					$listado_no_pendiente = $ControlVistaGestionSolicitudesEstados->obtenerListadoSolicitudNoPendienteUsuario($this->usuario->user_id,TRUE);
				break; 
			}			 
			$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$listado_pendiente,'lista_item');
			
			$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$listado_no_pendiente,'lista_item_realizadas');
//  			Funciones::mostrarArreglo($listado_pendiente,true);
//  			Funciones::mostrarArreglo($listado_no_pendiente,true);
			
			$path_template_reporte	= VarSystem::getPathVariables('dir_template').'site/admin/viajes/reportes/solicitudes_reporte.tpl';
			if(!is_array($listado_pendiente) || count($listado_pendiente) == 0)
			{
				$listado_pendiente = array();
			}
			$estados_reportes = array_merge($listado_pendiente, $listado_no_pendiente);  
  			//Funciones::mostrarArreglo($estados_reportes,true); 
			$reporte_listado_solicitudes 		= $this->FormGeneral->generarArchivoReporteExcell($estados_reportes,'estados_pendientes',$path_template_reporte);	 
			$e->refreshTemplate();
			//Funciones::mostrarArreglo($reporte_listado_solicitudes,true); 
			$e->setVariable('estados_solicitudes_archivo',$reporte_listado_solicitudes); 
			return $e;	 	
		}

		function mostrarDatosFicha($e,$persona)
		{
			$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$persona[0]); 	

			$archivos = array('rut','pasaporte','cv');
			for($i=0; $i < count($archivos);$i++)
			{
				if(trim($persona[0]['archivo_'.$archivos[$i]]) == '')
				{
					$e->addTemplate('bloque_archivo_'.$archivos[$i].'_form');
				}
				else
				{
					$e->addTemplate('bloque_archivo_'.$archivos[$i].'_file');
					$e->setVariable('archivo',$persona[0]['archivo_'.$archivos[$i]]);
				}				
			} 	 
			return $e;
		}		
		
		function mostrarFichaEstadoViajes()
		{ 
			$e = new miniTemplate($this->path_admin.'form_estados.tpl'); 
			if($this->usuario->permiso == 'investigador')
			{
				$e = new miniTemplate($this->path_admin.'form_estados_investigador.tpl');
			}		 
			 
			$ControlVistaCentroCostosResponsable = new ControlVistaCentroCostosResponsable();
			$centros_costo = $ControlVistaCentroCostosResponsable->obtenerListadoPorId();
			 
			$ControlVistaGestionSolicitudesEstados = new ControlVistaGestionSolicitudesEstados();
			$solicitud = $ControlVistaGestionSolicitudesEstados->obtenerSolicitud($this->valores['id_item']);  
			
			if($solicitud[0]['user_id_responsable'] != $this->usuario->user_id)
			{				
				$e = new miniTemplate($this->path_admin.'form_estados_investigador.tpl');
				if($solicitud[0]['id_persona_solicitante'] == $this->usuario->user_id)
				{ 
					if($solicitud[0]['id_solicitud_estado'] == 'solicitud_revision_cotizacion')
					{
						$e = new miniTemplate($this->path_admin.'form_estados.tpl'); 
					}
					if($solicitud[0]['id_solicitud_estado'] == 'solicitud_devolucion' || $solicitud[0]['id_solicitud_estado'] == 'solicitud')
					{
						return $this->formularioSolicitudViajes(); 
					}
				} 
			}
			//Funciones::mostrarArreglo($solicitud,true);  
			
		 	$e->setVariable('id_solicitud',$solicitud[0]['id_solicitud']);
		 	$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$solicitud[0]);
			$e->setVariable('disable_input','disabled');

		 	$e->setVariable('observacion',$solicitud[0]['observacion']);
				 //Funciones::mostrarArreglo($solicitud,true);
			$ControlGestionSolicitudesViaticos = new ControlGestionSolicitudesViaticos();
			$listado = $ControlGestionSolicitudesViaticos->obtenerDetalle($this->valores['id_item']);
			$total = count($listado);
			$colspan_tabla = $total+4; //* numero de tramos m&Aacute;s ortas columnas informativos*/
			$e->setVariable('colspan_tabla',$colspan_tabla);
			// Funciones::mostrarArreglo($centros_costo,true); 
			for($i=0;$i < $total;$i++)
			{
				$listado[$i]['pasajes_si_paga'] = $centros_costo[$listado[$i]['pasajes_si_paga']]['codigo'].' '.$centros_costo[$listado[$i]['pasajes_si_paga']]['centro_costo'];
				$listado[$i]['viatico_si_paga'] = $centros_costo[$listado[$i]['viatico_si_paga']]['codigo'].' '.$centros_costo[$listado[$i]['viatico_si_paga']]['centro_costo'];
				$listado[$i]['reembolsos_si_paga'] = $centros_costo[$listado[$i]['reembolsos_si_paga']]['codigo'].' '.$centros_costo[$listado[$i]['reembolsos_si_paga']]['centro_costo'];
				
				$e->addTemplate('bloque_estado_vista_tramo');
				$e->setVariable('orden',$listado[$i]['orden']);				
				
				$aux = $i + 1;
				$e->addTemplate('bloque_fila_itinerario_tramo_ficha');
				$e->setVariable('fila',$aux);
				$e->setVariable('colspan_tabla',$colspan_tabla);
				$e->setVariable('disable_input','disabled');
				$listado[$i]['fecha_inicio'] = ControladorFechas::invertirFecha($listado[$i]['fecha_inicio']);
				$listado[$i]['fecha_fin'] = ControladorFechas::invertirFecha($listado[$i]['fecha_fin']); 
				
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$listado[$i]); 
			} 
			// Funciones::mostrarArreglo($listado,true);

			$ControlGestionSolicitudesEstadosHistorialVista = new ControlGestionSolicitudesEstadosHistorialVista();
			$historial = $ControlGestionSolicitudesEstadosHistorialVista->obtenerHistorial($solicitud[0]['id_solicitud']);
			//array_pop($historial);		
		 	//Funciones::mostrarArreglo($historial,true);
		 	$total_historial = count($historial);
		 	
			for($i=0; $i < $total_historial;$i++)
			{
				$e->addTemplate('bloque_estado_estados_historial');
				if($historial[$i]['fecha_cierre'] == '0000-00-00 00:00:00')
				{
					$historial[$i]['fecha_cierre'] = '';
				}
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$historial[$i]);
				
				$ControlGestionSolicitudesEstadosArchivos = new ControlGestionSolicitudesEstadosArchivos();
				$archivos = $ControlGestionSolicitudesEstadosArchivos->obtenerArchivosEstado($historial[$i]['id_solicitud'],$historial[$i]['id_solicitud_estado'],$historial[$i]['fecha']);
				//Funciones::mostrarArreglo($archivos ,true);
				if(is_array($archivos) && count($archivos) > 0)
				{
					$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$archivos,'bloque_estado_estados_historial_archivos');
				}				
			} 
			 	 	
			$ControlPersonaObjeto = new PersonaControl();
			$persona = $ControlPersonaObjeto->getPersonaFicha($solicitud[0]['id_persona_beneficiario']);
			//Funciones::mostrarArreglo($persona,false,'personota');
			$persona[0]['rut_html'] = Funciones::formatoNumero($persona[0]['rut']);
			$e->refreshTemplate();
			$e = $this->mostrarDatosFicha($e,$persona);
			//echo 'bloque_estado_'.$solicitud[0]['id_solicitud_estado'];
			$e->addTemplate('bloque_estado_'.$solicitud[0]['id_solicitud_estado']);
			$total_archivos_extras = 7;
			for($j=1; $j < $total_archivos_extras;$j++)
			{
				$e->addTemplate('bloque_estado_'.$solicitud[0]['id_solicitud_estado'].'_archivo');
				$e->setVariable('i_archivo',$j);
			}
			
			$ControlGestionSolicitudesEstadosArchivos = new ControlGestionSolicitudesEstadosArchivos();
			if($this->usuario->permiso == 'investigador')
			{
				$archivos_solictud = $ControlGestionSolicitudesEstadosArchivos->obtenerArchivosCotizaciones($this->valores['id_item']);
			}
			else
			{
				$archivos_solictud = $ControlGestionSolicitudesEstadosArchivos->obtenerArchivos($this->valores['id_item']);
			}
			//Funciones::mostrarArreglo($archivos_solictud,true);
			if(is_array($archivos_solictud) && count($archivos_solictud)>0)
			{
				$e->addTemplate('bloque_estado_ficha_documentos_pestana');
				$e->addTemplate('bloque_estado_ficha_documentos');
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$archivos_solictud,'bloque_estado_ficha_documentos_detalle');
			}
			return $e;
		}
		
		function guardarEstadoViajes()
		{			
			//Funciones::mostrarArreglo($this->valores,true);
			$GestionSolicitudes = new GestionSolicitudes();
			$GestionSolicitudes->buscarObjeto($this->valores['id_solicitud']);
			// Funciones::mostrarArreglo($GestionSolicitudes,true);

			$GestionSolicitudesEstados = new GestionSolicitudesEstados();
			$GestionSolicitudesEstados->buscarElementoEstado($this->valores['id_solicitud'],$this->valores['id_solicitud_estado']);
			$GestionSolicitudesEstados->user_id_responsable = $this->usuario->user_id;
			//Funciones::mostrarArreglo($GestionSolicitudesEstados,true); 
			//Funciones::mostrarArreglo($this,true);

			$archivos = VarSystem::getFile();	
			for($i=1; $i < 100; $i++)
			{
				//print_r($archivos['archivo_'.$i]);
				if(isset($archivos['archivo_'.$i]))
				{
				/*	$GestionSolicitudesEstadosArchivos = new GestionSolicitudesEstadosArchivos();
					$path = VarSystem::getPathVariables('dir_repositorio').'doc/solicitudes_gestion/archivos/';  					
					$extension = explode('.',$archivos['archivo_'.$i]["name"]);
					$extension = array_pop($extension);
					$aux = $this->valores['id_solicitud'].'-'.time().'.'.$extension;
					move_uploaded_file($archivos['archivo_'.$i]["tmp_name"],$path. $aux);
					$GestionSolicitudesEstadosArchivos->id_solicitud 		= $this->valores['id_solicitud'];
					$GestionSolicitudesEstadosArchivos->id_solicitud_estado = $this->valores['id_solicitud_estado'];
					$GestionSolicitudesEstadosArchivos->fecha 				= $this->valores['fecha'];
					$GestionSolicitudesEstadosArchivos->nombre 				= $this->valores['nombre_archivo_'.$i];
					$GestionSolicitudesEstadosArchivos->archivo 			= $aux;
					$GestionSolicitudesEstadosArchivos->guardarObjeto();*/
					//Funciones::mostrarArreglo($GestionSolicitudesEstadosArchivos,true);					 
				}
				else
				{
					if(isset($this->valores['archivo_'.$i]) && trim($this->valores['archivo_'.$i]) != '')
					{
						$GestionSolicitudesEstadosArchivos = new GestionSolicitudesEstadosArchivos(); 
						$GestionSolicitudesEstadosArchivos->id_solicitud 		= $this->valores['id_solicitud'];
						$GestionSolicitudesEstadosArchivos->id_solicitud_estado = $this->valores['id_solicitud_estado'];
						$GestionSolicitudesEstadosArchivos->fecha 				= $this->valores['fecha'];
						$GestionSolicitudesEstadosArchivos->nombre 				= $this->valores['nombre_archivo_'.$i];
						$GestionSolicitudesEstadosArchivos->archivo 			= $this->valores['archivo_'.$i];
						$GestionSolicitudesEstadosArchivos->guardarObjeto();
						//Funciones::mostrarArreglo($GestionSolicitudesEstadosArchivos,true);					 
					}
					else
					{
						break;
					}
				}			 
			}  
			
			$GestionSolicitudesEstados->fecha_cierre 	= ControladorFechas::fechaActual();
			$GestionSolicitudesEstados->comentarios 	= nl2br($this->valores['comentario']);
			$GestionSolicitudesEstados->guardarObjeto();
			//Funciones::mostrarArreglo($GestionSolicitudesEstados,false,'GestionSolicitudesEstados');
			
			$ControlGestionTipoSolicitudes = new ControlGestionTipoSolicitudes(); 
			
			$nuevo_estado = $ControlGestionTipoSolicitudes->obtenerEstadoDecisionEstado($GestionSolicitudes->id_tipo_solicitudes,$this->valores['id_solicitud_estado'],$this->valores['aprobacion_solicitud']); 
			
			//Funciones::mostrarArreglo($nuevo_estado,false,'nuevo estado-------');
			if($nuevo_estado['temporalidad'] == 'hito')
			{ 
				$proximo_estado = $ControlGestionTipoSolicitudes->obtenerEstadoSiguiente($GestionSolicitudes->id_tipo_solicitudes,$nuevo_estado['id_tipo_estado'],false);
				
				$GestionSolicitudesEstadosExtra = $GestionSolicitudesEstados;
				$GestionSolicitudesEstadosExtra->newObject = true;
				$GestionSolicitudesEstadosExtra->id_solicitud_estado = $nuevo_estado['id_tipo_estado'];
				$GestionSolicitudesEstadosExtra->user_id_responsable = $nuevo_estado['user_id_responsable'];
				$GestionSolicitudesEstadosExtra->fecha = $GestionSolicitudesEstadosExtra->fecha_cierre;
				$GestionSolicitudesEstadosExtra->guardarObjeto();
				$nuevo_estado = $proximo_estado['id_tipo_estado']; 
			}
			else
			{
				$nuevo_estado = $nuevo_estado['id_tipo_estado'];
			} 
			
			$usuario = $ControlGestionTipoSolicitudes->obtenerResponsable($nuevo_estado);
			 
			
			//Funciones::mostrarArreglo($nuevo_estado,false);
			//Funciones::mostrarArreglo($usuario,true);
			if(is_array($usuario) && count($usuario) > 0)
			{
				$e_carta = new miniTemplate($this->path_admin.'carta/nueva_tarea.tpl'); 
				$e_carta->setVariable('id_solicitud',$GestionSolicitudes->id_solicitud);					
				$e_carta->addTemplate('bloque_envio_responsable_comentario');			
				$e_carta->setVariable('estado',$this->valores['aprobacion_solicitud']);
				$e_carta->setVariable('comentario',nl2br($this->valores['comentario'])); 
	 			Funciones::sendEmail($usuario[0]['email'],'[INTRANET] Nuevo estado de solicitud de viajes y viaticos, ID '.$GestionSolicitudes->id_solicitud,$e_carta->toHtml());
 			}
 			else
 			{
				$ControlGestionSolicitudes = new ControlGestionSolicitudes();
				$usuario = $ControlGestionSolicitudes->obtenerSolicitante($GestionSolicitudes->id_solicitud);
				$e_carta = new miniTemplate($this->path_admin.'carta/nueva_tarea.tpl'); 				
				$e_carta->addTemplate('bloque_envio_responsable_comentario');			
				$e_carta->setVariable('estado',$this->valores['aprobacion_solicitud']);
				$e_carta->setVariable('comentario',nl2br($this->valores['comentario'])); 
				$e_carta->setVariable('id_solicitud',$GestionSolicitudes->id_solicitud);	
	 			Funciones::sendEmail($usuario[0]['email'],'[INTRANET] Nueva respuesta de solicitud de viajes y viaticos, ID '.$GestionSolicitudes->id_solicitud,$e_carta->toHtml());
			}

			$GestionSolicitudesEstados = new GestionSolicitudesEstados();
			$GestionSolicitudesEstados->id_solicitud 		= $this->valores['id_solicitud'];
			$GestionSolicitudesEstados->id_solicitud_estado = $nuevo_estado;
			$GestionSolicitudesEstados->fecha 				= ControladorFechas::fechaActual();
			$GestionSolicitudesEstados->user_id_responsable = $this->usuario->user_id;  
			$GestionSolicitudesEstados->guardarObjeto();			
			 
			$GestionSolicitudes->fecha_solicitud			= ControladorFechas::fechaActual(); 
			$GestionSolicitudes->id_solicitud_estado 		= $nuevo_estado; 
		 	$GestionSolicitudes->guardarObjeto();
		}
	}

?>