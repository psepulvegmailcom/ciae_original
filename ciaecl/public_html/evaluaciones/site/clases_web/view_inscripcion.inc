<?php

	global $ControlHtml; 
	$opcion = explode('_',$ControlHtml->lastActionArray[0]);
	unset($opcion[0]);
	unset($opcion[1]);
	$opcion = implode('_',$opcion); 
  	$valoresGet = VarSystem::getGet();  
 
	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'inscripcion/'.$opcion.'.tpl'); 
	$e->setVariable('opcion_extra',$opcion);
 	$valores = VarSystem::getPost();
 	
 	$archivos = VarSystem::getFile();
 	
 	$conPost = true;
 	// Funciones::mostrarArreglo($valores); 
 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet();
 		$conPost = false;
 	}  
 	$mostrarValores = false; 
 	$mostrarError  	= false; 
 	$mostrarExito 	= false; 	
 	$conRefresh 	= false;
 	
 	$mensajeError  	= ''; 
 	$e->setVariable('clave_explicacion','Ingrese clave para su registro');
 
 	$e->setVariable('titulo_extra','Inscripción');
 	
 	$prefijo_carta = '';
 	$prefijo_asunto = ''; 
 	switch($ControlHtml->lastActionArray[0])
 	{
 		case 'view_inscripcion_mineduc_modelamiento2013':
 			$prefijo_carta  = 'pre_modelamiento_';
 			$prefijo_asunto = 'Pre';
 		break;
 		case 'view_inscripcion_mineduc_lenguaje2013':
 			$prefijo_carta  = 'pre_modelamiento_';
 			$prefijo_asunto = 'Pre';
 		break;
 		case 'view_inscripcion_mineduc_musica2013':
 			$prefijo_carta  = 'pre_modelamiento_';
 			$prefijo_asunto = 'Pre';
 		break;
 		case 'view_inscripcion_mineduc_matematicas2013':
 			$prefijo_carta  = 'pre_modelamiento_';
 			$prefijo_asunto = 'Pre';
 		break;
		default;
		 	$prefijo_carta = '';
		 	$prefijo_asunto = '';
		break;
	}

				
 	if(isset($valores['guardar']))
 	{
	 	$valores['form_email']		= str_replace(" ","",strtolower(trim($valores['form_email'])));
 		switch($valores['guardar'])
 		{
 			case 'guardar':
 			
	 			$Inscripcion = new Inscripcion(); 
	 			$email_original = '';
 				if(trim($valores['form_rut']) != '')
 				{
			 		$Inscripcion->consultaInscripcionRut($valores['form_rut'],$valores['form_tipo_inscripcion']);
			 		$email_original = $Inscripcion->email;
				}
				else
				{ 			
 					$Inscripcion->consultaInscripcion($valores['form_email'],$valores['form_tipo_inscripcion']);
 				}
 				Funciones::mostrarArreglo($Inscripcion);
			 	if($valores['form_comuna'] == 0)
			 	{
					$valores['form_comuna'] = 1;
				} 
				$valores['form_rut'] 		= str_replace(array('.','-',' '),array('','',''), $valores['form_rut']);	 
				$valores['form_nombre'] 	= ucwords(strtolower(trim($valores['form_nombre'])));
				$valores['form_apellidos'] 	= ucwords(strtolower(trim($valores['form_apellidos'])));
				
				foreach($valores as $var => $val)
 				{
 					$aux = explode('_',$var);
 					if($aux[0] == 'form')
 					{
 						unset($aux[0]);
						$var = implode('_',$aux);
 						$Inscripcion->$var = $val;
					}
 				}  			 
				if(trim($email_original) != '')
				{
					$Inscripcion->email = $email_original;
				}	 
				
				switch($valores['tipo_formulario_cuestionario'])
				{
					case 'cuestionario_multiple':
						$cuestionario = '';
						foreach($valores as $var => $val)
		 				{
		 					$aux = explode('_',$var);
		 					if($aux[0] == 'campo' && $aux[1] == 'extra2')
		 					{ 
		 						foreach($valores[$var] as $pregunta => $valorp) 
		 						{ 
		 							$cuestionario .= ''.$valorp.";";
		 						}
							}
		 				} 
		 				$Inscripcion->campo_extra2 = $cuestionario;
					break;					
				}
				if(is_array($archivos) && count($archivos) > 0)
				{
					$path_doc  	= VarSystem::getPathVariables('dir_repositorio').'doc/inscripciones/';
					
					$archivo_numero = 1; 
					foreach($archivos as $variable => $archivo_detalle)
					{ 
						$archivos[$variable]['new_name'] = $valores['form_email'].'_'.$variable;
						$DocumentFile  = new DocumentFile($path_doc); 
						$DocumentFile->checkPath(); 
						$DocumentFile->setFileArray($archivos[$variable]); 
						if($DocumentFile->saveFile(false))
						{
							$nombre_archivo  = $DocumentFile->getFileName();	
							$aux = 'archivo_extra'.$archivo_numero;
							$Inscripcion->$aux = $nombre_archivo;	
							$archivo_numero++; 
						}
						//Funciones::mostrarArreglo($DocumentFile);					
					}
				} 
				
				$Inscripcion->guardar($valores['form_email']); 
				
				Funciones::mostrarArreglo($Inscripcion);  
				 
				/* SE COPIA CANTIDAD DE INSCRIPCIONES EN INFORME DE EVENTOS */ 
				$ControladorEventosInforme = new ControladorEventosInforme();
				$aux = str_replace('view_inscripcion_','',$ControlHtml->lastActionArray[0]);  
				$ControladorEventosInforme->actualizarTotalInscritos($aux,$valores['form_tipo_inscripcion']);  
				
				$aux_caso 	= explode("_",$valores['form_tipo_inscripcion']);
				$caso 		= end($aux_caso); 
				if($caso == 'presencial' || $caso == 'online')
				{
					$caso_inscripcion = $caso; 
				}
				else
				{
					$caso_inscripcion = 'presencial';
				}					 
				
				$mostrarExito = true;   
		 	 
		 		$cartaInscripcion 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/'.$prefijo_carta.'inscripcion.tpl'); 
		 		Funciones::MostrarArreglo($valores);
		 		
		 	 	$asunto_extra = '';
		 	 	if($valores['tipo_formulario_confirmacion'] == 'online' && $caso_inscripcion == 'presencial')
		 	 	{
					$valores['tipo_formulario_confirmacion'] = 'normal';
				}
		 	 	//echo "<!--".$valores['form_tipo_inscripcion']." ---1--- ".$caso_inscripcion."----".$valores['tipo_formulario_confirmacion']." -->";
		 	 	switch($valores['tipo_formulario_confirmacion'])
				{
					case 'online':
						$cartaInscripcion->addTemplate('bloque_envio_no_confirmacion_online');
					break;
					case 'confirmacion':
						$cartaInscripcion->addTemplate('bloque_envio_confirmacion');
					break;
					case 'requisitos':
						$cartaInscripcion->addTemplate('bloque_envio_requisitos');
					break;
					case 'postulacion':
						$cartaInscripcion->addTemplate('bloque_envio_postulacion');
						$asunto_extra = 'Registro';
					break;						
					case 'inicia': 
						$cartaInscripcion  = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/inicia_inscripcion.tpl');
						$valores['bd_lista_extra'][] = 'pedagogias_carrera_'.$valores['form_inicia_situacion_academica_carrera'].'_'.$valores['form_inicia_situacion_academica'];
					break;					
					default:
						$cartaInscripcion->addTemplate('bloque_envio_no_confirmacion');
					break;
				}  
				$cartaInscripcion->refreshTemplate();
 			 	$cartaInscripcion->setVariable('inscripcion',$valores['form_tipo_inscripcion']); 
 			 	
 			 	
				$ControladorInscripcionBase = new ControladorInscripcionBase();
				$ControladorInscripcionBase->insertarNuevaInscripcion($Inscripcion);				 
				$ControladorInscripcionBase->insertarNuevaInscripcion($Inscripcion,$valores['bd_lista_extra']);							
			 
 			break; 
 			case 'validarEmail': 
				$cartaValidacion 			= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'cartas/validacion_email.tpl'); 	
				$email  = trim($valores['form_email']);
				$md5 	= md5(trim($valores['form_email']));
				$cartaValidacion->setVariable('email',$email);
				$cartaValidacion->setVariable('codigo',$md5);
				$e->setVariable('email_codigo',$md5); 
				$e->setVariable('email',$email); 
				$asunto = "C&oacute;digo de validaci&oacute;n email para inscripci&oacute;n";	
 				Funciones::sendEmail($email,$asunto,$cartaValidacion->toHtml()); 

				$Inscripcion = new Inscripcion();  
 				$Inscripcion->consultaInscripcion($valores['form_email'],$valores['form_tipo_inscripcion']);
				Funciones::mostrarArreglo($Inscripcion); 
 				if(isset($Inscripcion->email))
				{		
 					$mostrarValores = true;
				}
				$e->setVariable('email',$valores['form_email']);  				
 			break;
 			case 'consultaRut':
 				$Inscripcion 				= new Inscripcion();  
 				
				//Funciones::mostrarArreglo($valores,false,"valoresvaloresvaloresvalores"); 
 				if($valores['form_tipo_inscripcion'] == '2016-ValidacionPruebaINICIA')
 				{ 
 					$Inscripcion->consultaInscripcionSoloRut(trim($valores['form_rut']));
				}
				else
				{
					$Inscripcion->consultaInscripcionRut(trim($valores['form_rut']),$valores['form_tipo_inscripcion']);
				}
				//Funciones::mostrarArreglo($Inscripcion,true,"inscripcioninscripcioninscripcioninscripcion"); 
 				if(isset($Inscripcion->rut) && trim($Inscripcion->rut) != '')
				{		
 					$mostrarValores = true;
 					$conRefresh = true;
				}
				$e->setVariable('email',$Inscripcion->email); 
				$e->setVariable('rut',trim($valores['form_rut'])); 
 			break;
 			case 'consultaEmail':
 				$Inscripcion 				= new Inscripcion();  
 				//$Inscripcion->consultaInscripcion($valores['form_email'],$valores['form_tipo_inscripcion']);
 				$Inscripcion->consultaEmail($valores['form_email']);
				Funciones::mostrarArreglo($Inscripcion); 
 				if(isset($Inscripcion->email))
				{		
 					$mostrarValores = true;
				}
				//	Funciones::mostrarArreglo($mostrarValores,true);  
				//Funciones::mostrarArreglo($valores,true); 
				$e->setVariable('email',$valores['form_email']); 
				$Inscripcion->email = $valores['form_email'];
 			break; 
 			case 'consultaEmailInicia':
 				$Inscripcion 				= new Inscripcion(); 
 				$inscripciones = array('201212-ValidacionPrueba','201212-ValidacionPruebaEstudiantes','201212-ValidacionPruebaMide','201212-ValidacionPrueba_Rendicion_Estudiante','201212-ValidacionPrueba_Rendicion_Profesor');
 				$Inscripcion->consultaInscripciones($valores['form_email'],$inscripciones);
				//Funciones::mostrarArreglo($Inscripcion,true); 
 				if(isset($Inscripcion->email))
				{		
 					$mostrarValores = true;
				}
				$e->setVariable('email',$valores['form_email']);  
 			break; 
 		} 
 	}  
 	
 	$ControladorEventosInforme = new ControladorEventosInforme();
 	$opcionMenuCaso = $ControladorEventosInforme->obtenerOpcionMenu($ControlHtml->lastActionArray[0]); 
 	if(is_array($opcionMenuCaso) && count($opcionMenuCaso) > 0)
 	{
 		Funciones::mostrarArreglo($opcionMenuCaso,false,'opcion menu caso');
 		$minuto_extra = time() + 3600; // mas una hora extra
 		$ahora = date("Y-m-d",$minuto_extra );
 		//echo $opcionMenuCaso[0]['inscripcion_fecha_cierre']." ".$ahora." ".$opcionMenuCaso[0]['total_inscritos_presencial']." ".$opcionMenuCaso[0]['inscripcion_cupos_maximo'];
		if($ahora <= $opcionMenuCaso[0]['inscripcion_fecha_cierre'] && $opcionMenuCaso[0]['total_inscritos_presencial'] < $opcionMenuCaso[0]['inscripcion_cupos_maximo'])
		{
			$e->addTemplate('bloque_formulario');
			//echo ' bloque_formulario';
		}
		else
		{ 
			if($ahora <= $opcionMenuCaso[0]['inscripcion_fecha_cierre'] && $opcionMenuCaso[0]['total_inscritos_presencial'] >= $opcionMenuCaso[0]['inscripcion_cupos_maximo'])
			{ 
				$e->addTemplate('bloque_formulario_cierre_cupo');
			}
			else
			{
				$e->addTemplate('bloque_formulario_cierre');
			} 
			$e->addTemplate('bloque_formulario_cierre_extra');
			$e->addTemplate('bloque_formulario_cierre_extra2');
			//echo ' bloque_formulario_cierre';
		}
	}

 	/** SE MUESTRAN LOS VALORES EN EL FORMULARIO */
 	if($mostrarValores)
 	{ 	  
 		if($conRefresh)
 		{
			$e->refreshTemplate();
		}
 	 	 
		//Funciones::mostrarArreglo($Inscripcion,true,"inscripcioninscripcioninscripcioninscripcion"); 
		$datos = get_object_vars($Inscripcion); 
		foreach($datos as $var => $val)
		{
			$e->setVariable($var,$val);  
			//echo $var.' '.$val.'<br>';
		}   
		$e->addTemplate('bloque_select_comuna');
 		$e->setVariable('comuna_id',$Inscripcion->comuna);  
//  
		foreach($datos as $var => $val)
		{   
			$e->addTemplate('bloque_extra_'.$var);
			$e->setVariable($var,$val);		
		} 		
 	}
	else
	{	
		$e->setVariable('email',$valores['form_email']);
	}	
 	
	
	$ControlComuna = new ControlComuna();
	$comunas = $ControlComuna->getListadoCompleto();
	//Funciones::mostrarArreglo($comunas);
	for($i=0; $i < count($comunas); $i++)
	{
		$e->addTemplate('bloque_comuna');
		foreach($comunas[$i] as $var => $val)
		{
			$e->setVariable($var,$val);
		}
	}  
	
	$ControlPais = new ControlPais();
	$paises = $ControlPais->getPaises(); 
	for($i=0; $i < count($paises); $i++)
	{
		$e->addTemplate('bloque_pais');
		foreach($paises[$i] as $var => $val)
		{
			$e->setVariable($var,$val);
		}
	}   
	
	$ControlRegion = new ControlRegion();
	$regiones = $ControlRegion->getRegiones(); 
	for($i=0; $i < count($regiones); $i++)
	{
		$e->addTemplate('bloque_region');
		foreach($regiones[$i] as $var => $val)
		{
			$e->setVariable($var,$val);
		}
	} 
	
	$anno_minimo = 1950;
	$anno_actual = date('Y');
	for($i=$anno_actual; $i >= $anno_minimo;$i--)
	{
		$e->addTemplate('bloque_agno1');
		$e->setVariable('agno',$i);
		$e->addTemplate('bloque_agno2');
		$e->setVariable('agno',$i);
		$e->addTemplate('bloque_agno3');
		$e->setVariable('agno',$i);
	} 
  
 	if($mostrarError)
 	{
 		$e->addTemplate('bloque_envio_error');
 		$e->setVariable('mensaje_error',$mensajeError); 
 	}
 	if($mostrarExito)
 	{
 		$Menu = new Menu();
 		$Menu->getOpcion($valores['lastAction']); 
 		
 		$cartaInscripcion->setVariable('evento',stripcslashes($Menu->titulo_es));  		
 		$cartaInscripcion->setVariable('opcion_evento',trim($Menu->opcion));
 		
	 	if(is_object($cartaInscripcion))
		{
			$datos = get_object_vars($Inscripcion);
			foreach($datos as $var => $val)
			{ 
				$cartaInscripcion->setVariable($var,$val);				 
			}  	
			if(trim($asunto_extra) == '')
			{
				$asunto = 'Registro '.$prefijo_asunto.' Inscripci&oacute;n';
			}	
			else
			{
				$asunto = $asunto_extra;
			} 
		} 		 
 		$e->addTemplate('bloque_envio_exito'); 
		$e->setVariable('email', $Inscripcion->email);
 		Funciones::sendEmail($Inscripcion->email,$asunto,$cartaInscripcion->toHtml());
 		//echo $cartaInscripcion->toHtml();
 	} 
	echo $e->toHtml();
?>