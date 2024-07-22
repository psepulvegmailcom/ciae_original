<?php
	 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	
	$theSession 	= $ControlHtml->theSession;  
 	//Funciones::mostrarArreglo($theSession,true);
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'intranet_textos/textos/';   

	$MantenedoresGeneral 	= new MantenedoresGeneral();
	$ControlGeneralCorreccion = new ControlGeneralCorreccion();
	$valores 				= VarSystem::getPost(); 	
	$tipo_correccion 		= $ControlHtml->theSession->userObject->permiso;
	$username		 		= $ControlHtml->theSession->userObject->username;
 
	 //Funciones::mostrarArreglo($valores,true);
	/** BUSCA CORRECCION ACTUAL */
	$ControlCorreccion 	= new ControlCorreccion();
	$correccion 		= $ControlCorreccion->buscarCorreccionActiva($tipo_correccion); 
	
	$hoy = date("Y-m-d",time()); 
	
	$dia_extra = 0; /** SOLO PARA MANTENCION Y PROBAR COMO AVANZA LA COSA */ 
	$hoy = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")+$dia_extra, date("Y")));
	//echo $hoy; 
	//Funciones::mostrarArreglo($correccion,true);	
	
	if(is_array($correccion) && count($correccion) > 0)
	{	 	 
	 	/**  SE ENCONTRO UNA VERSI&oacute;N DE CORRECCION ACTIVA */
		$id_correccion = $correccion[0]['id_correccion']; 
			  
		$form_especial	= '';
		$caso_texto		= '';
		$caso_texto_criterio		= '';
		switch($lastAction[0])
		{
			case 'view_correccion_noticias': 
				$caso_texto		= 'noticia';
			break;
			case 'view_correccion_cuentos': 
				$caso_texto		= 'cuento';
			break;
			case 'view_correccion_cartas':
				$caso_texto		= 'carta';
			break; 
			case 'view_correccion_noticias_prueba': 
				$sufijo_tipo = '_supervision';
				$caso_texto		= 'noticia'.$sufijo_tipo;
			break;
			case 'view_correccion_cuentos_prueba': 
				$sufijo_tipo = '_supervision';
				$caso_texto		= 'cuento'.$sufijo_tipo;
			break;
			case 'view_correccion_cartas_prueba':
				$sufijo_tipo = '_supervision';
				$caso_texto		= 'carta'.$sufijo_tipo;
			break; 
			case 'view_correccion_cuentos_marcha_blanca': 
				$sufijo_tipo = '_marcha_blanca';
				$caso_texto	 = 'cuento'.$sufijo_tipo;
			break;
			case 'view_correccion_carta_marcha_blanca': 
				$sufijo_tipo = '_marcha_blanca';
				$caso_texto	 = 'carta'.$sufijo_tipo;
			break;
			case 'view_correccion_noticia_marcha_blanca': 
				$sufijo_tipo = '_marcha_blanca';
				$caso_texto	 = 'noticia'.$sufijo_tipo;
			break;
		}  
		$caso_texto_criterio	= str_replace($sufijo_tipo,'',$caso_texto); 
		
		$ControlCorreccionDia = new ControlCorreccionDia();
		/** REVISA QUE LA REVISION QUE SE CONSULTO ES LA QUE SE DEBE REVISAR POR ORDEN*/		
		$dia_correccion_actual = $ControlCorreccionDia->obtenerDiaCorreccionActual($id_correccion);
		Funciones::mostrarArreglo($dia_correccion_actual);
		if(is_array($dia_correccion_actual) && count($dia_correccion_actual) > 0)
		{
			if($dia_correccion_actual[0]['id_tipo_texto'] != $caso_texto)
			{
				/** NO HAY ELEMENTOS DISPONIBLES*/
				$e = new miniTemplate($path_admin.'mant_sin_correccion.tpl'); 			
				echo $e->toHtml();
				return '';
			}
		}
		
		/** SE REVISA QUE HOY ESTE PENDIENTE O SEA UNA DIA NUEVO QUE ESTE PENDIENTE, 
		ADEMAS DE REVISAR QUE NO HAYA REVISIONES CERRADAS PARA HOY*/
		$dia_correccion = $ControlCorreccionDia->obtenerDiaCorreccion($id_correccion,$caso_texto,$hoy);
		//Funciones::mostrarArreglo($dia_correccion,true);
		if(!is_array($dia_correccion) || count($dia_correccion) == 0)
		{
			/** NO HAY ELEMENTOS DISPONIBLES*/
			$e = new miniTemplate($path_admin.'mant_sin_correccion.tpl'); 			
			echo $e->toHtml();
			return '';
		} 
		 
		if($lastAction[2] == 'guardar')
		{ 
			$CorreccionUsuario = new CorreccionUsuario();
			$CorreccionUsuario->obtenerCorreccionTexto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['username'],$valores['id_texto']);
			$valores['criterio'] = str_replace('criterio_','',$valores['criterio']); 	 	 		
			$valores['criterio_texto'] = 'criterio_'.$valores['criterio'];
			
			if($valores['criterio'] == 5)
			{
				$CorreccionUsuario->criterio_5_1 = $valores['nivel_5_1'];
				$CorreccionUsuario->criterio_5_2 = $valores['nivel_5_2'];
				$CorreccionUsuario->criterio_5_3 = $valores['nivel_5_3'];
				$CorreccionUsuario->criterio_5_4 = $valores['nivel_5_4'];
				$CorreccionUsuario->criterio_5_5 = $valores['nivel_5_5']; 
			}
			else
			{				
				$CorreccionUsuario->$valores['criterio_texto'] = $valores['nivel']; 
			} 
 
			if($CorreccionUsuario->revisionCompleto())
			{
				/** REVISA SI TODOS LOS CRITERIOS ESTAN GUARDADOS, Y CIERRE EL PROCESO, 
				TE MANDA AL LISTADO GENERAL  */ 
				$lastAction[1] = ''; 
			}
			
			$CorreccionUsuario->guardarCorreccionTexto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['username'],$valores['id_texto']); 
			
			if($CorreccionUsuario->revisionCompleto() && trim($lastAction[1]) == '') /** REVISION DOBLE CORREGIDO Y DEFINITIVO */
			{
				$ControlGeneralCorreccion->guardarCorreccionDefinitiva($valores); 
				//return '';
				//$lastAction[1] = $ControlGeneralCorreccion->mantenerAbiertoElemento($CorreccionUsuario); return;				
			}

			if($CorreccionUsuario->revisionCompleto() && trim($lastAction[1]) == '') /** REVISION CIERRE DE DIA Y CORRECCION */
			{ 	
				$ControlGeneralCorreccion->revisionCierreProceso($valores);  				
			} 
		} 
		
		switch($lastAction[1])
		{	
			default:
				$e = new miniTemplate($path_admin.'mant'.$form_especial.'.tpl'); 
				$e->setVariable('caso_texto',$caso_texto);
				$e->setVariable('caso_texto_criterio',$caso_texto_criterio);
				$e->setVariable('opcion_modulo',$lastAction[0]);  
				
				/** SE OBTIENE EL LISTADO DE TEXTOS */ 
				$ControlCorreccionUsuario = new ControlCorreccionUsuario();
				$ListaDeObjetos = $ControlCorreccionUsuario->obtenerListadoUsuarioDia($dia_correccion[0]['id_correccion_dia'],$dia_correccion[0]['id_correccion'],$dia_correccion[0]['id_tipo_texto'],$username);
				
				//Funciones::mostrarArreglo($ListaDeObjetos,true); 
				if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
				{
					/** NO HAY ELEMENTOS DISPONIBLES*/
					$e = new miniTemplate($path_admin.'mant_sin_correccion.tpl'); 			
					echo $e->toHtml();
					return '';
				}
				   
				if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
				{
					$e->addTemplate('item_lista_nohay'); 
				}
				else
				{ 
					$total = count($ListaDeObjetos);					
					$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);					
					$e = $MantenedoresGeneral->mostrarListado($e,$ListaDeObjetos,'id_texto',$lastAction[0]);  
				}		
			break;		
			case 'modificar':
				$e = new miniTemplate($path_admin.'form'.$form_especial.'.tpl'); 
				$e->setVariable('opcion_modulo',$lastAction[0]); 
				
				$valores['id_texto'] = $valores['id_item'];
				$ControlCorreccionUsuario = new ControlCorreccionUsuario();
				$ListaDeObjetos = $ControlCorreccionUsuario->obtenerCorreccionTexto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['username'],$valores['id_texto']);
				
				Funciones::mostrarArreglo($ListaDeObjetos);
				$e = $MantenedoresGeneral->mostrarElementoValores($e,$valores);
	  			 
	  			$tipo_texto = $caso_texto_criterio;
	  			
				$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0]['id_texto'];
				$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]); 

				$CorreccionUsuario = new CorreccionUsuario();
				$CorreccionUsuario->obtenerCorreccionTexto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['username'],$valores['id_texto']); 				
				
				/** SE GUARDA TIEMPO INICIO DE REVISION DE NO HABERSE INICIADO ANTERIORMENTE */	 ;
				if(trim($CorreccionUsuario->time_inicio) == '0')
				{
					$CorreccionUsuario->time_inicio = time();
					switch($caso_texto_criterio) /** REVISION DE VALORES POR DEFECTO */
					{
						case 'cuento':
							$CorreccionUsuario->criterio_1 = 'N/A'; 
						break; 
						case 'noticia':
							$CorreccionUsuario->criterio_4 = 'N/A'; 
						break; 
					} 					 
					$CorreccionUsuario->guardarCorreccionTexto($valores['id_correccion_dia'],$valores['id_correccion'],$valores['id_tipo_texto'],$valores['username'],$valores['id_texto']); 
				}	
				
				$id_criterio = $CorreccionUsuario->buscarProximoCriterio(); /** SE BUSCA EL CRITERIO PENDIENTE */ 
				
	  			$e->setVariable('id_criterio',$id_criterio);
	  			$e->addTemplate('tabla_nivel_'.$tipo_texto); 
	  			 
				$ControlCriterio = new ControlCriterio();
				$Criterio = $ControlCriterio->obtenerCriterio($id_criterio,$tipo_texto);  
	  			 
	  			$f = new miniTemplate($path_admin.'tabla_nivel_destacado.tpl'); 
	  			$e->setVariable('destacado_criterio_'.$id_criterio,$f->toHtml());
	  			 
	  			$f = new miniTemplate($path_admin.'tabla_nivel_destacado_a.tpl'); 
	  			$e->setVariable('destacado_a_criterio_'.$id_criterio,$f->toHtml()); 
	  			 
	  			switch($id_criterio)
	  			{
					case '5':
						$f = new miniTemplate($path_admin.'tabla_nivel_nivel_puntuacion.tpl'); 				
					break;
					case '6':
						$f = new miniTemplate($path_admin.'tabla_nivel_nivel_global.tpl'); 
					break;
					default: 	
						if(trim($id_criterio) == '')
						{ 
							$f = new miniTemplate($path_admin.'tabla_nivel_nivel_inicio.tpl'); 						
						}
						else
						{
						  	$f = new miniTemplate($path_admin.'tabla_nivel_nivel_simple.tpl'); 
							if(is_array($Criterio) && count($Criterio) > 0)
							{
								$Criterio[0] = $MantenedoresGeneral->limpiezaCaracteres($Criterio[0]);
								$f = $MantenedoresGeneral->mostrarElementoValores($f,$Criterio[0]);
							} 									
							$ControlCriterioNivel = new ControlCriterioNivel();
							$Niveles = $ControlCriterioNivel->obtenerNiveles($id_criterio,$tipo_texto);  
							$total_niveles = count($Niveles);
							//Funciones::mostrarArreglo($Niveles,true);
							for($i=0; $i < $total_niveles;$i++)
							{
								$Niveles[$i] = $MantenedoresGeneral->limpiezaCaracteres($Niveles[$i]);  
								$f->setVariable('nivel_'.$Niveles[$i]['id_nivel'], $Niveles[$i]['descripcion'] ); 
							}
							
							for($i=0; $i < $total_niveles;$i++)
							{  
								if(trim($Niveles[$i]['informacion']) != '')
								{
									$f->addTemplate('tabla_criterio_nivel_ayuda_nivel_'.$Niveles[$i]['id_nivel']);
									$f->setVariable('informacion', $Niveles[$i]['informacion'] ); 
								}
							}
						}			
					break;
				} 
	  			$e->setVariable('niveles',$f->toHtml()); 
			break;  
		}
		echo $e->toHtml();
	}
	else
	{
		/** NO SE ENCONTRO NINGUNA VERSION ACTIVA*/
		$e = new miniTemplate($path_admin.'mant_sin_correccion.tpl');
		echo $e->toHtml(); 
	}
?>