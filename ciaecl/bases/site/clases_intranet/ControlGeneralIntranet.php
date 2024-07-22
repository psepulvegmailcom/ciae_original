<?php


	class ControlGeneralIntranet extends ControlGeneral
	{
		function ControlGeneralIntranet($path_admin,$ControlHtml)
		{
			parent::ControlGeneral($path_admin,$ControlHtml); 			
			$this->valores 		= VarSystem::getPost();
            $this->valoresGet   = VarSystem::getGet();
			//Funciones::mostrarArreglo($this,true);
			
			$this->FormGeneral  = new FormGeneral();  
		}
		
		function formularioPersonasMultiples($ObjetoPersona,$valores)
		{				
			$total = count($valores['persona_extra_nombre']);
			for($i=0; $i < $total; $i++)
			{
				if((trim($valores['persona_extra_nombre'][$i]) != '' && $valores['persona_extra_id'][$i] == 1) 
				|| (trim($valores['persona_extra_nombre'][$i]) == '' && $valores['persona_extra_id'][$i] > 1))
				{ 
					$PPersona = new $ObjetoPersona;
					$PPersona->id_persona 				= $valores['persona_extra_id'][$i];
				 	$PPersona->$valores['id_tipo'] 		= $valores['id_item'];
					$PPersona->orden 					= $valores['persona_extra_orden'][$i];
					$PPersona->cargo 					= $valores['persona_extra_cargo'][$i];
					$PPersona->destacado 				= $valores['persona_extra_destacado'][$i];
					$PPersona->$valores['p_extra'] 		= '';
					if($PPersona->id_persona == 1)
					{
						$PPersona->$valores['p_extra'] 	= $valores['persona_extra_nombre'][$i];
					} 
					
					$PPersona->guardarObjeto();
				}
			} 					
		}
		
		function guardarPersonasMultiples($ObjetoPersona,$valores,$i)
		{
				$ObjetoPersona->id_publicaciones	= $valores['id_item'];
				$ObjetoPersona->id_persona 			= $valores['persona_extra_id'][$i];
				$ObjetoPersona->persona_nombre 		= $valores['persona_extra_orden'][$i];
				$ObjetoPersona->orden 				= $valores['persona_extra_cargo'][$i];
				if($ObjetoPersona->id_persona == 1)
				{
					$ObjetoPersona->persona_nombre 	= $valores['persona_extra_nombre'][$i];	
				} 
				$ObjetoPersona->guardarObjeto();		
		}
		
		function eliminarPersonasMultiples($ObjetoClase,$valores)
		{
			$Personas = $ObjetoClase;
			$Personas->id_persona 		= $valores['persona_eliminar_id'];
			$Personas->id_proyecto			    = $valores['id_item'];	
			$Personas->id_publicaciones			= $valores['id_item'];
			$Personas->orden 			= $valores['persona_eliminar_orden'];
			$Personas->persona_nombre 	= $valores['persona_eliminar_nombre']; 
			$Personas->eliminarObjetoPersona();		
		}
		
		function eliminarPublicacionPersona($id_publicaciones)
		{
			$PublicacionesPersona = new PublicacionesPersona();
			$PublicacionesPersona->id_persona 		= 1;
			$PublicacionesPersona->id_publicaciones	= $id_publicaciones;
			$PublicacionesPersona->orden 			= 30;
			$PublicacionesPersona->persona_nombre 	= ''; 
			$PublicacionesPersona->eliminarObjetoPersona();	 
		}
				
		function guardarArchivos($archivos, $valores, $path, $tipoArchivo, $nuevoNombre)
		{		
			$path  = VarSystem::getPathVariables('dir_repositorio').$path; 
			if(is_array($archivos['form_'.$tipoArchivo]) && $archivos['form_'.$tipoArchivo]['size'] > 0)
			{				
				$archivos['form_'.$tipoArchivo]['new_name'] = $nuevoNombre; 
				$DocumentFile  = new DocumentFile($path);  
				$DocumentFile->setFileArray($archivos['form_'.$tipoArchivo]); 
				if($DocumentFile->saveFile(false))
				{
					$ObjetoClase->$tipoArchivo  = $DocumentFile->getFileName();					
				}								
			}
			return($ObjetoClase->$tipoArchivo);	
		}
		
		function asociarSitio($ObjetoClase,$valores,$id)		
		{
			$PSitio = new $ObjetoClase;
			$PSitio->$valores['id_tipo'] 	= $id;				
			$PSitio->id_site 				= $valores['sitio_usuario'];
			$PSitio->guardarObjeto();	
		}
		
		function personaRelacionSitio($ObjetoClase,$valores,$datos,$id)		
		{
		 	$datos = $valores['formexterno_tipo_persona'];
		 	for($i=0; $i < count($datos);$i++)
		 	{
		 		$PersonaRelacionTipo = new $ObjetoClase;
				$PersonaRelacionTipo->id_persona = $id;
				$PersonaRelacionTipo->id_tipo	 = $datos[$i];
				$PersonaRelacionTipo->id_site	 = $valores['sitio_usuario'];
				$PersonaRelacionTipo->guardarObjeto();
			}	
		}		
		
		function personaRelacionArea($ObjetoClase,$valores,$id)		
		{
		 	$areas = $valores['formexterno_area'];
		 	for($i=0; $i < count($areas);$i++)
		 	{
		 		$PersonaRelacionArea = new $ObjetoClase;
				$PersonaRelacionArea->id_persona = $id;
				$PersonaRelacionArea->id_area	 = $areas[$i];
				$PersonaRelacionArea->guardarObjeto();
			}	
		}				
		
		function mesesInicio()		
		{
			$meses_inicio[]['mes_inicio'] =  "01-Enero";
			$meses_inicio[]['mes_inicio'] =  "02-Febrero";
			$meses_inicio[]['mes_inicio'] =  "03-Marzo";
			$meses_inicio[]['mes_inicio'] =  "04-Abril";
			$meses_inicio[]['mes_inicio'] =  "05-Mayo";
			$meses_inicio[]['mes_inicio'] =  "06-Junio";
			$meses_inicio[]['mes_inicio'] =  "07-Julio";
			$meses_inicio[]['mes_inicio'] =  "08-Agosto";
			$meses_inicio[]['mes_inicio'] =  "09-Septiembre";
			$meses_inicio[]['mes_inicio'] =  "10-Octubre";
			$meses_inicio[]['mes_inicio'] =  "11-Noviembre";
			$meses_inicio[]['mes_inicio'] =  "12-Diciembre";
			return $meses_inicio;	
		}
		
		function guardarLinksArchivos($ObjetoClase, $archivos, $valores, $archivosFile, $id)
		{	
			$links = $valores['formlink'];

			$path_doc  		= VarSystem::getPathVariables('dir_repositorio').'doc/noticias/';
			$filas_externas = 10;		
			for($i=0; $i <= $filas_externas; $i++)
			{
				if(trim($links['url'][$i]) != '')
				{
					$links['tipo'][$i] = 'url';
				}
				if($valores['formlink_file_'.$i]!= '' )
				{ 	
				/*	$DocumentFile  	= new DocumentFile($path_doc); 
					$DocumentFile->checkPath(); 
					$DocumentFile->setFileArray($archivosFile[$archivos[$i]]);
					$archivosFile['formlink_file_'.$i]['new_name'] = $id.'_'.Funciones::cleanChar($archivosFile[$archivos[$i]]['name']);  
					$DocumentFile->setFileArray($archivosFile['formlink_file_'.$i]); 					 
					if($DocumentFile->saveFile(false))
					{ */
				
						$nameImagen = $valores['name_file_'.$i];
						$ext = end(explode(".", $valores['formlink_file_'.$i]));			
						$valores['formlink_file_'.$i]= $nameImagen.".".$ext;
						$links['tipo'][$i] = 'doc';
						$links['url'][$i]	= $valores['id_item'].'_'.$valores['formlink_file_'.$i]; 
					//	$links['url'][$i]	= $DocumentFile->getFileName(); 
				//	}			 				
				}
				if(trim($links['url'][$i]) == '')
				{
					continue;
				}
				
				$NoticiasLink = new $ObjetoClase;
				$NoticiasLink->id_noticia 	= $valores['id_item'];
				$NoticiasLink->link 		= $links['url'][$i];
				$NoticiasLink->texto 		= $links['texto'][$i];				
				$NoticiasLink->tipo 		= $links['tipo'][$i];
				$NoticiasLink->orden 		= $links['orden'][$i];

				$NoticiasLink->guardarObjeto();
			}
		}
		
		function guardarImagenesNoticia($ObjetoClase, $archivos, $valores, $archivosFile, $id)
		{	
			$path_doc  = VarSystem::getPathVariables('dir_repositorio').'image/noticias/';			
			$formimagen_elimnar = $valores['formimagen_elimnar'];
			if(is_array($formimagen_elimnar) && count($formimagen_elimnar) > 0)
			{  
				for($i=0; $i < count($formimagen_elimnar); $i++)
				{
					$ObjetoClase->$formimagen_elimnar[$i] = '';
				}
				$ObjetoClase->guardarObjeto($id);
			} 
			/* GUARDANDO FOTOS EN REPOSITORIO */
			$archivosFile	= VarSystem::getFile();  			
			$archivos 		= array('form_imagen','form_imagen2','form_imagen3'); 
			for($i=0; $i < count($archivos); $i++)
			{ 
				if($archivosFile[$archivos[$i]]['error'] == '0' )
				{
					$DocumentFile  	= new DocumentFile($path_doc); 
					$DocumentFile->setFileArray($archivosFile[$archivos[$i]]);
					//$archivosFile[$archivos[$i]]['new_name'] = $ObjetoClase->id_noticia.'_'.Funciones::cleanChar($archivosFile[$archivos[$i]]['name']); 
					$archivosFile[$archivos[$i]]['new_name'] = $id.'-'; 
					$DocumentFile->setFileArray($archivosFile[$archivos[$i]]); 
					//Funciones::mostrarArreglo($DocumentFile,true);	
					//Funciones::mostrarArreglo($archivosFile[$archivos[$i]],true);	
					if($DocumentFile->saveFile(false))
					{   //Funciones::mostrarArreglo($DocumentFile,true);	
						$aux = str_replace('form_','',$archivos[$i]);
						$ObjetoClase->$aux  = $DocumentFile->getFileName(); 
						//Funciones::mostrarArreglo($ObjetoClase,true);
					}			 				
				} 
			} 
		} 
	
		function mostrarFormularioSitios($e,$sitios,$datos_asociados,$recursos_sitios=array())
		{	
//			Funciones::mostrarArreglo($datos_asociados,false,'mostrarFormularioSitios datos_asociados');		 
//			Funciones::mostrarArreglo($sitios,false,'mostrarFormularioSitios sitios');
			
			$recursos_sitios_seleccion = array();
			if(is_array($recursos_sitios) && count($recursos_sitios) > 0)
			{
				/* el recurso tiene selecciones anteriores y se mostrar el el formulario */ 
				for($i=0; $i < count($recursos_sitios); $i++)
				{
					$recursos_sitios_seleccion[$recursos_sitios[$i]['id_site']] = $recursos_sitios[$i];
				}
			} 
				
//			Funciones::mostrarArreglo($recursos_sitios,false,'mostrarFormularioSitios recursos_sitios');
//			Funciones::mostrarArreglo($recursos_sitios_seleccion,false,'mostrarFormularioSitios recursos_sitios_seleccion'); 
			
			$total_sitios = count($sitios);
			if(is_array($sitios) && $total_sitios > 0 )
			{  
				$f = new miniTemplate(VarSystem::getPathVariables('dir_template').'site/admin/form_sitios.tpl');
				$v = new miniTemplate(VarSystem::getPathVariables('dir_template').'site/admin/form_sitios_validacion.tpl');
				for($i=0; $i < $total_sitios; $i++)
				{
					$sitios[$i]['seleccionado'] = false;
					$f->addTemplate('bloque_sitios_usuarios_global');
					$f->setVariable('fila',$i);	
					
			 		if(isset($recursos_sitios_seleccion[$sitios[$i]['id_site']]) && is_array($recursos_sitios_seleccion[$sitios[$i]['id_site']]))
					{
						$f->setVariable('checked_id_site','checked');
						$sitios[$i]['seleccionado'] = true;
					} 
					
					$v->addTemplate('bloque_sitios_usuarios_global');
					$v->setVariable('fila',$i);					
					foreach($sitios[$i] as $var => $val)
					{
						$f->setVariable($var,trim($val));
					}  
				 
				 	foreach($datos_asociados as $campo => $valores_asociados)
				 	{
						switch($valores_asociados['tipo'])
						{
							case 'tipo_recurso_estructura':

								$f->addTemplate('bloque_sitios_usuarios_global_id_tipo_estructura');
								$f->setVariable('fila',$i);				
								$ControlTipoRecursosEstructura = new ControlTipoRecursosEstructura();
								if(!isset($valores_asociados[$campo]['tipo_recursos_estructura'][$sitios[$i]['id_site']]))
								{
									$valores_asociados[$campo]['tipo_recursos_estructura'][$sitios[$i]['id_site']] = $ControlTipoRecursosEstructura->obtenerListado($sitios[$i]['id_site']); 
								}
								//Funciones::mostrarArreglo($valores_asociados[$campo],false,'datos estructura sitios '.$sitios[$i]['id_site']);
								$f = $this->MantenedoresGeneral->mostrarListadoGenerico($f,$valores_asociados[$campo]['tipo_recursos_estructura'][$sitios[$i]['id_site']],'bloque_sitios_usuarios_global_id_tipo_estructura_elemento');  
								
								if($sitios[$i]['seleccionado'])
								{
									$f->addTemplate('bloque_sitios_usuarios_global_id_tipo_estructura_selected');
									$f->setVariable('fila',$i);	
									$f->setVariable('valor',$recursos_sitios_seleccion[$sitios[$i]['id_site']]['id_tipo_estructura']);	 
								} 
								$v->addTemplate('bloque_sitios_usuarios_global_id_tipo_estructura');
								$v->setVariable('fila',$i);	 
							break;
							case 'tipo_recurso':
								
								$f->addTemplate('bloque_sitios_usuarios_global_id_tipo');
								$f->setVariable('fila',$i);				
								$ControlTipoRecursos = new ControlTipoRecursos();
								if(!isset($valores_asociados[$campo]['tipo_recursos'][$sitios[$i]['id_site']]))
								{
									$valores_asociados[$campo]['tipo_recursos'][$sitios[$i]['id_site']] = $ControlTipoRecursos->obtenerListado($sitios[$i]['id_site']);
								}
								//Funciones::mostrarArreglo($valores_asociados[$campo]['tipo_recursos'][$sitios[$i]['id_site']],false,'datos sitios 222');
								$f = $this->MantenedoresGeneral->mostrarListadoGenerico($f,$valores_asociados[$campo]['tipo_recursos'][$sitios[$i]['id_site']],'bloque_sitios_usuarios_global_id_tipo_elemento');  
								
								if($sitios[$i]['seleccionado'])
								{
									$f->addTemplate('bloque_sitios_usuarios_global_id_tipo_selected');
									$f->setVariable('fila',$i);	
									$f->setVariable('valor',$recursos_sitios_seleccion[$sitios[$i]['id_site']]['id_tipo']);			
									
								}
								
								$v->addTemplate('bloque_sitios_usuarios_global_id_tipo');
								$v->setVariable('fila',$i);	  
							break;
							default:
								$f->addTemplate('bloque_sitios_usuarios_global_'.$valores_asociados['tipo']);
								$f->setVariable('fila',$i);	
								if($sitios[$i]['seleccionado'])
								{									
								 	$f->setVariable('selected_'.$recursos_sitios_seleccion[$sitios[$i]['id_site']][$valores_asociados['tipo']],'selected');
								}								
								$v->addTemplate('bloque_sitios_usuarios_global_'.$valores_asociados['tipo']);
								$v->setVariable('fila',$i);				
							break;
						}
					}
				} 
				 
				//$f = $this->MantenedoresGeneral->mostrarListadoGenerico($f,$sitios,'bloque_sitios_usuarios_id'); 
				 
				
				$e->addTemplate('bloque_sitios_usuarios');
				$e->setVariable('contenido',$f->toHtml()); 
				$e->addTemplate('bloque_sitios_usuarios_validacion');
				$e->setVariable('contenido',$v->toHtml()); 
			} 
			 
			return $e;
		}	
		
		function limpiezaPalabrasClaves($texto,$palabras)
		{
			/* RECIBE PALABRAS COMPLETAS, TAL COMO SE INGRESO, PARA EVITAR DUPLICACIONES */
			//Funciones::mostrarArreglo('--'.htmlentities($texto).'--',true);
			$aux = explode(',',html_entity_decode(trim($texto)));
		 
			//Funciones::mostrarArreglo($aux,true);
			for($i=0; $i < count($aux); $i++)
			{
				$aux2 = str_replace("  "," ", trim($aux[$i]));
				$aux2 = str_replace(" ","_",$aux2);
				$palabras[$aux2] = $palabras[$aux2] + 1;
			}
			//Funciones::mostrarArreglo($palabras,true);
			return $palabras;
		}	
		
		function transformacionPalabrasClaves($palabras)
		{
			/* OBTIENE EL ARREGLO CON LAS PALABRAS UNIFICADAS, AHORA LO TRANSFORMAMOS A TEXTO CONTINUE CON COMAS */
			$salida = '';
			foreach($palabras as $palabra => $uno)
			{
				$salida .= str_replace("_"," ",$palabra).', '; 
			}
			$salida = substr(trim($salida), 0, -1);
			return $salida;
		}		 					
	}
	 
?>