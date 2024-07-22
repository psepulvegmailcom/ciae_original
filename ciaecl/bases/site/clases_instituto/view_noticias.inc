<?php
/**/
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet();
	$valores = VarSystem::getPost();

	$path_admin = VarSystem::getPathVariables('dir_template');
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);

	if(!isset($valoresGet['id']))
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias.tpl');
		$e->setVariable('variableMenu', 'pt-0');
		$e->setVariable('mt', '');
		$e->addTemplate('bloque_banner_vinculacion');
		$e->setVariable('page', $valoresGet["page"]);
		$e->setVariable('busca_flag', '2');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']);
		$ControlNoticias->sinFiltroIdioma();

	 	switch($valoresGet['page'])
		{
			case 'view_eventos':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1)
					$valores["busca_tipo"]="evento";
				if (!$valores["pagina"])
					$valores["pagina"]="";
			break;
			case 'view_actuales':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1)
					$valores["busca_tipo"]="noticia";
				if (!$valores["pagina"])
					$valores["pagina"]="";
			break;
				case 'view_prensa':
			 		$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1)
					$valores["buscador_tipo"]="medios";
				if (!$valores["pagina"])
					$valores["pagina"]="";
			break;
				case 'view_presentaciones':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1)
					$valores["busca_noticia_tipo"]="presentaciones";
				if (!$valores["pagina"])
					$valores["pagina"]="";
			break;
				case 'view_investigaciones':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1)
					$valores["busca_investigaciones_ie"]="1";
				if (!$valores["pagina"])
					$valores["pagina"]="";
			break;
			default:
				/** NOTICIAS HOME */
				if ($valores["seteaTipo"]!=1 && $valoresGet["busca_palabra"]=="" && $valoresGet['page']!="view_investigacion" && $valoresGet['page']=="view_vinculacion")
				{
					$ControlNoticias = new ControlNoticias();

					$ControlBanner = new ControlBanner();
					//$banner = $ControlBanner->obtenerBannerActivo($idioma);
					$e->showBlock('bloque_banner_home',$banner);

					$elementos = $ControlNoticias->obtenerNoticiasHomeVinc();
					if(is_array($elementos) && count($elementos)>0)
					{
						$e->addTemplate('bloque_home_noticia_general');

						$max_noticias = count($elementos);
						for($i=0; $i <  $max_noticias;$i++)
						{
							if($i==0)
							{
								$e->addTemplate('bloque_home_noticia_last');
							}
							else
							{
								$e->addTemplate('bloque_home_noticia');
							}
							if(trim($elementos[$i]['imagen']) == '')
							{
								$elementos[$i]['imagen'] = 'blanco.jpg';
							}
							$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
							$e->showDataSimple($elementos[$i]);
						}
					}

					if(VarSystem::obtenerIdiomaActual() == 'es')
					{
						/** EN LA PRENSA */
						$ControlNoticiasPrensa = new ControlNoticiasPrensa();
						$elementos = $ControlNoticiasPrensa->obtenerListadoPrensaSitio();
						if(is_array($elementos) && count($elementos)>0)
						{
							$bloque_caso = 'bloque_home_prensa_der';
							if($max_noticias > VarSystem::getTotalListarNoticiasCambio())
							// || $max_eventos > VarSystem::getTotalListarNoticiasCambio())
							{
								$bloque_caso = 'bloque_home_prensa_izq';
							}
							$bloque_caso = 'bloque_home_prensa_der';
							$e->addTemplate($bloque_caso);
							//$max = VarSystem::getTotalListarHome();
							$max = 4;
							if($max > count($elementos))
							{
								$max = count($elementos);
							}
							for($i=0; $i <  $max;$i++)
							{
								$elementos[$i]['url'] = str_replace(';','',$elementos[$i]['url']);
								// Funciones::mostrarArreglo($elementos[$i],true);
								$e->addTemplate($bloque_caso.'_detalle');
								$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
								$elementos[$i]['titulo_web'] = 	$elementos[$i]['titulo'];
								$e->showDataSimple($elementos[$i]);
							}
						}
						/** PRESENTACIONES */
						$elementosP = $ControlNoticias->obtenerListadoPresentacionSitio();
						if(is_array($elementosP) && count($elementosP)>0)
						{
							$e->addTemplate('bloque_home_presentacion_general');
							$max_noticias = count($elementosP);
							for($i=0; $i <  $max_noticias;$i++)
							{
								$e->addTemplate('bloque_home_presentacion');
								if(trim($elementosP[$i]['imagen']) == '')
								{
									$elementosP[$i]['imagen'] = 'blanco.jpg';
								}
								$elementosP[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementosP[$i]['fecha'],'en-es');
								$e->showDataSimple($elementosP[$i]);
							}
						}
					}
					if ($valoresGet['page'] == "view_detpostgrados")
					{
						$e->addTemplate('bloque_elemento_lateral_postgrados_abajo');
						$e->addTemplate('bloque_elemento_lateral_postgrados');
					}
					else
					{
						$e->addTemplate('bloque_elemento_lateral_noticia');
					}

					if(VarSystem::obtenerIdiomaActual() == 'es')
					{
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

		if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
		{
			if(!$valores and $valoresGet["busca_palabra"] != "")
				$valores["busca_palabra"] = $valoresGet["busca_palabra"];
			if(!$valores and $valoresGet["busca_Autor"] != "")
				 $valores["busca_Autor"]=$valoresGet["busca_Autor"];
			if($valores["busqueda_flag"]=="")
				$valores["busqueda_flag"]=$valoresGet["busqueda_flag"];

			$tipoBusqueda = $valores["busqueda_flag"];
			if($valores["buscador_tipo"] == "medios")
			{
			   $ControlNoticias = new ControlNoticiaPrensaSitio();
			}
			else
			{
			   if($valores["buscador_tipo"]=="noticia" || $valores["buscador_tipo"]=="evento")
			   {
			        $valores["busca_tipo"]=$valores["buscador_tipo"];
		   			$ControlNoticias = new ControlNoticias();
			   }
			}

            $val_buscar = array("Anno","simple|mes","simple|Autor_id","tipo","trabajo","noticia_tipo","investigaciones_ie","word|palabra");
            $val_qry_busca = array("year(noti.fecha)","month (noti.fecha)","id_persona","noti.tipo","trabajo","noti.noticia_tipo","noti.investigaciones_ie","palabra");
            $valoresBusqueda = array_combine($val_buscar, $val_qry_busca);
            $valBusquedaPalabra = array("titulo","bajada");
			list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlNoticias, $tipoBusqueda,0,$valoresBusqueda,$valBusquedaPalabra);
			foreach($valores as $var => $val)
			{
				$e->addTemplate('bloque_asignacion_valores_formulario');
				$e->setVariable('variable',$var);
				$e->setVariable('valor',$val);
			}
		}

		/*-----------------FIN BUSCADOR---------------------*/

		$total = count($listado);

		if(is_array($listado) && $total > 0)
		{
		    if (($valoresGet['page']!='view_prensa')&&($valoresGet['page']!='view_eventos')&& $valores["buscador_tipo"]!="medios" ){
				$e->addTemplate('bloque_elemento_general');
				$e->showBlock('bloque_elemento',$listado);
			}
			if ($valores["buscador_tipo"]=="medios")
			{
				$e->addTemplate('bloque_elemento_prensa_general');
				$e->showBlock('bloque_elemento_prensa',$listado);
			}

			if($valoresGet['page']=='view_eventos')
			{
				$e->addTemplate('bloque_elemento_eventos_general');
				for($i=0; $i < $total; $i++)
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

			/*---------  Paginaci&oacute;n   ---------------------*/

			$e->addTemplate('bloque_elemento_paginacion');
			$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));

			/*--------- Fin Paginaci&oacute;n   -----------------*/

			if ($valoresGet['page']=="view_detpostgrados"){
				$e->addTemplate('bloque_elemento_lateral_postgrados_abajo');
				$e->addTemplate('bloque_elemento_lateral_postgrados');
			}
			else
			{
				$e->addTemplate('bloque_elemento_lateral_noticia');
			};
		}
		else
		{
			if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
			{
				$e->addTemplate('bloque_no_elemento');
				$e->setVariable('langSite_general_no_hay_elementos','No se encontraron elementos');
			}
		}
	}
	else
	{

		$_id = $valoresGet['id'];

		/** MOSTRAR ELEMENTOS */
		$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);
		$elemento_actual = $ControlNoticias->obtenerElemento($valoresGet['id']);

		/*FUNCIONALIDAD QUE MUESTRA LA VISTA DENTRO DE LOS DIPLOMADOS, MAGISTER, DOCTORADO*/
		if ($elemento[0]['tipo_curso']=="diplomado" || $elemento[0]['tipo_curso']=="magister" || $elemento[0]['tipo_curso']=="doctorado")
		{
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_postgrado.tpl');
		}
		else
		{
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_ficha.tpl');
		}

		if ($elemento[0]['tipo_curso']=="magister" && $elemento[0]['id_noticia'] == 2311)
		{
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_magister.tpl');
		}

		if ($elemento[0]['tipo_curso']=="magister" && $elemento[0]['id_noticia'] == 2605)
		{
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_magister_indagacion.tpl');
		}

		$e->setVariable('url_site', VarConfig::path_site_www);
		$e->setVariable('url_site_encode', Funciones::cleanCharURL(VarConfig::path_site_www));
		$e->setVariable('url_encode', Funciones::cleanCharURL('&'));
		$e->setVariable('page', $valoresGet["page"]);
		$e->setVariable('busca_flag', '2');
		$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);
		$e->setVariable('variableMenu', 'pt-0');
		$e->setVariable('mt', '');

		if(is_array($elemento) && count($elemento) > 0)
		{
			$ControlHtml->laPagina->setTitleSite($elemento[0]['titulo']);
			$ControlHtml->laPagina->setDescriptionSite($elemento[0]['bajada']);
			$ControlHtml->laPagina->setImagenFondo('imageview.php?image=noticias/'.$elemento[0]['imagen']);

			$elemento[0]['titulo'] = Funciones::limpiarSaltoLinea($elemento[0]['titulo']);
			$elemento[0]['fecha_html_full']  = ControladorFechas::traducirMes($elemento[0]['fecha_html_full'], 'en-es');

			$e->setVariable('title_encode', Funciones::cleanCharURL($elemento[0]['titulo']." :: ".VarConfig::site_title));
			$e->setVariable('titulo_encode' ,Funciones::cleanCharURL($elemento[0]['titulo']));
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
			if($elemento[0]['id_noticia'] == '2106' || $elemento[0]['id_noticia'] == '2108' || $elemento[0]['id_noticia'] == '2360' || $elemento[0]['id_noticia'] == '2311')
			{
				if($elemento[0]['id_noticia'] == '2311')
				{
					$texto_postulacion = 'Postulaciones 2024 cerradas';
				}
				else
				{
					$texto_postulacion = 'Postulaciones 2024 cerradas';
				}

				$elemento[0] = array_merge($elemento[0], array('titulo_postulacion' => $texto_postulacion));
				$e->addTemplate('bloque_elemento_titulo');
				$e->setVariable('titulo_postulacion', $texto_postulacion);

				$e->addTemplate('bloque_elemento_postulacion');
				$e->setVariable('inscripcion_evento',$elemento[0]['inscripcion_evento']);

			}
			else
			{
				$elemento[0] = array_merge($elemento[0], array('titulo_postulacion' => 'POSTULACIONES PROXIMAMENTE'));

				if($elemento[0]['id_noticia'] == '2526')
				{
					$e->addTemplate('bloque_elemento_titulo');
					$e->setVariable('titulo_postulacion','POSTULACIONES ABIERTAS DESDE 01 DE AGOSTO DE 2022');
				}
				else
				{

					if($elemento[0]['id_noticia'] == '2605')
					{
						$e->addTemplate('bloque_elemento_titulo');
						$e->setVariable('titulo_postulacion','Postulaciones 2024 cerradas');
					}
					else
					{

						$e->addTemplate('bloque_elemento_titulo');
						$e->setVariable('titulo_postulacion','POSTULACIONES A CONVENIR');
					}
				}
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

			// $ControlNoticiasPersona = new ControlNoticiasProfesor();
			$ControlNoticiasPersona = new ControlNoticiasPersona();
			$ControlPersonaObjeto = new ControlPersonaObjeto();
			$personas = $ControlNoticiasPersona->obtenerPersonas($valoresGet['id']);
			$total = count($personas);
			$tipo_personas = array();

			$active = true;
			$carousel = array();

			if(is_array($personas) && $total)
			{
				$personas_grupo = array();
				// Reordena array personas por orden, tipo_id
				foreach ($personas as $persona)
				{
					$id_tp = $persona['id_tipo_persona'];
					$personas_grupo[$id_tp][] = $persona;
				}
				$e->addTemplate('bloque_elemento_personas');

				$n = 0;

				foreach ($personas_grupo as $key => $personas_sort)
				{
					foreach ($personas_sort as $persona)
					{
						$tipo_persona_id = $persona['id_tipo_persona'];
						if (!array_key_exists($tipo_persona_id, $tipo_personas))
						{
							$tipo_persona = $persona['tipo_persona'];

							$tipo_personas[$tipo_persona_id]['id_tipo_persona'] = $tipo_persona_id;
							$tipo_personas[$tipo_persona_id]['tipo_persona'] = $tipo_persona;
							$active_string = '';
							if($active)
							{
								$active_string = ' active';
							}
							$tipo_personas[$tipo_persona_id]['active'] = $active_string;
							$tipo_personas[$tipo_persona_id]['n'] = $n;

							$e->addTemplate('bloque_tipo_personas');
							$e->showDataSimple($tipo_personas[$tipo_persona_id]);

							$e->addTemplate('bloque_tipo_personas_cuadro');
							$e->showDataSimple($tipo_personas[$tipo_persona_id]);

							$n++;
						}

						$active = false;

						$e->addTemplate('bloque_personas');
						if(trim($persona['imagen']) == '')
						{
							$persona['imagen'] = 'blanco.jpg';
						}
						$personasSitio = $ControlPersonaObjeto->obtenerDatosIdIE($persona['id_persona']);
						$persona['urlIE'] ='ciae';
						if($personasSitio[0]['id_site'] == '6')
						{
							$persona['urlIE'] = 'ie';
						}
						$e->showDataSimple($persona);
					}
				}
			}

			$ControlNoticiasLink = new ControlNoticiasLink();
			$link = $ControlNoticiasLink->obtenerLinks($valoresGet['id']);
			$total = count($link);

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

			/* VARIABLES PARA PROGRAMAS ACADEMICOS DE POSTGRADO */
			if ($valoresGet['page'] == "view_detpostgrados")
			{
			    $e->addTemplate('bloque_elemento_lateral_postgrados_abajo');
				$e->addTemplate('bloque_elemento_lateral_postgrados');
				$e->setVariable('encargado',$elemento[0]['contacto_evento']);
					if($elemento[0]['organizadores_evento']!=''){
					$e->setVariable('organizadores_evento',$elemento[0]['organizadores_evento']);
					}else{
					$e->setVariable('organizadores_evento','postgrado@ie.uchile.cl');
					}
					if($elemento[0]['certificado_evento']!='')
					{
						$e->addTemplate('bloque_elemento_lateral_brochure');
						$e->setVariable('certificado_evento',$elemento[0]['certificado_evento']);
					}

					/*funcion provisoria para visualizar el boton quiero saber mas en magister*/
					if($elemento[0]['tipo_curso']=="magister" || $elemento[0]['tipo_curso']=="magister-prueba")
					{
						if($elemento[0]['id_noticia'] == '2311')
						{
							$link_saber_mas = 'index.php?langSite=es&page=view_inscripcion_2021_interesados_magister';
						}
						if($elemento[0]['id_noticia'] == '2605')
						{
							$link_saber_mas = 'index.php?langSite=es&page=view_inscripcion_2023_interesados_magister_indagacion';
						}
						$e->addTemplate('bloque_elemento_lateral_sabermas');
						$e->setVariable('link_saber_mas',$link_saber_mas);
						$e->addTemplate('bloque_elemento_lateral_comite_academico');
						$e->setVariable('noticia_id', $valoresGet['id']);
						$e->addTemplate('bloque_elemento_lateral_postulaaca_magister');
					}

					if($elemento[0]['tipo_curso']=="diplomado")
					{
						$link_saber_mas = 'index.php?langSite=es&page=view_inscripcion_2021_interesados_diplomados';
						$e->addTemplate('bloque_elemento_lateral_sabermas');
						$e->setVariable('link_saber_mas',$link_saber_mas);

						if($valoresGet['id'] != '2109' && $valoresGet['id'] != '2212')
						{
							$e->addTemplate('bloque_elemento_lateral_postulaaca_diplomado');
						}
					}

					if($elemento[0]['tipo_curso']=="doctorado")
					{
					//	$e->setVariable('link_saber_mas',$link_saber_mas);
						$e->addTemplate('bloque_elemento_lateral_postulaaca_doctorado');
					}
			}
			else
			{
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
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'404.tpl');
		}

		// Muestra carrusel de videos promocionales en pestaña Descripción de template noticias_postgrado.tpl

		// 3175: Diploma de especialización en indagación científica para la educación en ciencias
		if($_id <> '3175')
		{
			switch($_id)
			{
				case 2108:
					$e->addTemplate('bloque_postgrado_video_promo_lectura');
				break;
				case 2106:
					$e->addTemplate('bloque_postgrado_video_promo_mejoramiento');
				break;
				case 2360:
					$e->addTemplate('bloque_postgrado_video_promo_metodologia');
				break;
				default:
					$e->addTemplate('bloque_postgrado_video_promo');
				break;
			}

		}

		/*FUNCIONALIDAD QUE MUESTRA LA VISTA DENTRO DE LOS DIPLOMADOS, MAGISTER, DOCTORADO*/
		$e->addTemplate('bloque_elemento_quiero_saber_mas_'.$elemento_actual[0]['tipo_curso']);

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
		$e->setVariable('page', $valoresGet["page"]);
		$e->setVariable('busca_flag', '2');
		$max = count($elementos);
		for($i = 0; $i < $max; $i++)
		{
			$e->addTemplate('bloque_home_eventos');
			$elementos[$i]['fecha_completa'] = ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
			$elementos[$i]['mes'] = ControladorFechas::entregarMesAbrev($elementos[$i]['fecha_html_full'],'en-es');
			$elementos[$i]['dia'] = ControladorFechas::entregarDia($elementos[$i]['fecha_html_full']);
			$e->showDataSimple($elementos[$i]);
		}
	}

	if(VarSystem::obtenerIdiomaActual() == 'es')
	{
		/** PUBLICACIONES HOME */
		$ControlPublicaciones = new ControlPublicaciones();
		$ControlPublicacionesPersona = new ControlPublicacionesPersona();

		$elementos = $ControlPublicaciones->obtenerListadoHome();
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
			$elementos[$i]['fecha_html_full'] = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
			$e->showDataSimple($elementos[$i]);
		}
	}

	$e = $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'noticias','2',$valoresGet["page"]);

	echo $e->toHtml();

?>
