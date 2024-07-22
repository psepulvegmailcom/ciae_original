<?

	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml; 
	 // Funciones::mostrarArreglo($ControlHtml->lastActionArray);
	$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= explode('|',$ControlHtml->laPagina->lastAction);   
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/envios/'; 
	 		 
	$valores 		= VarSystem::getPost(); 
	$FormGeneral  	= new FormGeneral(); 
	$id_envio 		= VarSystem::getVariable("id_envio");
	$accion 		= VarSystem::getVariable("accion"); 
	//Funciones::mostrarArreglo($_POST);
	
	/** CONFIGURACIONES DE LA REVISION DE TRABAJOS */
	$casos_tipo_sesion = array('poster' => 'Sólo Sesión de Posters', 
						       'regular_simple' => 'Sólo Sesión Regular de Trabajo', 
							   'regular_poster' => 'Sesión Regular de Trabajo, o en su defecto Sesión de Posters');

	$alternativas_recomendaciones = array('poster' => array('poster_seleccionar' => 'Seleccionar para sesión de posters.','poster_no_seleccionar' => 'No seleccionar para sesión de posters.'),
										'regular_simple' => array('regular_simple_seleccionar' => 'Seleccionar para sesión regular de trabajo.','regular_simple_no_seleccionar' => 'No seleccionar para sesión regular de trabajo.'),
										'regular_poster' => array('regular_poster_seleccionar' => 'Seleccionar para sesión regular de trabajo.','regular_poster_no_seleccionar_si_poster' => 'No seleccionar para sesión regular de trabajo, pero sí para sesión de posters.', 'regular_poster_no_seleccionar' => 'No Seleccionar para sesión regular de trabajo ni para sesión de posters.'));	
										
	$alternativas_recomendaciones_unido = 	array_merge($alternativas_recomendaciones['poster'],$alternativas_recomendaciones['regular_simple'],$alternativas_recomendaciones['regular_poster']); 
	
	$alternativas_recomendaciones_unido_descarga = array('poster_seleccionar' => 'Poster_seleccionar',
														 'poster_no_seleccionar' => 'No_seleccionar',
														 'regular_simple_seleccionar' => 'Regular_seleccionar',
														 'regular_simple_no_seleccionar' => 'No_seleccionar',
														 'regular_poster_seleccionar' => 'Regular_seleccionar',
														 'regular_poster_no_seleccionar_si_poster' => 'Poster_seleccionar', 
														 'regular_poster_no_seleccionar' => 'No_seleccionar');	
	 	   		
	//print_r($alternativas_recomendaciones_unido);
	
	$ControlClase = new ControladorInscripcionEnvio();
	switch($lastAction[2])
	{
	 	case 'guardar':	  
			/** GUARDAR LA MODIFICACION O INGRESO*/  
			$elemento = new RevisionEnvio(); 
			$valoresFormulario = array('id_envio','criterio_1','criterio_2','criterio_3','criterio_4','criterio_5','criterio_6','criterio_7','criterio_8','comentario','decision','tipo_revision','promedio_nota');  
			for($i=0; $i < count($valoresFormulario); $i++)
			{
				$elemento->$valoresFormulario[$i] = " ".VarSystem::getVariable($valoresFormulario[$i])." ";		
			}  
			$elemento->username = $ControlHtml->theSession->userName;
			$elemento->fecha 	= time();
			$elemento->saveObject();   
			
			
			if($ControlHtml->lastActionArray[0] == 'admin_envio_final' && $theSession->userObject->permiso == 'coordinador')
			{
				$EnvioInscripcion = new EnvioInscripcion();
				$EnvioInscripcion->obtenerEnvio(VarSystem::getVariable('id_envio')); 
				$EnvioInscripcion->decision_final = VarSystem::getVariable('decision');
				$EnvioInscripcion->guardarEnvio();
			}
			//Funciones::mostrarArreglo($elemento);
			//Funciones::mostrarArreglo($valoresFormulario); 
		break;
		case 'guardar_estado':			 
			$elemento = new EnvioInscripcion(); 
			$elemento->obtenerEnvio(VarSystem::getVariable('id_envio')); 
			$elemento->estado 		= VarSystem::getVariable('estado');
			$elemento->area 		= VarSystem::getVariable('area');
			$elemento->comentario 	= VarSystem::getVariable('comentario');
			$elemento->guardarEnvio(); 

			if($theSession->userObject->permiso == 'administrador')
			{ 
				$revisores_sel = $valores['reviews'];
				Funciones::mostrarArreglo($revisores_sel);
				$total = count($revisores_sel);
				if(is_array($revisores_sel) && $total > 0)
				{
					$id_envio = VarSystem::getVariable('id_envio');
					$EnviosEvaluador = new EnviosEvaluador();
					$EnviosEvaluador->destroyObject('id_envio='.$id_envio);
					for($i=0; $i < $total; $i++)
					{
						$EnviosEvaluador = new EnviosEvaluador();
						$EnviosEvaluador->id_envio = $id_envio;
						$EnviosEvaluador->username = $revisores_sel[$i];
						$EnviosEvaluador->saveObject();
					}
				}

			}			
		break;
	}
	
	 //Funciones::mostrarArreglo($lastAction);
	switch($lastAction[1])
	{	
		default:
			/** LISTADO DE TRABAJOS PARA REVISAR */
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
			
			if($theSession->userObject->permiso == 'evaluador')
			{
				/** CONSULTA SOLO LOS IDS ASIGNADOS A EVALUADOR */
				$ListaDeObjetos = $ControlClase->obtenerListadoEvaluador($theSession->userName);
			}
			else
			{   
				/** CONSULTA POR LISTADO PARA ADMINISTRACION */ 
				$ListaDeObjetos	 = $ControlClase->obtenerListado();	
				$total = count($ListaDeObjetos); 
				Funciones::mostrarArreglo($ListaDeObjetos);
				if(is_array($ListaDeObjetos) && $total > 0)
				{ 
					/** DESCARGA EXCEL DE LISTADO */
					$e->addTemplate('item_lista_descarga');
					$e->setVariable('titulo_descarga','Download list of proposals');
					$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
					$output1 	= new miniTemplate($path_admin.'descarga_propuesta.tpl');
					    
					for($m=0; $m < $total; $m++)
					{  
						$output1->addTemplate('item_lista_revision'); 
						foreach($ListaDeObjetos[$m] as $var => $val)
						{ 	
							/** LIMPIEZA */
							$val = strip_tags(stripslashes($val)); 
							
							if($var == 'tipo_no_paper' && $val == 'si')
							{
								$val = 'yes'; 
							} 
							if($var == 'subtema' )
							{
							 	switch($val)
							 	{
									case 'Systems of educational governance for school effectiveness and improvement':
										$val = 1;
									break;
									case 'Support and accountability systems for school effectiveness and improvement':
										$val = 2;
									break;
									case 'The school as a system: Keys for improvement':
										$val = 3;
									break;
									case 'The classroom: expression of system changes and main learning scenario for students and teachers':
										$val = 4;
									break;
									default:
										$val = '';
									break;
								}
							}																
							$output1->setVariable($var,trim($val));
						}   
					}
					$archivo 	= SIDTOOLHtml::escribirExcelTabla($output1->toHtml(),$path,'xls','proposal_'); 
					$e->setVariable('archivo_tmp',$archivo);  
				}	 
				
				/** DESCARGA DE REVISIONES */
				$ControladorRevisionEnvio = new ControladorRevisionEnvio(); 
				$listaRevisiones = $ControladorRevisionEnvio->obtenerListadoCompleto();
				Funciones::mostrarArreglo($listaRevisiones);
				$total = count($listaRevisiones);
				if(is_array($listaRevisiones) && $total > 0)
				{
					$e->addTemplate('item_lista_descarga');
					$e->setVariable('titulo_descarga',"Download list of proposals's evaluations");
					$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
					$output 	= new miniTemplate($path_admin.'descarga_propuesta_revisiones.tpl'); 
					$id_anterior = 0; 
					for($m = 0; $m < $total; $m++)
					{  
						$output->addTemplate('item_lista_revision');
						
						$output->addTemplate('item_lista_revision_detalle');
						foreach($listaRevisiones[$m] as $var => $val)
						{ 	 	 		
							$output->setVariable($var,trim($val));
						}
						
						$aux = $m + 1;						
						if($listaRevisiones[$m]['id_envio'] == $listaRevisiones[$aux]['id_envio'])   
						{
							//echo "salida $m <br>";
							$m++;
							$output->addTemplate('item_lista_revision_detalle');
							foreach($listaRevisiones[$m] as $var => $val)
							{ 	 	 		
								$output->setVariable($var,trim($val));
							}
						}
					}
					$archivo 	= SIDTOOLHtml::escribirExcelTabla($output->toHtml(),$path,'xls','proposal_evaluations_'); 
					$e->setVariable('archivo_tmp',$archivo);  
				}
				
				$ControladorInscripcionEnvioAutores = new ControladorInscripcionEnvioAutores();
				$ListaAutores = $ControladorInscripcionEnvioAutores->obtenerListado();
				$total = count($ListaAutores);
				/** DESCARGA EXCEL DE LISTADO DE AUTORES */
				if(is_array($ListaAutores) && $total > 0)
				{
					$e->addTemplate('item_lista_descarga');
					$e->setVariable('titulo_descarga',"Download list of proposals's authors");
					$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
					$output 	= new miniTemplate($path_admin.'descarga_propuesta_autores.tpl');  
					for($m=0; $m < $total; $m++)
					{  
						$output->addTemplate('item_lista_revision');

						foreach($ListaAutores[$m] as $var => $val)
						{ 	 						
							if($var == 'presentador' && $val == 'si')
							{
								$val = 'yes';
							}			
							$output->setVariable($var,trim($val));
						}   
					}
					$archivo 	= SIDTOOLHtml::escribirExcelTabla($output->toHtml(),$path,'xls','proposal_author_'); 
					$e->setVariable('archivo_tmp',$archivo);  
				}
				/** DESCARGA DE TRABAJOS Y REVISOR */
				$ControladorConsultasGeneral = new ControladorConsultasGeneral();
				$revisores = $ControladorConsultasGeneral->revisoresEnvios();
				Funciones::mostrarArreglo($revisores);
				$total = count($revisores);
				if(is_array($revisores) && $total > 0)
				{ 
					$e->addTemplate('item_lista_descarga');
					$e->setVariable('titulo_descarga',"Download list of proposals's reviewers");
					$output 	= new miniTemplate($path_admin.'descarga_revisores.tpl'); 
					$in_envio_anterior = 0;
					for($m=0; $m < $total; $m++)
					{  
						$output->addTemplate('item_lista_elemento');
	  					$output->setVariable('id_envio',$revisores[$m]['id_envio']);
	  					$output->setVariable('revisor_1',$revisores[$m]['username']);
	  					if(is_null($revisores[$m]['username']))
	  					{
							$output->setVariable('revisor_2',$revisores[$m]['username']);
						}
						else
						{
							$m = $m + 1;
							$output->setVariable('revisor_2',$revisores[$m]['username']);
						}
					}				
					$archivo 	= SIDTOOLHtml::escribirExcelTabla($output->toHtml(),$path,'xls','proposal_reviewers_'); 
					$e->setVariable('archivo_tmp',$archivo); 				
				}								
			}  
			 
			/** DESCARGA REVISIONES */  
			 //Funciones::mostrarArreglo($ListaDeObjetos); 
		 	$ControladorRevisionEnvio = new ControladorRevisionEnvio(); 
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$total = count($ListaDeObjetos); 
				for($i=0; $i < $total; $i++)
				{ 
					$e->addTemplate('lista_item');   
					foreach($ListaDeObjetos[$i] as $var => $val)
					{
						$e->setVariable($var,trim($val));
					}  
					$revisiones = $ControladorRevisionEnvio->obtenerListado($ListaDeObjetos[$i]['id_envio']);
						
					$e->setVariable('revisiones',count($revisiones));
					
					$e->setVariable('estado_decision','pendiente');
					if(trim($revisiones[0]['tipo_revision']) == 'definitivo')
					{						
						$e->setVariable('estado_decision','completo');
					}
					if($i%2 == 0)						
					{
						$e->setVariable('class_color','fondo_oscuro');
					}	
				}  
			}   
		break;
		case 'modificar':
			$e = new miniTemplate($path_admin.'form.tpl');  
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos	 	= $ControlClase->obtenerListado($id_envio);
			
			
			$ControladorConsultasGeneral = new ControladorConsultasGeneral();
			$ListaDeObjetos	 	= $ControladorConsultasGeneral->obtenerEnvio($id_envio);
			$i = 0;
		 	 //Funciones::mostrarArreglo($ListaDeObjetos[0]);
		 	
			foreach($ListaDeObjetos[$i] as $var => $val)
			{ 			 
				if($var == 'tipo_no_paper' && $val == 'si')
				{
					$val = 'yes'; 
				}			
				if($var == 'fecha' )
				{
					$val = date("Y-m-d H:i:s",$val); 
				}		
				
				$e->setVariable($var,trim($val));
				if($var == 'abstract' || $var == 'propuesta' || $var == 'referencias')
				{
					$e->setVariable($var,stripslashes(nl2br(trim($val))));
				} 
			}  
			if($theSession->userObject->permiso != 'evaluador') 
			{
				$e->addTemplate('item_lista_no_evaluador'); 
				foreach($ListaDeObjetos[$i] as $var => $val)
				{ 	 
					$e->setVariable($var,trim($val));
				}  		

				$ControladorInscripcionEnvioAutores = new ControladorInscripcionEnvioAutores();
				$ListaAutores = $ControladorInscripcionEnvioAutores->obtenerListado($id_envio);
				$total = count($ListaAutores);
				if($total > 0 && is_array($ListaAutores))
				{
					//Funciones::mostrarArreglo($ListaAutores);
					for($m=0; $m < $total; $m++)
					{
						$e->addTemplate('item_lista_no_evaluador_autor');
						$numero = $m + 1;
						$e->setVariable('numero',$numero);
						if($m%2 == 0)
						{
							$e->setVariable('fondo','fondo_oscuro');
						} 
						foreach($ListaAutores[$m] as $var => $val)
						{ 	 						
							if($var == 'presentador' && $val == 'si')
							{
								$val = 'yes';
							}			
							$e->setVariable($var,trim($val));
						}   
					}
				} 
			  
			 	$ControladorRevisionEnvio = new ControladorRevisionEnvio();
			 	$comentarios = $ControladorRevisionEnvio->obtenerListado($ListaDeObjetos[$i]['id_envio']);  
			 	
			 	if(is_array($comentarios) && count($comentarios) > 0)
			 	{
			 	 	$tipo_revision = $comentarios[0]['tipo_revision'];
			 		for($i=0; $i <count($comentarios); $i++)
			 		{
			 			$e->addTemplate('bloque_revisiones');
			 			$e->setVariable('fecha_html',ControladorFechas::fecha2Date($comentarios[$i]['fecha'],0,true)); 
						foreach($comentarios[$i] as $var => $val)
						{ 			
							$e->setVariable($var,trim($val));
						}  
						$e->setVariable('decision_html',$alternativas_recomendaciones_unido[trim($comentarios[$i]['decision'])]); 
						
						if(trim($comentarios[$i]['promedio_nota']) != '' && $comentarios[$i]['promedio_nota'] != '0')
						{
							$e->addTemplate('bloque_revisiones_nota'); 
							foreach($comentarios[$i] as $var => $val)
							{ 			
								$e->setVariable($var,trim($val));
							}  
						} 
						//$e->setVariable('decision_html',$comentarios[$i]['decision']);
			 		}
			 	}
		 	}  
			 	
			for($i=1; $i < 9;$i++)
			{
				if($i < 8)
				{
					$e->addTemplate('bloque_chequeos_criterios');
					$e->setVariable('criterio',$i);	
				} 
				$e->addTemplate('bloque_chequeos_criterios_calculo');
				$e->setVariable('criterio',$i); 
			}			  
			switch($theSession->userObject->permiso)
			{
				case 'evaluador':				 
					$e->addTemplate('bloque_cambio_recomendacion_titulo_evaluador'); 
					$ControladorRevisionEnvio = new ControladorRevisionEnvio();
					$comentarios = $ControladorRevisionEnvio->obtenerEvaluacionUsuario($id_envio,$ControlHtml->theSession->userName);
					 
					if(is_array($comentarios) && count($comentarios) > 0)
					{
						$tipo_revision = $comentarios[0]['tipo_revision'];
				 		for($i=0; $i <count($comentarios); $i++)
				 		{
				 			$e->addTemplate('bloque_revisiones');
				 			$e->setVariable('fecha_html',ControladorFechas::fecha2Date($comentarios[$i]['fecha'],0,true)); 
							foreach($comentarios[$i] as $var => $val)
							{ 			
								$e->setVariable($var,trim($val));
							}  
							$e->setVariable('decision_html',$alternativas_recomendaciones_unido[trim($comentarios[$i]['decision'])]); 
							
							if(trim($comentarios[$i]['promedio_nota']) != '' && $comentarios[$i]['promedio_nota'] != '0')
							{
								$e->addTemplate('bloque_revisiones_nota'); 
								foreach($comentarios[$i] as $var => $val)
								{ 			
									$e->setVariable($var,trim($val));
								}  
							} 
							//$e->setVariable('decision_html',$comentarios[$i]['decision']);
				 		}
					}	
					else
					{
						$e->addTemplate('bloque_formulario_revisores');
					} 					
					 
				break; 
				case 'administrador':
					$e->addTemplate('bloque_formulario_admin'); 
					$e->setVariable('selected_'.$ListaDeObjetos[0]['estado'],'selected'); 
					$e->setVariable('comentario_interno',$ListaDeObjetos[0]['comentario']); 
					
					$ControladorEnviosEvaluador = new ControladorEnviosEvaluador();
					$revisores = $ControladorEnviosEvaluador->obtenerListado($ListaDeObjetos[0]['id_envio']);
					//Funciones::mostrarArreglo($revisores); 
					$total = count($revisores);  
					$revisores_sel = array();
					for($j=0; $j < $total; $j++)
					{
						$revisores_sel[$revisores[$j]['username']] = array();
					}
					//Funciones::mostrarArreglo($revisores_sel); 					
					$ControladorPermisos = new ControladorPermisos();
					$permiso = $ControladorPermisos->getPermisoByAlias('evaluador');
					
					//Funciones::mostrarArreglo($permiso);
					$ControladorDeUsuarios = new ControladorDeUsuarios();
					$revisores = $ControladorDeUsuarios->getUsuariosPermiso($permiso);  
					$total = count($revisores);
					for($j=0; $j < $total; $j++)
					{
						$e->addTemplate('bloque_formulario_admin_reviewer');
						$e->setVariable('username',$revisores[$j]['username']);
						if(array_key_exists($revisores[$j]['username'], $revisores_sel))
						{
							$e->setVariable('selected','selected');
						}
					} 
					//Funciones::mostrarArreglo($revisores);   
				break;
			}	
			if($lastAction[2] == 'guardar')
			{
				$e->addTemplate('bloque_volver_listado');
				$e->setVariable('opcion',$lastAction[0]);
			}
		break; 
	}  
	echo $e->toHtml();
?>