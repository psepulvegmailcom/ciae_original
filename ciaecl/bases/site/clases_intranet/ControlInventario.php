<?php


class InventarioLibrosLibros extends Objetos 
{		
	var $sourceTable = "site_gestion_inventario_libros_libros";
	
	function InventarioLibrosLibros() 
	{
		parent::Objetos();
        $this->dbKey = 'id_libro';
	} 
}  

class ControlInventarioLibrosLibros extends ControlObjetos
{
	var $obj; 	  
	
	function ControlInventarioLibrosLibros() 
	{			
		parent::ControlObjetos();
		$this->obj          = new InventarioLibrosLibros();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'estado, fecha_ingreso_base DESC,titulo ASC, id_libro DESC';  
	}
	
	function eliminarVacias()
	{		
		$sql = "DELETE FROM ".$this->sourceTable." WHERE ".$this->obj->dbKey." = ''";
		parent::consultarEspecifica($sql);
	}  
} 

class InventarioLibrosPrestamos extends Objetos 
{		
	var $sourceTable = "site_gestion_inventario_libros_prestamos";
	
	function InventarioLibrosPrestamos() 
	{
		parent::Objetos();
        $this->dbKey = 'id_prestamo';
	} 
	
	function buscarObjeto($id_prestamo)
	{ 
		parent::loadObject($this->dbKey.' = "'.$id_prestamo.'"');
	}
	
	function guardarObjeto($id_prestamo)
	{		         
		if($this->newObject)
		{
			parent::saveObject();
		}
		else
		{ 
			parent::saveObject($this->dbKey.' = "'.$id_prestamo.'"');
		}
	}
} 

class ControlInventarioLibrosPrestamos extends ControlObjetos
{
	var $obj; 	  
	
	function ControlInventarioLibrosPrestamos() 
	{			
		parent::ControlObjetos();
		$this->obj          = new InventarioLibrosPrestamos();
        $this->key 			= $this->obj->dbKey; 	
		$this->sourceTable  = $this->obj->sourceTable;
		$this->order 		= 'fecha_prestamo, fecha_devolucion,fecha_solicitud, id_libro DESC'; 
		$this->select 		= 'date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html, date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html,  date_format(fecha_solicitud,"%d-%m-%Y") AS fecha_solicitud_html';
	}  
}  

