<?php

	class ControlGeneralMantenedorEnLaPrensa extends ControlGeneral
	{
		function ControlGeneralMantenedorEnLaPrensa($path_admin,$ControlHtml)
		{
			parent::ControlGeneral($path_admin,$ControlHtml); 
			$this->valoresGet   = VarSystem::getGet();	 
			$this->ControlGeneralIntranet 		= new ControlGeneralIntranet();			
			$this->ControlClase 		= new ControlEnLaPrensaObjeto(); 
			$this->ControlClase->order 	= 'id_prensa DESC,'.$this->ControlClase->order ; 
			$this->ObjetoClase  		= new EnLaPrensaObjeto();
			// Funciones::mostrarArreglo($this->ControlClase,true);	
			$this->tipo_palabras_clave = 'en_la_prensa';					
		}
		
		function limpiezaListado()
		{
			 $ControlNoticiaPrensaSitio = new ControlNoticiaPrensaSitio();
			 $ControlNoticiaPrensaSitio->eliminarVacias();
		} 
		
		function mostrarListado()
		{ 
			$this->arregloCamposBusqueda = array('titulo','fecha','medio', 'nombre_site'); 
			$this->arregloCamposOrdenar  = array(array('titulo','T&iacute;tulo'), array('medio','Medio'),array('nombre_site','Sitio'));  
			
	        $this->arregloReportes = array(array('texto'=>'Descarga listado','id_descarga'=>'reporte_noticias_prensa','explicacion' => 'Descarga listado de noticias en la prensa')	);           
            $this->palabra = $this->valores['buscar_filtro_busqueda'];
           	$this->valBusquedaPalabra = array("titulo","bajada");                		   			
			            
            return parent::mostrarListado();   
		}
    
		function objetoGuardar()
		{
			//Funciones::mostrarArreglo($valores);
			//Funciones::mostrarArreglo($archivos);
			$this->ObjetoClase = $this->MantenedoresGeneralObjeto->guardarObjetoSimple($this->ObjetoClase,$this->valores); 
			$this->ObjetoClase->buscarObjeto($this->ObjetoClase->id_prensa); 
			if(!isset($this->ObjetoClase->id_prensa) && isset($this->ObjetoClase->id) && trim($this->ObjetoClase->id) != '')
			{   	/* prensa nueva */
				$this->ObjetoClase->id_prensa = $this->ObjetoClase->id;
			} 								
			//Funciones::mostrarArreglo($this->ObjetoClase);
		 	$NoticiaPrensaSitio = new NoticiaPrensaSitio();
		 	$NoticiaPrensaSitio->eliminarObjeto('0');
		 	$NoticiaPrensaSitio->eliminarObjeto($this->ObjetoClase->id_prensa);
			if(array($this->valores['sitios_id_site']) && count($this->valores['sitios_id_site']) > 0)
			{				 
				$sitios = $this->valores['sitios_id_site']; 
				foreach($sitios as $var => $val) 
				{ 
				 	$NoticiaPrensaSitio = new NoticiaPrensaSitio();
					$NoticiaPrensaSitio->id_prensa 	= $this->ObjetoClase->id_prensa;
					$NoticiaPrensaSitio->id_site 	= $val;
					$NoticiaPrensaSitio->guardarObjeto();
				}
			} 
			$this->valores['form_palabra_clave'] = $this->valores['form_palabras_clave'];
			$this->objectoGuardarPalabraClaves();   
		} 
		
		function mostrarFormulario()
		{
			$e = new miniTemplate($this->path_admin.'form.tpl'); 

			$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
			$ListaDeObjetos = $this->ControlClase->obtenerElemento($this->valores['id_item']); 
			if(!is_array($ListaDeObjetos))
			{
				$ListaDeObjetos[0]['fecha_html'] = date("d-m-Y");
			}  			 
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$this->ObjetoClase->dbKey];
			
			$ListaDeObjetos[0]['path_archivo']	= 'doc/en_la_prensa/';
			$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);  
			
			$ControlAreas = new ControlAreas();
			$ControlAreas->where = ' activo = "1" ';
			$areas = $ControlAreas->obtenerListado();
			 
            $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_area',$areas,$ListaDeObjetos[0],'id_area');  
             
            if(trim($ListaDeObjetos[0]['pdf']) != '')
            {
				$e->addTemplate('bloque_form_archivo');
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);  
			} 
			
			$ControlNoticiaPrensaSitio = new ControlNoticiaPrensaSitio();
			$elementos_sitios = $ControlNoticiaPrensaSitio->obtenerNoticiaSitio($ListaDeObjetos[0]['id_item']);
		 	//Funciones::mostrarArreglo($ListaDeObjetos->select,true);
			$campos_asociados_sitios = array();
			 
			$e = $this->ControlGeneralIntranet->mostrarFormularioSitios($e,$this->ControlHtml->elUsuarioSitios,$campos_asociados_sitios,$elementos_sitios); 
			return $e;
		}
	}
	 

?>