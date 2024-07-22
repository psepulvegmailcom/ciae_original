<?php
 
	global $ControlHtml;
	$ControladorHTML = new ControladorHTML();	
	$ControlProyectos = new  ControlProyectos();
	$ControlGeneralSitios = new ControlGeneralSitios();
	$valores = VarSystem::getPost();
  	$valoresGet = VarSystem::getGet();
  	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'proyectos.tpl'); 
	$e->setVariable('page',$valoresGet["page"]);
	$e->setVariable('busca_flag','3');
	 	/** FILTRO POR AREA ***/
 	$ControlAreas = new ControlAreas();
 	$areas = $ControlAreas->obtenerListado();
 	//Funciones::mostrarArreglo($areas,true);
 	  		
 	for($i=0; $i < count($areas); $i++)
  	{
  		$areas[$i]['area_show'] = $areas[$i]['area_'.VarSystem::obtenerIdiomaActual()];
	  	$e->addTemplate('bloque_proyectos_filtro_area'); 
	  	$e->showDataSimple($areas[$i]); 
	  	$e->addTemplate('bloque_proyectos_filtro_area_lateral'); 
	  	$e->showDataSimple($areas[$i]);  
  	} 

  	if(isset($valoresGet['case'])&& ($valores['inicia_busca']=="") )
  	{	
	  			
  		/** PRESENTACION FICHA DE PROYECTOS */ 
		$proyectos = $ControlProyectos->obtenerListado($valoresGet['id']); 
	//	Funciones::mostrarArreglo($proyectos);
		$e->addTemplate('bloque_proyectos_por_ficha');  

		$e = $ControlHtml->ControlIdioma->publicarTextoTemplate($e,$ControlHtml->langSite); 
		$e->showDataSimple($proyectos[0]);
		
 		$datos = array('caso'=>'proyectos','id'=>$valoresGet['id'],'template'=>$e);
 		$datos['template'] = $ControladorHTML->desplegarAreas($datos); 
 		$datos['template'] = $ControladorHTML->desplegarPersonas($datos);  
 		$e = $ControladorHTML->desplegarPublicaciones($datos);  
	
		if(trim($proyectos[0]['url']) != '')
		{
			$e->addTemplate('bloque_proyectos_por_ficha_campos_url');
			$e->showDataSimple($proyectos[0]);	
		}

		if(trim($proyectos[0]['imagen']) != 'blanco.jpg')
		{
			$e->addTemplate('bloque_proyectos_por_ficha_imagen');
			$e->setVariable('imagen',$proyectos[0]["imagen"]);
			$e->setVariable('id',$proyectos[0]["id_proyecto"]);
			$e->showDataSimple($proyectos[0]);	
		}
		$campos = array('antecedentes','objetivos','metodologia','productos');
		for($i=0; $i < count($campos); $i++)
		{
			if(trim($proyectos[0][$campos[$i]]) != '')
			{
				$e->addTemplate('bloque_proyectos_por_ficha_campos_previo');
				$e->setVariable('valor_campo',nl2br($proyectos[0][$campos[$i]]));
				$e->setVariable('lang_campo',$ControlHtml->ControlIdioma->valores['proyectos_'.$campos[$i]]);
			}
		}
		$campos = array('periodo','financiamiento','colaboradores');
		for($i=0; $i < count($campos); $i++)
		{
			if(trim($proyectos[0][$campos[$i]]) != '')
			{
				$e->addTemplate('bloque_proyectos_por_ficha_campos_posterior');
				$e->setVariable('valor_campo',nl2br($proyectos[0][$campos[$i]]));
				$e->setVariable('lang_campo',$ControlHtml->ControlIdioma->valores['proyectos_'.$campos[$i]]);
			}
		}  
		
		if(trim($proyectos[0]['tipo_proyecto']) != '')
		{ 	
			$e->addTemplate('bloque_proyectos_por_ficha_campos_tipo');
			$e = $ControlHtml->ControlIdioma->publicarTextoTemplate($e,$ControlHtml->langSite); 
			$e->setVariable('tipo_proyecto',$proyectos[0]['tipo_proyecto']);
		} 

    	if(trim($proyectos[0]['palabras_clave']) != '')
		{		
			$e->addTemplate('bloque_palabra_clave_general');
			$valores = $proyectos[0]['palabras_clave']; 
			$valor = explode(',',$valores); 						
			for ($i=0; $i<6; $i++)
			{
				if($valor[$i]!='')
				{
					$e->addTemplate('bloque_palabra_clave');
					$e->setVariable('page',$valoresGet["page"]);
					$e->setVariable('busca_flag','3');
					$e->setVariable('palabra',$valor[$i]);
				}										
			}	
		 } 	
	}
	else 
	{		 
		 /*-----------------Buscador ---------------*/	
		  //Funciones::mostrarArreglo($valores,true);		  					
		if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0) || ($valoresGet['page']=='view_proyectos_mejora') || (($valoresGet['id']=='')&&($valoresGet['page']=='view_proyectos')))
		{	
			if(!$valores and $valoresGet["busca_palabra"]!="") {
				$valores["busca_palabra"]=$valoresGet["busca_palabra"];
			}
			if($valoresGet["busca_palabra_clave"]!="") {
				$valores["busca_palabra_clave"]=$valoresGet["busca_palabra_clave"];
			}	
			if($valoresGet["busca_Autor"]!="") {
			 $valores["busca_Autor"]=$valoresGet["busca_Autor"];
			}
			if($valoresGet["busca_Autor_id"]!="") {
			 $valores["busca_Autor_id"]=$valoresGet["busca_Autor_id"];
			}
			if($valores["busqueda_flag"]=="") {
				$valores["busqueda_flag"]=$valoresGet["busqueda_flag"];
			}
		//	print_r($valores); 		
		   $tipoBusqueda	= $valores["busqueda_flag"];
           if($valores["busca_areaProyecto"]=="") {
              $ControlProyectos = new ControlProyectos();
           }else{			
		      $ControlProyectos = new ControlTipoAreaProyectos();
           }
            $val_buscar = array("Anno","simple|areaProyecto","Autor","word|palabra","simple|Autor_id","nameRange|rangoNombre");
            $val_qry_busca = array("pro.agno_inicio","id_area","apellido_paterno","palabras","pers.id_persona","apellido_paterno");
            $valoresBusqueda = array_combine($val_buscar, $val_qry_busca);
           	$valBusquedaPalabra = array("proy.proyecto","proy.antecedentes","proy.financiamiento"); 
               		   
			list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlProyectos, $tipoBusqueda,0,$valoresBusqueda,$valBusquedaPalabra);
						  
			foreach($valores as $var => $val)
			{   
				$e->addTemplate('bloque_asignacion_valores_formulario'); 
				$e->setVariable('variable',$var);
				$e->setVariable('valor',$val);
				$e->setVariable('titulo','Resultados B&uacute;squeda');			
			} 							
		} 		
		/*-----------------Fin Buscador---------------------*/
		$total = count($listado);
		if ($total < 2)
		{
			$valores["busqueda_flag"]="";
			$valoresGet["busca_Autor_id"]="";
		}
		if(is_array($listado) && $total > 0)
		{
			$ControlProyectosPersona = new ControlProyectosPersonas();
			$e->addTemplate('bloque_listado_proyectos_general');
			for($i=0; $i < $total; $i++)
			{ 			
				$autores2 = $ControlProyectosPersona->obtenerListadoPersonasDetalle($listado[$i]['id_proyecto']);

		
				$e->addTemplate($bloque_tipo.'bloque_listado_proyectos_busqueda'); 
				$e->setVariable('autores',$autores2);								
				$e->showDataSimple($listado[$i]);		 
			}
			
			if ($numPags<10)
			{
				$final=$numPags;	
			}					
			/*---------  Paginacion   ---------------------*/	
			$e->addTemplate('bloque_elemento_paginacion');				
			$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
			/*--------- Fin Paginacion   -----------------*/	
		} 					
		else
		{ 
		  if(VarSystem::getPathVariables('web_site')=="ciae_web2.0")
		  {
			if(!isset($valoresGet['case']))
			{
				/** DESCARGA DE LISTADO POR AREAS */
				$ControlTextos = new ControlTextos();
			  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']);    
			  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
			  	 
				$e->addTemplate('bloque_proyectos_por_defecto');
			  	$e->setVariable('descripcion',$texto_contenido); 
			  	
			 	$ControladorHTML  = new ControladorHTML();
			 	$datos = array('caso'=>'area','id'=>$areas[0]['id_area'],'template'=>$e,'despliegue_completo'=>false);
			  	$ControlAreas = new ControlAreas();
				$areas = $ControlAreas->obtenerListado();
				$total = count($areas);
				for($i=0; $i < $total; $i++)
				{
					$e->addTemplate('bloque_listado_areas');
					$datos['template'] = $e;
					$datos['id'] = $areas[$i]['id_area'];
					$datos['titulo_template'] = $areas[$i]['area'];
					$datos['template'] = $ControladorHTML->desplegarProyectos($datos); 
				}   
			}
			
			/** PROYECTOS DESTACADOS **/ 
			
			if($valoresGet['case']=="" && $valores["busqueda_flag"]=="")	
			{	
				$max_areas = '8';				  
				for($j=1; $j < $max_areas; $j++)
				{ 
					$condicion=" and seleccionado_area=".$j;
					$order = " Order by id_proyecto DESC ";
					$limite=" Limit 4";
					
					$listado= $ControlProyectos->obtenerListadoPorBusquedaPorArea("",$condicion,$order,$limite);
					$total = count($listado);
					if(is_array($listado) && $total > 0)
					{
						for($i=0; $i < $total; $i++)
						{ 
						$e->addTemplate('bloque_listado_proyectos_area'.$j);
						$e->setVariable('id_proyecto',$listado[$i]['id_proyecto']); 
						$e->setVariable('proyecto',$listado[$i]['proyecto']); 	
						
						$e->showDataSimple($listado[$i]);
						}
					}
				} 
			 }			
		 }
		 else 
		 { 
		 	
		 	// Funciones::mostrarArreglo($valoresGet,true); 
		 	if (($valoresGet['page']=='view_proyectos_investigacion'))
			{			 		
			  	$ControlTextos = new ControlTextos();
			  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']);  
				  
			  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];
	  			
				if ($valoresGet['linea']!='')
				{
					$e->addTemplate('bloque_proyectos_me_general');	
					$e->addTemplate('bloque_proyectos_'.$valoresGet['linea']);
					/*if ($valoresGet['linea']=='mejoramiento')
					{
						$e->addTemplate('bloque_proyectos_mejoramiento');
					}
					else 
						if($valoresGet['linea']=='preescolar')
						{
							$e->addTemplate('bloque_proyectos_preescolar');	
						}
					else
						if($valoresGet['linea']=='politicas')
						{
							$e->addTemplate('bloque_proyectos_politicas');
						}
					else 
						if($valoresGet['linea']=='investigacion')
						{
							$e->addTemplate('bloque_proyectos_investigacion');	
						}*/				
				}
				else
				{
				
					$e->addTemplate('bloque_proyectos_me');
				}
				  		
				    $listadoSitio = $ControlProyectos->obtenerListadoSitio();							
				    $total = count($listadoSitio);
					if(is_array($listadoSitio) && $total > 0)
					{
				    	for($i=0; $i < $total; $i++)//
						{				
				 			$e->addTemplate('bloque_listado_proyectos');
							 $e->setVariable('id_proyecto',$listadoSitio[$i]['id_proyecto']); 
							$e->setVariable('proyecto',$listadoSitio[$i]['proyecto']); 
							$e->showDataSimple($listadoSitio[$i]);
		  				}
		  			}
				}
				
				if (($valoresGet['page']=='view_proyectos_no_vigentes')){
					
				    $listadoNoVigentes = $ControlProyectos->obtenerListadoNoVigentes();							
				    $total = count($listadoNoVigentes);
					if(is_array($listadoNoVigentes) && $total > 0)
					{
						$ControlProyectosPersona = new ControlProyectosPersonas();
						$e->addTemplate('bloque_listado_proyectos_no_vigentes_general');
				    	for($i=0; $i < $total; $i++)
						{	
							$autores2 = $ControlProyectosPersona->obtenerListadoPersonasDetalle($listadoNoVigentes[$i]['id_proyecto']);			
				 			$e->addTemplate('bloque_listado_proyectos_no_vigentes');
				 			$e->setVariable('autores',$autores2);	
							$e->setVariable('id_proyecto',$listadoNoVigentes[$i]['id_proyecto']); 
							$e->setVariable('proyecto',$listadoNoVigentes[$i]['proyecto']); 
							$e->showDataSimple($listadoNoVigentes[$i]);
		  				}
		  			}
				}
			}
		}
	}	
		 

	$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'proyectos','3',$valoresGet["page"]); 
			
	echo $e->toHtml();
?>