class ControlGeneralInventarioLibros extends ControlGeneral
{
	function ControlGeneralInventarioLibros($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml); 			
		$this->valores 		= VarSystem::getPost();
        $this->valoresGet   = VarSystem::getGet();	 
        $this->Objeto  		= new InventarioLibrosLibros();   
		$this->ControlClase = new ControlInventarioLibrosLibros();
		$this->ObjetoClase  = new InventarioLibrosLibros(); 
        $this->ObjetoClase  = new ControlInventarioLibrosLibros(); 
	}  
	
	function limpiezaListado()
	{		
		$this->ControlClase = new ControlInventarioLibrosLibros();
		$this->ControlClase->eliminarVacias();
	}	
	
	function mostrarListadoPrestamo()
	{          
        $this->arregloCamposBusqueda = array('id_libro','autores','titulo','editorial','isbn','doi','tipo_libro','proyecto','centro_costo','investigador_acargo','comentarios','palabra_clave');  
        $this->arregloCamposOrdenar  = array(array('id_libro','ID CIAE'), array('fecha_ingreso_base','Fecha ingreso'), array('tipo_libro','Tipo de libro'),array('titulo','T&iacute;tulo'),array('estado','Estado'));   
        $this->arregloReportes = array(array('texto'=>'Descarga reporte libros','id_descarga'=>'inventario_biblioteca','explicacion' => 'Descarga de listado completo de libros'),
		array('texto'=>'Descarga reporte pr&eacute;stamos','id_descarga'=>'inventario_biblioteca_prestamos','explicacion' => 'Descarga de listado pr&eacute;stamo de libros')		);
		$this->arregloManualesUsuario = array(array('texto'=>'Manual mantenedor','doc_manual'=>'biblioteca_libros','explicacion' => 'Descarga de manual de uso de mantenedor de Biblioteca CIAE'));
		if(trim($this->valores['buscar_filtro_orden']) == '')
		{
			$this->valores['buscar_filtro_orden'] = 'estado DESC';
		}
		
		return parent::mostrarListado();   
	} 
	
	
	function mostrarListado()
	{          
        $this->arregloCamposBusqueda = array('id_libro','autores','titulo','editorial','isbn','doi','tipo_libro','proyecto','centro_costo','investigador_acargo','comentarios','palabra_clave');  
        $this->arregloCamposOrdenar  = array(array('id_libro','ID CIAE'), array('fecha_ingreso_base','Fecha ingreso'), array('tipo_libro','Tipo de libro'),array('titulo','T&iacute;tulo'),array('estado','Estado'));   
        $this->arregloReportes = array(array('texto'=>'Descarga reporte libros','id_descarga'=>'inventario_biblioteca','explicacion' => 'Descarga de listado completo de libros'),
		array('texto'=>'Descarga para formulario Gesti&oacute;n de Bienes','id_descarga'=>'inventario_biblioteca_formulario','explicacion' => 'Descarga de listado para creaci&oacute;n de archivo FORMULARIO GESTI&oacute;N DE BIENES DE ACTIVO FIJO CIAE ( F.G.B )') 	);
		$this->arregloManualesUsuario = array(array('texto'=>'Manual mantenedor','doc_manual'=>'biblioteca_libros','explicacion' => 'Descarga de manual de uso de mantenedor de Biblioteca CIAE'));
		return parent::mostrarListado();   
	} 
	
	function mostrarListadoFicha()
	{ 
        $this->arregloCamposBusqueda = array('id_libro','autores','titulo','editorial','isbn','doi','tipo_libro','palabra_clave');  
        $this->arregloCamposOrdenar  = array(array('id_libro','ID CIAE'), array('fecha_ingreso_base','Fecha ingreso'), array('tipo_libro','Tipo de libro'),array('titulo','T&iacute;tulo'),array('estado','Estado')); 
        $this->arregloReportes = array(array('texto'=>'Descarga reporte libros','id_descarga'=>'inventario_biblioteca_simple','explicacion' => 'Descarga de listado completo de libros'));  
        if(trim($this->valores['buscar_filtro_orden']) == '')
        { 
			$this->valores['buscar_filtro_orden'] = 'titulo ASC';
		} 
		return parent::mostrarListado();  
	} 
	
	function obtenerWhereSqlSite()
	{ 
		$where = '1'; 
		return $where;
	}
	
	function mostrarFormularioPrestamo($e)
	{   
		if ($this->valores['id_item']!=''  )
		{  
			$ControlVistaPrestamoUsuario = new ControlVistaPrestamoUsuario();
			$prestamos = $ControlVistaPrestamoUsuario->buscarPrestamosLibro($this->valores['id_item']); 
			
			if(is_array($prestamos) && count($prestamos) >0)
			{
				$aux = end($prestamos); 
				$editar = false;
				if($aux['fecha_devolucion'] == '0000-00-00')
				{
					 array_pop($prestamos);
					 $editar = true;
				}
				$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$prestamos,'bloque_form_prestamos');
				if($editar)
				{
					$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,array($aux),'bloque_form_prestamos_editar');
				}
				else
				{
					$e->addTemplate('bloque_form_prestamos_nuevo');
				}
			}
			else
			{
				$e->addTemplate('bloque_form_prestamos_nuevo');
			}
			Funciones::mostrarArreglo(array("aaaa",$prestamos),false,'fdfdfdfdf');
		}
		 
		return $e;
	}
	
	
	
	function mostrarFormulario()
	{	  			 
		$e = new miniTemplate($this->path_admin.'formulario.tpl'); 
        $e = parent::mostrarFormulario($e);
        
		$ControlVistaCentroCostosResponsable = new ControlVistaCentroCostosResponsable();
        $proyectos_responsable = $ControlVistaCentroCostosResponsable->buscarProyectosAdministracion('0');
        //Funciones::mostrarArreglo($proyectos_responsable,true);
    	$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$proyectos_responsable,'bloque_proyectos_centros_pago');	
		// Funciones::mostrarArreglo($this->usuario->permisosUsuario,true);
		$total_agno = Date('Y');
		for($i=$total_agno; $i >= 1920; $i--)
		{
			$e->addTemplate('bloque_form_agno');
			$e->setVariable('agno',$i); 
		}     
		return $e;            
	}
	
	function objetoGuardarPrestamo()
	{
		
	}
	
	function guardarSolicitud()
	{
		$carta = new miniTemplate($this->path_admin.'solicitud.tpl'); 
		
		$Usuario = new Usuario();
		$Usuario->buscarUsuarioPermisoParticular('gestion_biblioteca_prestamo');
		// Funciones::mostrarArreglo(array($this),true);
		
		$InventarioLibrosPrestamos = new InventarioLibrosPrestamos();
		$InventarioLibrosPrestamos->fecha_solicitud = date("Y-m-d");
		$InventarioLibrosPrestamos->comentario_solicitud = $this->valores['comentario_solicitud'];
		$InventarioLibrosPrestamos->id_libro = $this->valores['id_libro'];
		$InventarioLibrosPrestamos->usuario_solicitante = $this->persona_datos['user_id'];
		$InventarioLibrosPrestamos->usuario_gestiona = $Usuario->user_id;
		$InventarioLibrosPrestamos->guardarObjeto();
		
		$this->Objeto->buscarObjeto($this->valores['id_libro']);
		$this->Objeto->estado = 'solicitud_prestamo';
		$this->Objeto->guardarObjeto();
		$this->valores['comentario_solicitud'] = nl2br($this->valores['comentario_solicitud']);
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,get_object_vars($InventarioLibrosPrestamos));
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,get_object_vars($this->Objeto));
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$this->valores);
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$this->persona_datos);
		
		
		$PersonaObjetos = new PersonaObjetos();
		$PersonaObjetos->buscarUserId($Usuario->user_id);
		Funciones::sendEmail($PersonaObjetos->obtenerEmail(),'[INTRANET] Solicitud de pr&eacute;stamo de libro',$carta->toHtml()); 
		Funciones::sendEmail($this->persona_datos['email'],'[INTRANET] Solicitud de pr&eacute;stamo de libro',$carta->toHtml()); 
	  
		// Funciones::mostrarArreglo( $this->ControlHtml->elUsuarioPersona ,true);
		 	
	}
	
	function guardarPalabrasClaves()
	{  
		$this->Objeto->buscarObjeto($this->valores['id_libro']);
		$this->Objeto->palabra_clave = trim($this->valores['palabra_clave']);
		$this->Objeto->guardarObjeto(); 
	}
	
	function objetoGuardar()
	{
       if ($this->valores['id_item']=='')
		{   
			$this->valores['form_fecha_ingreso_base'] = date('d-m-Y'); 
		   	$this->Objeto->buscarObjeto($this->valores['form_id_libro']);
		   	
			//Funciones::mostrarArreglo($this->Objeto,true);
			if(trim($this->Objeto->id_libro) != '')
			{  
				Funciones::mostrarAlertaSimple('El nuevo elemento no se pudo ingresar, porque el ID CIAE, ya se encuentra en uso.');
				return false;
			}  
		} 	
		else
		{
			//Funciones::mostrarArreglo($this->valores,true);
			if(trim($this->valores['fecha_devolucion']) != '' && !isset($this->valores['fecha_prestamo']))
			{
				/* editar*/
				$this->valores['form_estado'] = 'activo';
				$ControlInventarioLibrosPrestamos = new ControlInventarioLibrosPrestamos();
				$prestamos = $ControlInventarioLibrosPrestamos->obtenerElemento($this->valores['id_item']); 
				$aux = end($prestamos);
				$ControlInventarioLibrosPrestamos->obj->buscarObjeto($this->valores['id_item'],$aux['fecha_prestamo']);
				$ControlInventarioLibrosPrestamos->obj->fecha_devolucion = ControladorFechas::invertirFecha($this->valores['fecha_devolucion']);
				$ControlInventarioLibrosPrestamos->obj->guardarObjeto($this->valores['id_item'],$aux['fecha_prestamo']);
	
				//Funciones::mostrarArreglo($ControlInventarioLibrosPrestamos->obj,true);			
			}
			else
			{
				if(trim($this->valores['usuario']) != '' && trim($this->valores['fecha_prestamo']) != '' && isset($this->valores['fecha_prestamo']) && isset($this->valores['usuario']))
				{
					/* nuevo prestamo*/
					
					$this->valores['form_estado'] = 'prestado';
					$ControlInventarioLibrosPrestamos = new ControlInventarioLibrosPrestamos();
					$ControlInventarioLibrosPrestamos->obj->usuario = $this->valores['usuario'];
					$ControlInventarioLibrosPrestamos->obj->fecha_devolucion = ControladorFechas::invertirFecha($this->valores['fecha_devolucion']);
					$ControlInventarioLibrosPrestamos->obj->fecha_prestamo = ControladorFechas::invertirFecha($this->valores['fecha_prestamo']);
					$ControlInventarioLibrosPrestamos->obj->id_libro = $this->valores['id_item'];
					$ControlInventarioLibrosPrestamos->obj->guardarObjeto();
					//Funciones::mostrarArreglo($ControlInventarioLibrosPrestamos->obj,true);
				}
			}
		} 
		// Funciones::mostrarArreglo($this->valores,true);
		parent::objetoGuardar();  
	}
}

class ControlVistaPrestamoUsuario extends ControlVistas
{
	function ControlVistaPrestamoUsuario()
	{
		parent::ControlVistas(); 			
		$this->key 			= 'id_prestamo';
		$this->sourceTable  = 'view_gestion_biblioteca_prestamos';
		$this->order		= 'fecha_solicitud DESC,fecha_devolucion,fecha_prestamo';		
		$this->select 		= 'date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html, date_format(fecha_prestamo,"%d-%m-%Y") AS fecha_prestamo_html,  date_format(fecha_solicitud,"%d-%m-%Y") AS fecha_solicitud_html';
	} 
	
	function buscarPrestamosLibro($id_libro)
	{ 
		$this->where = "id_libro = '".$id_libro."'";
		return parent::obtenerListado();
	}
}

?>