<?php
/**/
	global $ControlHtml;
	$ControlNoticias = new ControlNoticias();
  	$valoresGet = VarSystem::getGet();
	$valores = VarSystem::getPost();

	$path_admin = VarSystem::getPathVariables('dir_template');
	$ControlGeneralSitios = new ControlGeneralSitios($path_admin,$ControlHtml);

	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'investigacion.tpl');
	$ControlNoticias->sinFiltroIdioma();
	$e->setVariable('mt','mt-0');
	if($valoresGet['page']=='view_investigacion'){
		$e->setVariable('variableMenu','pt-0');
		$e->setVariable('mt','');
			$e->addTemplate('bloque_elemento_investigacionbanner');
			$e->addTemplate('bloque_elemento_investigaciontotal');
	}

    if($valoresGet['page']=='view_postgrado'){
    		$tipo_noticia ='postgrado';
			$elementos = $ControlNoticias->obtenerListadoPostgrados();
			$e->addTemplate('bloque_elemento_postgrado');
	}
	if($valoresGet['page']=='view_cursos'){
		    $tipo_noticia ='curso';
		    $elementos = $ControlNoticias->obtenerListadoCursos();
		    $e->addTemplate('bloque_elemento_curso');
	}
	if($valoresGet['page']=='view_diplomado'){
		    $tipo_noticia ='diplomado';
		    $elementos = $ControlNoticias->obtenerListadoDiplomados();
		    $e->addTemplate('bloque_elemento_diplomado');
	}

	$elementosInIE = $ControlNoticias->obtenerInvestigacionesIEInvestigacion();
	if(is_array($elementosInIE) && count($elementosInIE)>0)
	{
		$e->addTemplate('bloque_home_invest_general');

		$max_noticias = count($elementosInIE);
		for($i=0; $i <  $max_noticias;$i++)
		{
			$e->addTemplate('bloque_home_invest_ie');
			if(trim($elementosInIE[$i]['imagen']) == '')
			{
				$elementosInIE[$i]['imagen'] = 'blanco.jpg';
			}
			$elementosInIE[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementosInIE[$i]['fecha_html_full'],'en-es');
			$e->showDataSimple($elementosInIE[$i]);
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