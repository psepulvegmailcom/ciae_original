<?php
/**/
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost();  

	$path_admin				= VarSystem::getPathVariables('dir_template'); 
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);	 

	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'postgrados.tpl');
	$ControlNoticias->sinFiltroIdioma(); 
	//$e->setVariable('mt','mt-0');
	$e->setVariable('organizadores_evento','postgrado@ie.uchile.cl');
		//$e->setVariable('variableMenu','pt-0');
		$e->setVariable('variableMenu','pt-0');
		$e->setVariable('mt','');

    if($valoresGet['page']=='view_postgrado'){
    		$tipo_noticia ='postgrado';
			$elementos = $ControlNoticias->obtenerListadoPostgrados();
			$e->addTemplate('bloque_elemento_postgrado'); 
		$e->addTemplate('bloque_elemento_postgradobanner');	
	}
	if($valoresGet['page']=='view_cursos'){
		    $tipo_noticia ='curso';
		    $elementos = $ControlNoticias->obtenerListadoCursos(); 
		    $e->addTemplate('bloque_elemento_curso'); 
		$e->addTemplate('bloque_elemento_postgradobanner');	
	}
	if($valoresGet['page']=='view_diplomado'){
		    $tipo_noticia ='diplomado';
		    $elementos = $ControlNoticias->obtenerListadoDiplomados();
		    $e->addTemplate('bloque_elemento_diplomado'); 
		$e->addTemplate('bloque_elemento_postgradobanner');	
	}
	if($valoresGet['page']=='view_postgradohome'){
		//$e->setVariable('variableMenu','pt-0');
		//$e->setVariable('mt','');
		$elementos = $ControlNoticias->obtenerListadoPostgradosHome();
		$e->addTemplate('bloque_elemento_postgradototal'); 
		$e->addTemplate('bloque_elemento_postgradobanner');	
	}
	/*nueva vista magister*/
	if($valoresGet['page']=='view_magister'  ){
		$tipo_noticia ='magister';
		
	    $elementos = $ControlNoticias->obtenerListadoMagister();
	    $e->addTemplate('bloque_elemento_magister');
		$e->addTemplate('bloque_elemento_postgradobanner');	
	}
	/*nueva vista doctorado*/
	if($valoresGet['page']=='view_doctorado'  ){
		$tipo_noticia ='doctorado';
	    $elementos = $ControlNoticias->obtenerListadoDoctorado();
	    $e->addTemplate('bloque_elemento_doctorado'); 
		$e->addTemplate('bloque_elemento_postgradobanner');	
	}

	if(is_array($elementos) && count($elementos)>0)
	{							
		//$e->addTemplate('bloque_elemento_trabajo']);   						
		$max_recursos = count($elementos);						
		for($i=0; $i <  $max_recursos;$i++)
		{
		//	Funciones::mostrarArreglo($e->setVariable,true);
			$e->addTemplate('bloque_elemento_postgradohome');
			if(trim($elementos[$i]['imagen']) == '')
			{
				$elementos[$i]['imagen'] = 'blanco.jpg';
			}

			if(trim($elementos[$i]['tipo_curso']) == 'diplomado'){
				$elementos[$i]['estilo'] = 'diplomado';	
			}
			if(trim($elementos[$i]['tipo_curso']) == 'posgrado'){
				$elementos[$i]['estilo'] = 'posgrado';	
			}
			if(trim($elementos[$i]['tipo_curso']) == 'magister'){
				$elementos[$i]['estilo'] = 'diplomado';	
			}
			if(trim($elementos[$i]['tipo_curso']) == 'doctorado'){
				$elementos[$i]['estilo'] = 'doctorado';	
			}

			/*
			if(trim($elementos[$i]['tipo_curso']) == 'diplomado')
			{
				$elementos[$i]['estilo'] = 'diplomado';
			}else{
				$elementos[$i]['estilo'] = 'posgrado';
			}
			*/

			$e->setVariable('img',$i+1);
			$elementos[$i]['bajada']= substr($elementos[$i]['bajada'], 0, 230)." "; 
			$elementos[$i]['fecha_html_full']  = 
			ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
			$elementos[$i]['tituloAca'] = $elementos[$i]['titulo'];
			$e->showDataSimple($elementos[$i]);
			
		}
	} 
	
    $elementos = $ControlNoticias->obtenerListadoTipoPostgrado($tipo_noticia);
	if(is_array($elementos) && count($elementos)>0)
	{							
		$e->addTemplate('bloque_elemento_noticia_general');   						
		$max_recursos = count($elementos);						
		for($i=0; $i <  $max_recursos;$i++)
		{
			$e->addTemplate('bloque_elemento_noticia');
			if(trim($elementos[$i]['imagen']) == '')
			{
				$elementos[$i]['imagen'] = 'blanco.jpg';
			}
			$elementos[$i]['bajada']= substr($elementos[$i]['bajada'], 0, 230)."..."; 
			$elementos[$i]['fecha_html_full']  = 
			ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
			$elementos[$i]['tituloAca'] = $elementos[$i]['titulo'];
			$e->showDataSimple($elementos[$i]);
			
		}
	} 

	echo $e->toHtml();
?>