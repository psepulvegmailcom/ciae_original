<?php

	global $ControlHtml;
  	$PersonaControl = new PersonaControl();
  	$valores 	= VarSystem::getPost();
  	$valoresGet = VarSystem::getGet();

  	if(!isset($valoresGet['case']))
  	{
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/listado.tpl');
	  	switch($ControlHtml->lastActionArray[0])
	  	{
			case 'view_personas_direccion':
				$grupo = 'direccion';
			break;
			case 'view_personas_investigadores':
				$grupo = 'investigadores';
			break;
			case 'view_personas_investigadores_asistentes':
				$grupo = 'investigadores_asistentes';
			break;
			case 'view_personas_gestion':
				$grupo = 'gestion';
			break;
		} 
		$rango= $valoresGet["busca_rango"];
		$e->setVariable('page',$valoresGet["page"]);
		$personas = $PersonaControl->obtenerListadoPersonasTipo($grupo,$rango);
		Funciones::mostrarArreglo($personas);
		$total = count($personas);
		switch($ControlHtml->lastActionArray[0])
	  	{
			case 'view_personas_direccion':
				$anterior = '';
				for($i=0; $i < $total; $i++)
				{
					if($anterior != $personas[$i]['id_tipo'])
					{
						$e->addTemplate('bloque_contenido_'.$grupo);
						$e->showDataSimple($personas[$i]); 
					}
					$e->addTemplate('bloque_contenido_'.$grupo.'_item');
					$e->showDataSimple($personas[$i]); 
					$anterior = $personas[$i]['id_tipo'];
				} 
			break;
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
							$e->addTemplate('bloque_contenido_'.$grupo_extra.'_tr'); 
							$columnasvan = 0;
						} 
					}  
					if($personas[$i]['id_tipo'] == 5)
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
					$e->addTemplate('bloque_contenido_'.$grupo_extra.'_td');
					$e->showDataSimple($personas[$i]); 
					$anterior = $personas[$i]['id_tipo']; 
					$columnasvan++; 
				} 
			break; 
		}
	}
	else
	{
		if(trim($valoresGet['case']) == 'ficha')
		{
			$ControladorHTML = new ControladorHTML();
			$personas = $PersonaControl->obtenerListadoPersonasTipo($grupo,$rango, $valoresGet['id']); 
			Funciones::mostrarArreglo(array('PERSONAFICHA',$personas)); 
			 
			if(is_array($personas))
			{	
			
				if ($valoresGet["page"]=='view_personas_gestion'){					
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/ficha_gestion.tpl');
				}else{ 
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/ficha.tpl'); 
				}
		 		$datos = array('caso'=>'personas','id'=>$valoresGet['id'],'template'=>$e);
		 		$datos['template'] = $ControladorHTML->desplegarAreas($datos); 

		 		$datos['template'] = $ControladorHTML->desplegarProyectosPersona($datos); 
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
				//Funciones::mostrarArreglo($proyectos);
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
				$ControlPublicaciones = new ControlPublicaciones();
				$ControlPublicacionesPersona = new ControlPublicacionesPersona();
				$publicaciones = $ControlPublicaciones->obtenerListadoPorPersona($valoresGet['id']);
				//bloque_contenido_especial_publicacion
				Funciones::mostrarArreglo($publicaciones);
				if(count($publicaciones) > 0 && is_array($publicaciones))
				{
					$e->addTemplate('bloque_contenido_especial_publicacion');
					$e->setVariable('titulo_bloque','Publicaciones'); 
					$total = count($publicaciones); 
					for($i=0; $i < $total; $i++ )
					{
						$e->addTemplate('bloque_especial_listado_link2');
						
						$autores = $ControlPublicacionesPersona->obtenerListadoPersonas($publicaciones[$i]['id_publicaciones']);
						$titulo = $autores.' ('.$publicaciones[$i]['agno'].'). '.$publicaciones[$i]['titulo'];
						$e->setVariable('listado_blque',$titulo); 
						$e->setVariable('texto_extra',$publicaciones[$i]['codigo']);
						$e->setVariable('opcion','view_proyectos');
						$e->setVariable('case','ficha');
						$e->setVariable('id',$publicaciones[$i]['id_proyecto']); 
					} 
				} 
			}
			else
			{
				$e = new miniTemplate(VarSystem::getPathVariables('dir_template_web').'personas/no_existe.tpl'); 
			}
		} 
	}
	echo $e->toHtml();
?>