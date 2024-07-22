<?php

class ControlEncuesta 
{
	var $usuario;
	function ControlEncuesta($usuario)
	{
		$this->usuario 			 = $usuario;
		$this->ControlArea 		 = new ControlArea(); 
		$this->ControlComponente = new ControlComponente();
		$this->ControlElemento 	 = new ControlElemento();
		$this->ControlNivel 	 = new ControlNivel();
		$this->valores 	 		 = VarSystem::getPost();	
		$this->path_template 	 = VarSystem::getPathVariables('dir_template').'encuesta/';
		
		global $ControlHtml;		
		$this->PersonaControl = new PersonaControl();
		$this->PersonaControl->setPersonaByUser($ControlHtml->elUsuarioP);
		$this->encuesta_enviada = false;
		if($this->PersonaControl->obj->encuesta_enviada == 1)
		{
			$this->encuesta_enviada = true;	
		}	
		$this->mostrarArea = false;	 
	}
	
	function setUsuario($objUsuario)
	{
		$this->objUsuario = $objUsuario;
	}
		
	function enviarEncuesta()
	{
		$this->PersonaControl->obj->encuesta_enviada = 1;
		$this->PersonaControl->obj->saveObject('user_id = "'.$this->PersonaControl->obj->user_id.'"');
	}
	
	function mostrarPropuestas()
	{
		$e = new miniTemplate($this->path_template.'propuestas.tpl');		  
		return $e;
	}
	
	function mostrarAyuda()
	{
		$e = new miniTemplate($this->path_template.'ayuda.tpl');		  
		return $e;
	}
	
	function mostrarEnvio()
	{
		$e = new miniTemplate($this->path_template.'envio.tpl');
	 	$envio = true;
		/* revision mi cuenta */				  	 
		global $ControlHtml;		
		$elUsuarioP 		= $ControlHtml->elUsuarioP;
		$e->addTemplate('bloque_revision_item');
		$e->setVariable('revision_item','Paso 3 Mi Cuenta'); 
		$ControlPersona 	= new PersonaControl();
		$ControlPersona->setPersonaByUser($elUsuarioP); 
		if($ControlPersona->obj->completa == 1)
		{
			$e->addTemplate('bloque_revision_item_ok');
		}
		else
		{
			$e->setVariable('revision_item_msg','Falta completar información');
			$e->addTemplate('bloque_revision_item_error');	
			$envio = false;		
		}
	 	/*  REVISION PREGUNTAS DE AREAS */ 
		$e->addTemplate('bloque_revision_item');
		$e->setVariable('revision_item','Paso 5: Cuestionario de Áreas'); 	
		$error = true; 
		
		$ControlAreaRespuesta = new ControlAreaRespuesta();
		$componentes = $ControlAreaRespuesta->obtenerAreasConponentesUsuario($this->usuario);
		// Funciones::mostrarArreglo($componentes);
		$totalComponentes = count($componentes);
		
		$ControlComponenteRespuesta = new ControlComponenteRespuesta();
		$componentesRespuesta = $ControlComponenteRespuesta->obtenerRespuestasUsuario($this->usuario);
		// Funciones::mostrarArreglo($componentesRespuesta);
		$totalRespuestaComponentes = count($componentesRespuesta);
		//echo $totalRespuestaComponentes .' '. $totalComponentes;
		if($totalRespuestaComponentes == $totalComponentes)
		{
			$error = false; 
			for($i=0; $i < $totalRespuestaComponentes ; $i++)
			{
				if($componentesRespuesta[$i]['completo'] == 0)
				{
			 		$error = true;
				}
			}
		}
		if(!$error)
		{
			$e->addTemplate('bloque_revision_item_ok');
		}
		else
		{
			$e->setVariable('revision_item_msg','Falta completar formularios');
			$e->addTemplate('bloque_revision_item_error');
			$envio = false;					
		}	 
		
		if($envio)
		{
			$e->addTemplate('bloque_revision_enviar_encuesta');
		}
		return $e;
	} 
	
