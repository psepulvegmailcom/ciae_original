<?php 
	global $ControlHtml;  
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost(); 
  	$ControlBoletines = new ControlBoletines();
  	//$boletines = $ControlBoletines->obtenerListado();
	$valores["busqueda_flag"]="4";
	$valores["boletin"]="boletin";
	if (!$valores["pagina"]) $valores["pagina"]="";
  	
  	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'boletin.tpl');
	
	/*-----------------Buscador ---------------*/
											
	if (($valores["busqueda_flag"]>0))
	{			 		
		$tipoBusqueda	= $valores["busqueda_flag"];			
		$ControlBoletines = new ControlBoletines();
				   
		list($boletines,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlBoletines, $tipoBusqueda);
								  
		foreach($valores as $var => $val)
			{   
			$e->addTemplate('bloque_asignacion_valores_formulario');
			$e->setVariable('variable',$var);
			$e->setVariable('valor',$val);		
			} 							
	}  
	/*-----------------Fin Buscador---------------------*/
	$total = count($boletines);
	for($i=0; $i < count($boletines); $i++)
	{
		$e->addTemplate('bloque_elemento_boletin');
		$boletines[$i]['mes_html'] = ControladorFechas::entregarMes($boletines[$i]['mes'],$ControlHtml->langSite);
		Funciones::mostrarArreglo($boletines);
		$e->showDataSimple($boletines[$i]);
	} 
	/*---------  Paginación   ---------------------*/	
	$e->addTemplate('bloque_elemento_paginacion');				
	$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
	/*--------- Fin Paginación   -----------------*/
	
			/** EVENTOS NOTICIAS */ 
	$ControlNoticias = new ControlNoticias();
	$elementos = $ControlNoticias->obtenerEventosHome();
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