<?php

	global $ControlHtml;
  	$valoresGet = VarSystem::getGet();
  	$idioma 	= VarSystem::obtenerIdiomaActual();
  	$valores 	= VarSystem::getPost(); 

	//header('Content-Type: text/html; charset=UTF-8'); 

 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet();
		$valores["busqueda_flag"]=1;
		//$valores["busca_Anno"]='2015'; 
 	}  
		
	$id_publicaciones = $valoresGet['id_publicaciones'];
  	$ControlPublicaciones = new ControlPublicaciones();
  	$tipo = $valoresGet['tipo'];
	
	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'publicaciones/publicaciones.tpl');
		$e->setVariable('id_publicaciones',$id_publicaciones);
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','1');
		
	if(trim($id_publicaciones) != '' && ($valores["buscar"]!="buscar"))
  	{
		$e->addTemplate('bloque_publicaciones_detalle');
		$listado = $ControlPublicaciones->obtenerListadoPorPublicacion($id_publicaciones);  
				
		$ControlPublicacionesPersona = new ControlPublicacionesPersona();
		$listado[0]['autores_html'] = $ControlPublicacionesPersona->obtenerListadoPersonas($id_publicaciones);

	  	Funciones::mostrarArreglo($listado);
	  	$e->showDataSimple($listado[0]);
		if((trim($listado[0]['documento']) != '') && (trim($listado[0]['documento_publico'])=="si"))
		{ 
			$e->addTemplate('bloque_elemento_documento');
			$e->setVariable('documento',$listado[0]['documento']); 
		}
		if((trim($listado[0]['link']) != ''))
		{ 
			$e->addTemplate('bloque_elemento_documento_link');
			$e->setVariable('link',$listado[0]['link']); 
		}	
		if((trim($listado[0]['doi']) != ''))
		{ 
			$e->addTemplate('bloque_elemento_link_doi');
			$e->setVariable('doi',$listado[0]['doi']); 
		}		
	}	 
	else
	{				
		$e->addTemplate('bloque_buscador');
		$e 	= $ControlHtml->ControlIdioma->publicarTextoTemplate($e);
		$e->showDataSimple($valores); 	
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','1');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']); 
		
		$agno = $valores['anno'];
		if(trim($agno) == '')
		{
			$agno = date("Y");
			$valores['anno'] = $agno;
		}
	
		$e->setVariable('titulo',$menu[0]['titulo_'.VarSystem::obtenerIdiomaActual()]); 
		
		$bloque_tipo = 'bloque_elemento'; 
		$tipo 		= 1;
		//$ControlPublicaciones = new ControlPublicaciones();
		
		$publicacion = $valores["publicacion_flag"];
		
		
		 
		
		if(!is_array($listado) || count($listado) == 0)
		{
			$ControlPublicaciones = new ControlPublicaciones();
			$agno = $ControlHtml->ControlIdioma->obtenerVariable('publicaciones_filtro_todo');
			$listado 	= $ControlPublicaciones->obtenerListadoPorTipoAgno($tipo);
		}
	
		/***************** BUSCADOR ********************/

		if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
		{	
			if(!$valores and $valoresGet["busca_palabra"]!="") $valores["busca_palabra"]=$valoresGet["busca_palabra"];
			if($valoresGet["busca_Autor"]!="") $valores["busca_Autor"]=$valoresGet["busca_Autor"];
			if($valoresGet["busca_Autor_id"]!="") $valores["busca_Autor_id"]=$valoresGet["busca_Autor_id"];
			if($valores["busqueda_flag"]=="") $valores["busqueda_flag"]=$valoresGet["busqueda_flag"];		 		
			$tipoBusqueda	= $valores["busqueda_flag"];			
			$ControlPublicaciones = new ControlPublicaciones();
			
			list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlPublicaciones, $tipoBusqueda);
						  
			foreach($valores as $var => $val)
			{   
				$e->addTemplate('bloque_asignacion_valores_formulario');
				$e->setVariable('variable',$var);
				$e->setVariable('valor',$val);		
			} 	
									
		}  
		/***************** FIN BUSCADOR ********************/	 
	
		$total = count($listado);
		
	  	Funciones::mostrarArreglo($listado); 
	  
		if(is_array($listado) && $total > 0)
		{
				
			$ControlPublicacionesPersona = new ControlPublicacionesPersona();
			for($i=0; $i < $total; $i++)
			{ 
				$e->addTemplate($bloque_tipo); 
				$e->showDataSimple($listado[$i]);
				$autores = $ControlPublicacionesPersona->obtenerListadoPersonas($listado[$i]['id_publicaciones']);
				$e->setVariable('autores',$autores);
				if(trim($listado[$i]['ver_detalle']) == '1')
				{
					
					$e->addTemplate($bloque_tipo.'_bloque_elemento_ver_detalle');
					$e->showDataSimple($listado[$i]);
				}
				else
				{
					if(trim($listado[$i]['documento']) != '')
					{
						$e->addTemplate($bloque_tipo.'_bloque_elemento_documento'); 
						$e->showDataSimple($listado[$i]);
					}
					if(trim($listado[$i]['link']) != '')
					{
						$e->addTemplate($bloque_tipo.'_bloque_elemento_link');
						$e->showDataSimple($listado[$i]);
					}	
				}	 
			}	
			
			/*---------  Paginación   -----------------*/	
			$e->addTemplate('bloque_elemento_paginacion');
		 	$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
		 	/*--------- Fin Paginación   -----------------*/	
		}	  
	
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