	function mostrarMediosVerificacion()
	{  
		$lastAction = explode('|',$this->valores['lastAction']);		 
		$RepuestaNivel = new RepuestaNivel();
		$RepuestaNivel->buscarObjeto($this->usuario);	
		//Funciones::mostrarArreglo(	$RepuestaNivel );		 
		if(!isset($RepuestaNivel->usuario))
		{
			$RepuestaNivel->usuario = $this->usuario;
			$RepuestaNivel->fecha   = time(); 			
			$RepuestaNivel->guardarObjeto(); 
			/* se crea por primera vez la respuesta del usuario aunque este todo vacio */
		}		
		if(trim($lastAction[1]) == 'guardar_datos')
		{ 
			$RepuestaNivel->fecha   	= time(); 
			$RepuestaNivel->completo 	= '0';
			$total = 0; 
		 	foreach($this->valores as $key => $valor)
			{
				$aux = str_replace('guardar_valor_','',$key);
				if(trim($aux) != trim($key))
				{ 
					// echo $aux.' '.$key.' '.$valor.'<br>';
					$RepuestaNivel->$aux = $valor;	
					if(trim($valor) != '')
					{
						$total++; //echo 'sumo<br>';
					}	
				}
			}					 
			if($total == 6 && trim($this->valores['guardar_valor_pregunta_desarrollo_4']) == '')
			{
				$RepuestaNivel->completo = '1';			
			}  
			if($total == 7)
			{
				$RepuestaNivel->completo = '1';			
			}		
			//echo $total.';'.$this->valores['guardar_valor_pregunta_desarrollo_4'].';';	
			$RepuestaNivel->guardarObjeto($this->usuario);
		}
		//Funciones::mostrarArreglo(	$RepuestaNivel );
		$e = new miniTemplate($this->path_template.'listado_medio.tpl');
		foreach($RepuestaNivel as $key => $valor)
		{ 
			$e->setVariable($key,$valor);	
		}		
		return $e;
	}
	
	function mostrarAreas()
	{
		$areas = $this->ControlArea->getItem();  
		$ControlAreaRespuesta = new ControlAreaRespuesta();
		$areasUsuario = $ControlAreaRespuesta->obtenerAreasUsuario($this->usuario); 
		$e = new miniTemplate($this->path_template.'listado_area.tpl'); 
		 // Funciones::mostrarArreglo($areas);  
//		   Funciones::mostrarArreglo($areasUsuario);  
		$e->addTemplate('bloque_areas_pregunta');
		//$e->showBlock('bloque_areas_pregunta_lista',$areas); 
		$e->showBlock('bloque_areas',$areasUsuario); 
		return $e; 
	}
	
	function guardarComponente()
	{		
		$ComponenteRespuesta = new ComponenteRespuesta();
		$ComponenteRespuesta->obtenerRespuesta($this->usuario,$this->valores['id_componente']); 
		$aux = explode('|',$this->valores['lastAction']);
		if($aux[2] == 'guardar_componente')
		{
			if(trim($this->valores['comentario'])!= '')
			{
				$ComponenteRespuesta->fecha 	= time();
				$ComponenteRespuesta->respuesta = trim($this->valores['comentario']);
				$ComponenteRespuesta->completo 	= 1;
				$ComponenteRespuesta->guardarRespuesta();
			}
		}
		return $ComponenteRespuesta;
	}
	
	function guardarIndicadoresEjemplos()
	{
		$lastAction = explode('|',$this->valores['lastAction']);
		if(isset($this->valores['comentario_elemento']) && trim($this->valores['comentario_elemento']) != '' && trim($lastAction[2] == 'guardar_nivel'))
		{
			$ElementoRespuesta = new ElementoRespuesta();
			$ElementoRespuesta->obtenerRespuesta($this->usuario,$this->valores['id_elemento']);
			$ElementoRespuesta->usuario 	= $this->usuario;
			$ElementoRespuesta->fecha 		= time();
			$ElementoRespuesta->respuesta 	= $this->valores['comentario_elemento'];
			$ElementoRespuesta->id_elemento = $this->valores['id_elemento'];
			$ElementoRespuesta->guardarRespuesta();
		}
			
		if(isset($this->valores['respuesta_indicador']))
		{
			foreach($this->valores['respuesta_indicador'] as $id => $respuesta) 
			{
				if(trim($respuesta) != '')
				{
					$IndicadorRespuestas = new IndicadorRespuestas();
					$IndicadorRespuestas->saveRespuesta($id,$respuesta,$this->usuario);
				} 
			}
		}
		if(isset($this->valores['respuesta_ejemplo']))
		{
			foreach($this->valores['respuesta_ejemplo'] as $id => $respuesta) 
			{
				if(trim($respuesta) != '')
				{
					$EjemploRespuestas = new EjemploRespuestas();
					$EjemploRespuestas->saveRespuesta($id,$respuesta,$this->usuario);
				} 
			}
		}
	}
	
