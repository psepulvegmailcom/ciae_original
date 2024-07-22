<?php 

	/** CONTROLADOR GENERAL PARA INICIALIZAR LOS CONTROLADORES  */
	class ControlGeneral
	{
		function ControlGeneral($path_admin,$ControlHtml)
		{
			//Funciones::mostrarArreglo($ControlHtml,true);
			$this->path_admin 					= $path_admin;			
			$this->usuario						= $ControlHtml->elUsuarioP;
			$this->persona						= $ControlHtml->Persona;
			$this->persona_datos				= $ControlHtml->elUsuarioPersona;
			$this->lastAction 					= $ControlHtml->lastActionArray;
			$this->site_id						= $ControlHtml->site_id;
			$this->site_name					= $ControlHtml->site_name;
			$this->MantenedoresGeneral 			= new MantenedoresGeneral(); 
			$this->MantenedoresGeneralObjeto	= new MantenedoresGeneralObjeto();  
			$this->valores 						= VarSystem::getPost();
            $this->valoresBusqueda 				= VarSystem::getPost();
            $this->valBusquedaPalabra 		    = VarSystem::getPost();
			$this->valores_get					= VarSystem::getGet();
			$this->valores_file					= VarSystem::getFile();
			$this->FormGeneral					= new FormGeneral();
			$this->opcion 						= '';
			$this->utilizar_vista				= false;  			
			//Funciones::mostrarArreglo($ControlHtml,false,"completito1");
			$this->ControlHtml 					= $ControlHtml;
			
			$this->tipo_palabras_clave 			= 'generico';
		}  
		
		function setearControlGeneralIntranet($Controlador)
		{
			$this->ControlGeneralIntranet 		= $Controlador;
		} 
		
		function setearControlClase($Control)
		{
			$this->ControlClase 		= $Control;
			$this->ControlClase->order 	= $Control->order ; 
			//Funciones::mostrarArreglo($this->ControlClase,false,'ControlClaseControlClase');
		} 
		
		function setearObjetoClase($Objecto)
		{
			$this->ObjetoClase = $Objecto; 
			//Funciones::mostrarArreglo($this->ObjetoClase);
		}  
		
		function setearPalabrasClaves($palabras)
		{
			$this->tipo_palabras_clave = $palabras;
		}
		 
		function obtenerWhereSqlSite()
		{
			$where = '';
			for($i=0; $i < count($this->ControlHtml->elUsuarioSitios);$i++)
			{
				if($i > 0)
				{
					$where .= " OR ";
				}
				$where .= 'id_site = "'.$this->ControlHtml->elUsuarioSitios[$i]['id_site'].'"';
				
			}
			if(trim($where) != '')
			{
				$where = "(".$where.")";
			}
			return $where;
		}
        
 		function obtenerWhereSql($arregloCampos,$busqueda)
		{
			$where = '';
            $findme = '-20';
            $pos = strpos($busqueda, $findme);
                 if ($pos=='5'){
                     $busqueda  = date("Y-m-d", strtotime($busqueda));
                 }         
			for($i=0; $i < count($arregloCampos);$i++)
			{
				if($i > 0)
				{
					$where .= " OR ";
				}
				$where .= $arregloCampos[$i]." LIKE '%".$busqueda."%' ";	
				//$where .= "MATCH(".$arregloCampos[$i].") AGAINST ('%".$busqueda."%' ) ";
			}
            //print_r($where);
			if(trim($where) != '')
			{
				$where = "(".$where.")";
			}
			return $where;
		}
        
 		function obtenerOrderSql($Order)
		{
			$order = '';
				$order .=  $Order ;	

			return $order;
		} 
		
		function setearVariablesGenerales($e)
		{ 
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
			return $e;			
		}
				
		function setOpcion($opcion)
		{
			$this->opcion = $opcion;
		} 
		
		function setObjetos($ControlObjeto,$Objeto)
		{
			$this->ControlObjeto 	= $ControlObjeto;
			$this->Objeto		 	= $Objeto;
			$this->utilizar_vista	= false;
		}		
		
		function setObjetoVista($ControlVista)
		{
			$this->ControlObjetoVista 	= $ControlVista;
			$this->utilizar_vista		= true;
		}
		
		function mostrarVolver($e,$opcion='')
		{			
			if(trim($opcion) == '')
			{
				$opcion = $this->opcion;
			}   
			$e->setVariable('tag_volver',$this->FormGeneral->showVolverOpcionSimple($opcion));
			return $e;
		} 
		
		function mostrarMensajeError($mensaje,$caso,$entrega='template')
		{			
			$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'mensaje_guardar_datos.tpl');
			$e->setVariable('mensaje_texto',$mensaje);
			$e->setVariable('caso_mensaje',$caso);
			if($entrega == 'template') 
			{
				return $e;
			}
			else
			{
				return $e->toHtml();
			}	
		}
		
		function mostrarMensajeNoAcceso($entrega='template')
		{
			$mensaje = "Ud no tiene permisos para acceder a esta funcionalidad";
			$e = $this->mostrarMensajeError($mensaje,'error');
			if($entrega == 'template') 
			{
				return $e;
			}
			else
			{
				return $e->toHtml();
			}
		}

		function mostrarObjetoListado($e='')
		{ 
			if(trim($e) == '')
			{
				$e = new miniTemplate($this->path_admin.'listado.tpl');
			} 
			if($this->utilizar_vista)
			{
				$listado = $this->ControlObjetoVista->obtenerListado();
			}
			else
			{ 
				$listado = $this->ControlObjeto->obtenerListado();
			}
			/** PAGINAMIENTO **/
			$total_despliegue = VarSystem::getTotalListar();
			$id_pagina = $this->valores['id_pagina'];
			if(trim($id_pagina) == '')
			{
				$id_pagina = 1;
			}
			$id_pagina = $id_pagina - 1; 
			$i_inicio = $id_pagina * $total_despliegue;
			$i_fin 		= ($id_pagina + 1) * $total_despliegue - 1;
			if(count($listado) < $i_fin)
			{
				$i_fin = count($listado)-1;
			}
			$listado_aux = $listado;
			$listado = array();
			//echo $i_inicio.' '.$i_fin.' '.$id_pagina;
			for($i=$i_inicio; $i <= $i_fin;$i++)
			{
				$listado[] = $listado_aux[$i];
			}
			$paginas = ceil(count($listado_aux)/$total_despliegue);
			if($paginas >= 2)
			{		
				$e->addTemplate('item_lista_paginamiento');
						
				$e->setVariable('total',count($listado_aux));
				for($i=1; $i <= $paginas; $i++)
				{
					$e->addTemplate('item_lista_paginamiento_pagina');
					$e->setVariable('id_pagina',$i);
					if($i == $this->valores['id_pagina'])
					{
						$e->setVariable('clase_especial','paginamiento_seleccion');
					}
				}	
			}  
			$e = $this->MantenedoresGeneral->mostrarListado($e,$listado,$this->ControlObjeto->obj->dbKey,$this->opcion); 
			return $e;
		}	 

		function mostrarObjetoFormulario($e='')
		{ 
			if(trim($e) == '')
			{ 
				$e = new miniTemplate($this->path_admin.'formulario.tpl');
			}	
			$e = $this->mostrarVolver($e);   
			if(trim($this->valores['id_item']) != '')
			{
				$elemento = $this->ControlObjeto->obtenerElemento($this->valores['id_item']); 
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$elemento[0]);
			} 
			return $e;
		}
		
		function mostrarElementosListadoSimple($e,$listado)
		{
			$total = count($listado);
			for($i=0; $i < count($listado);$i++)
			{
				$e->addTemplate('bloque_periodos_escuela');
			}
		}
		
		function objectoGuardarPalabraClaves()
		{ 
			//Funciones::mostrarArreglo($this->valores,true);
			if(isset($this->valores['form_palabra_clave']) && trim($this->valores['form_palabra_clave']) != '')
			{
				$ControlNube = new ControlNube();  
				$sitios = $this->valores['sitios_id_site']; 
				foreach($sitios as $var => $val) 
				{ 
					$ControlNube->agregarNuevaPalabraNube($this->valores['form_palabra_clave'],$val,$this->tipo_palabras_clave);
				}  
			}
		}
		
		function objetoGuardar()
		{
			$this->MantenedoresGeneralObjeto->guardarObjetoSimple($this->Objeto,$this->valores); 
		}

		function eliminarRecursos()
		{ 			
			$this->ObjetoClase->buscarObjeto($this->valores['id_item']); 
			$this->MantenedoresGeneralObjeto->eliminarObjetoSimple($this->ObjetoClase,$this->valores); 
		}
		
		function mostrarFicha($e='')
		{
			if(!is_object($e))
			{
				$e = new miniTemplate($this->path_admin.'ficha.tpl');
			} 
			return  $this->mostrarFormulario($e); 
		}	 

		function mostrarFormulario($e='')
		{
			if(!is_object($e))
			{
				$e = new miniTemplate($this->path_admin.'form.tpl');
			}  

			$e->setVariable('tag_volver',$this->FormGeneral->showVolver($this->lastAction[0]));
			$e->setVariable('opcion_modulo',$this->lastAction[0]);  
            
			if(trim($this->valores['id_item']) == '')
			{ 
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
			Funciones::mostrarArreglo(array($ListaDeObjetos),false,'kdkdkkdkdk');		 
			$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]); 			
			  
			return $e;
		}  	
		
		function limpiezaListado()
		{
			/* funcion por defecto, que debe ser redefinida por cada Clase de control general, 
			si no se redefine simplemente se llama en mostrarListado() y si esta vacio no hace nada*/
		}	 
    
		function mostrarListado($e='')
		{						
			$this->limpiezaListado();			

			if(!is_object($e))
			{
				$e = new miniTemplate($this->path_admin.'mant.tpl');	
			} 		 
			$e->setVariable('opcion_modulo',$this->lastAction[0]); 
		    $e = $this->MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_orden',$arregloCampos,'','id_orden');
            $e->setVariable('page',$this->valoresGet["page"]); 
            
            /** FILTRO DE BUSQUEDA Y ORDEN DE FORMULARIO, PARA CONSULTA SQL **/
			
            if(trim($this->valores['buscar_filtro_busqueda']) != '')
            {   
        		$trozos=explode(" ",$this->valores['buscar_filtro_busqueda']);
                $numero=count($trozos);
                                     
                $this->valores['buscar_filtro_busqueda'] = html_entity_decode($this->valores['buscar_filtro_busqueda']);
				$e->addTemplate('bloque_form_buscar_orden_buscar');
				$e->setVariable('valor_buscar',$this->valores['buscar_filtro_busqueda']); 
            	$this->valores['buscar_filtro_busqueda'] = str_replace(" ","%",$this->valores['buscar_filtro_busqueda']);
                 if($this->busquedaMultiSitio == 0)
		         { 						                          
				//	list($strQry) = $this->MantenedoresGeneral->buscadorSimple($this->palabra,0,$this->valBusquedaPalabra);  
				//	$this->ControlClase->where = $this->obtenerWhereSqlSite()." AND ( ".$strQry." )";
                    $this->ControlClase->where = $this->obtenerWhereSql($this->arregloCamposBusqueda,$this->valores['buscar_filtro_busqueda']); 
                 }
	             else
				 {
                    $this->ControlClase->where = $this->obtenerWhereSqlSite()." AND ". $this->obtenerWhereSql($this->arregloCamposBusqueda,$this->valores['buscar_filtro_busqueda']); 
                 }
            }  
	        if (trim($this->valores['buscar_filtro_orden']) != '')
			{ 
	            $this->ControlClase->order = $this->obtenerOrderSql($this->valores['buscar_filtro_orden']).','.$this->ControlClase->order; 
				$e->addTemplate('bloque_form_buscar_orden_ordenar');
				$e->setVariable('valor_ordenar',$this->valores['buscar_filtro_orden']); 
	        }               
			//echo  	$this->ControlClase->where;	    
			$total = $this->ControlClase->obtenerTotalListado();		
			list($limite,$numPags,$final,$inicio,$pagina,$tamPag,$limitInf) = $this->MantenedoresGeneral->calculoPaginasPaginamiento($total,$this->valores);			
		    //Funciones::mostrarArreglo($this->ControlClase,true);  
			$this->ControlClase->setLimit($limite);
			$ListaDeObjetos = $this->ControlClase->obtenerListado();
			//Funciones::mostrarArreglo($ListaDeObjetos,true);  
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 				
	 		}
			else
			{  
		  		list($inicio,$final) = $this->MantenedoresGeneral->calculoPaginasPaginamientoAjuste($pagina,$tamPag,$numPags);		
				$paginamiento = $this->FormGeneral->paginamientoListado($pagina,  $inicio, $final, $numPags,$total );   
				$e->refreshTemplate();
				$e->setVariable('paginamiento',$paginamiento);
				$descarga_reportes = $this->FormGeneral->despliegueListadoReportes($this->arregloReportes); 
				$e->setVariable('descarga_reportes_estandar',$descarga_reportes);
				$descarga_manuales = $this->FormGeneral->despliegueListadoManuales($this->arregloManualesUsuario); 
				$e->setVariable('descarga_manuales_estandar',$descarga_manuales);  
				
				$total = VarSystem::getTotalListar();

                for($i=0; $i < $total; $i++)
				{
					if(isset($ListaDeObjetos[$i]['mesTexto']) && trim($ListaDeObjetos[$i]['mesTexto']) != '')
					{
						$ListaDeObjetos[$i]['mesTexto'] = ControladorFechas::entregarMes($ListaDeObjetos[$i]['mes'],'es');
					}                       
				}                     
				$e = $this->MantenedoresGeneral->mostrarListado($e,$ListaDeObjetos,$this->ObjetoClase->dbKey,$this->lastAction[0],$limitInf); 
			}              
       		$e = $this->MantenedoresGeneral->mostrarSeleccionOrdenSimple($e,'bloque_form_id_orden',$this->arregloCamposOrdenar);        
			return $e;			
		}					
	}  
	
