<?php
/**/ 
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost(); 
//echo VarSystem::getPathVariables('web_site').'ddddd';

	$path_admin				= VarSystem::getPathVariables('dir_template'); 
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);	
	

	$ControlNoticias = new ControlNoticias(); 
	
	
	if(!isset($valoresGet['id']))
	{
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias.tpl');
		
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']); 
		$ControlNoticias->sinFiltroIdioma();
	
		$bloque_listado_default = 'bloque_elemento';
	 	switch($valoresGet['page'])
		{			
			case 'view_agenda':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1) 
					$valores["busca_tipo"]="evento";
				if (!$valores["pagina"]) 
					$valores["pagina"]="";
				$e->setVariable('caso_titulo_modulo',"Actividades");
				$bloque_listado_default = 'bloque_elemento_agenda';
			break;
			case 'view_noticias':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1) 
					$valores["busca_tipo"]="noticia";
				if (!$valores["pagina"]) 
					$valores["pagina"]="";
				$e->setVariable('caso_titulo_modulo',"Noticias");
				$bloque_listado_default = 'bloque_elemento_noticia';
			break;
				case 'view_prensa':
			 	$valores["busqueda_flag"]=2;
				if ($valores["seteaTipo"]!=1) 
					$valores["busca_tipo"]="medios"; 
				if (!$valores["pagina"]) 
					$valores["pagina"]="";
				$e->setVariable('caso_titulo_modulo',"En la prensa");
				$bloque_listado_default = 'bloque_elemento_prensa';
			break;


			default:  
			
					/** NOTICIAS HOME */
				if ($valores["seteaTipo"]!=1 && $valoresGet["busca_palabra"]=="")
				{
				 
					
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
							$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
							$e->showDataSimple($elementos[$i]);
						}
					}
					
					if(VarSystem::obtenerIdiomaActual() == 'es')
					{
						/** EN LA PRENSA */
						$ControlNoticiasPrensa = new ControlNoticiasPrensa(); 
						$elementos = $ControlNoticiasPrensa->obtenerListadoPrensaSitio();
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
								$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es'); 
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

		/*-----------------BUSCADOR ---------------*/
		
		if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
		{	
			
			if(!$valores and $valoresGet["busca_palabra"]!="") 
				$valores["busca_palabra"]=$valoresGet["busca_palabra"];			
			if(!$valores and $valoresGet["busca_Autor"]!="")
				 $valores["busca_Autor"]=$valoresGet["busca_Autor"];			
			if($valores["busqueda_flag"]=="") 
				$valores["busqueda_flag"]=$valoresGet["busqueda_flag"];
		
			$tipoBusqueda	= $valores["busqueda_flag"];
			if($valores["busca_tipo"]=="medios")
			{
			   $ControlNoticias = new ControlNoticiasPrensa();
			}
			else
			{
			   if($valores["busca_tipo"]=="noticia" || $valores["busca_tipo"]=="evento")
			   {			
		   			$ControlNoticias = new ControlNoticias();
			   }
			} 
			
			//Funciones::mostrarArreglo($ControlNoticias,true);
			list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlNoticias, $tipoBusqueda);
						  
			//Funciones::mostrarArreglo(array('inicio'=>$inicio,'final'=>$final,'numPags'=>$numPags),true,'salida buscardorGeneral');
		 
			foreach($valores as $var => $val)
			{   
				$e->addTemplate('bloque_asignacion_valores_formulario');
				$e->setVariable('variable',$var);
				$e->setVariable('valor',$val);		
			} 							
		}  
		
		/*-----------------FIN BUSCADOR---------------------*/
						 	
		//$e->setVariable('titulo',$menu[0]['titulo_'.VarSystem::obtenerIdiomaActual()]);		
		$total = count($listado);
		if(is_array($listado) && $total > 0)
		{
			$listado  = ControladorFechas::traducirMes($listado,'en-es');
			$listado  = ControladorFechas::transformarFechaHTML($listado);
			
		 	//Funciones::mostrarArreglo($listado,true);
			/*if ($valores["busca_tipo"]=="medios")
			{
				$e->showBlock($bloque_listado_default,$listado); 
			}
			else
			{
				$e->showBlock('bloque_elemento',$listado); 
			}*/
			$e->showBlock($bloque_listado_default,$listado); 

			/*---------  Paginaci&oacute;n   ---------------------*/	
			
			//	Funciones::mostrarArreglo(array($pagina,$inicio,$final,$numPags ),true);
			$e->addTemplate('bloque_elemento_paginacion');				
			$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
					  
			//Funciones::mostrarArreglo(array('pagina'=>$pagina, 'inicio'=>$inicio,'final'=>$final,'numPags'=>$numPags),false,'arraglos noticias paginamiento');
			/*--------- Fin Paginaci&oacute;n   -----------------*/ 
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
		/** MOSTRAR ELEMENTOS */		
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'noticias_ficha.tpl');		
		$e->setVariable('url_site',VarConfig::path_site_www);
		$e->setVariable('url_site_encode',Funciones::cleanCharURL(VarConfig::path_site_www));
		$e->setVariable('url_encode',Funciones::cleanCharURL('&')); 
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','2');
		$elemento = $ControlNoticias->obtenerElemento($valoresGet['id']);


		 //Funciones::mostrarArreglo($elemento,true);
		
		if(is_array($elemento) && count($elemento) > 0)
		{ 
			
			$ControlHtml->laPagina->setTitleSite($elemento[0]['titulo']);
			$ControlHtml->laPagina->setDescriptionSite($elemento[0]['bajada']);
			$ControlHtml->laPagina->setImagenFondo('imageview.php?image=noticias/'.$elemento[0]['imagen']);
			
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
			
			if($elemento[0]['tipo'] == 'evento')
			{
				$e->addTemplate('bloque_mostrar_fecha');
				$e->setVariable('fecha_html_full',$elemento[0]['fecha_html_full']);
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
 							
						
	/** EVENTOS NOTICIAS */ 
	$ControlNoticias = new ControlNoticias();
	$elementos = $ControlNoticias->obtenerEventosHome('DESC');
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
		$e->addTemplate('bloque_home_palabras');
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
		
        
     
  	$ControlGeneralSitios = new ControlGeneralSitios();
  	$e = $ControlGeneralSitios->mostrarNoticiasDestacadasHome($e); 
    
	$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'noticias','2',$valoresGet["page"]); 
	

		

	echo $e->toHtml();
?>