	function guardarNiveles()
	{
		$NivelRespuesta = new NivelRespuesta();
		$NivelRespuesta->obtenerRespuesta($this->usuario,$this->valores['id_elemento']);	
		//Funciones::mostrarArreglo($NivelRespuesta);	
		$obligatorios = array('es_comprensible' => 0, 'es_pertinente' => 0, 'es_factible' => 0, 'graduacion_adecuada' => 0, 'indispensable' => 0, 'eliminaria' => 0, 'evidencia_suficiente' => 0, 'evidencia_congruente' => 0, 'medios_suficiente' => 0, 'medios_pertinente' => 0, 'medios_tienemedio' => 0, 'medios_esposible' => 0, 'pa_1' => 0, 'pa_2' => 0, 'pa_3' => 0);
		
		$aux = explode('|',$this->valores['lastAction']);
		if($aux[2] == 'guardar_nivel')
		{
			$NivelRespuesta->usuario 		= $this->usuario;
			$NivelRespuesta->id_elemento  	= $this->valores['id_elemento'];
			$total_respuesta = 0;
			foreach($this->valores as $key => $valor)
			{
				$aux = str_replace('valor_nivel_','',$key);
				if(trim($aux) != $key)
				{
					$NivelRespuesta->$aux = $valor;
					if(trim($valor) != '' && isset($obligatorios[$aux]))
					{
						$obligatorios[$aux] = 1; 
					}
				}
			} 
			$NivelRespuesta->completo = '1';
			foreach($obligatorios as $case => $estado)
			{
				if($estado == 0)
					$NivelRespuesta->completo = '0';	
			}
				
			$NivelRespuesta->fecha = time();
			$NivelRespuesta->guardarRespuesta(); 
	    }	
	    //Funciones::mostrarArreglo($NivelRespuesta);
	    //Funciones::mostrarArreglo($obligatorios);
		return $NivelRespuesta; 
	}
	
	function guardarAreas()
	{
		$AreaRespuesta = new AreaRespuesta();
		$AreaRespuesta->setUsuario($this->usuario);
		$AreaRespuesta->usuario = $this->usuario;
		//Funciones::mostrarArreglo($AreaRespuesta);
		$AreaRespuesta->eliminarAreas();
		for($i=0; $i < count($this->valores['areas_responder']); $i++)
		{
			$AreaRespuesta = new AreaRespuesta();
			$AreaRespuesta->usuario = $this->usuario;
			$AreaRespuesta->id_area = $this->valores['areas_responder'][$i];
			$AreaRespuesta->saveObject();
		}
	}
	
	function mostrarComponentes()
	{ 
		$e = new miniTemplate($this->path_template.'listado_area.tpl');
		if(trim($this->valores['id_area']) == '0')
		{ 
			$ControlAreaRespuesta = new ControlAreaRespuesta();
			$areasUsuario = $ControlAreaRespuesta->obtenerAreasUsuario($this->usuario);  
			$this->valores['id_area'] = $areasUsuario[0]['id_area'];
		} 
		$areas = $this->ControlArea->getItem($this->valores['id_area']); 
		//Funciones::mostrarArreglo($areas); 
		$e->showBlock('bloque_areas',$areas);
		$componentes = $this->ControlComponente->getComponentesPorArea($this->valores['id_area']);
		//Funciones::mostrarArreglo($componentes); echo $this->valores['id_area'];
		$total = count($componentes);
	 	$ComponenteRespuesta = new ComponenteRespuesta();
	 	$areaCompleta = true;
		for($i=0; $i < $total;$i++)
		{
			$ComponenteRespuesta->obtenerRespuesta($this->usuario,$componentes[$i]['id_componente']); 
			//Funciones::mostrarArreglo($ComponenteRespuesta);	
			$componentes[$i]['estado_componente'] = 'Incompleto'; 
			if($ComponenteRespuesta->completo == 1)
			{
				$componentes[$i]['estado_componente'] = 'Completo'; 
			}	
			else
			{
				$areaCompleta = false;
			}	
		}
		$e->showBlock('bloque_componentes_extra',$componentes); 
		//Funciones::mostrarArreglo($componentes);
		return $e;
	} 
	
