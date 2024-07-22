<?php
 
 
	class ControlGeneralMantenedorNoticias extends ControlGeneral
	{
		function ControlGeneralMantenedorNoticias($path_admin,$ControlHtml)
		{
			parent::ControlGeneral($path_admin,$ControlHtml); 
            $this->valoresGet   = VarSystem::getGet();		 
			$this->ControlGeneralIntranet 		= new ControlGeneralIntranet();	
            $this->ControlClase  = new ControlNoticiaSitioObjeto();  
            //$this->ControlClase  = new ControlNoticiaObjeto();              
			$this->ControlClase->order = 'id_noticia DESC,'.$this->ControlClase->order ;   
			$this->ControlClase->group = ' id_noticia '; 
			$this->ObjetoClase  = new NoticiaObjeto();
			parent::setObjetos($this->ControlClase,$this->ObjetoClase);	
			$this->tipo_palabras_clave = 'noticias';            			
		} 
		 
   		function mostrarListado()
    	{
            $this->arregloCamposBusqueda =  array('titulo','autor','bajada','tipo','nombre_site','fecha','noticia', 'calendario_curso', 'costo_evento', 'requisitos', 'plan_estudio', 'perfil_egreso');
            $this->arregloCamposOrdenar  = 	array(array('titulo','T&iacute;tulo'), 
                                    		array('tipo','Tipo'),
                                    		array('fecha','Fecha'));
           
	        $this->arregloReportes = array(array('texto'=>'Descarga listado noticias y eventos','id_descarga'=>'reporte_noticias','explicacion' => 'Descarga de listado completo de noticias y eventos'));
            $this->arregloManualesUsuario = array(array('texto'=>'Manual mantenedor','doc_manual'=>'modulo_noticias','explicacion' => 'Descarga de manual de uso de mantenedor'));

            $this->palabra = $this->valores['buscar_filtro_busqueda'];
           	$this->valBusquedaPalabra = array("titulo","bajada");
            return parent::mostrarListado();
    	}

		function limpiezaListado()
		{
			$ControladorNoticiasSimple = new ControladorNoticiasSimple();
			$ControladorNoticiasSimple->eliminarVacias();
			$NoticiasLink = new NoticiasLink();
			$NoticiasLink->eliminarVacios();
		}


		function mostrarFormulario()
		{
			$e = new miniTemplate($this->path_admin.'form.tpl');
			
			//$e->setVariable('site',$SITE);
			 //Funciones::mostrarArreglo($this,true);
			$e = $this->FormGeneral->showHeaderForm($e,$this->lastAction,$this->valores); 
			$ListaDeObjetos = $this->ControlClase->obtenerElemento($this->valores['id_item']);
			//Funciones::mostrarArreglo($this,true);
			//var_dump($ListaDeObjetos['calendario_curso']);
			if(!is_array($ListaDeObjetos))
			{
				$ObjetoClaseNuevo  = new NoticiaObjeto();
				$ObjetoClaseNuevo->fecha = date("Y-m-d");
				$ObjetoClaseNuevo->usuario = $this->persona_datos['user_id'];
				$ObjetoClaseNuevo->id_noticia = $this->ControlClase->obtenerProximoID();
				//Funciones::mostrarArreglo($ObjetoClaseNuevo,true);
				$ObjetoClaseNuevo->guardarObjeto();
				$ObjetoClaseNuevo->buscarObjeto($ObjetoClaseNuevo->id);
				$ListaDeObjetos = $this->ControlClase->obtenerElemento($ObjetoClaseNuevo->id_noticia);

				$ListaDeObjetos[0]['id_noticia_nuevo'] = $ObjetoClaseNuevo->id_noticia;
				$ListaDeObjetos[0]['fecha_html'] = date("d-m-Y");
				$ListaDeObjetos[0]['autor'] = $this->persona_datos['nombre'].' '.$this->persona_datos['apellido_paterno'].' - Comunicaciones CIAE';
				$ListaDeObjetos[0]['idioma'] = 'es';
				$ListaDeObjetos[0]['tipo'] = 'noticia';
				$ListaDeObjetos[0]['noticia'] = '....';
				$ListaDeObjetos[0]['id_item'] = $ObjetoClaseNuevo->id_noticia;
			}
			else
			{
				//$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
				$ListaDeObjetos[0]['id_item'] = $this->valores['id_item'];
			}

			//$ListaDeObjetos[0]['imagen'] = '511--1401116972.jpg';
			$ListaDeObjetos[0]['path_galeria']	= 'image/noticias/'.$ListaDeObjetos[0]['id_item'].'/';
			$ListaDeObjetos[0]['path_archivo']	= 'doc/noticias/';
			$ListaDeObjetos[0]['path_imagen']	= 'image/noticias/';
			$ListaDeObjetos[0]['usuario'] 		= $this->persona_datos['user_id'];
			$ListaDeObjetos[0]['fecha_ingreso'] = time();
  			 //Funciones::mostrarArreglo($ListaDeObjetos,true);
			
			$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);

			$e->setVariable('form_noticia_editor',$this->FormGeneral->showEditorHTML('form_noticia'));
			
        	if($ListaDeObjetos[0]['trabajo']== '1')
			{  
				$e->setVariable('checked_id_trabajo','checked');
			}
        	if($ListaDeObjetos[0]['investigaciones_ie']== '1')
			{  
				$e->setVariable('checked_id_investigaciones_ie','checked');
			}

        	if($ListaDeObjetos[0]['cursos_ie']== '1')
			{  
				$e->setVariable('checked_id_cursos_ie','checked');
			}
        	if($ListaDeObjetos[0]['tipo_curso']== 'postgrado')
			{  
				$e->setVariable('checked_tipo_postgrado','checked');
			}
        	if($ListaDeObjetos[0]['tipo_curso']== 'curso')
			{  
				$e->setVariable('checked_tipo_curso','checked');
			}
			if($ListaDeObjetos[0]['tipo_curso']== 'diplomado')
			{  
				$e->setVariable('checked_tipo_diplomado','checked');
			}
			/*agregramos el nuevo check para el radio magister en noticias*/
			if($ListaDeObjetos[0]['tipo_curso']== 'magister')
			{  
				$e->setVariable('checked_tipo_magister','checked');
			}
        	if($ListaDeObjetos[0]['tipo_curso']== 'egresado')
			{  
				$e->setVariable('checked_tipo_egresado','checked');
			}
        	if($ListaDeObjetos[0]['noticia_tipo']== 'postgrado')
			{  
			}
        	if($ListaDeObjetos[0]['noticia_tipo']== 'diplomado')
			{ 
				$e->setVariable('checked_noticia_diplomado','checked'); 
			}
        	if($ListaDeObjetos[0]['noticia_tipo']== 'curso')
			{ 
				$e->setVariable('checked_noticia_curso','checked'); 
			}
        	if($ListaDeObjetos[0]['noticia_tipo']== 'presentaciones')
			{ 
				$e->setVariable('checked_noticia_presentaciones','checked'); 
			}						
									
			/** MUESTRA DE IMAGENES EN CASO DE HABERLAS **/
			if(isset($ListaDeObjetos[0]['imagen']) && trim($ListaDeObjetos[0]['imagen']) != '')
			{  
				$e->addTemplate('bloque_imagen_anterior');
				$e->setVariable('imagen',$ListaDeObjetos[0]['imagen']); 
			}
			/** BUSCAR ARCHIVOS DE GALERIA DE FOTOS **/
			if($ListaDeObjetos[0]['id_item'] != '')
			{
				$e->addTemplate('bloque_galeria_archivo');
				$path_galeria  		= VarSystem::getPathVariables('dir_repositorio').'image/noticias/'.$ListaDeObjetos[0]['id_item'].'/';
				$imagenes_galeria 	= SIDTOOLHtml::obtenerArchivos($path_galeria);  
				//Funciones::mostrarArreglo($imagenes_galeria,true);
				for($m=0; $m < count($imagenes_galeria); $m++)
				{
					if($imagenes_galeria[$m] == 'index.php')
						continue;
					$e->addTemplate('bloque_galeria_archivo_imagen');
					$e->setVariable('id_item',$ListaDeObjetos[0]['id_item']);	
					$e->setVariable('imagen',$imagenes_galeria[$m]); 
					if(($m%2) == 1)
					{
						$e->addTemplate('bloque_galeria_archivo_imagen_salto');
					}	
				}
			}
			/** BUSCAR LINK EXTERNOS **/
			$ControlNoticiasLink = new ControlNoticiasLink();
			$links = $ControlNoticiasLink->obtenerLinks($ListaDeObjetos[0]['id_item']);
			
			// Funciones::mostrarArreglo($links,true);
			for($i=0; $i < count($links); $i++)
			{
				 $fila = $i + 1; 
				$links[$i]['fila'] = $fila;
				$e->addTemplate('bloque_noticia_link');
				if(is_array($links)  && isset($links[$i]) && trim($links[$i]['texto']) != '')
				{ 
					//Funciones::mostrarArreglo($links[$i],true);
					$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$links[$i]);					
					$e->addTemplate('bloque_noticia_link_eliminar'); 
					$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$links[$i]); 									
					$e->addTemplate('bloque_noticia_link_eliminar_url_'.$links[$i]['tipo']);
					$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$links[$i]); 
				} 
				else
				{
					$e->setVariable('fila',$fila);
				}
			}
			
			$ControlNoticiaSitio = new ControlNoticiaSitio();
			$recursos_sitios = $ControlNoticiaSitio->obtenerNoticiaSitio($ListaDeObjetos[0]['id_noticia']);
			//  Funciones::mostrarArreglo($recursos_sitios,false,"sitioslll");
			//Funciones::mostrarArreglo($this->ControlHtml->elUsuarioSitios,false,"sitioslll");
			$campos_asociados_sitios = array('activo' => array('tipo' => 'activo' ),  'destacado' => array('tipo'=> 'destacado'),  'destacado_forzado' => array('tipo'=> 'destacado_forzado'));
			 
			$e = $this->ControlGeneralIntranet->mostrarFormularioSitios($e,$this->ControlHtml->elUsuarioSitios,$campos_asociados_sitios,$recursos_sitios);
			  Funciones::mostrarArreglo($recursos_sitios,false,"sitioslll");
			    Funciones::mostrarArreglo($campos_asociados_sitios,false,"campos_asociados_sitios sitioslll");
