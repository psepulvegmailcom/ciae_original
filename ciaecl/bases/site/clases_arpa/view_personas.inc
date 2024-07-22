<?php

	global $ControlHtml;
  	$PersonaControl = new PersonaControl();
  	$valores 	= VarSystem::getPost();
  	$valoresGet = VarSystem::getGet();
 
  	if(!isset($valoresGet['case']))
  	{
		if($valoresGet['case']!='view_egresados')
		{
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/listado.tpl');

			 
				if($valoresGet['page']=='view_equipo_arpa')
				{					
					$e->addTemplate('bloque_elemento_lateral_qs');
				}
						
		}
		$e->setVariable('mt','mt-0');
	  	switch($ControlHtml->lastActionArray[0])
	  	{
			case 'view_equipo_direccion':
				$grupo = 'direccion_ie';
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/listado_equipo_direccion.tpl');
			break;
			case 'view_personas_direccion':
				$grupo = 'direccion';
			break;
			case 'view_personas_investigadores':
				$e->setVariable('variableMenu','pt-0');
				$e->setVariable('mt','');
				$grupo = 'investigadores';
				$e->addTemplate('bloque_banner_academicos');
			break;			
			case 'view_equipo_arpa':
				$e->setVariable('variableMenu','pt-0');
				$e->setVariable('mt','');
				$grupo = 'arpa';
				$e->addTemplate('bloque_banner_academicos');
			break;
			case 'view_personas_profesores':
				$e->setVariable('variableMenu','pt-0');
				$e->setVariable('mt','');
				$grupo = 'profesores';
				$e->addTemplate('bloque_banner_academicos');
			break;
			case 'view_personas_investigadores_asistentes':
				$grupo = 'investigadores_asistentes';
			break;
			case 'view_personas_gestion':
				$grupo = 'gestion';
			break;
			case 'view_personas_mm':
				$grupo = 'investigadores';
			break;
			case 'view_egresados':
			$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'listado_egresados.tpl');
				$grupo = 'egresados';
			break;			
			default:
				$grupo = str_replace('view_personas_','',$ControlHtml->lastActionArray[0]);
			break;
		} 
		$rango= $valoresGet["busca_rango"];
		$e->setVariable('page',$valoresGet["page"]);
		$personas = $PersonaControl->obtenerListadoPersonasTipo($grupo,$rango);

		
		$total = count($personas); 
		switch($ControlHtml->lastActionArray[0])
	  	{ 
			default: 
				$anterior = '';
				$columnas = 4;
				$columnasvan = 0;
				$universidad = '';
				$grupo_extra = 'investigadores';
				Funciones::mostrarArreglo($personas);
				for($i=0; $i < $total; $i++)
				{  
				  if($anterior != $personas[$i]['id_tipo'])
					{  
						$e->addTemplate('bloque_contenido_'.$grupo_extra); 
						$e->showDataSimple($personas[$i]); 
						if($columnasvan%$columnas != 0)
						{
							$e->addTemplate('bloque_contenido_'.$grupo_extra.'_tr_universidad'); 
							$e->setVariable('tipo',$personas[$i]['tipo']);
							$columnasvan = 0;
						} 
					}  
					if($personas[$i]['mostrar_universidad'] == 1 )
					{ 
						if(trim($universidad) != $personas[$i]['orden_universidad'])
						{
							$e->addTemplate('bloque_contenido_'.$grupo_extra.'_tr');  
							$columnasvan = 0;
							$e->addTemplate('bloque_contenido_'.$grupo_extra.'_tr_universidad');
							$e->setVariable('universidad',$personas[$i]['universidad']);
							$universidad = $personas[$i]['orden_universidad'];
						}
					} 
					if($columnasvan%$columnas == 0)
					{
						$e->addTemplate('bloque_contenido_'.$grupo_extra.'_tr');
						$columnasvan = 0;  
					} 
					if($personas[$i]['id_tipo'] == 17)
					{ 
						$e->addTemplate('bloque_contenido_'.$grupo_extra.'_td_listado');
					}
					else
					{						
						$e->addTemplate('bloque_contenido_'.$grupo_extra.'_td');
					}
					$e->showDataSimple($personas[$i]); 
					if($grupo == 'gestion'  )
					{
						$e->addTemplate('bloque_contenido_'.$grupo_extra.'_td_cargo');	
						$e->showDataSimple($personas[$i]);  
					}					
					$anterior = $personas[$i]['id_tipo']; 
					$columnasvan++; 
				} 
				
				if(VarSystem::getPathVariables('web_site') == 'web_mejormatematica')
				{
					$ControlNoticias = new  ControlNoticias();
					$elementos = $ControlNoticias->obtenerNoticiasRecientes();
					if(is_array($elementos) && count($elementos)>0)
					{
						$e->addTemplate('bloque_noticia_reciente');   
						
						$max_noticias = count($elementos);
						for($i=0; $i <  $max_noticias;$i++)
						{
							$e->addTemplate('bloque_noticia');
							if(trim($elementos[$i]['imagen']) == '')
							{
								$elementos[$i]['imagen'] = 'blanco.jpg';
							}
							$elementos[$i]['fecha_html_full']  = ControladorFechas::traducirMes($elementos[$i]['fecha'],'en-es');
							$e->showDataSimple($elementos[$i]);
						}
					} 
				} 
			break; 
		}
	}
	else
	{
		if(trim($valoresGet['case']) == 'ficha') /* CASO MUESTRA FICHA DE LA PERSONA */
		{
			$ControladorHTML = new ControladorHTML();
			$personas = $PersonaControl->obtenerListadoPersonasTipo($grupo,$rango, $valoresGet['id']); 
			
			if(is_array($personas))
			{				
				if ($valoresGet["page"]=='view_personas_gestion')
				{					
					$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/ficha_gestion.tpl');					
				}
				else
				{ 
					$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/ficha.tpl'); 
				}
				if(trim($personas[0]['grado'])!='') 
				{
					$e->setVariable('titulo','Título');
					$e->setVariable('grado',$personas[0]['grado']);
				}
				if(trim($personas[0]['archivo_cv']) !='' ) 
				{
					$e->setVariable('CV','CV');
					$e->setVariable('icono_cv','fas fa-user');
				}
				if(trim($personas[0]['cv']) !='' ) 
				{
					$e->setVariable('Bio','Bio');
					$e->setVariable('icono_bio','far fa-file-alt');
				}
				if($personas[0]['url']!='') 
				{
					$e->setVariable('Sitio','Sitio Web');
					$e->setVariable('icono_url','fas fa-address-card');
				}
		 		$datos = array('caso'=>'personas','id'=>$valoresGet['id'],'template'=>$e);
		 		$datos['template'] = $ControladorHTML->desplegarAreas($datos); 

		 		$datos['template'] = $ControladorHTML->desplegarProyectosPersona($datos); 
		 		
			/*	if ($datos['id']=='3'){	
					$datos['titulo_template'] = "<h4> Publicaciones </h4>"; 													
				}*/
				 			
				$e = $ControladorHTML->desplegarPublicacionesPersona($datos);

				$e->setVariable('opcion',$ControlHtml->lastActionArray[0]);
				$campo_enter = array('afiliacion','grado','cargo','telefono','url');
				foreach($personas[0] as $var => $val)
				{  
					$clave = array_search($var,$campo_enter);
					if($var == 'url')
					{
						$e->setVariable('url_html', trim($val));	
					}
					if(is_numeric($clave) && trim($val) != '' )
					{
						$val = trim($val)."\n\n";
					} 
					$e->setVariable($var, trim(nl2br($val)));
					  
				}  


				$proyectos = $PersonaControl->obtenerProyecto($valoresGet['id']);
				if(count($proyectos) > 0 && is_array($proyectos))
				{
					$e->addTemplate('bloque_contenido_especial');
					$e->setVariable('titulo_bloque','Proyectos'); 
					

					$total = count($proyectos); 
					for($i=0; $i < $total; $i++ )
					{
						$e->addTemplate('bloque_especial_listado_link');
						$e->setVariable('listado_blque',$proyectos[$i]['proyecto']);
						if(trim($proyectos[$i]['codigo']) != '')
						{
							$proyectos[$i]['codigo'] = $proyectos[$i]['codigo'].' - ';
						}
						$e->setVariable('texto_extra',$proyectos[$i]['codigo']);
						$e->setVariable('opcion','view_proyectos');
						$e->setVariable('case','ficha');
						$e->setVariable('id',$proyectos[$i]['id_proyecto']); 
					} 
				}  
			 
				if($valoresGet['page']=='view_direccion_ficha')
				{					
					$e->addTemplate('bloque_menu_lateral_quienes');
				}
				elseif($valoresGet['page']=='view_equipo_arpa')
				{					
					$e->addTemplate('bloque_elemento_lateral_qs');
				}
				else
				{ 
					$e->addTemplate('bloque_menu_lateral_general');	
				}
 				
			}
			else
			{
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/no_existe.tpl'); 
			}
		}
		else
		{
		
			if(trim($valoresGet['case']) == 'fichaBio') /* CASO MUESTRA FICHA DE LA PERSONA */
			{
			  $ControladorHTML = new ControladorHTML();
			  $personas = $PersonaControl->obtenerListadoPersonasTipo($grupo,$rango, $valoresGet['id']); 
			  $e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/fichaBio.tpl');
			  $datos = array('caso'=>'personas','id'=>$valoresGet['id'],'template'=>$e);

			  		foreach($personas[0] as $var => $val)
				{  
					$clave = array_search($var,$campo_enter);
					if($var == 'url')
					{
						$e->setVariable('url_html', trim($val));	
					}
					if(is_numeric($clave) && trim($val) != '' )
					{
						$val = trim($val)."\n\n";
					} 
					$e->setVariable($var, trim(nl2br($val)));
					  
				}
				  		
			}		 
		}
	}
    
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