/** CONTROLADOR GENERAL Y GLOBAL DE LOS MANTENEDORES CONTROLADORES DE OBJETOS  */
/**
 * MantenedoresGeneralObjeto
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class MantenedoresGeneralObjeto
{   
  /**
   * MantenedoresGeneralObjeto::MantenedoresGeneralObjeto()
   *
   * @return void
   */
	function MantenedoresGeneralObjeto()
	{ 
		 
	}

	function setearVariablesGuardarObjetoSimple($ObjetoClase,$valores,$prefijo='form')
	{
		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->buscarObjeto($valores['id_item']);
		}
		foreach($valores as $var => $val)
		{
			$aux = explode('_',$var);
			if($aux[0] == $prefijo)
			{
				$aux = str_replace($prefijo.'_','',$var);
				
				$aux_fecha = explode('fecha',$var);
				if(count($aux_fecha) > 1)
				{ 
 					$val = ControladorFechas::invertirFecha($val);
				}  
				$val = Funciones::TextoSimple($val);
				$ObjetoClase->$aux = $val;
			}			
		}
		return $ObjetoClase;
	}	 
				
	function guardarArchivoObjeto($Objeto,$archivo,$path,$filename='')
	{ 
		$DocumentFile 			= new DocumentFile($path); 
		$archivos = VarSystem::getFile();
		$error_save = false;  
		$DocumentFile->setFileArray($archivos[$archivo]);
		if(trim($filename) != '')
		{ 
			$DocumentFile->setNewName($filename) ;
			//$DocumentFile->notChangeName(); 
		} 
		if(!$DocumentFile->saveFile(false))
		{
			//echo "sdfsdf se guardo".$path;
			if(trim($DocumentFile->getOriginalName()) != '')
			{
				$msg = "El archivo ".$DocumentFile->getOriginalName()." no se pudo guardar porque ";
				if($DocumentFile->isErrorExtension())
					$msg .= " no pertenece a los archivos permitidos";
				else
					$msg .= " ocurri&oacute; un error al intentar guardarlo, por favor intentelo nuevamente o comuniquese con la administraci&oacute;n del sistema"; 
				//$this->ControlHtml->showMensajeGuardarDatos('error',$msg);
				echo $msg;
				$error_save = true; 
			}
		}
		else
		{
			$Objeto->$archivo = $DocumentFile->fileName; 
		}
		//Funciones::mostrarArreglo($DocumentFile,true);
		return $Objeto;
	}
	
	
  /**
   * MantenedoresGeneralObjeto::guardarObjetoSimple()
   *
   * @param mixed $ObjetoClase
   * @param mixed $valores
   * @return
   */
	function guardarObjetoSimple($ObjetoClase,$valores,$prefijo='form')
	{ 	   				 
		$ObjetoClase = $this->setearVariablesGuardarObjetoSimple($ObjetoClase,$valores,$prefijo);
		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->guardarObjeto($valores['id_item']);
		}
		else
		{
			$ObjetoClase->guardarObjeto(); 
		}
		return $ObjetoClase; 
	}
	
	function eliminarObjetoSimple($ObjetoClase,$valores)
	{ 
 		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->buscarObjeto($valores['id_item']);
			$ObjetoClase->eliminarObjeto($valores['id_item']);
		} 
	} 
	
	function activarObjetoSimple($ObjetoClase,$valores,$valor_activar='')
	{ 
 		if(trim($valores['id_item']) != '' && trim($valor_activar) != '')
 		{ 
			$ObjetoClase->buscarObjeto($valores['id_item']); 
			if($ObjetoClase->$valor_activar == 1)
				$ObjetoClase->$valor_activar = '0';
			else
				$ObjetoClase->$valor_activar = 1;
				 
			$ObjetoClase->guardarObjeto($valores['id_item']);
		} 
	}	
}