	function mostrarElementos()
	{   
		$respuestas 	= $this->guardarComponente(); 
		$e = new miniTemplate($this->path_template.'listado_area.tpl');

		if(trim($this->valores['id_area']) == '0')
		{ 
			$ControlAreaRespuesta = new ControlAreaRespuesta();
			$areasUsuario = $ControlAreaRespuesta->obtenerAreasUsuario($this->usuario);  
			$this->valores['id_area'] = $areasUsuario[0]['id_area'];
		} 		
		$areas = $this->ControlArea->getItem($this->valores['id_area']);
		$e->showBlock('bloque_areas',$areas);
		$componentes = $this->ControlComponente->getItem($this->valores['id_componente']); 
		
		$total = count($componentes);
	 	$ComponenteRespuesta = new ComponenteRespuesta();
		$componente_completo = true;
		for($i=0; $i < $total;$i++)
		{
			$ComponenteRespuesta->obtenerRespuesta($this->usuario,$componentes[$i]['id_componente']);	
			$componentes[$i]['estado_componente'] = 'Incompleto'; 
			if($ComponenteRespuesta->completo == 1)
			{
				$componentes[$i]['estado_componente'] = 'Completo'; 
				$componente_completo = true; 
			}		 
		}		
		$e->showBlock('bloque_componentes',$componentes);
		$elementos = $this->ControlElemento->getElementosPorComponente($this->valores['id_componente']); 
		$totalelementos  = count($elementos);
		$NivelRespuesta  = new NivelRespuesta(); 
		
		$elemento_completo = true;
		for($i=0; $i < $totalelementos; $i++)
		{
			$NivelRespuesta->obtenerRespuesta($this->usuario,$elementos[$i]['id_elemento']);
			$elementos[$i]['estado_elemento'] = 'Incompleto';
			if($NivelRespuesta->completo == 1)
			{
				$elementos[$i]['estado_elemento'] = 'Completo'; 
			}	 
			else
			{
				$elemento_completo = false;
			}
		}  
		$e->showBlock('bloque_elementos',$elementos); 
		if($componente_completo || $elemento_completo) 
		{
			$e->addTemplate('bloque_pregunta_elemento');  
			$e->setVariable('comentario',$respuestas->respuesta); 
		}	
		
		$componentes_extra = $this->ControlComponente->getComponentesPorArea($this->valores['id_area']);
		$e->showBlock('bloque_componentes_extra',$componentes_extra); 
		//Funciones::mostrarArreglo($componentes_extra);
		
		if($this->objUsuario->perms < 3)
		{	
			$e->addTemplate('bloque_pregunta_elemento_comentarios'); 
			$ControlComponenteRespuesta = new ControlComponenteRespuesta();
			$respuestas = $ControlComponenteRespuesta->obtenerRespuestasComponente($this->valores['id_componente']);
			//Funciones::mostrarArreglo($respuestas);
			for($i=0; $i < count($respuestas); $i++)
			{
				if(trim($respuestas[$i]['respuesta']) != '')
				{
					$respuestas[$i]['respuesta'] = Funciones::TextoSimple(nl2br($respuestas[$i]['respuesta']));
					$e->addTemplate('bloque_pregunta_elemento_comentarios_detalles');
					$e->setVariable('fecha',ControladorFechas::fecha2Date($respuestas[$i]['fecha'],0,true));
					$e->setVariable('respuesta',$respuestas[$i]['respuesta']);
					$e->setVariable('usuario',$respuestas[$i]['usuario']);
				}
			}
		}
		return $e;
	} 
	
