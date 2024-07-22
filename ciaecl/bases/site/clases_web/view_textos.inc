<?php

	global $ControlHtml;
  	$valoresGet = VarSystem::getGet();
  	$valores = VarSystem::getPost();
	$ControlTextos = new ControlTextos();
  	$textos = $ControlTextos->obtenerElemento($valoresGet['page']);
  	$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'version_textos_planos.tpl');
  	$texto_contenido = $textos[0]['texto_'.$ControlHtml->langSite];

	$opcion = explode('_', $valoresGet['page']);
	unset($opcion[0]);
	$opcion = implode('_',$opcion);



  	if(trim($texto_contenido) == '')
  	{

			if($valoresGet['id'] == '2605')
		  {
			  $opcion = 'preguntas_frecuentes_indagacion';
		  }

  		$archivo_texto = VarSystem::getPathVariables('dir_template').'site/textos/'.$opcion.'.tpl';
		//echo $archivo_texto;
  		if(file_exists($archivo_texto))
  		{
  			$f 	= new miniTemplate($archivo_texto);
  			$texto_contenido = $f->toHtml();
  		}
  	}


  	$e->setVariable('texto_contenido',$texto_contenido);
  	$e->setVariable('caso',$valoresGet['page']);
  	$Menu = new Menu();
	$Menu->getOpcion($valoresGet['page']);
	///print_r($Menu);
	$titulo = 'titulo_'.$ControlHtml->langSite;

	$e->setVariable('descripcion',stripcslashes($Menu->$titulo));


	$aux = explode('_',$ControlHtml->lastActionArray[0]);
	$clave = end($aux);
	$e->setVariable('clave',$clave);

	if ($Menu->sitio=='web_arpa_uchile') /* sitio arpa */
	{
		$e->setVariable('variableMenu','pt-0');
		$e->setVariable('descripcion',stripcslashes($Menu->$titulo));
		if ($valoresGet['page']=="view_quienes_arpa")
		{
			$e->addTemplate('bloque_banner_portada_quienes_ie');
		}
		else
		{
			$e->addTemplate('bloque_banner_simple');
		}
	}
	else
	{
		if ($valoresGet['page']=="view_quienes_ie" || $valoresGet['page']=="view_direccion_ie" || $valoresGet['page']== "view_equipo_direccion"  || $valoresGet['page']=="view_consejo_ie"  || $valoresGet['page']=="view_comisiones_ie"  || $valoresGet['page']== "view_junta_electoral" || $valoresGet['page']== "view_evaluacion_academica" || $valoresGet['page']=="view_concurso_academico"  || $valoresGet['page']=="view_local_autoevaluacion"  || $valoresGet['page']=="view_comite_ie"   )
		{
			$e->setVariable('variableMenu','pt-0');
			$e->setVariable('descripcion',stripcslashes($Menu->$titulo));
			$e->addTemplate('bloque_banner_portada_quienes_ie');
		}
		else
		{
			$e->setVariable('mt','mt-0');
		}
	}


	if (($valoresGet['page']=="view_privacidad_datos" || $valoresGet['page']=="view_alianzas_ie") || ($valoresGet['page']=="view_difusion_ie") ){

		$e->setVariable('variableMenu','pt-0');
		$e->addTemplate('bloque_banner_simple');

		$e->addTemplate('bloque_elemento_lateral_vinculacion');


	} elseif($valoresGet['page']=="view_internacionalizacion_ie" || $valoresGet['page']=="view_bases_filosofia"){
		$e->addTemplate('bloque_banner_investigacion');
		$e->addTemplate('bloque_elemento_lateral_investigacion');
	 }
	 elseif($valoresGet['page']=="view_colab_inst"){
		$e->addTemplate('bloque_elemento_lateral_academicos');
	 }
	  elseif ($valoresGet['page']=="view_constituyente_ie" || $valoresGet['page']=="view_constituyente_ie_derecho" || $valoresGet['page']=="view_constituyente_ie_publica" || $valoresGet['page']=="view_constituyente_ie_intercultural" || $valoresGet['page']=="view_constituyente_ie_libertad" || $valoresGet['page']=="view_constituyente_ie_genero" || $valoresGet['page']=="informacion_estudiantes")
	{

		$e->setVariable('variableMenu', 'pt-0');
		$e->addTemplate('bloque_banner_contituyente');
		$e->addTemplate('bloque_elemento_lateral_vinculacion');
	}
	elseif ($valoresGet['page']=="view_informacion_estudiantes" || $valoresGet['page'] == "view_preguntas_frecuentes")
	{

		$e->setVariable('variableMenu', 'pt-0');
		$e->addTemplate('bloque_banner_informacion');
		$e->addTemplate('bloque_elemento_lateral_postgrados');
	}
	else{
		$e->addTemplate('bloque_elemento_lateral_qs');
	}
			/** Menu IE  */
	if($valoresGet['page']=="view_calificacion_ie" || $valoresGet['page'] == "view_evaluacion_academica"
	 || $valoresGet['page']=="view_concurso_academico" || $valoresGet['page']=="view_local_autoevaluacion"){
	 	$e->setVariable('menuPactive','active');
		$e->addTemplate('bloque_elemento_lateral_comisiones');
		$e->addTemplate('bloque_elemento_lateral_comisiones_caja');
	 }
	if( $valoresGet['page']=="view_concurso_academico"){
		$e->addTemplate('bloque_elemento_lateral_comisiones_secretaria');
		$e->addTemplate('bloque_elemento_lateral_comisiones_concurso_acad');
	 }
	if( $valoresGet['page']=="view_evaluacion_academica"){
		$e->addTemplate('bloque_elemento_lateral_evaluacion_secretaria');
		$e->addTemplate('bloque_elemento_lateral_comisiones_reglamento_cal_acad');
	 }
	if( $valoresGet['page']=="view_local_autoevaluacion"){
		$e->addTemplate('bloque_elemento_lateral_comisiones_reglamento_autoeval');
	 }
	if( $valoresGet['page']=="view_junta_electoral"){
		$e->addTemplate('bloque_elemento_lateral_comisiones_elecciones_junta');
	 }




		   /** ------- */
	if(trim($textos[0]['imagen']) != '')
	{
		$e->addTemplate('bloque_texto_imagen');
		$e->setVariable('imagen',$textos[0]['imagen']);
	}

	if ($valoresGet['page']=="view_consejo_ie"){
		$e->addTemplate('bloque_banner_consejo_ie');
	}

  	$ControlGeneralSitios = new ControlGeneralSitios();
  	$e = $ControlGeneralSitios->mostrarNoticiasDestacadasHome($e);

      	/** EVENTOS NOTICIAS */
	$ControlNoticias = new ControlNoticias();
	$elementos = $ControlNoticias->obtenerEventosHome('ASC');
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

	echo $e->toHtml();
?>
