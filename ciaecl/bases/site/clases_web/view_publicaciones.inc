<?php

	global $ControlHtml;
  	$valoresGet = VarSystem::getGet();
  	$idioma 	= VarSystem::obtenerIdiomaActual();
  	$valores 	= VarSystem::getPost();
    $valoresBusqueda      = VarSystem::getPost();
	$ControlGeneralSitios = new ControlGeneralSitios();

	//header('Content-Type: text/html; charset=UTF-8');

 	if(count($valores) == 0)
 	{
 		$valores = VarSystem::getGet();
		$valores["busqueda_flag"]=1;
		//$valores["busca_Anno"]='2015';
 	}

	switch($valoresGet['page'])
	{
		case 'view_publicaciones_interes':
			$valores["busqueda_flag"]=1;
			$valores["busca_tipoPublica"]="interes general";
			if (!$valores["pagina"]) $valores["pagina"]="";

		break;
		case 'view_publicaciones_sist_escolar':
			$valores["busqueda_flag"]=1;
			$valores["busca_tipoPublica"]="sistema escolar";
			if (!$valores["pagina"]) $valores["pagina"]="";

		break;
			case 'view_publicaciones_academicas':
			$valores["busqueda_flag"]=1;
			$valores["busca_tipoPublica"]="academicas";
			if (!$valores["pagina"]) $valores["pagina"]="";

		break;
   }


	//print_r($valores);
	//print_r($valoresGet);


	$id_publicaciones = $valoresGet['id_publicaciones'];
  	$ControlPublicaciones = new ControlPublicaciones();
  	$tipo = $valoresGet['tipo'];

	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'publicaciones/publicaciones.tpl');
	$e->setVariable('id_publicaciones',$id_publicaciones);
	$e->setVariable('page',$valoresGet["page"]);
	$e->setVariable('busca_flag','1');

	if($valoresGet['page']=='view_publicaciones'){
		$e->setVariable('variableMenu','pt-0');
		$e->setVariable('mt','');
			$e->addTemplate('bloque_elemento_investigacionbanner');
			$e->addTemplate('bloque_elemento_investigaciontotal');
	}



	if(trim($id_publicaciones) != '' && ($valores["buscar"]!="buscar"))
  	{
		$listado = $ControlPublicaciones->obtenerListadoPorPublicacion($id_publicaciones);

		if(is_array($listado) && count($listado) > 0)
		{
			$e->addTemplate('bloque_publicaciones_detalle');

			if($listado[0]['id_tipo'] == '8' && $listado[0]['documento_publico'] == 'no' )
			{
				$Publicaciones = new Publicaciones();
				$Publicaciones->buscarObjeto($id_publicaciones);
				$Publicaciones->documento_publico = 'si';
				$Publicaciones->guardarObjeto();
				$listado[0]['documento_publico'] = 'si';
			}
			if($listado[0]['id_tipo'] == '8')
			{
				$listado[0]['numero_html'] = 'N&deg; '.$listado[0]['numero'].' - ';
			}
			else
			{
				$listado[0]['numero'] = '';
			}
		//	if($listado[0]['bib_volume']!='') $listado[0]['bib_volume']= " VOL".$listado[0]['bib_volume'];
		//	Funciones::mostrarArreglo($listado,true);

			$ControlPublicacionesPersona = new ControlPublicacionesPersona();
			$listado[0]['autores_html'] = $ControlPublicacionesPersona->obtenerListadoPersonas($id_publicaciones);

		  	//Funciones::mostrarArreglo($listado,false,'elemento publicaciones');
		  	$e->showDataSimple($listado[0]);
			if((trim($listado[0]['documento']) != '') && (trim($listado[0]['documento_publico'])=="si"))
			{
				$e->addTemplate('bloque_elemento_documento');
				$e->setVariable('documento',$listado[0]['documento']);
			}
			if((trim($listado[0]['link']) != ''))
			{
				$e->addTemplate('bloque_elemento_documento_link');
				$e->setVariable('link',$listado[0]['link']);
			}
			if((trim($listado[0]['doi']) != ''))
			{
				$listado[0]['doi'] = str_replace(' ','',$listado[0]['doi']);
				$listado[0]['doi'] = str_replace('http://dx.doi.org/','',$listado[0]['doi']);
				$listado[0]['doi'] = str_replace('dx.doi.org/','',$listado[0]['doi']);
				$listado[0]['doi'] = str_replace('doi:','',$listado[0]['doi']);
				$e->addTemplate('bloque_elemento_link_doi');
				$e->setVariable('doi',$listado[0]['doi']);
			}

			if(trim($listado[0]['palabras_clave']) != '')
			{
			//	echo "valoresGet".$valoresGet["page"];
				$e->addTemplate('bloque_palabra_clave_general');
				$valores = $listado[0]['palabras_clave'];
				$valor = explode(',',$valores);
				for ($i=0; $i<6; $i++)
				{
					if($valor[$i]!='')
					{
						$e->addTemplate('bloque_palabra_clave');
						$e->setVariable('page',$valoresGet["page"]);
						$e->setVariable('busca_flag','1');
						$e->setVariable('palabra',$valor[$i]);
					}
				}
			}
		}
		else
		{
			$e->addTemplate('bloque_publicaciones_detalle_no_existe');
		}
	}
	else
	{

		$e->addTemplate('bloque_buscador');
		$e 	= $ControlHtml->ControlIdioma->publicarTextoTemplate($e);
		$e->showDataSimple($valores);
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','1');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']);

		$agno = $valores['anno'];
		if(trim($agno) == '')
		{
			$agno = date("Y");
			$valores['anno'] = $agno;
		}

		$e->setVariable('titulo',$menu[0]['titulo_'.VarSystem::obtenerIdiomaActual()]);
		$e->setVariable('doi',$menu[0]['doi']);
		$bloque_tipo = 'bloque_elemento';
		$tipo 		= 1;
		//$ControlPublicaciones = new ControlPublicaciones();

		$publicacion = $valores["publicacion_flag"];


		if(!is_array($listado) || count($listado) == 0)
		{
			$ControlPublicaciones = new ControlPublicaciones();
			$agno = $ControlHtml->ControlIdioma->obtenerVariable('publicaciones_filtro_todo');
			$listado 	= $ControlPublicaciones->obtenerListadoPorTipoAgno($tipo);
		}

		/***************** BUSCADOR ********************/

		if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
		{
			if(!$valores and $valoresGet["busca_palabra"]!="") $valores["busca_palabra"]=$valoresGet["busca_palabra"];
			if($valoresGet["busca_Autor"]!="") $valores["busca_Autor"]=$valoresGet["busca_Autor"];
			if($valoresGet["busca_tipoPublica"]!="") $valores["busca_tipoPublica"]=$valoresGet["busca_tipoPublica"];
			if($valoresGet["busca_Autor_id"]!="") $valores["busca_Autor_id"]=$valoresGet["busca_Autor_id"];
			if($valores["busqueda_flag"]=="") $valores["busqueda_flag"]=$valoresGet["busqueda_flag"];
			$tipoBusqueda	= $valores["busqueda_flag"];
			$ControlPublicaciones = new ControlPublicaciones();
           // array($valores['busca_Autor']["nombre_publicacion"]);

            $val_buscar= array('Autor',"word|palabra","simple|Autor_id","Anno","Area","tipoDocumento","nameRange|rangoNombre");
            $val_qry_busca= array("nombre_publicacion","palabra","id_persona","pub.agno","pub.id_area","pub.id_tipo","apellido_paterno");
            $valoresBusqueda = array_combine($val_buscar, $val_qry_busca);
            $valBusquedaPalabra = array("publ.titulo","publ.resumen");

			list($listado,$inicio,$final,$numPags) = $ControlHtml->MantenedoresGeneral->buscardorGeneral($valores, $ControlPublicaciones, $tipoBusqueda,0, $valoresBusqueda, $valBusquedaPalabra);
			foreach($valores as $var => $val)
			{
				$e->addTemplate('bloque_asignacion_valores_formulario');
				$e->setVariable('variable',$var);
				$e->setVariable('valor',$val);
			}

		}
		/***************** FIN BUSCADOR ********************/

		$total = count($listado);

		//print_r($listado );

		if(is_array($listado) && $total > 0)
		{
			// print_r($listado);
			$ControlPublicacionesPersona = new ControlPublicacionesPersona();
			for($i=0; $i < $total; $i++)
			{

				$e->addTemplate($bloque_tipo);
				if($listado[$i]['bib_capitulo']!=''){ $listado[$i]['bib_capitulo']= $listado[$i]['bib_capitulo'].", ";}
				if($listado[$i]['bib_paginas']!=''){ $listado[$i]['bib_paginas']= " (pp.".$listado[$i]['bib_paginas']."). ";}
				if($listado[$i]['bib_pais']!=''){ $listado[$i]['bib_pais']= ", ".$listado[$i]['bib_pais'].": ";}
				if(($listado[$i]['id_tipo']!='2' && $listado[$i]['id_tipo']!='4') && trim($listado[$i]['doi'])!=''){
					$e->setVariable('alink',"<a href='https://doi.org/".$listado[$i]['doi']."' target='_blank'>");
					$e->setVariable('endlink','</a>');
				}
				$e->showDataSimple($listado[$i]);
				$autores = $ControlPublicacionesPersona->obtenerListadoPersonas($listado[$i]['id_publicaciones']);
				$e->setVariable('autores',$autores);
				if($listado[$i]['bib_volume']!=''){ $listado[$i]['bib_volume']= ", ".$listado[$i]['bib_volume'];}
				$e->setVariable('volumen',$listado[$i]['bib_volume']);
				if(trim($listado[$i]['ver_detalle']) == '1')
				{
					$e->addTemplate($bloque_tipo.'_bloque_elemento_ver_detalle');
					$e->showDataSimple($listado[$i]);
				}
				else
				{
					if(trim($listado[$i]['documento']) != '')
					{
						$e->addTemplate($bloque_tipo.'_bloque_elemento_documento');
						$e->showDataSimple($listado[$i]);
					}
					if(trim($listado[$i]['link']) != '')
					{
						$e->addTemplate($bloque_tipo.'_bloque_elemento_link');
						$e->showDataSimple($listado[$i]);
					}

				}

			}

			/*---------  PAGINACION   -----------------*/

			$e->addTemplate('bloque_elemento_paginacion');
		 	$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
		 	/*--------- FIN PAGINACION   -----------------*/
		}

	}
  	/* MUESTRA DE AGNOS PARA FILTRO LATERAL */

	$ControlPublicaciones = new ControlPublicaciones();
	$agnos	 	= $ControlPublicaciones->obtenerAgnosPublicaciones($tipo);
  	for($i=0; $i < count($agnos); $i++)
  	{
  		if(trim($agnos[$i]['agno']) == '')
  		{
			continue;
		}
	  	$e->addTemplate('bloque_publicaciones_filtro_agno');
	  	$e->setVariable('agno',$agnos[$i]['agno']);
  	}
  	$e->addTemplate('bloque_publicaciones_filtro_agno');
  	$e->setVariable('agno',$ControlHtml->ControlIdioma->obtenerVariable('publicaciones_filtro_todo'));


 	/** FILTRO POR AREA ***/
 	$ControlAreas = new ControlAreas();
 	$areas = $ControlAreas->obtenerListado();
 	//Funciones::mostrarArreglo($areas,true);
 	for($i=0; $i < count($areas); $i++)
  	{
  		$areas[$i]['area_show'] = $areas[$i]['area_'.VarSystem::obtenerIdiomaActual()];
	  	$e->addTemplate('bloque_publicaciones_filtro_area');
	  	$e->showDataSimple($areas[$i]);
	  	$e->addTemplate('bloque_publicaciones_filtro_area_lateral');
	  	$e->showDataSimple($areas[$i]);
  	}


 	/** FILTRO POR TIPO DE PUBLICACIONES ***/
  	$ControlTipoPublicaciones = new ControlTipoPublicaciones();
  	$tipos = $ControlTipoPublicaciones->obtenerListado();
 	//Funciones::mostrarArreglo($tipos,true);
 	for($i=0; $i < count($tipos); $i++)
  	{
	  	$e->addTemplate('bloque_publicaciones_filtro_tipo');
	  	$e->showDataSimple($tipos[$i]);
	  	$e->addTemplate('bloque_publicaciones_filtro_tipo_lateral');
	  	$e->showDataSimple($tipos[$i]);
  	}

	$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'publicaciones','1',$valoresGet["page"]);
	echo $e->toHtml();

?>
