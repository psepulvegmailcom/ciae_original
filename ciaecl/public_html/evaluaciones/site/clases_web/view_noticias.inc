<?php

	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost(); 
	
	if(!isset($valoresGet['id']))
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias.tpl');
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']); 
		$ControlNoticias->sinFiltroIdioma();
	
	 	switch($valoresGet['page'])
		{
			case 'view_eventos':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1) $valores["busca_tipo"]="evento";
				if (!$valores["pagina"]) $valores["pagina"]="";
			break;
			case 'view_actuales':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1) $valores["busca_tipo"]="noticia";
				if (!$valores["pagina"]) $valores["pagina"]="";
			break;
				case 'view_prensa':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1) $valores["busca_tipo"]="medios"; 
				if (!$valores["pagina"]) $valores["pagina"]="";
			break;


			default:  
					/** NOTICIAS HOME */
				if ($valores["seteaTipo"]!=1 && $valoresGet["busca_palabra"]==""){
					$ControlNoticias = new ControlNoticias();
					$dias_menos = -1*VarSystem::getDiasCaducidad();
					$fecha_caducidad = ControladorFechas::fechaActual(true,false,$dias_menos);
					$ControlNoticias->caducarNoticias($fecha_caducidad); 
					
					$dias_menos = -1*(VarSystem::getDiasCaducidad()+45);
					$fecha_caducidad = ControladorFechas::fechaActual(true,false,$dias_menos);
					$ControlNoticias->caducarNoticiasForzar($fecha_caducidad); 
					
					$dias_mas = -2;
					$fecha_caducidad = ControladorFechas::fechaActual(true,false,$dias_mas);
					$ControlBanner = new ControlBanner();
					$ControlBanner->caducarBanner($fecha_caducidad); 
					
					$ControlBanner = new ControlBanner();
					//$banner = $ControlBanner->obtenerBannerActivo($idioma);
					$e->showBlock('bloque_banner_home',$banner); 
					
					$elementos = $ControlNoticias->obtenerNoticiasHome();
					if(is_array($elementos) && count($elementos)>0)
					{
						$e->addTemplate('bloque_home_noticia_general');   
						
						$max_noticias = count($elementos);
						for($i=0; $i <  $max_noticias;$i++)
						{
							$e->addTemplate('bloque_home_noticia');
							if(trim($elementos[$i]['imagen']) == '')
							{
								$elementos[$i]['imagen'] = 'blanco.jpg';
							}
							$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
							$e->showDataSimple($elementos[$i]);
						}
					}
					
											if(VarSystem::obtenerIdiomaActual() == 'es')
						{
						/** EN LA PRENSA */
						$ControlNoticiasPrensa = new ControlNoticiasPrensa(); 
						$elementos = $ControlNoticiasPrensa->obtenerListado();
						// Funciones::mostrarArreglo($elementos,false,'PRENSA----------');
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
							$max = VarSystem::getTotalListarHome(); 
							for($i=0; $i <  $max;$i++)
							{
								$elementos[$i]['url'] = str_replace(';','',$elementos[$i]['url']); 
								 //Funciones::mostrarArreglo($elementos[$i],true);
								$e->addTemplate($bloque_caso.'_detalle');  
								$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es'); 
								$elementos[$i]['titulo_web'] = 	$elementos[$i]['titulo'];
								$e->showDataSimple($elementos[$i]);
								if(trim($elementos[$i]['pdf']) != '')
								{
								 $e->addTemplate('bloque_prensa_pdf');
								 $e->showDataSimple($elementos[$i]);
								}
							}
						}	
					}
					
				  }
			break; 
		}   	

					/*-----------------Buscador ---------------*/
						
						if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
						{	
						if(!$valores and $valoresGet["busca_palabra"]!="") $valores["busca_palabra"]=$valoresGet["busca_palabra"];			
						if($valores["busqueda_flag"]=="") $valores["busqueda_flag"]=$valoresGet["busqueda_flag"];
						
						   $tipoBusqueda	= $valores["busqueda_flag"];
						   if($valores["busca_tipo"]=="medios"){
							   $ControlNoticias = new ControlNoticiasPrensa();
							   }else
							   if($valores["busca_tipo"]=="noticia" || $valores["busca_tipo"]=="evento"){			
						   		$ControlNoticias = new ControlNoticias();
							   }
							list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlNoticias, $tipoBusqueda);
										  
							foreach($valores as $var => $val)
							{   
								$e->addTemplate('bloque_asignacion_valores_formulario');
								$e->setVariable('variable',$var);
								$e->setVariable('valor',$val);		
							} 							
						}  
					/*-----------------Fin Buscador---------------------*/
										 	
						$e->setVariable('titulo',$menu[0]['titulo_'.VarSystem::obtenerIdiomaActual()]);		
						$total = count($listado);
						if(is_array($listado) && $total > 0)
						{
							$listado  = ControladorFechas::traducirMes($listado,'en-es');
							if ($valores["busca_tipo"]=="medios"){
								$e->showBlock('bloque_elemento_prensa',$listado); 
							}else{
							$e->showBlock('bloque_elemento',$listado); 
							}
						/*---------  PaginaciÃ³n   ---------------------*/	
						$e->addTemplate('bloque_elemento_paginacion');				
						$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
						/*--------- Fin PaginaciÃ³n   -----------------*/	
						
						}	
							

	}
	else
	{ 
		/** MOSTRAR ELEMENTOS */		
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_ficha.tpl');
		
		$e->setVariable('url_site',VarConfig::path_site_www);
		$e->setVariable('url_site_encode',Funciones::cleanCharURL(VarConfig::path_site_www));
		$e->setVariable('url_encode',Funciones::cleanCharURL('&')); 
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2');
		$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);


		 Funciones::mostrarArreglo($elemento);
		
		if(is_array($elemento) && count($elemento) > 0)
		{ 
			$elemento[0]['titulo'] = Funciones::limpiarSaltoLinea($elemento[0]['titulo']);
			 
			$elemento[0]['fecha_html_full']  = ControladorFechas::traducirMes($elemento[0]['fecha_html_full'],'en-es');
			
			$e->setVariable('title_encode',Funciones::cleanCharURL($elemento[0]['titulo']." :: ".VarConfig::site_title));
			$e->setVariable('titulo_encode' ,Funciones::cleanCharURL($elemento[0]['titulo'])); //." :: ".VarConfig::site_title));
			$e->setVariable('bajada_encode' ,Funciones::cleanCharURL($elemento[0]['bajada']));
			$e->setVariable('imagen_decode',Funciones::cleanCharURL($elemento[0]['imagen']));
					
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
						
			$ControlNoticiasLink = new ControlNoticiasLink();
			$link = $ControlNoticiasLink->obtenerLinks($valoresGet['id']);
			$total = count($link);
			Funciones::mostrarArreglo($link);
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
					
					$e->addTemplate('bloque_elemento_'.$link[$k]['tipo']);
					$e->showDataSimple($link[$k]);
				} 								
			}


			
			if($elemento[0]['tiene_galeria'] == 1)
			{
				$dir = VarSystem::getPathVariables('dir_repositorio')."image/noticias/".$valoresGet['id'];
				if(is_dir($dir))
				{ 
					$imagenes = Funciones::obtenerListaArchivos($dir);
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
			} 
			
			/** SE GUARDA LA VISITA */
			$NoticiasVisitas = new NoticiasVisitas();
			$NoticiasVisitas->id_noticia = $valoresGet['id'];
			$NoticiasVisitas->tipo_visita = 'local';
			if(isset($valoresGet['externo']) && trim($valoresGet['externo']) != '')
			{
				$NoticiasVisitas->tipo_visita = $valoresGet['externo'];
			}
			$NoticiasVisitas->agregarVisita();
			
		} 
		else
		{
			$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'404.tpl');
			 
		}	
	
	} 
							
						
							/** EVENTOS NOTICIAS */ 
						$ControlNoticias = new ControlNoticias();
						$elementos = $ControlNoticias->obtenerEventosHome();
						$max_eventos = count($elementos);
						if(is_array($elementos) && $max_eventos > 0)
						{
							$e->addTemplate('bloque_home_palabras');
							$e->setVariable('page',$valoresGet["page"]);
							$e->setVariable('busca_flag','2'); 
							$e->addTemplate('bloque_home_eventos_general');
							$max = count($elementos);
							for($i=0; $i <  $max;$i++)
							{
							  $e->addTemplate('bloque_home_eventos');	
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
						

	echo $e->toHtml();
?>