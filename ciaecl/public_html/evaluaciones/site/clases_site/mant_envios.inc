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
	
	$ControlClase = new ControladorEnvioInscripcion();
	switch($lastAction[2])
	{
	 	case 'guardar':	  
			/*GUARDAR LA MODIFICACION O INGRESO*/  
			$elemento = new RevisionEnvio(); 
			$valoresFormulario = array('id_envio','criterio_1','criterio_2','criterio_3','criterio_4','criterio_5','criterio_6','criterio_7','comentario','decision','tipo_revision');  
			for($i=0; $i < count($valoresFormulario); $i++)
			{
				$elemento->$valoresFormulario[$i] = " ".VarSystem::getVariable($valoresFormulario[$i])." ";		
			}  
			$elemento->username = $ControlHtml->theSession->userName;
			$elemento->fecha 	= time();
			$elemento->saveObject();   
			
			if($ControlHtml->lastActionArray[0] == 'admin_envio_final' && $theSession->userObject->permiso == 'coordinador')
			{
				$ControladorAreasSesion     = new ControladorAreasSesion();
				$AreasSesion 				= new AreasSesion();
				if(isset($valores['eliminar']) && is_array($valores['eliminar']))
				{
					foreach($valores['eliminar'] as $id_sesion_eliminar => $envios_eliminar)
					{
						foreach($envios_eliminar as $id_envio_eliminar => $caso_eliminar)
						{ 
							if(trim($caso_eliminar) == 'si')
							{
								$AreasSesion->obtenerSesion($id_sesion_eliminar); 	
								for($k=1; $k <= 6; $k++)
								{
									$aux = 'id_envio_cupo_'.$k;
									if($AreasSesion->$aux == $id_envio_eliminar)
									{
										$AreasSesion->$aux = '0';
									}
								}	 
 								$AreasSesion->guardarSesion();
							}
						}
					}
				}
				//Funciones::mostrarArreglo($valores);
					
				if($valores['decision'] == 'seleccionado')
				{
					$AreasSesion->obtenerSesion($valores['sesion']); 
					$sesion_asignada  = false; 
					$trabajo_asignado = false; 
					for($k=1; $k <= 6; $k++)
					{
						$aux = 'id_envio_cupo_'.$k; 
						if($AreasSesion->$aux == 0)
						{
							$AreasSesion->$aux  = $valores['id_envio'];
							$sesion_asignada 	= true; 
							break;
						}
						else
						{
							if($AreasSesion->$aux  == $valores['id_envio'])
							{
								$trabajo_asignado = true;
								break;
							}
						}
					} 
					$AreasSesion->guardarSesion(); 	 
				}
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
		break;
	}
	
	 //Funciones::mostrarArreglo($lastAction);
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
			$ControladorAreasUsuario = new ControladorAreasUsuario();
			$areaUsuario = $ControladorAreasUsuario->obtenerListado($theSession->userName); 
			$ListaDeObjetos	 	= $ControlClase->obtenerListado(0,$areaUsuario[0]['id_area']);
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
				 
				$ControladorRevisionEnvio = new ControladorRevisionEnvio();
				$comentarios = $ControladorRevisionEnvio->obtenerListados($areaUsuario[0]['id_area']);
				// Funciones::mostrarArreglo($comentarios);
				$total_comentarios = count($comentarios);
				
				if(is_array($comentarios) && $total_comentarios > 0)
				{
					$e->addTemplate('item_lista_descarga');
					$path 		= VarSystem::getPathVariables('dir_repositorio_tmp');
					$output 	= new miniTemplate($path_admin.'descarga.tpl'); 
					for($m=0; $m < $total_comentarios; $m++)
					{
						$output->addTemplate('item_lista_revision');
						foreach($comentarios[$m] as $var => $val)
						{ 			
							$output->setVariable($var,trim($val));
						}  
					}
					$archivo 	= SIDTOOLHtml::escribirExcelTabla($output->toHtml(),$path); 
					$e->setVariable('archivo_tmp',$archivo);  
				}  
			}   
		break;
		case 'modificar':
			$e = new miniTemplate($path_admin.'form.tpl'); 	 
			 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos	 	= $ControlClase->obtenerListado($id_envio);
			$i = 0;
		 	//Funciones::mostrarArreglo($ListaDeObjetos[0]	);
		 	
			foreach($ListaDeObjetos[$i] as $var => $val)
			{ 			
				$e->setVariable($var,trim($val));
			}  
			$ControlPais = new ControlPais();
 			$pais = $ControlPais->getPaises($ListaDeObjetos[$i]['pais']);
 			$e->setVariable('pais',$pais[0]['pais']);  
	 		$tipo_revision = 'evaluacion';
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
		 		}
		 	}
		 	else
		 	{
		 		$e->setVariable('no_hay_comentarios','No hay revisiones registradas');
		 	}
			 	
			for($i=1; $i < 8;$i++)
			{
				$e->addTemplate('bloque_chequeos_criterios');
				$e->setVariable('criterio',$i);
			}	     
			switch($theSession->userObject->permiso)
			{
				case 'evaluador':
					if(trim($tipo_revision) == 'definitivo')
					{ 
						$e->addTemplate('bloque_formulario_revisores_cerrado');
					}
					else
					{ 	
						$e->addTemplate('bloque_formulario_revisores');
					}
				break;
				case 'coordinador':  
					if(trim($tipo_revision) == 'definitivo')
					{
						$e->addTemplate('bloque_formulario_revisores_cerrado'); 
					}
					else
					{ 
						if($ControlHtml->lastActionArray[0] == 'admin_envio')
						{
							$e->addTemplate('bloque_formulario_revisores'); 
						}
					} 
					if($ControlHtml->lastActionArray[0] == 'admin_envio_final')
					{  
						if(isset($sesion_asignada) && !$sesion_asignada)
						{
							if(!$trabajo_asignado)
							{
								$e->addTemplate('bloque_sesion_llena');
							}
							else
							{
								$e->addTemplate('bloque_sesion_asignado');
							}
						} 							
						$e->addTemplate('bloque_formulario_revisores');
						$e->addTemplate('bloque_formulario_coordinadores');
						$ControladorEnvioInscripcion = new ControladorEnvioInscripcion();
						$ControladorAreasSesion      = new ControladorAreasSesion();
						$sesiones = $ControladorAreasSesion->obtenerSesionesArea($ListaDeObjetos[0]['id_area']);
						//Funciones::mostrarArreglo($sesiones); 
						for($i=0; $i < count($sesiones);$i++)
						{
							$e->addTemplate('bloque_formulario_coordinadores_sesion'); 
							$total_inscritos = 0;
							$trabajos = array();
							for($j=1; $j <= $sesiones[$i]['cupo']; $j++)
							{
								if($sesiones[$i]['id_envio_cupo_'.$j] > 0)
								{
									$total_inscritos++;
									$trabajos[] = $ControladorEnvioInscripcion->obtenerListado($sesiones[$i]['id_envio_cupo_'.$j]); 
								}	
							}  
							$sesiones[$i]['total_inscritos'] = $total_inscritos;
							$sesiones[$i]['orden_sesion'] 	 = $i + 1;
							foreach($sesiones[$i] as $var => $val)
							{ 			
								$e->setVariable($var,trim($val));
							} 						
						    if(count($trabajos) > 0)
						    { 
								for($j=0; $j < count($trabajos); $j++)
								{	
						    		$e->addTemplate('bloque_formulario_coordinadores_sesion_trabajo');
									foreach($trabajos[$j][0] as $var => $val)
									{ 	 
										$e->setVariable($var,trim($val));
									}  
									$e->setVariable('id_sesion',$sesiones[$i]['id_sesion']);
								}
						    }
						}
					}
				break;
				case 'administrador':
					$e->addTemplate('bloque_formulario_admin'); 
					$e->setVariable('selected_'.$ListaDeObjetos[0]['estado'],'selected');
					$e->setVariable('selected_area_'.$ListaDeObjetos[0]['id_area'],'selected');
					$e->setVariable('comentario_interno',$ListaDeObjetos[0]['comentario_interno']);
				break;
			}	
		break; 
	}  
	echo $e->toHtml();
?>