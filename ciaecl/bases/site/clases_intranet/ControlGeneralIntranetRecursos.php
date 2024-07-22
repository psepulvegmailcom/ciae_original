<?php
 
	
	class ControlGeneralMantenedorRecursos extends ControlGeneral
	{
		function ControlGeneralMantenedorRecursos($path_admin,$ControlHtml)
		{
			parent::ControlGeneral($path_admin,$ControlHtml);
            $this->valoresGet   = VarSystem::getGet(); 	 
			$this->ControlGeneralIntranet 		= new ControlGeneralIntranet();	

			$this->ControlClase = new ControlRecursosSitioObjeto();
			$this->ControlClase->group = ' id_recurso ';  
			$this->ObjetoClase  = new RecursosObjeto();
			$this->FormGeneral  = new FormGeneral();  	
			$this->tipo_palabras_clave = 'recursos';				
		} 
		
		function limpiezaListado()
		{
			 $ControlRecursosSitioObjeto = new ControlRecursosSitioObjeto();
			 $ControlRecursosSitioObjeto->eliminarVacias();
		} 
		
        function mostrarListado()
    	{   	    
            $this->arregloCamposBusqueda = array('titulo','autor','fecha','nombre_site'); 
            $this->arregloCamposOrdenar = array(array('titulo','T&iacute;tulo'), 
                                    array('tipo','Tipo'),
                                    array('fecha','Fecha'));
            $this->palabra = $this->valores['buscar_filtro_busqueda'];
           	$this->valBusquedaPalabra = array("titulo","bajada");                                                  
            return parent::mostrarListado();
    	} 
        
		function eliminarRecursos()
		{ 
			
			$this->ObjetoClase->buscarObjeto($this->valores['id_item']);
			//Funciones::mostrarArreglo($this->ObjetoClase,true);
			
			if(trim($this->ObjetoClase->imagen) != '' && file_exists(VarSystem::getPathVariables('dir_repositorio').'image/recursos/'.$this->ObjetoClase->imagen))
			{
				@unlink(VarSystem::getPathVariables('dir_repositorio').'image/recursos/'.$this->ObjetoClase->imagen);
			}
			if(trim($this->ObjetoClase->archivo) != '' && file_exists(VarSystem::getPathVariables('dir_repositorio').'doc/recursos/'.$this->ObjetoClase->archivo))
			{
				@unlink(VarSystem::getPathVariables('dir_repositorio').'doc/recursos/'.$this->ObjetoClase->archivo);	
			}			
			 
			$this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ObjetoClase,$this->valores);
			$RecursoSitio = new RecursoSitio();
			$RecursoSitio->eliminarObjeto($this->valores['id_item']); 
		}
		
		function guardarRecurso()
		{
			//Funciones::mostrarArreglo($this->valores,true);
			$palabras = array();
			$palabras = $this->ControlGeneralIntranet->limpiezaPalabrasClaves($this->valores['form_palabras_clave'],$palabras);			
			//Funciones::mostrarArreglo($palabras,true);
			 
			
			
			$this->ObjetoClase = $this->MantenedoresGeneralObjeto->guardarObjetoSimple($this->ObjetoClase,$this->valores);  
			if(!isset($this->ObjetoClase->id_recurso) && isset($this->ObjetoClase->id) && trim($this->ObjetoClase->id) != '')
			{    
				$this->ObjetoClase->id_recurso = $this->ObjetoClase->id;
			}  
			
			$sitios_seleccionados = $this->valores['sitios_id_site'];			
		  	$RecursosSitio = new RecursoSitio();
		  	$RecursosSitio->eliminarObjeto($this->ObjetoClase->id_recurso);
		  	$total_sitios_seleccionados = count($sitios_seleccionados);
		  	
			if($total_sitios_seleccionados > 0 && is_array($sitios_seleccionados))
			{
				foreach($sitios_seleccionados as $i => $sitio)
				{										
					$ControlTipoRecursos 	= new ControlTipoRecursos(); 
					$NombreTipo 			= $ControlTipoRecursos->obtenerNombreTipo($this->valores['sitios_id_tipo'][$i]);
					//$palabras[$NombreTipo[0]['tipo']] = 1;
					$palabras = $this->ControlGeneralIntranet->limpiezaPalabrasClaves($NombreTipo[0]['tipo'],$palabras);
					//Funciones::mostrarArreglo($palabras,true);					
					
				  	$RecursosSitio = new RecursoSitio(); 
		 			$RecursosSitio->id_recurso 	        = $this->ObjetoClase->id_recurso;
		 			$RecursosSitio->id_site 	        = $sitio;
		            $RecursosSitio->activo 		        = $this->valores['sitios_activo'][$i]; 
		            $RecursosSitio->destacado 	        = $this->valores['sitios_destacado'][$i]; 
		            $RecursosSitio->id_tipo 	        = $this->valores['sitios_id_tipo'][$i];
                    $RecursosSitio->id_tipo_estructura 	= $this->valores['sitios_id_tipo_estructura'][$i];  
	 				$RecursosSitio->guardarObjeto($this->ObjetoClase->id_recurso,$sitio);
				}
			} 
			$this->ObjetoClase->palabras_clave = $this->ControlGeneralIntranet->transformacionPalabrasClaves($palabras);  
			$this->ObjetoClase->guardarObjeto();
			
			$this->objectoGuardarPalabraClaves();	
		}
		
		
		function mostrarFormulario()
		{
			$e = new miniTemplate($this->path_admin.'form.tpl'); 

			$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
			$e->setVariable('path_imagen','image/recursos/');
            $e->setVariable('path_recurso','doc/recursos/');
            //$e->setVariable('prefijo_nombre_extra_archivo','dddddddddddd');
            
			if(trim($this->valores['id_item']) == '')
			{
				$ListaDeObjetos = array();
				$ListaDeObjetos[0]['id_item'] = '00';
				$ListaDeObjetos[0]['fecha_html'] = date("d-m-Y");
				$e->setVariable('caso_form','Ingreso'); 
			}			
			else
			{				
				$e->setVariable('caso_form','Modificaci&oacute;n');
				$ListaDeObjetos = $this->ControlClase->obtenerElemento($this->valores['id_item']);
				$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$this->ObjetoClase->dbKey];	
			}  	
			
			$ListaDeObjetos[0]['usuario'] = $this->ControlHtml->theSession->userId;
			$ListaDeObjetos[0]['fecha_ingreso'] = time(); 
			//Funciones::mostrarArreglo($ListaDeObjetos,true);		 
			$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]); 			
			
			if(trim($this->valores['id_item']) != '')
			{
				if(trim($ListaDeObjetos[0]['archivo']))
				{
					$e->addTemplate('bloque_archivo_anterior');
					$e->setVariable('archivo',$ListaDeObjetos[0]['archivo']);
				}
				if(trim($ListaDeObjetos[0]['imagen']))
				{
					$e->addTemplate('bloque_imagen_anterior');
					$e->setVariable('imagen',$ListaDeObjetos[0]['imagen']);
				}
			}		


			/* años */
			$agno_actual =  date("Y");
			for($agno_list = 2000; $agno_list <= date("Y");$agno_list++)
			{
				$e->addTemplate('bloque_agno_recurso');
				$e->setVariable('agno_list',$agno_list);
			}



			
			$ControlRecursoSitio = new ControlRecursoSitio();
			$recursos_sitios = $ControlRecursoSitio->obtenerRecursosSitio($ListaDeObjetos[0]['id_recurso']);
			 
			$campos_asociados_sitios = array('activo' => array('tipo' => 'activo' ), 'id_tipo' => array('tipo' => 'tipo_recurso'), 'id_tipo_estructura' => array('tipo' => 'tipo_recurso_estructura'), 'destacado' => array('tipo'=> 'destacado'));
			 
			$e = $this->ControlGeneralIntranet->mostrarFormularioSitios($e,$this->ControlHtml->elUsuarioSitios,$campos_asociados_sitios,$recursos_sitios);
			 
			return $e;
		}  
	}  
?>