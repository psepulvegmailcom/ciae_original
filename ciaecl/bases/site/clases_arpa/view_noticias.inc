<?php
/**/
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost();
	
	$path_admin				= VarSystem::getPathVariables('dir_template'); 
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);	
	
	if(!isset($valoresGet['id']))
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias.tpl');
		$e->setVariable('mt','mt-0');
		$e->setVariable('variableMenu','pt-0');
		$e->setVariable('mt','');
		$e->addTemplate('bloque_banner_vinculacion');	
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']); 
		$ControlNoticias->sinFiltroIdioma();
		
		$valores["busqueda_flag"] = 2;
		if (!$valores["pagina"]) {
			$valores["pagina"] = "";
		}

	 	switch($valoresGet['page'])
		{
			case 'view_eventos':
				if ($valores["seteaTipo"] != 1) {
					$valores["busca_tipo"] = "evento";
				}
			break;
			case 'view_actuales':
				if ($valores["seteaTipo"] != 1) {
					$valores["busca_tipo"] = "noticia";
				}
			break;
			case 'view_prensa':
				if ($valores["seteaTipo"]!=1) {
					$valores["buscador_tipo"] = "medios";
				}
			break;			
			case 'view_presentaciones':
				if ($valores["seteaTipo"] != 1) {
					$valores["busca_noticia_tipo"] = "presentaciones";
				}
			break;
			case 'view_investigaciones':
				if ($valores["seteaTipo"] != 1) {
					$valores["busca_investigaciones_ie"] = "1";
				}
			break;
			case 'view_videos':
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias_videos.tpl');
			break;
			case 'view_calendario':
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias_calendario.tpl');
			break;
			default:

				$valores["busqueda_flag"] = "";

				/** NOTICIAS HOME */
				if
				(
					$valores["seteaTipo"] != 1 &&
					$valoresGet["busca_palabra"] == "" &&
					$valoresGet['page'] != "view_investigacion" &&
					$valoresGet['page'] == "view_vinculacion"
				) 
				{

					$ControlNoticias = new ControlNoticias(); 
					$ControlBanner = new ControlBanner();
					$e->showBlock('bloque_banner_home',$banner); 
					$elementos = $ControlNoticias->obtenerNoticiasHomeVinc();
					if(is_array($elementos) && count($elementos) > 0)
					{
						$e->addTemplate('bloque_home_noticia_general');   
							
						$max_noticias = count($elementos);
						for($i=0; $i <  $max_noticias;$i++)
						{
							if($i == 0) {
								$e->addTemplate('bloque_home_noticia_last');	
							} else {
								$e->addTemplate('bloque_home_noticia');
							}
							if(trim($elementos[$i]['imagen']) == '') {
								$elementos[$i]['imagen'] = 'blanco.jpg';
							}
							$elementos[$i]['fecha_html_full'] = ControladorFechas::traducirMes(
								$elementos[$i]['fecha'],'en-es'
							);
							$e->showDataSimple($elementos[$i]);
						}
					}

					if(VarSystem::obtenerIdiomaActual() == 'es')
					{
						/** EN LA PRENSA */
						$ControlNoticiasPrensa = new ControlNoticiasPrensa(); 
						$elementos = $ControlNoticiasPrensa->obtenerListadoPrensaSitio();
						if(is_array($elementos) && count($elementos) > 0)
						{ 
							$bloque_caso = 'bloque_home_prensa_der';
							if($max_noticias > VarSystem::getTotalListarNoticiasCambio()) {
								$bloque_caso = 'bloque_home_prensa_izq';
							}
							$bloque_caso = 'bloque_home_prensa_der';
							$e->addTemplate($bloque_caso);
							$max = 4;
							if($max > count($elementos)) {
								$max = count($elementos);
							}
							for($i = 0; $i <  $max; $i++) {
								$elementos[$i]['url'] = str_replace(';', '', $elementos[$i]['url']); 
								$e->addTemplate($bloque_caso.'_detalle'); 
								$elementos[$i]['fecha_html_full'] = ControladorFechas::traducirMes(
									$elementos[$i]['fecha'],
									'en-es'
								); 
								$elementos[$i]['titulo_web'] = $elementos[$i]['titulo'];
								$e->showDataSimple($elementos[$i]);
							}
						}
						
						
						/** PRESENTACIONES */
						$elementosP = $ControlNoticias->obtenerListadoPresentacionSitio();
						if(is_array($elementosP) && count($elementosP) > 0) {
							$e->addTemplate('bloque_home_presentacion_general');   
							$max_noticias = count($elementosP);
							for($i = 0; $i < $max_noticias; $i++)
							{
								$e->addTemplate('bloque_home_presentacion');						
								if(trim($elementosP[$i]['imagen']) == '') {
									$elementosP[$i]['imagen'] = 'blanco.jpg';
								}
								$elementosP[$i]['fecha_html_full']  = ControladorFechas::traducirMes(
									$elementosP[$i]['fecha'],
									'en-es'
								);
								$e->showDataSimple($elementosP[$i]);
							}
						}
					}

					if ($valoresGet['page'] == "view_detpostgrados") {
						$e->addTemplate('bloque_elemento_lateral_postgrados_abajo');	
						$e->addTemplate('bloque_elemento_lateral_postgrados');				
					} else{
						$e->addTemplate('bloque_elemento_lateral_noticia');	
					};                  
							
					if(VarSystem::obtenerIdiomaActual() == 'es') {
						/** BOLETIN HOME */
						$ControlBoletines = new ControlBoletines(); 
						$elementos = $ControlBoletines->obtenerUltimoBoletin();

						$bloque_caso = 'bloque_home_boletin_der'; 
						$e->addTemplate($bloque_caso.'_detalle');  
						$elementos[0]['agno'] = 	$elementos[0]['agno'];
						$elementos[0]['mes']  = ControladorFechas::entregarMes($elementos[0]['mes'] ,$ControlHtml->langSite);
						$elementos[0]['archivo'] = 	$elementos[0]['archivo'];
						$e->showDataSimple($elementos[0]);	

						/** BOLETIN FOCO */
						$ControlBoletinesFoco = new ControlBoletinesFoco(); 
						$elementosFoco = $ControlBoletinesFoco->obtenerUltimoBoletin();

						$bloque_caso = 'bloque_home_boletin_foco'; 
						$e->addTemplate($bloque_caso.'_detalle');  
						$elementosFoco[0]['agno'] = 	$elementosFoco[0]['agno'];
						$elementosFoco[0]['titulo'] = 	$elementosFoco[0]['titulo'];
						$elementosFoco[0]['mes']  = ControladorFechas::entregarMes($elementosFoco[0]['mes'] ,$ControlHtml->langSite);
						$elementosFoco[0]['archivo'] = 	$elementosFoco[0]['archivo'];
						$e->showDataSimple($elementosFoco[0]);	
								
						/** ESPECIALES INFORMATIVOS */
						$ControlBoletinesEspeciales = new ControlBoletinesEspeciales(); 
						$elementosEspeciales = $ControlBoletinesEspeciales->obtenerUltimoBoletin();

						$bloque_caso = 'bloque_home_boletin_informativo'; 
						$e->addTemplate($bloque_caso.'_detalle');  
						$elementosEspeciales[0]['agno'] = 	$elementosEspeciales[0]['agno'];
						$elementosEspeciales[0]['titulo'] = 	$elementosEspeciales[0]['titulo'];
						$elementosEspeciales[0]['mes_html']  = ControladorFechas::entregarMes($elementosEspeciales[0]['mes'] ,$ControlHtml->langSite);
						$e->showDataSimple($elementosEspeciales[0]);	
							
					}            					
				}				
			break;
		}   	
           

		/*-----------------BUSCADOR ---------------*/
		if (($valores["busqueda_flag"] > 0) || ($valoresGet["busqueda_flag"] > 0))
		{	
			if(!$valores and $valoresGet["busca_palabra"] != "") {
				$valores["busca_palabra"] = $valoresGet["busca_palabra"];
			}				
			if(!$valores and $valoresGet["busca_Autor"] != "") {
				 $valores["busca_Autor"] = $valoresGet["busca_Autor"];
			}				 
			if($valores["busqueda_flag"] == "") {
				$valores["busqueda_flag"] = $valoresGet["busqueda_flag"];
			}
			$tipoBusqueda = $valores["busqueda_flag"];
			if($valores["buscador_tipo"] == "medios")
			{
			   $ControlNoticias = new ControlNoticiaPrensaSitio();
			}
			else
			{
			   if($valores["buscador_tipo"] == "noticia" || $valores["buscador_tipo"] == "evento")
			   {
			        $valores["busca_tipo"] = $valores["buscador_tipo"];
		   			$ControlNoticias = new ControlNoticias();
			   }
			} 
            
            $val_buscar = array(
				"Anno",
				"simple|mes",
				"simple|Autor_id",
				"tipo",
				"trabajo",
				"noticia_tipo",
				"investigaciones_ie",
				"word|palabra"
			);
            $val_qry_busca = array(
				"year(noti.fecha)",
				"month (noti.fecha)",
				"id_persona",
				"noti.tipo",
				"trabajo",
				"noti.noticia_tipo",
				"noti.investigaciones_ie",
				"palabra"
			);
            $valoresBusqueda = array_combine($val_buscar, $val_qry_busca);
            $valBusquedaPalabra = array("titulo", "bajada");         
			list(
				$listado,
				$inicio,
				$final,
				$numPags
			) = $ControlHtml->MantenedoresGeneral->buscardorGeneral(
				$valores,
				$ControlNoticias,
				$tipoBusqueda,
				0,
				$valoresBusqueda,
				$valBusquedaPalabra
			);						  	 
			foreach($valores as $var => $val) {   
				$e->addTemplate('bloque_asignacion_valores_formulario');
				$e->setVariable('variable', $var);
				$e->setVariable('valor', $val);		
			} 							
		}  
       
		/*-----------------FIN BUSCADOR---------------------*/
		$total = count($listado);

		if(is_array($listado) && $total > 0)
		{
		    if (
				($valoresGet['page'] != 'view_prensa') &&
				($valoresGet['page'] != 'view_eventos') &&
				($valores["buscador_tipo"] != "medios")
			) {
				$e->addTemplate('bloque_elemento_general');	
				$e->showBlock('bloque_elemento', $listado);
			}
			if ($valores["buscador_tipo"] == "medios")
			{
				$e->addTemplate('bloque_elemento_prensa_general');	
				$e->showBlock('bloque_elemento_prensa', $listado); 
			}

			if($valoresGet['page'] == 'view_eventos') {
				$e->addTemplate('bloque_elemento_eventos_general');	
				for($i = 0; $i < $total; $i++)
				{ 	
					$dia[$i] = date('d', strtotime($listado[$i]['fecha']));
					$mes[$i] = date('F', strtotime($listado[$i]['fecha']));
					$agno[$i] = date('Y', strtotime($listado[$i]['fecha']));	 
					$listado[$i]['mesE']= 
					ControladorFechas::entregarMesAbr($mes[$i],'en-es'); 
					$listado[$i]['diaE']= 
					ControladorFechas::entregarDia($dia[$i],'en-es');
					$listado[$i]['agnoE'] = $agno[$i];
					$e->addTemplate('bloque_elemento_eventos');					
					$e->showDataSimple($listado[$i]);
				}
			}

			/*---------  Paginación   ---------------------*/	
			$e->addTemplate('bloque_elemento_paginacion');				
			$e->setVariable(
				'enlacePie',
				$ControlHtml->FormGeneral->paginamientoListado(
					$pagina,
					$inicio,
					$final,
					$numPags
				)
			);

			/*--------- Fin Paginación   -----------------*/ 
			if ($valoresGet['page'] == "view_detpostgrados") {
				$e->addTemplate('bloque_elemento_lateral_postgrados_abajo');	
				$e->addTemplate('bloque_elemento_lateral_postgrados');				
			} else {
				$e->addTemplate('bloque_elemento_lateral_noticia');	
			}
		}
		else
		{		 
			if (($valores["busqueda_flag"] > 0) || ($valoresGet["busqueda_flag"] > 0)) {
				$e->addTemplate('bloque_no_elemento');
				$e->setVariable(
					'langSite_general_no_hay_elementos',
					'No se encontraron elementos'
				);
			}		
		}	 
	}
	else
	{ 

		/** MOSTRAR ELEMENTOS */
		$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);

		/*FUNCIONALIDAD QUE MUESTRA LA VISTA DENTRO DE LOS DIPLOMADOS, MAGISTER*/
		if ($elemento[0]['tipo_curso'] == "diplomado" || $elemento[0]['tipo_curso'] == "magister")	{
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias_postgrado.tpl');
		} else {
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias_ficha.tpl');
		}

		if ($elemento[0]['tipo_curso'] == "magister") {
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias_magister.tpl');
		}

		/*vista de prueba*/
		if ($elemento[0]['tipo_curso'] == "magister-prueba") {
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias/noticias_magister_prueba.tpl');
		}
		$e->setVariable('url_site', VarConfig::path_site_www);
		$e->setVariable('url_site_encode', Funciones::cleanCharURL(VarConfig::path_site_www));
		$e->setVariable('url_encode', Funciones::cleanCharURL('&')); 
		$e->setVariable('page', $valoresGet["page"]);
		$e->setVariable('busca_flag', '2');
		$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);
		if(is_array($elemento) && count($elemento) > 0) { 
			$ControlHtml->laPagina->setTitleSite($elemento[0]['titulo']);
			$ControlHtml->laPagina->setDescriptionSite($elemento[0]['bajada']);
			$ControlHtml->laPagina->setImagenFondo('imageview.php?image=noticias/'.$elemento[0]['imagen']);
			$elemento[0]['titulo'] = Funciones::limpiarSaltoLinea($elemento[0]['titulo']);
			$elemento[0]['fecha_html_full'] = ControladorFechas::traducirMes($elemento[0]['fecha_html_full'],'en-es');
			
			$e->setVariable('title_encode',Funciones::cleanCharURL($elemento[0]['titulo']." :: ".VarConfig::site_title));
			$e->setVariable('titulo_encode' ,Funciones::cleanCharURL($elemento[0]['titulo'])); //." :: ".VarConfig::site_title));
			$e->setVariable('bajada_encode' ,Funciones::cleanCharURL($elemento[0]['bajada']));
			$e->setVariable('imagen_decode',Funciones::cleanCharURL($elemento[0]['imagen']));							
			$elemento[0]['descriptor'] = Funciones::cortar_palabras($elemento[0]['bajada']);
										
			$e->showDataSimple($elemento[0]);

			if(trim($elemento[0]['bajada']) != '')
			{
				$e->addTemplate('bloque_elemento_bajada');
				$e->showDataSimple($elemento[0]);				
			}

			if(trim($elemento[0]['url']) != '' )
			{
				$e->addTemplate('bloque_elemento_principal');
			}			
			if(trim($elemento[0]['url']) != '')
			{
				$e->addTemplate('bloque_elemento_principal');
				$e->addTemplate('bloque_elemento_url');
				$e->showDataSimple($elemento[0]);	
			}


			/*habilitar boton para inscripcion del magister, adem&Aacute;s de a&ntilde;adir titulo din&Aacute;mico seg&uacute;n el id*/
			if($elemento[0]['id_noticia'] == '2106' || $elemento[0]['id_noticia'] == '2108' || $elemento[0]['id_noticia'] == '2360')
			{ 
					$texto_postulacion = 'Postulaciones cerradas';
				 	

				$elemento[0] = array_merge($elemento[0], array('titulo_postulacion' => $texto_postulacion));
				$e->addTemplate('bloque_elemento_titulo');
				$e->setVariable('titulo_postulacion',$texto_postulacion);
				 
					$e->addTemplate('bloque_elemento_postulacion');
					$e->setVariable('inscripcion_evento',$elemento[0]['inscripcion_evento']);
				 
			}
			else
			{ 
				$elemento[0] = array_merge($elemento[0], array('titulo_postulacion' => 'POSTULACIONES PROXIMAMENTE'));
				$e->addTemplate('bloque_elemento_titulo');
				$e->setVariable('titulo_postulacion','POSTULACIONES PROXIMAMENTE');
				 
			}


			if(trim($elemento[0]['imagen']) != '' || trim($elemento[0]['imagen2']) != '' || trim($elemento[0]['imagen3']) != '')
			{
				$e->addTemplate('bloque_elemento_imagen');
				for($k=1; $k < 2; $k++)
				{
					$aux = $k;
					if($aux == 1)
					{
						$aux = '';
					}
					if(trim($elemento[0]['imagen'.$aux]) != '')
					{ 
						$e->addTemplate('bloque_elemento_imagen_detalle');
						if(trim($elemento[0]['imagen'.$aux.'_bajada']) != '')
						{
						 $elemento[0]['imagen'.$aux.'_bajada'] = nl2br("\n\n".strip_tags($elemento[0]['imagen'.$aux.'_bajada'])); 
						} 
						$e->setVariable('imagen_bajada',$elemento[0]['imagen'.$aux.'_bajada']);
						$e->setVariable('imagen',$elemento[0]['imagen'.$aux]);
					}
				}				
			}

			$ControlNoticiasPersona = new ControlNoticiasPersona();
			$ControlPersonaObjeto = new ControlPersonaObjeto();
			$personas = $ControlNoticiasPersona->obtenerPersonas($valoresGet['id']);
			$total = count($personas);

			if(is_array($personas) && $total > 0)
			{				
				  $e->addTemplate('bloque_elemento_personas');

					for($i=0; $i <  $total; $i++)
					{
						$e->addTemplate('bloque_personas');
						if(trim($personas[$i]['imagen']) == '')
						{
							$personas[$i]['imagen'] = 'blanco.jpg';
						}
						$personasSitio = $ControlPersonaObjeto->obtenerDatosIdIE($personas[$i]['id_persona']);
						if($personasSitio[0]['id_site']=='6'){
							$personas[$i]['urlIE'] = 'ie'; 
						}
						else{
							$personas[$i]['urlIE'] ='ciae';
						}
							
						$e->showDataSimple($personas[$i]);
					}
						
			}

			$ControlNoticiasProfesor = new ControlNoticiasProfesor();
			$ControlProfesorObjeto = new ControlProfesorObjeto();
			$profesores = $ControlNoticiasProfesor->obtenerProfesores($valoresGet['id']);
			$total = count($profesores);

			if(is_array($profesores) && $total > 0)
			{				
				  $e->addTemplate('bloque_elemento_profesores');

					for($i=0; $i <  $total; $i++)
					{
						$e->addTemplate('bloque_profesores');
						if(trim($profesores[$i]['imagen']) == '')
						{
							$profesores[$i]['imagen'] = 'blanco.jpg';
						}
						
						$personasSitio = $ControlProfesorObjeto->obtenerDatosIdIE($profesores[$i]['id_persona']);
						if($personasSitio[0]['id_site']=='6'){
							$profesores[$i]['urlIE'] = 'ie'; 
						}
						else{
							$profesores[$i]['urlIE'] ='ciae';
						}
							
						$e->showDataSimple($profesores[$i]);
					}
			}

			$ControlNoticiasProfesorAcademico = new ControlNoticiasProfesorAcademico();
			$ControlProfesorAcademicoObjeto = new ControlProfesorAcademicoObjeto();
			$profesoresA = $ControlNoticiasProfesorAcademico->obtenerProfesoresAcademico($valoresGet['id']);
			$total = count($profesoresA);

			if(is_array($profesoresA) && $total > 0)
			{				
				  $e->addTemplate('bloque_elemento_academicos');

					for($i=0; $i <  $total; $i++)
					{
						$e->addTemplate('bloque_academicos');
						if(trim($profesoresA[$i]['imagen']) == '')
						{
							$profesoresA[$i]['imagen'] = 'blanco.jpg';
						}
						
						$personasSitio = $ControlProfesorAcademicoObjeto->obtenerDatosIdIE($profesoresA[$i]['id_persona']);
						if($personasSitio[0]['id_site']=='6'){
							$profesoresA[$i]['urlIE'] = 'ie'; 
						}
						else{
							$profesoresA[$i]['urlIE'] ='ciae';
						}
							
						$e->showDataSimple($profesoresA[$i]);
					}
			}

			$ControlNoticiasProfesorVisitante = new ControlNoticiasProfesorVisitante();
			$ControlProfesorVisitanteObjeto = new ControlProfesorVisitanteObjeto();
			$profesoresV = $ControlNoticiasProfesorVisitante->obtenerProfesores($valoresGet['id']);
			$total = count($profesoresV);

			if(is_array($profesoresV) && $total > 0)
			{				
				  $e->addTemplate('bloque_elemento_visitantes');

					for($i=0; $i <  $total; $i++)
					{
						$e->addTemplate('bloque_visitantes');
						if(trim($profesoresV[$i]['imagen']) == '')
						{
							$profesoresV[$i]['imagen'] = 'blanco.jpg';
						}
						
						$personasSitio = $ControlProfesorVisitanteObjeto->obtenerDatosIdIE($profesoresV[$i]['id_persona']);
						if($personasSitio[0]['id_site']=='6'){
							$profesoresV[$i]['urlIE'] = 'ie'; 
						}
						else{
							$profesoresV[$i]['urlIE'] ='ciae';
						}
							
						$e->showDataSimple($profesoresV[$i]);
					}
			}

			$ControlNoticiasLink = new ControlNoticiasLink();
			$link = $ControlNoticiasLink->obtenerLinks($valoresGet['id']);
			$total = count($link);
			//Funciones::mostrarArreglo($link);
			if(is_array($link) && $total > 0)
			{	
				$e->addTemplate('bloque_elemento_principal');			
				for($k=0; $k < $total; $k++)
				{  
					$aux 	=  str_replace('http:','',trim($link[$k]['link']));
					$aux2 	=  str_replace('https:','',trim($link[$k]['link'])); 
					if($aux == trim($link[$k]['link']) && $aux2 == trim($link[$k]['link']))
					{
						$link[$k]['tipo'] = 'doc'; 
					} 
				
					if ($link[$k]['tipo']=='url'){
					$link_ciae = substr($link[$k]['link'], 0, 25);
					 if ($link_ciae=='http://www.ciae.uchile.cl' &&  ereg('view_inscripcion', $link[$k]['link']) && $link[$k]['id_noticia'] > '1300'){
						$link_generico= substr($link[$k]['link'], 25);
						$link[$k]['link_ie']='http://www.ie.uchile.cl'.$link_generico;
					}	else{
						 $link[$k]['link_ie']=	$link[$k]['link'];
						}										
					}
					
					$e->addTemplate('bloque_elemento_'.$link[$k]['tipo']);
					$e->showDataSimple($link[$k]);
				} 								
			} 
			
			if($elemento[0]['tiene_galeria'] == 1)
			{				 
				$imagenes = (array) json_decode(file_get_contents(VarSystem::getPathVariables('dir_doc_public')."imagegaleria.php?id=".$valoresGet['id']));
				 
				if(is_array($imagenes) && count($imagenes)>0)
				{
					$listar_fila = VarSystem::getTotalListarGaleria();
					$por_fila = 0;
					$e->addTemplate('bloque_elemento_galeria');
					foreach($imagenes as $var => $val)
					{						
						if(trim($var) == '.svn' || trim($var) == 'index.php' || trim($var) == 'Thumbs.db')
						{
							continue;
						}
						$e->addTemplate('bloque_elemento_galeria_td');
						$e->setVariable('imagen',$var);
						$e->setVariable('id',$valoresGet['id']);
					}
				} 
			}
			
			if ($valoresGet['page']=="view_detpostgrados"){
			    $e->addTemplate('bloque_elemento_lateral_postgrados_abajo');	
				$e->addTemplate('bloque_elemento_lateral_postgrados');
				$e->setVariable('encargado',$elemento[0]['contacto_evento']);
					if($elemento[0]['organizadores_evento']!=''){
					$e->setVariable('organizadores_evento',$elemento[0]['organizadores_evento']);
					}else{
					$e->setVariable('organizadores_evento','postgrado@ie.uchile.cl');
					}
					if($elemento[0]['certificado_evento']!=''){
						$e->addTemplate('bloque_elemento_lateral_brochure');
						$e->setVariable('certificado_evento',$elemento[0]['certificado_evento']);
					}

					/*funcion provisoria para visualizar el boton quiero saber mas en magister*/
					if($elemento[0]['tipo_curso']=="magister" || $elemento[0]['tipo_curso']=="magister-prueba"){
						$link_saber_mas = 'index.php?langSite=es&page=view_inscripcion_2021_interesados_magister';
						$e->addTemplate('bloque_elemento_lateral_sabermas');
						$e->setVariable('link_saber_mas',$link_saber_mas);
						$e->addTemplate('bloque_elemento_lateral_comite_academico');
						$e->setVariable('noticia_id', $valoresGet['id']);
					}
			}
			else{
				$e->addTemplate('bloque_elemento_lateral_noticia');	
			};
			
			
			if($elemento[0]['palabra_clave'] != '')
			{
			//	echo "valoresGet".$valoresGet["page"];
				$e->addTemplate('bloque_palabra_clave_general');
				$valores = $elemento[0]['palabra_clave']; 
				$valor = explode(',',$valores); 						
				for ($i=0; $i<6; $i++)
				{
					if($valor[$i]!='')
					{
						$e->addTemplate('bloque_palabra_clave');
						$e->setVariable('page',$valoresGet["page"]);
						$e->setVariable('busca_flag','2');
						$e->setVariable('palabra',$valor[$i]);
					}										
				}						
			} 
			
			$elementos = $ControlNoticias->obtenerNoticiasRecientes();           
			if(is_array($elementos) && count($elementos)>0)
			{
				$e->addTemplate('bloque_noticia_reciente');   				
				$max_noticias = count($elementos);
				for($i=0; $i <  $max_noticias;$i++)
				{
					$e->addTemplate('bloque_noticia');
					if(trim($elementos[$i]['imagen']) == '')
					{
						$elementos[$i]['imagen'] = 'blanco.jpg';
					}
					$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
					$e->showDataSimple($elementos[$i]);
				}
			} 
			
			/** SE GUARDA LA VISITA */
							
			$ControladorNoticiasVisitas = new ControladorNoticiasVisitas();
			$ControladorNoticiasVisitas->registrarVisitaNoticias($valoresGet['id'],$valoresGet['externo']);
			 
			
			
			 
					
				 
			 
		} 
		else
		{
			$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'404.tpl'); 
		} 
	} 
	
	 
	 /* VIDEOS YOUTUBE */
	 $e = $ControlGeneralSitios->mostrarVideosRecursos($e);	 /* el id tipo es propio del sitio */

	$e = $ControlGeneralSitios->mostrarGifInformativoCIAE($e);							
						
	/** EVENTOS NOTICIAS */ 
	$ControlNoticias = new ControlNoticias();
	$elementos = $ControlNoticias->obtenerEventosHomeIE('ASC');
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
		$e->addTemplate('s');
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2'); 
		//$e->addTemplate('bloque_home_eventos_general');
		$max = count($elementos);
		for($i=0; $i <  $max;$i++)
		{
		  $e->addTemplate('bloque_home_eventos');
          $elementos[$i]['fecha_completa']= 
		  ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es'); 	
		  $elementos[$i]['mes']= 
		  ControladorFechas::entregarMesAbrev($elementos[$i]['fecha_html_full'],'en-es'); 
		  $elementos[$i]['dia']= 
		  ControladorFechas::entregarDia($elementos[$i]['fecha_html_full']);
		  $e->showDataSimple($elementos[$i]);
		}
	}	
						
	if(VarSystem::obtenerIdiomaActual() == 'es')
	{
		/** PUBLICACIONES HOME */ 
		$ControlPublicaciones = new ControlPublicaciones();
		$ControlPublicacionesPersona = new ControlPublicacionesPersona();
		
		$elementos = $ControlPublicaciones->obtenerListadoHome();
		// Funciones::mostrarArreglo($elementos,true);
		if(is_array($elementos) && count($elementos)>0)
		{
			$e->addTemplate('bloque_home_publicaciones_general');
			$max = VarSystem::getTotalListarHome();
			if(count($elementos) < $max)
			{
				$max = count($elementos);
			}
			for($i=0; $i < $max;$i++)
			{
				$e->addTemplate('bloque_home_publicaciones'); 
				$e->showDataSimple($elementos[$i]);
	
				$autores = $ControlPublicacionesPersona->obtenerListadoPersonas($elementos[$i]['id_publicaciones']);
				$e->setVariable('autores',$autores);
				
				if(trim($elementos[$i]['documento']) != '')
				{
					$e->addTemplate('bloque_home_publicaciones_bloque_elemento_documento');
					$e->showDataSimple($elementos[$i]);
				}
				if(trim($elementos[$i]['link']) != '')
				{
					$e->addTemplate('bloque_home_publicaciones_bloque_elemento_link');
					$e->showDataSimple($elementos[$i]);
				}  			
			}
		}
	}
		
        
	$elementos = $ControlNoticias->obtenerNoticiasDestacadaForzada();          
	if(is_array($elementos) && count($elementos)>0)
	{
		$e->addTemplate('bloque_noticia_visitada');   				
		$max_noticias = count($elementos);
		for($i=0; $i <  $max_noticias;$i++)
		{
			$e->addTemplate('bloque_visitada');
			if(trim($elementos[$i]['imagen']) == '')
			{
				$elementos[$i]['imagen'] = 'blanco.jpg';
			}
			$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
			$e->showDataSimple($elementos[$i]);
		}
	} 
        
        
        
	$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'noticias','2',$valoresGet["page"]); 
	
	 	
		

	echo $e->toHtml();
?>