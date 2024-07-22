<?php

	class ControlGeneralHonorarios extends ControlGeneral
	{
		function ControlGeneralHonorarios($path_admin,$ControlHtml)
		{ 
			parent::ControlGeneral($path_admin,$ControlHtml); 
            $this->valoresGet    = VarSystem::getGet();		   
            $this->ControlClase  = new ControlGestionHonorariosPersonas();  
			$this->ObjetoClase   = new GestionHonorarios();
			parent::setObjetos($this->ControlClase,$this->ObjetoClase);	 
		}  
	
		function mostrarListado()
		{
			$this->arregloCamposBusqueda = array('numero_convenio','numero_decreto','labor','apellido_paterno','proyecto','estado_convenio'); 
	        $this->arregloCamposOrdenar = array(array('numero_convenio','N&uacute;mero de convenio'), 
	                                array('numero_decreto','N&uacute;mero de decreto'), 
	                                array('apellido_paterno','Apellidos'), 
	                                array('fecha_creacion','Fecha de creaci&oacute;n'), 
	                                array('fecha_termino','Fecha de t&eacute;rmino'), 
	                                array('fecha_convenio','Fecha de convenio'), 
	                                array('fecha_creacion','Fecha de creaci&oacute;n'), 
	                                array('fecha_firma','Fecha de firma'), 
	                                array('fecha_compromiso','Fecha de compromiso'), 
	                                array('fecha_aprobacion','Fecha de aprobaci&oacute;n'), 
	                                array('proyecto','Proyecto'),
									array('estado_convenio','Estado'));
			return parent::mostrarListado();     
		}
		
		function importarReporte()
		{
			$e = new miniTemplate($this->path_admin.'importar_reporte.tpl'); 
			//Funciones::mostrarArreglo($this->valores,true);
			$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
			
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objReader->setReadDataOnly(true);
		 	$objPHPExcel = $objReader->load(VarSystem::getPathVariables('dir_repositorio_tmp').$this->valores['form_archivo_importacion']);
			$objHoja = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$total = count($objHoja);
			
			$datos = array(); 
  			for($i=2; $i <= $total;$i++)
  			{	 
  				$datos[$i] = $objHoja[$i];
  				
				$GestionHonorarios = new GestionHonorarios(); 
				
				$datos[$i]['numero_convenio'] 	= $objHoja[$i]['A'].'/'.$objHoja[$i]['B'];
				//$GestionHonorarios->buscarConvenio($datos[$i]['numero_convenio']);
				$GestionHonorarios->numero_convenio = $datos[$i]['numero_convenio'];
				$datos[$i]['numero_decreto'] 	= $objHoja[$i]['AC'].'/'.$objHoja[$i]['AD'];
				$datos[$i]['estado'] 	= $objHoja[$i]['AF'];
				if(trim($datos[$i]['estado']) != '')
				{
					$GestionHonorarios->id_tipo_estados_honorarios = strtolower($datos[$i]['estado']);
				}
				if(trim($datos[$i]['numero_decreto']) != '/')
				{
					$GestionHonorarios->numero_decreto = $datos[$i]['numero_decreto']; 
				}	
				else
				{
					$GestionHonorarios->numero_decreto = ''; 
				}								
				$salida = $GestionHonorarios->guardarImportacion();
				if($salida)
				{
					//echo "sdfsdfsd<br>";
				} 
			} 
			//Funciones::mostrarArreglo($datos,true);
			return $e;
		} 
		
		function enviarEmailBoletas($e)
		{
			//Funciones::mostrarArreglo($this->valores,true);
			$e = new miniTemplate($this->path_admin.'enviar_boletas.tpl');
			$e->addTemplate('bloque_datos_enviadas_boleta');
			for($i=0; $i < count($this->valores['enviar_boletas']);$i++)
			{
				switch($this->valores['caso_boleta'][$this->valores['enviar_boletas'][$i]])
				{
					case 'global': 
						$ControlGestionHonorariosPersonasCuotas = new ControlGestionHonorariosPersonasCuotas();
						$cuotas = $ControlGestionHonorariosPersonasCuotas->obtenerCuotasConvenio($this->valores['enviar_boletas'][$i]);	   			   
						$carta =   new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/boletas_envio_global.tpl'); 
						for($j=0; $j<count($cuotas); $j++)
						{
							if($j==0)
							{								
								$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$cuotas[$j]);
								$carta->setVariable('fecha_hoy',date("d-m-Y"));
							//	$carta->setVariable('mes_hoy',date("m"));
							//	$carta->setVariable('agno_hoy',date("Y"));
								$e->addTemplate('bloque_datos_enviadas_boleta_detalle');
								$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$cuotas[$j]);
							}
							
							$carta->addTemplate('bloque_datos_boleta_mensual'); 
							$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$cuotas[$j]);
							$aux = $j + 1;
							$carta->setVariable('tipo_informe','Mensual');
						//	$mes_texto = ControladorFechas::entregarMes(date("n"));
						//	$carta->setVariable('actualmes',date("n"));
							$mes_palabra = ControladorFechas::entregarMes($cuotas[$j]['numero_mes']);
							$carta->setVariable('mes_palabra',$mes_palabra);
							
							if($aux == count($cuotas))
							{
								$carta->setVariable('tipo_informe','Final');
							}
							$e->setVariable('salida_correo',$carta->toHtml());
						}
						$GestionHonorarios = new GestionHonorarios();
						$GestionHonorarios->buscarObjeto($this->valores['enviar_boletas'][$i]);
						$GestionHonorarios->envio_correo_general = 1;
						$GestionHonorarios->guardarObjeto($this->valores['enviar_boletas'][$i]); 
						Funciones::sendEmail($cuotas[0]['email'],'[BH] Solicitud &uacute;nica de Boleta de Honorarios (CIAE-U.Chile)',$carta->toHtml(),FALSE,FALSE,'','','bh');
					break;
					case 'mensual':

						$ControlGestionHonorariosPersonasCuotas = new ControlGestionHonorariosPersonasCuotas();			
						
						$aux = explode('-',$this->valores['enviar_boletas'][$i]);
						
						$cuotas = $ControlGestionHonorariosPersonasCuotas->obtenerCuotaConvenio($aux[0],$aux[1]);	   			   
						//Funciones::mostrarArreglo($cuotas,true);
						$carta =   new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/boletas_envio_mensual.tpl'); 
					 								
						$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$cuotas[0]);
						$mes_palabra = ControladorFechas::entregarMes($cuotas[0]['numero_mes']);
						$carta->setVariable('mes_palabra',$mes_palabra);
						$carta->setVariable('fecha_hoy',date("d-m-Y")); 
					//	$carta->setVariable('mes_hoy',date("m"));
					//	$carta->setVariable('agno_hoy',date("Y"));
						$e->addTemplate('bloque_datos_enviadas_boleta_detalle');
						$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$cuotas[0]);
						
						$e->setVariable('salida_correo',$carta->toHtml()); 
						$GestionHonorariosCuotas = new GestionHonorariosCuotas();
						$GestionHonorariosCuotas->buscarHonorarioCuota($aux[0],$aux[1]);
						$GestionHonorariosCuotas->estado = 'enviado';
						$GestionHonorariosCuotas->guardarCuotas($aux[0],$aux[1]); 
						Funciones::sendEmail($cuotas[0]['email'],'[BH] Recordatorio de Env&iacute;o de Boletas (CIAE-U.Chile)',$carta->toHtml(),FALSE,FALSE,'','','bh');
						
					break;
				} 
			}
			return $e;
		}
		
		function enviarBoletas($e)
		{									 
			$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
			$e->setVariable('opcion_modulo',$this->lastAction[0]);   
			
			$ControlGestionHonorariosPersonas = new ControlGestionHonorariosPersonas();
			$salida_primero = $ControlGestionHonorariosPersonas->obtenerNoEnviados();
		//	Funciones::mostrarArreglo($salida_primero,true);
			for($i=0; $i < count($salida_primero); $i++)
			{
				$e->addTemplate('bloque_datos_boleta'); 
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$salida_primero[$i]); 
			}
			$ControlGestionHonorariosPersonasCuotas = new ControlGestionHonorariosPersonasCuotas();
			$salida  = $ControlGestionHonorariosPersonasCuotas->obtenerEnvioBoletas();
			//Funciones::mostrarArreglo($salida,true);
			for($i=0; $i < count($salida); $i++)
			{
				$e->addTemplate('bloque_datos_boleta_mensual');  
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$salida[$i]); 
			}			
			return $e;
		}
		

		function mostrarFormulario()
		{  
			//Funciones::mostrarArreglo($this->valores,true);
			if(trim($this->valores['id_item']) != '' || $this->lastAction[1] == 'consultar_email')
			{
				$e = new miniTemplate($this->path_admin.'form.tpl');  
				$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
				$e->setVariable('opcion_modulo',$this->lastAction[0]);
				$e->setVariable('caso_form','Actualizar');
				$ListaDeObjetos = array();
				if(trim($this->valores['id_item']) != '')
				{
					$ListaDeObjetos = $this->ControlClase->obtenerElemento($this->valores['id_item']);
					if(isset($ListaDeObjetos[0]['id_item']))
					{
						$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$this->ObjetoClase->dbKey];
						$this->valores['form_id_persona'] = $ListaDeObjetos[0]['id_persona'];
					}
				}
				else
				{
					$e->setVariable('caso_form','Crear nuevo');  
				}
 
				
				$ControlGeneralSolicitudesGestion = new ControlGeneralSolicitudesGestion($this->path_admin,$this->ControlHtml);  
				$e = $ControlGeneralSolicitudesGestion->formularioPersonas($e,'honorarios');
				
				$ListaDeObjetos[0]['usuario'] = $this->ControlHtml->theSession->userId;
				$ListaDeObjetos[0]['fecha_ingreso'] = time();  
				
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);  		
	
				/* muestra de formulario de persona */
				if(is_array($persona) && is_array($persona[0]) && count($persona[0]) > 0)
				{
					$e->addTemplate('bloque_datos_ficha_honorarios');
					$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$persona[0]);
					$e->addTemplate('bloque_validacion_datos_ficha_honorarios');
				}  	
				
				$ControlRegionComunas = new ControlRegionComunas();
				$comunas = $ControlRegionComunas->obtenerListado();				
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$comunas,'listado_comuna');
				
				$ControlPais = new ControlPais();
				$paises = $ControlPais->getPaises();
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$paises,'listado_pais');
				
				
				Funciones::mostrarArreglo(array(array('valores'=>$this->valores),array('persona'=>$persona),array('honorario'=>$ListaDeObjetos)),false,'kdkdkkdkdk');		 	
				
				$ControlVistaCentroCostosResponsable = new ControlVistaCentroCostosResponsable(); 
				$centro_costos = $ControlVistaCentroCostosResponsable->buscarProyectosAdministracion();
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$centro_costos,'bloque_centros_costo');	

				
				$PersonaControl = new PersonaControl();
				$personas = $PersonaControl->getListaEmailSimple();
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$personas,'bloque_persona_responsable');	
			} 
			else
			{
				/* creacion o busqueda de persona, para crear honorario */
				$e = new miniTemplate($this->path_admin.'form_inicio_consulta_persona.tpl');
				$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
				$e->setVariable('opcion_modulo',$this->lastAction[0]);
				
				$e->setVariable('caso_form','Crear nuevo');  
				$e->addTemplate('bloque_autocomplete_email_personas_script');
				$PersonaControl = new PersonaControl();
				$personas = $PersonaControl->getListaEmailSimple();
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$personas,'bloque_autocomplete_email_personas');
				$ListaDeObjetos[0] = array();
			} 	  
			return $e;
		}  	
	}
?>