/** CONTROLADOR GENERAL Y GLOBAL DE LOS MANTENEDORES CON TEMPLATE */
/**
 * MantenedoresGeneral
 *
 * @package ciae_web
 * @author 
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class MantenedoresGeneral extends ControlObjetos
{   
  /**
   * MantenedoresGeneral::MantenedoresGeneral()
   *
   * @return void
   */
	function MantenedoresGeneral()
	{ 
		 
	}
	 
	function cambioTitulo($nuevo)
	{			
		$e = new miniTemplate(VarSystem::getPathVariables('dir_template_general').'cambioTitulo.tpl');
		$e->setVariable('nuevo',$nuevo);
		echo $e->toHtml();
	}
	
	function calculoPaginasPaginamiento($total,$valores)
	{
		//Funciones::mostrarArreglo(array($total,$valores ),true,'antes calculoPaginasPaginamiento');
		$FormGeneral = new FormGeneral(); 
		list($pagina,$inicio,$final) = $FormGeneral->paginamientoReseteo();
		
		$tamPag = $final;
		if(trim($pagina) != '' && trim($valores["pagina"]) != '')
		{
			$pagina = $valores["pagina"];
		}  			
		// Funciones::mostrarArreglo(array($pagina,$inicio,$final,$tamPag,$total),true);
		list($limite,$numPags,$limitInf) =  $FormGeneral->paginamientoLimite($pagina,$tamPag,$total); 
	    //Funciones::mostrarArreglo(array($pagina,$inicio,$final,$tamPag,$total,$limite,$numPags,$limitInf),true);
		
		if ($numPags < 11)
		{
			$final=$numPags;
		}
		else
		{
			$final=10;
		} 
		
		//Funciones::mostrarArreglo(array('limite'=>$limite,'numPags'=>$numPags,'final'=>$final,'inicio'=>$inicio,'pagina'=>$pagina,'tamPag'=>$tamPag,'limitInf'=>$limitInf),true,'salida calculoPaginasPaginamiento');
		//Funciones::mostrarArreglo(array($limite,$numPags,$final,$inicio,$pagina,$tamPag,$limitInf),true,'salida calculoPaginasPaginamiento');
		return array($limite,$numPags,$final,$inicio,$pagina,$tamPag,$limitInf);
		
	}
	
	function calculoPaginasPaginamientoAjuste($pagina,$tamPag,$numPags)
	{
		$FormGeneral = new FormGeneral(); 
		if(!isset($pagina))
		{
				//list($pagina,$inicio,$final) = $ControlHtml->FormGeneral->paginamientoReseteo();
		}
		else
		{				
		    list($inicio,$final) = $FormGeneral->paginamientoNumeroPaginas($pagina,$tamPag,$numPags);
		} 
		return array($inicio,$final);
	}
	
	function buscardorGeneral($valores,$ControlObjeto,$tipoBusqueda,$tipoRecurso,$valoresBusqueda,$valBusquedaPalabra)
	{ 
		list($strQryRes, $strQry, $order) = parent::obtenerQryPorBusqueda($valores,$tipoBusqueda,$valoresBusqueda,$valBusquedaPalabra);
           $listadoN = $ControlObjeto->obtenerListadoPorBusqueda($strQryRes, $strQry, $order);
		$total = count($listadoN);
		$FormGeneral = new FormGeneral();
		list($limite,$numPags,$final,$inicio,$pagina,$tamPag,$limitInf) = $this->calculoPaginasPaginamiento($total,$valores); 		
			$listado 	= $ControlObjeto->obtenerListadoPorBusqueda($strQryRes,$strQry, $order, $limite);							
		 list($inicio,$final) = $this->calculoPaginasPaginamientoAjuste($pagina,$tamPag,$numPags);
		return array($listado,$inicio,$final,$numPags);
	} 
    
    function buscadorSimple($valores,$tipoBusqueda,$valBusquedaPalabra)
    {
      list($strQry, $strQryRes) = parent::obtenerLeyendaPalabraBusqueda($valores,$tipoBusqueda,$valBusquedaPalabra);
      return array($strQry, $strQryRes);
    }
	
  /**
   * MantenedoresGeneral::mostrarListadoGenerico()
   *
   * @param mixed $e
   * @param mixed $listado
   * @param mixed $bloque
   * @return
   */
	function mostrarListadoGenerico($e,$listado,$bloque)
	{	
		//Funciones::mostrarArreglo($listado,true);
		$total = count($listado);  
		for($i=0; $i < $total; $i++)
		{
			$e->addTemplate($bloque); 
			$listado[$i]['fila'] = $i + 1;  
			foreach($listado[$i] as $var => $val)
			{				
				$e->setVariable($var,trim($val));
			}  
			$e->setVariable('class_color','fondo_claro');
			if($i%2 == 0)						
			{
				$e->setVariable('class_color','fondo_oscuro');
			}
		}			
		return $e; 
	} 
	
  /**
   * MantenedoresGeneral::mostrarListado()
   *
   * @param mixed $e
   * @param mixed $listado
   * @param mixed $llave
   * @param mixed $opcion
   * @return
   */
	function mostrarListado($e,$listado,$llave,$opcion,$inicio_fila=0)
	{
		$total = count($listado);  
		for($i=0; $i < $total; $i++)
		{
			$e->addTemplate('lista_item');
			$listado[$i]['fila'] = $i + 1 + $inicio_fila; 
			$listado[$i]['id_item'] = $listado[$i][$llave];
			 
			// Funciones::mostrarArreglo($listado[$i],false,'titutlo');
			$e->setVariable('opcion_modulo',$opcion);
			foreach($listado[$i] as $var => $val)
			{ 
				$val = Funciones::TextoSimple(trim($val));
				$e->setVariable($var,trim($val));
				$aux_fecha = explode('fecha',$var);
				if(count($aux_fecha) > 1)
				{ 
					$val = ControladorFechas::invertirFecha($val);
					$e->setVariable($var.'_html',$val);
				} 
			}  
			$e->setVariable('class_color','fondo_claro');
			if($i%2 == 0)						
			{
				$e->setVariable('class_color','fondo_oscuro');
			}
		}			
		return $e; 
	}
	
  /**
   * MantenedoresGeneral::transformarSalto()
   *
   * @param mixed $seleccion
   * @return
   */
	function transformarSalto($seleccion)
	{
		foreach($seleccion as $var => $val)
		{
			$seleccion[$var] = nl2br($val);
		} 
		return $seleccion;
	}
	
  /**
   * MantenedoresGeneral::limpiezaCaracteres()
   *
   * @param mixed $seleccion
   * @return
   */
	function limpiezaCaracteres($seleccion)
	{ 
		foreach($seleccion as $var => $val)
		{ 
			$val = Funciones::LimpiarSaltosLinea($val);
			$val = Funciones::LimpiarEspacios($val);
			$seleccion[$var] = trim($val);
		} 
		//Funciones::mostrarArreglo($val,true);
		return $seleccion;
	}
	
  /**
   * MantenedoresGeneral::mostrarElementoValores()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @return
   */
	function mostrarElementoValores($e,$seleccion)
	{			
		if(is_array($seleccion))
		{
			foreach($seleccion as $var => $val)
			{  
				$val = Funciones::TextoSimple(trim($val));
				$e->setVariable($var,$val);
				$aux_fecha = explode('fecha',$var);
				if(count($aux_fecha) > 1)
				{ 
					$val = ControladorFechas::invertirFecha($val);
					$e->setVariable($var.'_html',$val);
				}  
				$e->setVariable('checked_'.$var.'_'.$val,'checked');
			}
		} 
		return $e; 
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccionOrden()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @param integer $total
   * @return
   */
	function mostrarSeleccionOrden($e,$seleccion,$total=30)
	{
		for($i=1; $i  < $total ; $i++)
		{
			$e->addTemplate('bloque_form_orden');
			$e->setVariable('orden',$i); 
			if($i == $seleccion['orden'])
			{
				$e->setVariable('selected','selected');
			}
		} 
		return $e;
	}
		
  /**
   * MantenedoresGeneral::mostrarSeleccionEstado()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @param string $llave
   * @return
   */
	function mostrarSeleccionEstado($e,$seleccion,$llave ='activo')
	{  
		$e->setVariable('checked_'.$seleccion[$llave],'checked'); 
		return $e;
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccionBinario()
   *
   * @param mixed $e
   * @param mixed $seleccion
   * @param string $llave
   * @return
   */
	function mostrarSeleccionBinario($e,$seleccion,$llave ='activo')
	{  
		$e->setVariable('checked_'.$llave.'_'.$seleccion[$llave],'checked'); 
		return $e;
	}
	
	
	function asignarValoresExternosObjeto($objeto,$valores,$prefijo='form')
	{
		foreach($valores as $var => $val)
		{
			$aux = explode('_',$var);
			if($aux[0] == $prefijo)
			{
				unset($aux[0]);
				$var = implode('_',$aux);
				$objeto->$var = $val;
			}
		}  
		return $objeto;
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccion()
   *
   * @param mixed $e
   * @param mixed $bloque
   * @param mixed $listado
   * @param mixed $seleccion
   * @param mixed $llave
   * @return
   */
	function mostrarSeleccion($e,$bloque,$listado,$seleccion=array(),$llave='')
	{
	    // Funciones::mostrarArreglo($listado,true);
		$total = count($listado);
		$largo_texto = 100;
		for($i=0; $i < $total;$i++)
		{
			$e->addTemplate($bloque);
			foreach($listado[$i] as $var => $val)
			{
				$len = strlen($val); 
				if($len > $largo_texto)
				{
					$val = substr($val,0,$largo_texto).'...';
				}
				$e->setVariable($var,trim($val));                     
			}   
			if(trim($llave) != '' && count($seleccion) > 0)
			{
				if($listado[$i][$llave] == $seleccion[$llave])
				{
					$e->setVariable('selected','selected');
				}
			}
		}
		return $e;
	}
	function mostrarSeleccionOrdenSimple($e,$bloque,$listado)
	{
		$total = count($listado);
            
		for($i=0; $i < $total;$i++)
		{
			for($j=0; $j < 2; $j++)
			{
				$e->addTemplate($bloque);                 
				$list2[0] = $listado[$i]['0']." ASC";
				$list2[1] = $listado[$i]['0']." DESC";
				$list[0]  = $listado[$i]['1']." ASC";
				$list[1]  = $listado[$i]['1']." DESC"; 
				$e->setVariable('campoFiltro',trim($list[$j]));
				$e->setVariable('Orden',trim($list2[$j])); 
			}                                         
	   }
	   return $e;
	}
	
  /**
   * MantenedoresGeneral::mostrarSeleccionMultiple()
   *
   * @param mixed $e
   * @param mixed $bloque
   * @param mixed $listado
   * @param mixed $seleccion
   * @param mixed $llave
   * @return
   */
	function mostrarSeleccionMultiple($e,$bloque,$listado,$seleccion,$llave)
	{
		$total = count($listado);
		$i_aux = 0;
		for($i=0; $i < $total;$i++)
		{
			$e->addTemplate($bloque);
			foreach($listado[$i] as $var => $val)
			{
				$e->setVariable($var,trim($val));
			}  
			if($listado[$i][$llave] == $seleccion[$i_aux][$llave])
			{
				$e->setVariable('selected','selected');
				$i_aux++;
			}
		}
		return $e;
	}	

  /**
   * MantenedoresGeneral::mostrarPersonasEdicionListado()
   *
   * @param mixed $e
   * @param mixed $listado
   * @param mixed $opcion
   * @return
   */
	function mostrarPersonasEdicionListado($e,$listado,$opcion)
	{
		// Funciones::mostrarArreglo($listado,true);
		/** PERSONAS EXISTENTES */
		$total = count($listado);
		if(is_array($listado) && $total > 0)
		{
			for($i = 0; $i < $total; $i++)
			{
				$e->addTemplate('bloque_form_persona_extra');
	
				$e->setVariable('opcion_modulo',$opcion); 				
				if(trim($listado[$i]['nombre_publicacion']) == '')
				{
					if($listado[$i]['id_persona'] > 1)
					{
						$listado[$i]['nombre_publicacion'] = $listado[$i]['apellido_paterno'].', '.$listado[$i]['nombre'][0].'.';	
					}
					else
					{
						$listado[$i]['nombre_publicacion'] = $listado[$i]['nombre_extra'];
					}					
				} 
				foreach($listado[$i] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}				
			}
		}
		/** PERSONAS PARA INGRESAR */
		$nuevos = 5;
		$total_orden =30;
		$ControlClase = new ControlPersonaObjeto();
		$personas = $ControlClase->obtenerListado();
		$personas[0]['nombre'] = '(nombre extra)';
		$total_personas = count($personas);
		for($i=0; $i < $nuevos; $i++)
		{
			$e->addTemplate('bloque_form_persona_extra_ingreso');
			
			for($j=0; $j < $total_personas; $j++)
			{
				$e->addTemplate('bloque_form_persona_extra_ingreso_nombre');
				foreach($personas[$j] as $var => $val)
				{
					$e->setVariable($var,trim($val));
				}
			}
			
			for($j=1; $j < $total_orden ; $j++)
			{
				$e->addTemplate('bloque_form_persona_extra_ingreso_orden');
				$e->setVariable('orden',$j);  
			} 
		} 
		return $e;
	} 
	
	function colorFilaGenerico($e,$i)
	{		
		$e->setVariable('class_color','fondo_oscuro');
		if($i%2 == 0)						
		{
			$e->setVariable('class_color','fondo_claro');
		}
		return $e;
	}
	
	
}
?>