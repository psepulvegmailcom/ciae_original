<?
	 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'intranet_textos/inconsistencias/'; 
	 		 
	$MantenedoresGeneral 	= new MantenedoresGeneral();
	$valores 				= VarSystem::getPost();  
	$form_especial			= ''; 
	 
	if($lastAction[1] == 'guardar' )
	{  
 	 	//Funciones::mostrarArreglo($valores,true);
 	 	$ControlCorreccionInconsistencia = new ControlCorreccionInconsistencia();
 	 	$ControlCorreccionInconsistencia->guardarCierreInconsistencia($valores['id_texto'],$valores['id_tipo_texto'],$valores['criterio']);
 	 	 
 	 	$nivel 			= $valores['nivel'][$valores['id_texto']]; 
		$valor_criterio = $nivel[$valores['id_tipo_texto']];  
 	 	$valor_criterio = $valor_criterio[$valores['criterio']]; 
 	 	  
 	 	$ControlCorreccionDefinitivo = new ControlCorreccionDefinitivo();
 	 	$ControlCorreccionDefinitivo->guardarModificacionInconsistencia($valores['id_texto'],$valores['id_tipo_texto'],$valores['criterio'],$valor_criterio);
 	 	$inconsistencias = $ControlCorreccionInconsistencia->buscarEstadoInconsistencia($valores['id_texto'],$valores['id_tipo_texto'],$valores['criterio']);
 	 	//Funciones::mostrarArreglo($inconsistencias,true);
 	 	if(is_array($inconsistencias) && count($inconsistencias) > 0)
 	 	{
			/* NO SE CIERRA*/
		}
		else
		{
			$ControlCorreccionDefinitivo-> guardarCierreInconsistencia($valores['id_texto'],$valores['id_tipo_texto']);
		}
	} 
	 
	
	$ControlVistaCorreccionInconsistenciaMultiple = new ControlVistaCorreccionInconsistenciaMultiple();
	$listado  = $ControlVistaCorreccionInconsistenciaMultiple->obtenerListado();
 	//Funciones::mostrarArreglo($listado,true);
	$e = new miniTemplate($path_admin.'mant'.$form_especial.'.tpl'); 
	 
	$e->setVariable('opcion_modulo',$lastAction[0]);  
	 
	//  Funciones::mostrarArreglo($ObjetoClase);
	// Funciones::mostrarArreglo($ListaDeObjetos[1]);
	if(!is_array($listado) || count($listado) == 0)
	{
		$e->addTemplate('item_lista_nohay'); 
	}
	else
	{   
		$total = count($listado);  
		$anteriores = array('id_texto' => '',
							'id_tipo_texto' => '',
							'criterio' => '');
		$fila = 1;
		
		$avanza = false;
		$i = 0;
		while($i < $total)
		{
			$listado[$i]['id_item'] = $listado[$i]['id_texto'];
			$listado[$i]['fila'] = $fila; 
			//Funciones::mostrarArreglo(array($i,$anteriores,$listado[$i]),true);
			if(trim($anteriores['id_texto']) != $listado[$i]['id_texto'] || trim($anteriores['id_tipo_texto']) != $listado[$i]['id_tipo_texto'] || trim($anteriores['criterio']) != $listado[$i]['criterio'])
			{
				$e->addTemplate('lista_item');
				$fila++;
				$e->setVariable('opcion_modulo',$opcion);
				foreach($listado[$i] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}  
				$e->setVariable('class_color','fondo_claro');
				if($fila%2 == 0)						
				{
					$e->setVariable('class_color','fondo_oscuro');
				}
				$aux = str_replace('criterio_5','',$listado[$i]['criterio']);
				if($aux != $listado[$i]['criterio'])
				{
					$e->addTemplate('lista_item_criterio_textual');
				}
				else
				{
					$e->addTemplate('lista_item_criterio_numerico');
				}							 	 
			}   
			$e->addTemplate('lista_item_correcto_valor');
			$e->setVariable('username',$listado[$i]['username']); 
			$e->setVariable('valor_criterio',$listado[$i][$listado[$i]['criterio']]); 
			
			$anteriores['id_texto'] 	 = $listado[$i]['id_texto'];
			$anteriores['id_tipo_texto'] = $listado[$i]['id_tipo_texto'];
			$anteriores['criterio'] 	 = $listado[$i]['criterio']; 
			$i++; 
		} 
		//Funciones::mostrarArreglo($listado,true);		 
	}		 
	echo $e->toHtml();
?>