	function mostrarPregunta()
	{  
		$this->guardarIndicadoresEjemplos();
		$e = new miniTemplate($this->path_template.'listado_area.tpl');	
		if(trim($this->valores['id_area']) == '0')
		{ 
			$ControlAreaRespuesta = new ControlAreaRespuesta();
			$areasUsuario = $ControlAreaRespuesta->obtenerAreasUsuario($this->usuario);  
			$this->valores['id_area'] = $areasUsuario[0]['id_area'];
		} 	
		$areas = $this->ControlArea->getItem($this->valores['id_area']);
		//Funciones::mostrarArreglo($this->valores);
		$e->showBlock('bloque_areas',$areas);
		$componentes = $this->ControlComponente->getItem($this->valores['id_componente']);
	
		$total = count($componentes);
	 	$ComponenteRespuesta = new ComponenteRespuesta(); 
		$e->showBlock('bloque_componentes',$componentes);		
		$aux = explode('|',$this->valores['lastAction']);  
		 
		if($aux[2] == 'guardar_nivel' && $this->valores['valor_extra'] == 'continuar')
		{ 
			$siguiente = $this->ControlElemento->obtenerElementoSiguiente($this->valores['id_elemento']);
			if($siguiente > 0)
			{
				$this->valores['id_elemento'] = $siguiente;				
				$respuestas = new NivelRespuesta();
				$respuestas->obtenerRespuesta($this->usuario,$this->valores['id_elemento']);
				$e->setVariable('id_elemento',$this->valores['id_elemento']);
			}	
		} 
		$elementos = $this->ControlElemento->getItem($this->valores['id_elemento']);
		//	Funciones::mostrarArreglo($elementos);
		$totalelementos  = count($elementos); 
		 
		$NivelRespuesta  = new NivelRespuesta();
		for($i=0; $i < $totalelementos; $i++)
		{
			$NivelRespuesta->obtenerRespuesta($this->usuario,$elementos[$i]['id_elemento']);
			$elementos[$i]['estado_elemento'] = 'Incompleto';
			if($NivelRespuesta->completo == 1)
			{
				$elementos[$i]['estado_elemento'] = 'Completo'; 
			} 
		} 
	 	//Funciones::mostrarArreglo($elementos);	
		$e->showBlock('bloque_elementos',$elementos); 
		$niveles = $this->ControlNivel->getNivelesPorElemento($this->valores['id_elemento']);
		 
		$e->addTemplate('bloque_elementos_continuacion');
	 	//Funciones::mostrarArreglo($niveles);
	 	$id_elemento_siguiente = $this->ControlElemento->obtenerElementoSiguiente($this->valores['id_elemento']);
	 	if($id_elemento_siguiente > 0)
	 	{
	 		$e->addTemplate('bloque_elementos_continuacion_siguiente');
	 		$e->setVariable('id_elemento_siguiente',$id_elemento_siguiente);	 		
	 	}
	 	$id_elemento_anterior = $this->ControlElemento->obtenerElementoAnterior($this->valores['id_elemento']);
	 	if($id_elemento_anterior > 0)
	 	{
	 		$e->addTemplate('bloque_elementos_continuacion_anterior');
	 		$e->setVariable('id_elemento_anterior',$id_elemento_anterior);	 		
	 	}	 	  
	 	
		$componentes_extra = $this->ControlComponente->getComponentesPorArea($this->valores['id_area']);
		$e->showBlock('bloque_componentes_extra',$componentes_extra); 
		//Funciones::mostrarArreglo($componentes_extra);
		$e->addTemplate('bloque_niveles'); 
		$e->setVariable('definicion_estandar',$elementos[0]['definicion']);
		$ElementoRespuesta = new ElementoRespuesta();
		$ElementoRespuesta->obtenerRespuesta($this->usuario,$this->valores['id_elemento']);
		$e->setVariable('comentario_elemento',$ElementoRespuesta->respuesta); 
		
		if($this->objUsuario->perms < 3)
		{
			$ControlElementoRespuesta = new ControlElementoRespuesta();
			$respuestasE = $ControlElementoRespuesta->obtenerRespuestasElemento($this->valores['id_elemento']);
			//Funciones::mostrarArreglo($respuestasE);
			$e->addTemplate('bloque_estandares_comentarios');
			$totalE = count($respuestasE);
			$hayrespuesta = 0;
			for($m=0; $m < $totalE; $m++)
			{
				if(trim($respuestasE[$m]['respuesta']) != '')
				{ 
					$hayrespuesta++; 
					$respuestasE[$m]['respuesta'] = Funciones::TextoSimple(nl2br($respuestasE[$m]['respuesta']));
					$e->addTemplate('bloque_estandares_comentarios_detalles');
					$e->setVariable('fecha',ControladorFechas::fecha2Date($respuestasE[$m]['fecha'],0,true));
					$e->setVariable('respuesta',$respuestasE[$m]['respuesta']);
					$e->setVariable('usuario',$respuestasE[$m]['usuario']);					
				}	 
			}
			if($hayrespuesta == 0)
			{
				$e->addTemplate('bloque_estandares_comentarios_no_detalles');
			}
		}
		
		
  		
		$e->addTemplate('bloque_pregunta');
		$e->setVariable('color_area',	$areas[0]['color']);
		$e->addTemplate('bloque_explicacion_respuesta'); 	 
			
		$ControlEjemplo = new ControlEjemplo();
	 	$ejemplos = $ControlEjemplo->getEjemplosPorElemento($this->valores['id_elemento']);
	 	//Funciones::mostrarArreglo($ejemplos);
	 	if(is_array($ejemplos) && count($ejemplos) >0)
	 	{
	 		$e->addTemplate('bloque_ejemplos_global');
	 		$ControlEjemploRespuesta = new ControlEjemploRespuesta();
	 		for($i=0; $i < count($ejemplos); $i++)
	 		{
	 			$respuesta = $ControlEjemploRespuesta->getRespuestaEjemplos($ejemplos[$i]['id_ejemplo'], $this->usuario); 
	 			//Funciones::mostrarArreglo($respuesta);
				$e->addTemplate('bloque_ejemplos');
				$fila_color = '_claro';
				if($i%2 == 0)						
				{					
					$fila_color = '_oscuro'; 
				} 				
				$e->setVariable('class_color',$fila_color); 
				$e->setVariable('respuesta',$respuesta[0]['respuesta']);	 
				$e->setVariable('ejemplo',$ejemplos[$i]['ejemplo']);	 	
				$e->setVariable('id_ejemplo',$ejemplos[$i]['id_ejemplo']);
				if($this->objUsuario->perms < 3)
				{
					$e->addTemplate('bloque_ejemplos_comentarios');
					$respuestas = $ControlEjemploRespuesta->getRespuestas($ejemplos[$i]['id_ejemplo']);
					if(is_array($respuestas) && count($respuestas)>0)
					{
						for($j=0; $j < count($respuestas); $j++)
						{
							if(trim($respuestas[$j]['respuesta']) != '')
							{
								$e->addTemplate('bloque_ejemplos_comentarios_detalles');
								$e->setVariable('fecha',ControladorFechas::fecha2Date($respuestas[$j]['fecha'],0,true));
								$e->setVariable('respuesta',$respuestas[$j]['respuesta']);
								$e->setVariable('usuario',$respuestas[$j]['usuario']);
							}
						}
					}
					else
					{
						$e->addTemplate('bloque_ejemplos_comentarios_no_detalles');
					}
				}		 
	 		}
	 	}	
		else
		{
			$e->addTemplate('bloque_no_ejemplos');
		}	
	 
	 	$ControlIndicador = new ControlIndicador();
	 	$indicadores = $ControlIndicador->getIndicadoresPorElemento($this->valores['id_elemento']);
	 	//Funciones::mostrarArreglo($indicadores);
	 	if(is_array($indicadores) && count($indicadores) >0)
	 	{
	 		$ControlIndicadorRespuesta = new ControlIndicadorRespuesta();
	 		$ControlEjemploRespuesta = new ControlEjemploRespuesta();
	 		for($i=0; $i < count($indicadores); $i++)
	 		{
	 			$respuesta = $ControlIndicadorRespuesta->getRespuestaIndicadores($indicadores[$i]['id_indicador'], $this->usuario); 
	 	//		Funciones::mostrarArreglo($respuesta);
				$e->addTemplate('bloque_indicadores'); 
				$fila_color = '_claro';
				if($i%2 == 0)						
				{					
					$fila_color = '_oscuro'; 
				} 				
				$e->setVariable('class_color',$fila_color); 				
				$e->setVariable('respuesta',$respuesta[0]['respuesta']);
				$indicadores[$i]['indicador'] = Funciones::TextoSimple(nl2br($indicadores[$i]['indicador']));					 
				$e->setVariable('indicador',$indicadores[$i]['indicador']);	  
				$e->setVariable('id_indicador',$indicadores[$i]['id_indicador']);	
				if($this->objUsuario->perms < 3)
				{
					$e->addTemplate('bloque_indicadores_comentarios');
					$respuestas = $ControlIndicadorRespuesta->getRespuestas($indicadores[$i]['id_indicador']);
					if(is_array($respuestas) && count($respuestas)>0)
					{
						for($j=0; $j < count($respuestas); $j++)
						{
							if(trim($respuestas[$j]['respuesta']) != '')
							{
								$respuestas[$j]['respuesta'] = Funciones::TextoSimple(nl2br($respuestas[$j]['respuesta']));
								$e->addTemplate('bloque_indicadores_comentarios_detalles');
								$e->setVariable('fecha',ControladorFechas::fecha2Date($respuestas[$j]['fecha'],0,true));
								$e->setVariable('respuesta',$respuestas[$j]['respuesta']);
								$e->setVariable('usuario',$respuestas[$j]['usuario']);
							}
						}
					}
					else
					{
						$e->addTemplate('bloque_indicadores_comentarios_no_detalles');
					}
				}					
	 		}
	 	}
		else
		{
			$e->addTemplate('bloque_no_indicadores');
		}						
		return $e;
	}
	
	function mostrarGlosario()
	{
		$e = new miniTemplate($this->path_template.'glosario.tpl');		  
		return $e;
	}
}
?>