//			var_dump($recursos_sitios);
			return $e;
		}
		
		function objetoGuardar()
		{

			///Funciones::mostrarArregloProduccion($this->valores," valores noticias");

			if(file_exists(VarSystem::getPathVariables('dir_repositorio').$this->valores['ruta_galeria']))
			{
				$this->valores['form_tiene_galeria'] = '1';
			}  
            if(isset($this->valores['form_trabajo']) && $this->valores['form_trabajo']=="on"){
                $this->valores['form_trabajo'] = '1';
            }else{
                $this->valores['form_trabajo'] = '0';
            }
            if(isset($this->valores['form_investigaciones_ie']) && $this->valores['form_investigaciones_ie']=="on"){
                $this->valores['form_investigaciones_ie'] = '1';
            }else{
                $this->valores['form_investigaciones_ie'] = '0';
            }
            if(isset($this->valores['form_cursos_ie']) && $this->valores['form_cursos_ie']=="on")
			{
                $this->valores['form_cursos_ie'] = '1';
            }
			else
			{
                $this->valores['form_cursos_ie'] = '0';
            }

            if(isset($this->valores['form_descuento_evento']))
			{
            	if($this->valores['form_descuento_evento'] != null)
				{
            		$this->valores['form_descuento_evento'] = '<a class="btn" style="cursor:pointer;" id="ver_descuentos_diplomado" onclick="verDescuento()">Ver Descuentos</a><div id="divVerDescuento" style="display:none;" class="form-group">'.$this->valores['form_descuento_evento'].'</div>';
            	}
				else
				{
            		$this->valores['form_descuento_evento'] = '';
            	}
            }

			parent::objetoGuardar(); 	   
			$sitios_seleccionados = $this->valores['sitios_id_site'];
		  	$NoticiaSitio = new NoticiaSitio();		  
		  	/*if ($this->valores['sitios_id_site'][0] != '1')
			{
				$NoticiaSitio->eliminarObjetoSite($this->valores['id_item'],$this->valores['sitios_id_site'][0]);
			} 
			else 
			{
				$NoticiaSitio->eliminarObjeto($this->valores['id_item']);
		  	}*/
			$NoticiaSitio->eliminarObjeto($this->valores['id_item']);
		  	$total_sitios_seleccionados = count($sitios_seleccionados);
		  	Funciones::mostrarArreglo($sitios_seleccionados,false,"sitios_seleccionados");
			if($total_sitios_seleccionados > 0 && is_array($sitios_seleccionados))
			{
				foreach($sitios_seleccionados as $i => $sitio)
				{		
					
				  	$NoticiaSitio = new NoticiaSitio(); 
		 			$NoticiaSitio->id_noticia 	= $this->valores['id_item'];
		 			$NoticiaSitio->id_site 	 	= $sitio;
					if(trim($this->valores['sitios_activo'][$i]) == '')
					{
						$this->valores['sitios_activo'][$i] = 0;
					}
		            $NoticiaSitio->activo 		= $this->valores['sitios_activo'][$i]; 
					if(trim($this->valores['sitios_destacado'][$i]) == '')
					{
						$this->valores['sitios_destacado'][$i] = 0;
					}
		            $NoticiaSitio->destacado 	= $this->valores['sitios_destacado'][$i]; 
					if(trim($this->valores['sitios_destacado_forzado'][$i]) == '')
					{
						$this->valores['sitios_destacado_forzado'][$i] = 0;
					} 
		            $NoticiaSitio->destacado_forzado 	= $this->valores['sitios_destacado_forzado'][$i]; 
	 				$NoticiaSitio->guardarObjeto($this->ObjetoClase->id_noticia,$sitio);
				}
			} 
			
			if(isset($this->valores['formimagengaleria_eliminar']) && count($this->valores['formimagengaleria_eliminar']) > 0 && is_array($this->valores['formimagengaleria_eliminar']))
			{
				for($m=0; $m < count($this->valores['formimagengaleria_eliminar']); $m++)
				{
					if(file_exists(VarSystem::getPathVariables('dir_repositorio').$this->valores['ruta_galeria'].$this->valores['formimagengaleria_eliminar'][$m]))
					{
						unlink(VarSystem::getPathVariables('dir_repositorio').$this->valores['ruta_galeria'].$this->valores['formimagengaleria_eliminar'][$m]);
					}
				}
			}  
			/*** LINKS EXTERNOS ***/
			
			$path_doc  		= VarSystem::getPathVariables('dir_repositorio').'doc/noticias/';
			
			if(count($this->valores['formlink_eliminar']) > 0 && is_array($this->valores['formlink_eliminar']))
			{
				for($i=0; $i < count($this->valores['formlink_eliminar']);$i++)
				{					
					$NoticiasLink = new NoticiasLink();
				  	$NoticiasLink->eliminarObjeto($this->valores['formlink_eliminar'][$i]);
				}
			}

			$filas_externas = 10;		
			for($i=0; $i <= $filas_externas; $i++)
			{
				if(!isset($this->valores['formlink']['texto'][$i]) && trim($this->valores['formlink']['texto'][$i]) == '')
				{
					continue;
				}
				if(trim($this->valores['formlink']['url'][$i]) != '')
				{
					$this->valores['formlink']['tipo'][$i] = 'url';
					$this->valores['formlink']['url'][$i]  = trim($this->valores['formlink']['url'][$i]);
					
					$aux = str_replace("http://","",$this->valores['formlink']['url'][$i]);
					if($aux == $this->valores['formlink']['url'][$i])
					{
						$aux = str_replace("https://","",$this->valores['formlink']['url'][$i]);
						if($aux != $this->valores['formlink']['url'][$i])
						{
							$this->valores['formlink']['url'][$i] = "https://".$aux;
						} 
						else
						{						
							$this->valores['formlink']['url'][$i] = "http://".$this->valores['formlink']['url'][$i];
						}
					}  
				} 

				if($this->valores['formlink_file_'.$i]!= '' )
				{ 	   
					$this->valores['formlink']['archivo'][$i] 	= $this->valores['name_file_'.$i]; 
					$this->valores['formlink']['url'][$i] 		= $this->valores['formlink']['archivo'][$i];
					$this->valores['formlink']['tipo'][$i] 		= 'doc'; 				 			 				
				}
				
				$NoticiasLink = new NoticiasLink();
				$NoticiasLink->id_noticia 	= $this->valores['id_item'];
				$NoticiasLink->link 		= $this->valores['formlink']['url'][$i];
				$NoticiasLink->texto 		= $this->valores['formlink']['texto'][$i];				
				$NoticiasLink->tipo 		= $this->valores['formlink']['tipo'][$i];
				$NoticiasLink->orden 		= $this->valores['formlink']['orden'][$i]; 
				$NoticiasLink->guardarObjeto();
			} 
			
			$this->objectoGuardarPalabraClaves(); 
		} 
	}

?>