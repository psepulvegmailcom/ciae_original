<?php
	 
	 
	global $ControlHtml;
	$ControlRecursos = new ControlRecursos();
  	$valoresGet = VarSystem::getGet(); 
	$valores = VarSystem::getPost(); 
	$ControlGeneralSitios = new ControlGeneralSitios();

	if(!isset($valoresGet['id']))
	{		 
		$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'biblio_dig.tpl');
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','5');
		$ControladorDeMenu = new ControladorDeMenu();
		$menu = $ControladorDeMenu->getMenuOpcion($valoresGet['page']); 
		$ControlRecursos->sinFiltroIdioma();
			
		if($valoresGet['page']=='view_recursos')	
		{
             $valores["busqueda_flag"]=5;
			if (!$valores["pagina"])
			{ 
				$valores["pagina"]="";
			}
		}
		else
		{
			if(($valoresGet['page']!='view_recursos')&& ($valoresGet['id_tipo']!=''))	
			{	
			 	$valores["busqueda_flag"]=5;
			 	$valores["busca_idtipoRecurso"] = $valoresGet["id_tipo"];
                $valores["busca_opcion_sitio"] = $valoresGet['page'];
				if (!$valores["pagina"])
					 $valores["pagina"]="";
                $ControlTipoEstructura = new TipoRecursosEstructura();
                $ControlTipoEstructura->buscarObjeto($valoresGet['page']);
                $encabezado = $ControlTipoEstructura->tipo_estructura;
			}
		}	
			

		
		if(!$valoresGet['id_tipo'])
		{					
				if (($valores["tipoPublicacion"]!='')||($valoresGet["tipoPublicacion"]!=''))
				{
					if($valores["tipoPublicacion"]=="")
					{
						$valores["tipoPublicacion"]=$valoresGet["tipoPublicacion"];
					}
					$ControlRecursos = new ControlRecursos();
					$e->addTemplate('bloque_elemento_encabezado');
					$e->setVariable('encabeza',$encabezado);
					$listado = $ControlRecursos->obtenerRecursosPorTipo($valores["tipoPublicacion"]); 	               
						
				} else {																			
					/** HOME */							
				if ($valores["seteaTipo"]!=1 && $valoresGet["busca_palabra"]=="")
				{
					$ControlRecursos = new ControlRecursos(); 
				  
					
			if ($valoresGet['page']!=""){
			 
				    $elementos = $ControlRecursos->obtenerRecursosEstructuraSitio($valoresGet['page']);
					if(is_array($elementos) && count($elementos)>0)
					{							
						$e->addTemplate('bloque_recursos_'.$valoresGet['page']);   						
						$max_recursos = count($elementos);
						
						for($i=0; $i <  $max_recursos;$i++)
						{
							$e->addTemplate('bloque_'.$valoresGet['page']);
							if(trim($elementos[$i]['imagen']) == '')
							{
								$elementos[$i]['imagen'] = 'blanco.jpg';
							}
							$tipo = $ControlRecursos->obtenerTipoRecurso($elementos[$i]['id_tipo']);
							$elementos[$i]['tipo']= $tipo[0]['tipo']; 
							$elementos[$i]['bajada']= substr($elementos[$i]['bajada'], 0, 230)."..."; 
							$elementos[$i]['fecha_html_full']  = 
							ControladorFechas::traducirMes($elementos[$i]['fecha_html_full'],'en-es');
							$elementos[$i]['tituloAca'] = $elementos[$i]['titulo'];
							$e->setVariable('page',$valoresGet["page"]);
							$e->showDataSimple($elementos[$i]);
							
						}
					}                 
               }	
					
					
					$links = $ControlRecursos->obtenerRecursosLink();
					if(is_array($links) && count($links)>0) 
					{		
						//echo "-------links------";					
						$e->addTemplate('bloque_home_recursos_link');  
							$max_recursos = count($links);
						
						for($i=0; $i <  $max_recursos;$i++)
						{
							$e->addTemplate('bloque_recursos_link');

							if(trim($links[$i]['imagen']) == '')
							{
								$links[$i]['imagen'] = 'blanco.jpg';
							}
							$links[$i]['fecha_html_full']  = 
							ControladorFechas::traducirMes($links[$i]['fecha_html_full'],'en-es');
							$link[$i]['titulo'] = Funciones::limpiarSaltoLinea($links[$i]['titulo']);
							$e->showDataSimple($links[$i]);
						} 
					}
										
				  }
			   } 				  
			}   	

			/*-----------------Buscador ---------------*/
					
			if (($valores["busqueda_flag"]>0)||($valoresGet["busqueda_flag"]>0))
			{	
				if($valoresGet["busca_palabra"]!="") {
				$valores["busca_palabra"]=$valoresGet["busca_palabra"];
                }			
	         if($valores["busqueda_flag"]=="") $valores["busqueda_flag"]=$valoresGet["busqueda_flag"];
									
			   $tipoBusqueda  = $valores["busqueda_flag"];
			  // print_r($valores);
			   if($valores["busca_tipo"]=="archivos")
			    {
				   $ControlRecursos = new ControlRecursos();
				}
				else
				{			
			   	   $ControlRecursos = new ControlRecursos();
				}  
                    $val_buscar = array("tipoRecurso","tipo","word|palabra","simple|idtipoRecurso","opcion_sitio");
                    $val_qry_busca = array("rec.palabras_clave","ns.id_link","palabra","rec.id_tipo","rec.opcion_site");
                    $valoresBusqueda = array_combine($val_buscar, $val_qry_busca); 
                    
                    $valBusquedaPalabra = array("rec.titulo","rec.bajada");           
                 
				list($listado,$inicio,$final,$numPags) =  
				$ControlHtml->MantenedoresGeneral->buscardorGeneral($valores,$ControlRecursos, $tipoBusqueda, $tipoRecurso, $valoresBusqueda, $valBusquedaPalabra );
				//Funciones::mostrarArreglo(array($valores,$ControlRecursos, $tipoBusqueda, $tipoRecurso),true);
							  
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
					$e->addTemplate('bloque_elemento_enc');
					$e->setVariable('encabeza',$encabezado);
                    
					$listado  = ControladorFechas::traducirMes($listado,'en-es');
					if ($valores["busca_tipo"]=="2"){						 							
						$e->showBlock('bloque_elemento_link',$listado); 
					  }else{
						for($i=0; $i < $total; $i++)
						{								
							$listado[$i]["pagina_actual"] = $valoresGet["page"];	
						}										
						$e->showBlock('bloque_elemento',$listado);														
					}
					/*---------  Paginacion   ---------------------*/	
					$e->addTemplate('bloque_elemento_paginacion');				
					$e->setVariable('enlacePie',$ControlHtml->FormGeneral->paginamientoListado($pagina,$inicio,$final,$numPags ));
					/*--------- Fin Paginacion   -----------------*/					
				}														

	}
	else
	{ 
		/** MOSTRAR ELEMENTOS */	
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'recursos_ficha.tpl');
		$e->setVariable('url_site',VarConfig::path_site_www);
		$e->setVariable('url_site_encode',Funciones::cleanCharURL(VarConfig::path_site_www));
		$e->setVariable('url_encode',Funciones::cleanCharURL('&')); 
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','5');
		$elemento = $ControlRecursos->obtenerRecurso($valoresGet['id']);

		 //Funciones::mostrarArreglo($elemento);
		
		if(is_array($elemento) && count($elemento) > 0)
		{ 
			
			$ControlHtml->laPagina->setTitleSite($elemento[0]['titulo']);
			$ControlHtml->laPagina->setDescriptionSite($elemento[0]['bajada']);
			$ControlHtml->laPagina->setImagenFondo('imageview.php?image=recursos/'.$elemento[0]['imagen']);
						
			$elemento[0]['titulo'] = Funciones::limpiarSaltoLinea($elemento[0]['titulo']);
			 
			$elemento[0]['fecha_html_full']  = ControladorFechas::traducirMes($elemento[0]['fecha_html_full'],'en-es');
			
			$e->setVariable('title_encode',Funciones::cleanCharURL($elemento[0]['titulo']." :: ".VarConfig::site_title));
			
			$e->setVariable('titulo_encode' ,Funciones::cleanCharURL($elemento[0]['titulo'])); //." :: ".VarConfig::site_title));
			$e->setVariable('bajada_encode' ,Funciones::cleanCharURL($elemento[0]['bajada']));
			$e->setVariable('tipo' ,Funciones::cleanCharURL($elemento[0]['tipo']));

			$e->setVariable('imagen_decode',Funciones::cleanCharURL($elemento[0]['imagen']));
					
			$e->showDataSimple($elemento[0]);  

			if(trim($elemento[0]['bajada']) != '')
			{
				$e->addTemplate('bloque_elemento_bajada');
				$e->showDataSimple($elemento[0]);
			}
			
			if(trim($elemento[0]['video']) != '')
			{
				$e->addTemplate('bloque_elemento_video');
				$e->showDataSimple($elemento[0]);
			}
			if(trim($elemento[0]['imagen']) != '' && trim($elemento[0]['video']) == '')
			{
				$e->addTemplate('bloque_elemento_img');
				$e->showDataSimple($elemento[0]);
			}
			if(trim($elemento[0]['archivo']) != '' && trim($elemento[0]['id_tipo']) != '6')
			{
				$e->addTemplate('bloque_elemento_archivo');
				$e->showDataSimple($elemento[0]);
			}

			if(trim($elemento[0]['descripcion']) != '' )
			{
				$e->addTemplate('bloque_elemento_descripcion');
				$e->showDataSimple($elemento[0]);
			}			
			if(trim($elemento[0]['url']) != '')
			{
				$e->addTemplate('bloque_elemento_principal');
				$e->addTemplate('bloque_elemento_url');
				$e->showDataSimple($elemento[0]);	
			}
			if(trim($elemento[0]['id_tipo']) == '6')
			{
				$e->addTemplate('bloque_elemento_seminario');
				$e->showDataSimple($elemento[0]);	
			}
			if(trim($elemento[0]['id_tipo']) == '7')
			{
				$e->addTemplate('bloque_elemento_taller');
				$e->showDataSimple($elemento[0]);	
			}
			if(trim($elemento[0]['id_tipo']) == '8')
			{
				$e->addTemplate('bloque_elemento_taller_presentacion');
				$e->showDataSimple($elemento[0]);	
			}
			if(trim($elemento[0]['link_externo']) != '')
			{
				$e->addTemplate('bloque_elemento_link_externo');
				$e->setVariable('link_externo',$elemento[0]['link_externo']);
                $e->setVariable('link_externo_texto',$elemento[0]['link_externo_texto']);	
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
						
			$ControlRecursosLink = new ControlRecursosLink();
			$link = $ControlRecursosLink->obtenerLinks($valoresGet['id']);
			$total = count($link);
			//Funciones::mostrarArreglo($link);
			if(is_array($link) && $total > 0)
			{	
				$e->addTemplate('bloque_elemento_materiales');			
				for($k=0; $k < $total; $k++)
				{  
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
			
			if($elemento[0]['palabras_clave'] != '')
			{
			//	echo "valoresGet".$valoresGet["page"];
				$e->addTemplate('bloque_palabra_clave_general');
				$valores = $elemento[0]['palabras_clave']; 
				$valor = explode(',',trim($valores)); 
				$total = count($valor);						
				for ($i=0; $i< $total; $i++)
				{
					if($valor[$i]!='')
					{
						$e->addTemplate('bloque_palabra_clave');
						$e->setVariable('page',$valoresGet["page"]);
						$e->setVariable('busca_flag','5');
						$e->setVariable('palabra',trim($valor[$i]));
					}										
				} 		
			}  
		} 		
		else
		{
			$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'404.tpl'); 
		}
		
		if (VarSystem::getPathVariables('web_site')=='web_mejormatematica')
		{
			$e = $ControlGeneralSitios->mostrarNoticiasRecientes($e); 
		} 
	} 
	
	/* LISTADO BARRA LATERAL DE TIPOSDE RECURSOS DISPONIBLES */
	$ControlRecursosObjetoView = new ControlRecursosObjetoView();
	$estructura_base = $ControlRecursosObjetoView->obtenerListadoEstructuraTipo($ControlHtml->id_sitio);
	//Funciones::mostrarArreglo($estructura_base,true);
	$estructura_anterior = '';
	for($i=0; $i < count($estructura_base); $i++)
	{
		if($estructura_anterior != $estructura_base[$i]['id_tipo_estructura'])
		{
			$estructura_anterior = $estructura_base[$i]['id_tipo_estructura'];
			$e->addTemplate('bloque_menu_lateral_tipo_estructura_listado');
			foreach($estructura_base[$i] as $var => $val)
			{
				$e->setVariable($var,$val);
			}
		}
		$e->addTemplate('bloque_menu_lateral_tipo_estructura_listado_detalle');
		foreach($estructura_base[$i] as $var => $val)
		{
			$e->setVariable($var,$val);
		}		
	} 
													
		/** EVENTOS NOTICIAS */ 
	$ControlRecursos = new ControlRecursos();
	$elementos = $ControlRecursos->obtenerRecursosHome();
	$max_eventos = count($elementos);
	if(is_array($elementos) && $max_eventos > 0)
	{
		$e->addTemplate('bloque_home_palabras');
		$e->setVariable('page',$valoresGet["page"]);
		$e->setVariable('busca_flag','5'); 
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
		$ControlRecursos = new $ControlRecursos();
		$ControlPublicacionesPersona = new ControlPublicacionesPersona();
		
		$elementos = $ControlRecursos->obtenerRecursosHome();
		
		 //Funciones::mostrarArreglo($elementos,true);
		if(is_array($elementos) && count($elementos)>0)
		{
			$e->addTemplate('bloque_home_recursos_general');
			$max = VarSystem::getTotalListarHome();
			if(count($elementos) < $max)
			{
				$max = count($elementos);
			}
	
			for($i=0; $i < $max;$i++)
			{
				
				$e->addTemplate('bloque_home_recursos'); 
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
	 
	$e =  $ControlGeneralSitios->mostrarDatosNubePalabraClaves($e,$ControlHtml->id_sitio,'recursos','5',$valoresGet["page"],'8'); 


	echo $e->toHtml();
?>