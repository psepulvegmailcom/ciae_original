<?php 

	global $ControlHtml; 
	
	$valores 	= VarSystem::getPost();
	$valoresGet = VarSystem::getGet();	
	$lastAction = explode('|',$valores['lastAction']);
	//Funciones::mostrarArreglo($lastAction);
	switch($lastAction[1])
	{
		default: 
			$e 		 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'encuesta_previo.tpl');
		break;
		case 'save_encuesta': 
		
			$e 		 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'encuesta_cierre.tpl');
			$ParticipantesBloque = new ParticipantesBloque();
			
			$ParticipantesBloque->eliminarSeleccion($valores['form_email']);
			
			$tipo_bloque = 'symposiums_accepted';
			$seleccion = $valores['seleccion'][$tipo_bloque];
			foreach($seleccion as $orden_bloque => $valor)
			{
				$ParticipantesBloque->buscarSeleccion($valores['form_email'],$tipo_bloque,$orden_bloque);
				$ParticipantesBloque->guardarSeleccion($valores['form_email'],$tipo_bloque,$orden_bloque,$valor); 
			}  
		break;
		case 'search_email': 
			$e 		 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'encuesta.tpl');
			$ControladorParticipantes 			= new ControladorParticipantes();
			$ControladorEnvioBloqueAsignacion 	= new ControladorEnvioBloqueAsignacion();
			$ControladorInscripcionEnvioAutores = new ControladorInscripcionEnvioAutores();
			$persona 	= $ControladorParticipantes->consultarParticipante($valores['form_email']);
			$ControladorParticipantesBloque = new ControladorParticipantesBloque();
			$seleccion = $ControladorParticipantesBloque->obtenerListado($valores['form_email']);
			//Funciones::mostrarArreglo($seleccion);
			$seleccion_id = array();
			for($i=0; $i < count($seleccion);$i++)
			{
				$seleccion_id[$seleccion[$i]['id_envio']] = 1;
			}
			//Funciones::mostrarArreglo($seleccion_id);			
			
			if(is_array($persona) && count($persona) > 0)
			{  
				$e->showDataSimple($persona[0]); 
				/** CONSULTA POR LOS SIMPOSIOS DISPONIBLES */
			 	$ControladorEnvioBloque = new ControladorEnvioBloque();
			 	$bloques = $ControladorEnvioBloque->obtenerListado('symposiums_accepted');
			 	//Funciones::mostrarArreglo($bloques);
			 	for($i=0; $i < count($bloques); $i++)
			 	{
					$e->addTemplate('bloque_bloque_dia');
					$e->showDataSimple($bloques[$i]);
					$detalle = $ControladorEnvioBloqueAsignacion->obtenerListadoDetalle($bloques[$i]['tipo'],$bloques[$i]['orden']);
					//Funciones::mostrarArreglo($detalle); 
					for($j=0; $j < count($detalle); $j++)
					{
						$e->addTemplate('bloque_bloque_detalle');
						
						if(isset($seleccion_id[$detalle[$j]['id_envio']]))
						{
							$e->setVariable('checked','checked');
						}						
						 
						$e->showDataSimple($detalle[$j]);
						$autores = $ControladorInscripcionEnvioAutores->obtenerListado($detalle[$j]['id_envio']);
						//Funciones::mostrarArreglo($autores); 
						for($k=0; $k < count($autores);$k++)
						{
							$e->addTemplate('bloque_bloque_detalle_autores');
							foreach($autores[$k] as $var => $val)
							{
								$autores[$k][$var] = stripcslashes($autores[$k][$var]);
								$autores[$k][$var] = ucwords(strtolower($autores[$k][$var]));
							} 
							$e->showDataSimple($autores[$k]); 
							if($k > 0)
							{
								$e->setVariable('separador',"; ");
							}
						}						
					}
				}				
			} 
			else
			{
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'encuesta_previo.tpl');
				$e->addTemplate('bloque_nueva_consulta');
			}
		break;
	}
	  
	echo $e->toHtml();
?>