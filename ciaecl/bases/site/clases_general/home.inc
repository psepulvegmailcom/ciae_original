<?php
	
	global $ControlHtml;  	  
	
	$tpl_home = 'version_home';
	if($ControlHtml->tipo_dispositivo == 'desktop')
	{
		$tpl_home = $tpl_home.'_desktop';
	}
	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').$tpl_home.'.tpl'); 
	$idioma = VarSystem::obtenerIdiomaActual();
	 
	 
	//	Funciones::mostrarArreglo($ControlHtml,true);
	$path_admin				= VarSystem::getPathVariables('dir_template'); 
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);

	/** NOTICIAS HOME **/

	/*$ControlSite = new ControlSite;
	$site = $ControlSite->NombreSite(VarSystem::getPathVariables('web_site'));
	$site = $site[0]['id_site'];*/
		
	$site = $ControlHtml->site_id;
	$ControlNoticias = new ControlNoticias(); 
	
	$ControlBanner = new ControlBanner();
	$banner = $ControlBanner->obtenerBanner($idioma, $site);
	$banner['0']['active'] = 'active';
	$e->showBlock('bloque_banner_home',$banner);  
	
	$banner = $ControlBanner->obtenerBannerPie($idioma, $site);
	if(is_array($banner) && count($banner)>0)
	{
		$banner['0']['active'] = 'active';
		$e->showBlock('bloque_banner_home_pie',$banner);
	}   
	
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
	
	/** EVENTOS HOME */ 
	$elementos = $ControlNoticias->obtenerEventosHome('ASC'); 
	
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
		$e->addTemplate('bloque_home_eventos_general');
		$max = count($elementos);

		for($i=0; $i <  $max;$i++)
		{
			$e->addTemplate('bloque_home_eventos');
			$elementos[$i]['mes']= ControladorFechas::entregarMesAbrev($elementos[$i]['fecha_html_full'],'en-es'); 
			$elementos[$i]['dia']= ControladorFechas::entregarDia($elementos[$i]['fecha_html_full']);			
			//$elementos[$i]['titulo'] = strtoupper($elementos[$i]['titulo']);
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
				$e->showDataSimple($elementos[$i]);
			}
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
			Funciones::mostrarArreglo($listado,false,'publicaciones home');
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
	
	if(VarSystem::obtenerIdiomaActual() == 'es')
	{	 
		/** DOCUMENTOS DE TRABAJO HOME */
		$ControlPublicaciones = new ControlPublicaciones();
		$documentos = $ControlPublicaciones->obtenerDocumentosHome();
		$documentos = $documentos[0];
		//Funciones::mostrarArreglo($documentos,true);
		
		$ControlPublicacionesPersona = new ControlPublicacionesPersona();
		$documentos['autores'] = $ControlPublicacionesPersona->obtenerListadoPersonas($documentos['id_publicaciones']);
		
		//Funciones::mostrarArreglo($documentos,true);
		$e->addTemplate('bloque_home_publicaciones_documentos');
		$e->showDataSimple($documentos); 
		
		if(VarSystem::obtenerIdiomaActual() == 'es')
		{
			$e->addTemplate('bloque_home_banner_interno_es');
		}
	}
	
	if(VarSystem::obtenerIdiomaActual() == 'es')
	{	 
		/** PROYECTOS HOME */
		$ControlProyectos = new ControlProyectos();
		$listado = $ControlProyectos->obtenerListadoHome();

		$max = count($listado);
		$max = 2; //muestra 2 proyectos
		//Funciones::mostrarArreglo($documentos,true);
		//$fila_aux = floor(rand(0,5));
		$numero_img_0 = floor(rand(0,3));
		$numero_img_1 = floor(rand(4,8)); 
		for($i=0; $i < $max;$i++)
		{
			$aux = 'numero_img_'.$i;
			$e->addTemplate('bloque_home_proyectos');
			$e->showDataSimple($listado[$i]);  
			$e->setVariable('i_fila',$$aux	);  
		}
		if(VarSystem::obtenerIdiomaActual() == 'es')
		{
			$e->addTemplate('bloque_home_banner_interno_es');
		}
	}
	 
	 
	 /* VIDEOS YOUTUBE */
	$e = $ControlGeneralSitios->mostrarVideosRecursos($e,'Multimedia');	 /* el id tipo es propio del sitio */
	$e = $ControlGeneralSitios->mostrarGifInformativoCIAE($e);
	
	if(VarSystem::obtenerIdiomaActual() == 'en')
	{
		$e->addTemplate('bloque_home_version_extra_ingles'); 
		
		$ControlTextos = new ControlTextos();
	  	$textos = $ControlTextos->obtenerElemento('view_presentacion');
	  	//Funciones::mostrarArreglo($textos,true);
	  	$e->setVariable('texto_presentacion',$textos[0]['texto_en']); 
	} 
	echo $e->toHtml();
?>	