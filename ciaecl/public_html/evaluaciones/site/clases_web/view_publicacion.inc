<?php	

	global $ControlHtml;
	$ControlPublicaciones = new ControlPublicaciones();
  	$valoresGet = VarSystem::getGet(); 
  	$valores 	= VarSystem::getPost();
  	
  	Funciones::mostrarArreglo($valores);
  	Funciones::mostrarArreglo($valoresGet);
  	$id_publicaciones = $valoresGet['id_publicaciones'];
  	
  	$tipo = $valoresGet['tipo'];
  	if(trim($tipo) == '')
  	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'publicaciones/publicaciones_doc_trabajo.tpl'); 
	}	 
  	else
  	{
		if($tipo == 'bib')
		{			
			$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'publicaciones/publicaciones_detalle_bib.tpl');
		}
	}
	$e->setVariable('id_publicaciones',$id_publicaciones);
	
	if(isset($valores['caso']) && trim($valores['caso']) == 'guardar')
  	{ 
  		$id_publicaciones = $valores['id_publicaciones']; 
	}	
 
	$listado = $ControlPublicaciones->obtenerListadoPorPublicacion($id_publicaciones);  
	 
	$ControlPublicacionesPersona = new ControlPublicacionesPersona();
	$listado[0]['autores_html'] = $ControlPublicacionesPersona->obtenerListadoPersonas($id_publicaciones);
	 
  	Funciones::mostrarArreglo($listado);
	$e->showDataSimple($listado[0]);

 	if(isset($valores['caso']) && trim($valores['caso']) == 'guardar')
  	{  
		$ControladorContacto = new ControladorContacto();
		$ControladorContacto->envioDocumentos($id_publicaciones);
		$ControladorContacto->enviarContacto($valores);  
		$e->addTemplate('bloque_mensaje_enviado');
	}	
	
	
		/* MUESTRA DE AÑOS PARA FILTRO LATERAL */
  	
	$ControlPublicaciones = new ControlPublicaciones();
	$agnos	 	= $ControlPublicaciones->obtenerAgnosPublicaciones($tipo);   
  	for($i=0; $i < count($agnos); $i++)
  	{
  		if(trim($agnos[$i]['agno']) == '')
  		{
			continue;
		}
	  	$e->addTemplate('bloque_publicaciones_filtro_agno'); 
	  	$e->setVariable('agno',$agnos[$i]['agno']); 
  	}
  	$e->addTemplate('bloque_publicaciones_filtro_agno'); 
  	$e->setVariable('agno',$ControlHtml->ControlIdioma->obtenerVariable('publicaciones_filtro_todo')); 
 
 
 	/** FILTRO POR AREA ***/
 	$ControlAreas = new ControlAreas();
 	$areas = $ControlAreas->obtenerListado();
 	//Funciones::mostrarArreglo($areas,true);
 	for($i=0; $i < count($areas); $i++)
  	{
  		$areas[$i]['area_show'] = $areas[$i]['area_'.VarSystem::obtenerIdiomaActual()];
	  	$e->addTemplate('bloque_publicaciones_filtro_area'); 
	  	$e->showDataSimple($areas[$i]); 
	  	$e->addTemplate('bloque_publicaciones_filtro_area_lateral'); 
	  	$e->showDataSimple($areas[$i]);  
  	} 	
  	
  	
 	/** FILTRO POR TIPO DE PUBLICACIONES ***/
  	$ControlTipoPublicaciones = new ControlTipoPublicaciones();
  	$tipos = $ControlTipoPublicaciones->obtenerListado();
 	//Funciones::mostrarArreglo($tipos,true);
 	for($i=0; $i < count($tipos); $i++)
  	{
	  	$e->addTemplate('bloque_publicaciones_filtro_tipo'); 
	  	$e->showDataSimple($tipos[$i]); 
	  	$e->addTemplate('bloque_publicaciones_filtro_tipo_lateral'); 
	  	$e->showDataSimple($tipos[$i]);  
  	} 	
	echo $e->toHtml();
?>