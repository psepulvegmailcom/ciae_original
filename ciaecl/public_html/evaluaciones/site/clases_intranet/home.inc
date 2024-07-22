<? 
	global $ControlHtml;  	 
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_home.tpl'); 
	
	$ControlBanner = new ControlBanner();
	$banner = $ControlBanner->obtenerBannerActivo();
	//Funciones::mostrarArreglo($banner,true);
	$e->showBlock('bloque_banner_home',$banner); 

	/** NOTICIAS HOME */
	$ControlNoticias = new ControlNoticias();
	$dias_menos = -1*VarSystem::getDiasCaducidad();
	$fecha_caducidad = ControladorFechas::fechaActual(true,false,$dias_menos);
	$ControlNoticias->caducarNoticias($fecha_caducidad);
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
	$elementos = $ControlNoticias->obtenerEventosHome();
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
		$e->addTemplate('bloque_home_eventos_general');
		$max = count($elementos);
		for($i=0; $i <  $max;$i++)
		{
			$e->addTemplate('bloque_home_eventos'); 
			$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
			$e->showDataSimple($elementos[$i]);
		}
	}	
	/** EN LA PRENSA */
	$ControlNoticiasPrensa = new ControlNoticiasPrensa(); 
	$elementos = $ControlNoticiasPrensa->obtenerListado();
	 //Funciones::mostrarArreglo($elementos,true);
	if(is_array($elementos) && count($elementos)>0)
	{ 
		$bloque_caso = 'bloque_home_prensa_der';
		if($max_noticias > VarSystem::getTotalListarNoticiasCambio())// || $max_eventos > VarSystem::getTotalListarNoticiasCambio())
		{
			$bloque_caso = 'bloque_home_prensa_izq'; 
		} 
		$e->addTemplate($bloque_caso); 
		$max = VarSystem::getTotalListarHome(); 
		for($i=0; $i <  $max;$i++)
		{
			//Funciones::mostrarArreglo($elementos[$i],true);
			$e->addTemplate($bloque_caso.'_detalle');  
			$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es'); 
			$e->showDataSimple($elementos[$i]);
		}
	}	
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
	
	echo $e->toHtml();
?>	