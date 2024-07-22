<?php 

	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
  	$ControlTrabajo = new ControlNoticias();
    //$ControlTrabajo = $ControlNoticias->obtenerListadoPorBusquedaTrabajo();
	$valores["busqueda_flag"]="2";
    
	if (!$valores["pagina"]) $valores["pagina"]="";
  	
  	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'trabajo.tpl');
	
	/*-----------------Buscador ---------------*/
											
	if (($valores["busqueda_flag"]>0))
	{			 		
		$tipoBusqueda	= $valores["busqueda_flag"];	 
				   
		list($trabajo,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlTrabajo, $tipoBusqueda);
								  
		foreach($valores as $var => $val)
		{    
			$e->addTemplate('bloque_listado_trabajo');
			$e->setVariable('variable',$var);
			$e->setVariable('valor',$val);		
		} 							
	}  
	/*-----------------Fin Buscador---------------*/
	$total = count($trabajo);
	for($i=0; $i < count($trabajo); $i++)
	{
		$e->addTemplate('bloque_elemento_trabajo');
		$trabajo[$i]['mes_html'] = ControladorFechas::entregarMes($trabajo[$i]['mes'],$ControlHtml->langSite);
		Funciones::mostrarArreglo($trabajo);
		$e->showDataSimple($trabajo[$i]);
	} 
	/*---------  Paginacion   ---------------------*/	
	$e->addTemplate('bloque_elemento_paginacion');				
	$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
	/*--------- Fin Paginacion   -----------------*/
	
			/** EVENTOS NOTICIAS */ 
	$ControlNoticias = new ControlNoticias();
	$elementos = $ControlNoticias->obtenerEventosHome('ASC');
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
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