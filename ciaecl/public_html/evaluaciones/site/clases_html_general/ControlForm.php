<?php 

	class FormGeneral 
	{ 
		var $template_dir;
		var $template;
		
		function FormGeneral()
		{ 
			$this->template_dir = VarSystem::getPathVariables('dir_template')."general/".$file;
			$this->template_dir_general = VarSystem::getPathVariables('dir_template')."general/"; 
		}

		function trasnformacionOrderListado($order)
		{
			global $ControlHtml;
			$orden_aux 				= $ControlHtml->pagina_sistema_orden." ".$ControlHtml->pagina_sistema_direccion;		
			$orden 					= $order;	
			if(trim($orden_aux) != '')
			{
				array_unshift($orden,$orden_aux);
			}   
			$orden = implode(', ',$orden); 
			return $orden;
		}
		
		function pieEmail($firma,$sitio,$url)
		{
			$this->template = new miniTemplate(VarSystem::getPathVariables('dir_template')."admin/email/firma.tpl");
			$this->template->setVariable('firma', $firma );  
			$this->template->setVariable('url', $url );  
			$this->template->setVariable('nombre_sitio',$sitio  );
			return $this->template->toHtml();  
		}
		
		function getValoresPaginamiento($total_datos,$listar=0)
		{
			global $ControlHtml;
			
			$pagina_sel 		= $ControlHtml->pagina_sistema;
			$total 				= VarSystem::getTotalPagina($total_datos);
			if($listar == 0)
				$listar 			= VarSystem::getTotalListar(); 
			
			$valores = array('inicio'=>0,'fin'=>0);
			if($total_datos == 0)
				$valores['inicio'] = -1;
			else
				$valores['inicio'] 	= ($pagina_sel-1)*$listar;

			$valores['fin'] 	= $valores['inicio']+$listar; 
			if($valores['fin'] > $total_datos)
				$valores['fin'] = $total_datos;
			 
			 return $valores;
		}
		
		function showPaginamientoOrden($orden_opcion)
		{			
			$this->template 	= new miniTemplate($this->template_dir_general.'paginamiento_orden.tpl');
			global $ControlHtml;
			
			$pagina_sel 		= $ControlHtml->pagina_sistema;  
			$this->template->setVariable('pagina_sistema', $ControlHtml->pagina_sistema);  
			$direccion = $ControlHtml->pagina_sistema_direccion; 
			if(trim($direccion) == '')
				$direccion = 'asc';
			
			$this->template->setVariable('checked_'.$direccion,'checked');
			foreach($orden_opcion as $opcion => $texto)
			{			
				$this->template->addTemplate('opcion_orden');
				$this->template->setVariable('opcion',$opcion);
				$this->template->setVariable('texto',$texto);
				if($opcion == $ControlHtml->pagina_sistema_orden)
				{					
					$this->template->setVariable('selected','selected');
				}
			}
			$output = $this->template->toHtml();
			return $this->showOutput($output);
		}
		
		function showPaginamiento($total_datos,$pagina_sel='',$opcion='')
		{
			global $ControlHtml;
			$mostrar			= 5;
			if(trim($pagina_sel) == '')
				$pagina_sel 		=  $ControlHtml->pagina_sistema; 
			$total 				=  VarSystem::getTotalPagina($total_datos);  
			 
			if(trim($pagina_sel) == '')
				$pagina_sel = 1;
			$this->template 	= new miniTemplate($this->template_dir_general.'paginamiento.tpl');
			$this->template->setVariable('pagina_actual',$pagina_sel);
			$this->template->setVariable('pagina_actual_orden',$ControlHtml->pagina_sistema_orden." ".$ControlHtml->pagina_sistema_direccion);
			
			/* numero de registros */
			$valores = $this->getValoresPaginamiento($total_datos); 
			$this->template->setVariable('total',$total_datos);
			$this->template->setVariable('total_inicio',$valores['inicio']+1);
			$this->template->setVariable('total_fin',$valores['fin']);
			
			
			$anterior = $pagina_sel-1;
			if($anterior > 0)
			{
				$this->template->addTemplate('paginamiento_prev');
				$this->template->setVariable('pagina_opcion',$opcion);
				$this->template->setVariable('anterior_pagina',$anterior);
			}
			 
			$inicio = $pagina_sel - $mostrar;  
			for($i=$inicio;$i < $pagina_sel ; $i++)
			{   
				if($i <= 0)
					continue;
				$this->template->addTemplate('paginamiento_numero_prev');
				$this->template->setVariable('pagina_opcion',$opcion);
				$this->template->setVariable('numero_pagina',$i); 
			}
			 
			$this->template->addTemplate('paginamiento_numero_sel'); 
			$this->template->setVariable('pagina_opcion',$opcion);
			$this->template->setVariable('numero_pagina',$pagina_sel); 

			$inicio = $pagina_sel + 1;
			$fin	= $inicio + $mostrar;
			for($i = $inicio;$i < $fin ; $i++)
			{   
				if($i > $total)
					break;
				$this->template->addTemplate('paginamiento_numero');
				$this->template->setVariable('pagina_opcion',$opcion);
				$this->template->setVariable('numero_pagina',$i); 
			}			

			$proxima = $pagina_sel + 1;
			if($proxima <= $total)
			{
				$this->template->addTemplate('paginamiento_proxima');
				$this->template->setVariable('pagina_opcion',$opcion);
				$this->template->setVariable('proxima_pagina',$proxima);
			}			
			 
			$output = $this->template->toHtml();
			return $this->showOutput($output); 
		}

		function showSelectIdiomas($idioma_sel='')
		{
			$idiomas 		= VarSystem::getIdiomasPermitidosCompleto();
			$template_file 	= VarSystem::getPathVariables('dir_template')."admin/select_idioma.tpl";
			$this->template 	= new miniTemplate($template_file);	
			foreach($idiomas as $id_idioma => $idioma)
			{
				$this->template->addTemplate('lista_idiomas');
				$this->template->setVariable('id_idioma',$id_idioma);
				$this->template->setVariable('idioma',$idioma);
				if($idioma_sel == $id_idioma)
					$this->template->setVariable('selected','selected');
			}
			return $this->template->toHtml();
		}
		
		function showMensajeForm($tipo,$msg)
		{
			$template_file = VarSystem::getPathVariables('dir_template')."admin/mensaje.tpl";
			$this->template 	= new miniTemplate($template_file);			
			$this->template->addTemplate('mensaje_'.$tipo);
			$this->template->setVariable('msg',$msg);
			return $this->template->toHtml();
		} 
		
		function showHeaderForm($e,$lastAction,$valores)
		{
			$e->setVariable('tag_volver',$this->showVolver($lastAction[0]));
			$e->setVariable('opcion_modulo',$lastAction[0]);
			$e->setVariable('caso_form','Nuevo');
			if(isset($valores['id_item']) && trim($valores['id_item']) != '')
			{
				$e->setVariable('caso_form','Modificación');
			} 
			return $e;
		}
		
		function showVolver($opcion='home')
		{
			$template_file = VarSystem::getPathVariables('dir_template')."general/volver.tpl";
			$this->template 	= new miniTemplate($template_file);
			$this->template->setVariable('opcion',$opcion);
			global $ControlHtml;
			
			$this->template->setVariable('texto_volver',$ControlHtml->ControlIdioma->obtenerVariable('general_volver'));
			$out = $this->template->toHtml();
			
			return $out;
		}
		
		function showRut($variable,$rut='',$dv='')
		{
			$this->template 	= new miniTemplate($this->template_dir.'rut.tpl');
			$this->template->setVariable('variable',$variable);
			$this->template->setVariable('rut',$rut);
			$this->template->setVariable('dv',strtoupper($dv));
		
			return $this->template->toHtml();
		}
		
		function showOutput($output)
		{			
			/*$output = str_replace("
"," ",$output);*/
			$output = str_replace("	","",$output);
			$output = str_replace("option>","option>\n ",$output);
			$output = str_replace("var ","\n var ",$output);
			$output = str_replace(" >","> ",$output);
			return $output;
		} 
		
		function showComunasSeleccionadas($comunasOferente)
		{  
		 	$total 				= count($comunasOferente);
			
			$comunasSeleccionadas = array();
			for($i=0; $i < $total;$i++)
			{
				if(is_array($comunasOferente[$i]))
				{ 
					$comunasSeleccionadas[$comunasOferente[$i]['comuna_id']] = true;
				}
				else
				{
					$comunasSeleccionadas[$comunasOferente[$i]] = true;
				}
			} 
			$ControlRegion 	= new ControlRegion(); 
			$ControlComuna 	= new ControlComuna();
			$regiones 		= $ControlRegion->getRegiones();
			$total_regiones = count($regiones); 
			
			$this->template 	= new miniTemplate($this->template_dir.'comuna_multiple_show.tpl');
			
			for($i=0; $i < $total_regiones; $i++)
			{  		
				$comunas 		= $ControlComuna->getComunasByIdRegion($regiones[$i]['region_id']);	 
			
				$moduloComuna 	= '';
				$total_comunas 	= count($comunas);
				$hay = 0;
				for($j=0; $j < $total_comunas; $j++)
				{ 
					if((bool)$comunasSeleccionadas[$comunas[$j]['comuna_id']])
					{
						if($hay == 0)
						{								
							$this->template->addTemplate('bloque_show_region');
							$this->template->setVariable('nombre_region',Funciones::cleanHtml($regiones[$i]['region']));  
						}
						$hay = 1;
						$this->template->addTemplate('bloque_show_comuna'); 
						$this->template->setVariable('nombre_comuna',Funciones::cleanHtml($comunas[$j]['comuna']));  
					}
					$this->template->refreshTemplate();	
				} 
			}    
			return $this->template->toHtml();	
		}
		
		function showRegion($id_selected='',$js='')
		{
		
			$this->template 	= new miniTemplate($this->template_dir.'region.tpl');
			 
			if(trim($id_selected) == '')
			{  
				if(trim($js) != '')
				{ 
					$this->template->addTemplate('region_js_default');
					$this->template->setVariable('region_js',$js);
				}			
				else
				{
					$this->template->addTemplate('region_default');
				}
				$this->template->refreshTemplate();
			}
			
			$ControlRegion 	= new ControlRegion(); 
			$regiones 		= $ControlRegion->getRegiones();
			
			
			for($i=0; $i < count($regiones); $i++)
			{ 
				//echo $js;
				if(trim($js) != '')
				{
					$this->template->addTemplate('region_js');
					$this->template->setVariable('region_js',$js); 
				}
				else
				{					
					$this->template->addTemplate('region');
				}
				$this->template->setVariable('region_id',$regiones[$i]['region_id']);
				$this->template->setVariable('region_nombre',Funciones::cleanHtml($regiones[$i]['region']));
				if($id_selected ==  $regiones[$i]['region_id'])
				{
					$this->template->setVariable('selected','selected');
				}
			} 
			$output = $this->template->toHtml();
			return $this->showOutput($output);
		} 
		
		function showComunaRegion($id_selected='')
		{
		
			$this->template 	= new miniTemplate($this->template_dir.'region_comuna.tpl');
			
			if(trim($id_selected) == '')
			{
				$this->template->addTemplate('comuna_region_defecto');
				$this->template->refreshTemplate();
			}
			
			$ControlRegion 	= new ControlRegion();
			$ControlComuna 	= new ControlComuna();
			$regiones 		= $ControlRegion->getRegiones();
			
			for($i=0; $i < count($regiones); $i++)
			{
				$comunas 	= $ControlComuna->getComunasByIdRegion($regiones[$i]['region_id']);		

				for($j=0; $j < count($comunas); $j++)
				{
					$this->template->addTemplate('comuna_region');
					$this->template->setVariable('comuna_id',$comunas[$j]['comuna_id']);
					$this->template->setVariable('comuna_nombre',Funciones::cleanHtml($comunas[$j]['comuna']));
					$this->template->setVariable('region_nombre',Funciones::cleanHtml($regiones[$i]['region']));
					if($id_selected ==  $comunas[$j]['comuna_id'])
					{
						$this->template->setVariable('selected','selected');
					}
				}
			}
			$output = $this->template->toHtml();
			return $this->showOutput($output);
		}
		
		function showComunaByRegion($id_region,$id_selected=0,$separador=' ')
		{
		
			$this->template 	= new miniTemplate($this->template_dir.'comuna.tpl');
			 
			if(trim($id_selected) == '')
			{
				$this->template->addTemplate('comuna_region_defecto');
				$this->template->refreshTemplate();
			}
			 
			$ControlComuna 	= new ControlComuna(); 
			$comunas 		= $ControlComuna->getComunasByIdRegion($id_region);		

			if($id_selected == 0)
			{
				$this->template->addTemplate('comuna_defecto');
			}
			for($j=0; $j < count($comunas); $j++)
			{
				$this->template->addTemplate('comuna');
				$this->template->setVariable('comuna_id',$comunas[$j]['comuna_id']);
				$this->template->setVariable('comuna_nombre',Funciones::cleanHtml($comunas[$j]['comuna'])); 
				if($id_selected > 0 && $id_selected ==  $comunas[$j]['comuna_id'])
				{
					$this->template->setVariable('selected','selected');
				}
			}
			 
			$output = $this->template->toHtml();
			return $this->showOutput($output);
		} 

		function showComunaByRegionOption($select_name,$id_region,$id_selected=0)
		{
		
			$this->template 	= new miniTemplate($this->template_dir.'comuna_option.tpl');
			
			$this->template->setVariable('select_name',$select_name);
			if(trim($id_selected) == '')
			{
				$this->template->addTemplate('comuna_region_defecto');
				$this->template->refreshTemplate();
			}
			 
			$ControlComuna 	= new ControlComuna(); 
			$comunas 		= $ControlComuna->getComunasByIdRegion($id_region);		

			$option = 0;
			if($id_selected == 0)
			{
				$this->template->addTemplate('comuna_defecto');
				$option++;
			}
			
			for($j=0; $j < count($comunas); $j++)
			{ 
				$this->template->addTemplate('comuna');
				$this->template->setVariable('select_option_id',$option); 
				$this->template->setVariable('comuna_id',$comunas[$j]['comuna_id']);
				$this->template->setVariable('comuna_nombre', $comunas[$j]['comuna']); 
				if($id_selected > 0 && $id_selected ==  $comunas[$j]['comuna_id'])
				{
					$this->template->setVariable('selected','selected');
				}
				$option++;
			}
			$output = $this->template->toHtml();
			return $this->showOutput($output);
		}
		
		function showAgnoSelect($id_selected=0,$agno_inicio=0,$agno_fin=0)
		{
			if($agno_fin == 0)
				$agno_fin = date("Y");
			if($agno_inicio == 0)
				$agno_inicio = 1840;
			
			return $this->showFechaSelect('A&ntilde;o',$agno_inicio,$agno_fin,$id_selected);
		}
		
		function showMesSelect($id_selected=0)
		{
			return $this->showFechaSelect('Mes',1,12,$id_selected);
		}
		
		function showDiaSelect($id_selected=0)
		{
			return $this->showFechaSelect('D&iacute;a',1,31,$id_selected);
		}
		
		function showEditorHTML($form_name)
		{ 
			$e 	= new miniTemplate(VarConfig::path_site_local.'www/libjs/tinymce/template_header.tpl');
			$e->setVariable('form_name',$form_name);
			return $e->toHtml();
		}
		
		private function showFechaSelect($texto,$inicio,$fin,$id_selected=0)
		{			
			$this->template 	= new miniTemplate($this->template_dir.'fecha_select.tpl');
			if(trim($id_selected) == 0)
			{
				$this->template->addTemplate('select_defecto');
				$this->template->setVariable('textdefecto_select_form',$texto);
				$this->template->refreshTemplate();
			}	
			
			for($i=$inicio ; $i <= $fin; $i++)
			{
				$this->template->addTemplate('select_lista');
				$this->template->setVariable('lista_id',$i);
				$this->template->setVariable('lista_nombre',$i); 
				if($id_selected ==  $i)
				{
					$this->template->setVariable('selected','selected');
				}			
			}
			return $this->template->toHtml();
		}
		
		function showActualFile($file_name,$caso='registro')
		{  
			$this->template 	= new miniTemplate($this->template_dir.'file_actual.tpl');
			$this->template->setVariable('nombre_documento',$file_name);
			$id_oferente = $ControlHtml->id_oferente;
			if(trim($id_oferente) == '')
				$id_oferente = VarSystem::getVariable("id_oferente");
			$this->template->setVariable('id_oferente',$id_oferente);
			if($caso == 'registro')
			{
				$this->template->addTemplate('archivo_actual_eliminar');
				$this->template->setVariable('nombre_documento',$file_name);
			}
			return $this->template->toHtml();
		}
		
		function paginamientoReseteo()
		{
		   $pagina = 1;
		   $inicio = 1;
		   $final = VarSystem::getTotalListar();
		   return array($pagina,$inicio,$final);
		}
		
		function paginamientoLimite($pagina,$tamPag,$total)
		{
			if(trim($pagina) == '')
			{
				$pagina = 1;
			}
			$limitInf = ($pagina-1)*$tamPag;		
			$numPags=ceil($total/$tamPag);	
			
			
			
			$limite = " LIMIT ".$limitInf.",".$tamPag;
			return array($limite,$numPags);
		}
		
		function paginamientoNumeroPaginas($pagina,$tamPag,$numPags)
		{
		 
 					$seccionActual = intval(($pagina-1) / $tamPag);
				   $inicio = ($seccionActual * $tamPag)+1;		
				  if($pagina < $numPags){
					  $final = $inicio+$tamPag-1;
				     }else{
					    $final = $numPags;
				   	 }		
				  if ($final > $numPags){
						  $final = $numPags;
				   }


		   	
			return array(   $inicio,$final);
		}
		
		
		
		function paginamientoListado($pagina,  $inicio, $final, $numPags)
		{
					   
		   $e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'paginamiento.tpl');	
		   	if($pagina>1)
			{
				$e->addTemplate('bloque_paginamiento_anterior');		
				$e->setVariable('pagina_anterior',($pagina - 1));   
			}
			for($i=$inicio;$i<=$final;$i++)
			{
				 $e->addTemplate('bloque_paginamiento_numero');	 
				 $e->setVariable('pagina',$i);  
				
				if($i==$pagina)
				{
				  $e->addTemplate('bloque_paginamiento_numero_seleccionada');
			    }else{
				  $e->addTemplate('bloque_paginamiento_numero_simple');
			    }
			   
				$e->setVariable('pagina',$i);
			}

			if($pagina < $numPags)
			{
				$e->addTemplate('bloque_paginamiento_siguiente');		
				$e->setVariable('pagina_siguiente',($pagina + 1));   
			}
		   
		   	$paginacion = $e->toHtml();
		   		   		 			
			return $paginacion;
		}
		
		function showAyudaFile()
		{		
			$this->template 	= new miniTemplate($this->template_dir.'file_ayuda.tpl');			
			$file_permitidos 		= VarSystem::getExtensionPermitidas();
			$this->template->setVariable('extensiones_permitidas',implode(', ',$file_permitidos));
			return $this->template->toHtml();
		}
		
		function showTituloModulo($titulo) 
		{
			$this->template 	= new miniTemplate($this->template_dir.'titulo_modulo.tpl');
			$this->template->setVariable('titulo_menu',$titulo);
			return $this->template->toHtml();
		}
		
		function showHelpForm($title,$message,$id)
		{ 	 
			$this->template = new miniTemplate($this->template_dir.'ayuda.tpl'); 
			$title = Funciones::TextoSimple(ucfirst($title),true);
			$this->template->setVariable('ayuda_title',$title);			
			$msg = Funciones::TextoSimple(ucfirst($message),true);
			$this->template->setVariable('ayuda_msg',$msg);
			$this->template->setVariable('ayuda_id',"ayuda_".$id);
			return $this->template->toHtml();
		}
		
		function showFormularioRevision($prefijo,$valores,$option)
		{			
			return 'borrrar formaulario del control form';
		}

		function showListadoTemplate($tpl,$datos,$bloque,$selected='',$html=true,$prefijo='')
		{  
			if(!is_array($datos[0]))
			{ 
				$datos = array($datos);
			} 
			$total 	= count($datos);
			if(is_array($datos) && $total > 0)
			{
				for($i = 0; $i < $total; $i++)
				{
					$tpl->addTemplate($bloque);
					foreach($datos[$i] as $campo => $valor)
					{ 
						if($html)
							$valor = Funciones::TextoSimple($valor);
						$tpl->setVariable($prefijo.$campo,$valor); 
						if(is_array($selected))
						{
							if($selected['campo'] == $campo && $selected['valor'] == $valor)
							{
								$tpl->setVariable('selected',$selected['select']); 
							}
						} 						
					}
				}
			}
			return $tpl;
		}

		function agregarValoresObjeto($obj,$valores,$prefijo='')
		{	 
			if(is_object($obj))
			{
				$campos = get_object_vars($obj); 
				foreach($campos as $campo => $valor)
				{
					$aux = $prefijo.$campo;
					if(isset($valores[$aux]))
					{  
						$obj->$campo = $valores[$aux];
					} 
				}  
			}
			return $obj;
		}
		 
	}
?>