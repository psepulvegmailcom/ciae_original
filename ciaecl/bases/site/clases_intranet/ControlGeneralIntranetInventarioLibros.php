<?php



class ControlGeneralInventarioLibros extends ControlGeneral
{
	function ControlGeneralInventarioLibros($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml); 			
		$this->valores 		= VarSystem::getPost();
        $this->valoresGet   = VarSystem::getGet();	 
        $this->Objeto  		= new InventarioLibrosLibros();   
		$this->ControlClase = new ControlInventarioLibrosLibros(); 
        $this->ObjetoClase  = new ControlInventarioLibrosLibros(); 
	} 
	
	function mostrarListadoPrestamo()
	{          
        $this->arregloCamposBusqueda = array('fecha_prestamo','fecha_solicitud','fecha_devolucion','estado','usuario_solicitante','usuario_gestiona');  
        $this->arregloCamposOrdenar  = array(array('fecha_prestamo_html','Fecha Pr&eacute;stamo'),array('fecha_solicitud_html','Fecha Solicitud'),array('fecha_devolucion_html','Fecha Devoluci&oacute;n'),  array('estado','Estado'),array('usuario_solicitante','Solicitantes'),array('usuario_gestiona','Encargados'));   
        $this->arregloReportes = array(array('texto'=>'Descarga reporte pr&eacute;stamos','id_descarga'=>'inventario_biblioteca_prestamos','explicacion' => 'Descarga de listado pr&eacute;stamo de libros')		);
		$this->arregloManualesUsuario = array(array('texto'=>'Manual mantenedor','doc_manual'=>'biblioteca_libros','explicacion' => 'Descarga de manual de uso de mantenedor de Biblioteca CIAE'));
		if(trim($this->valores['buscar_filtro_orden']) == '')
		{
			$this->valores['buscar_filtro_orden'] = 'estado DESC';
		}  
		//Funciones::mostrarArreglo(array($this->ControlClase,$this->ObjetoClase),true);
		return parent::mostrarListado();   
	} 

	function objetoGuardarPrestamo()
	{  
		$InventarioLibrosPrestamos = new InventarioLibrosPrestamos();
			
		if(trim($this->valores['id_item']) != '')
		{ 
			$InventarioLibrosPrestamos->buscarObjeto($this->valores['id_item']); 
		}
		
		$InventarioLibrosPrestamos->estado = $this->valores['form_estado'];
		
		$InventarioLibrosPrestamos->fecha_solicitud = ControladorFechas::invertirFecha($this->valores['form_fecha_solicitud']);
		$InventarioLibrosPrestamos->fecha_prestamo  = ControladorFechas::invertirFecha($this->valores['form_fecha_prestamo']);
		$InventarioLibrosPrestamos->numero_memo  	= $this->valores['form_numero_memo'];
		if(trim($InventarioLibrosPrestamos->fecha_prestamo) != '')
		{
			$InventarioLibrosPrestamos->estado = 'solicitud'; 
		} 	
		$InventarioLibrosPrestamos->fecha_devolucion_estimada = ControladorFechas::invertirFecha($this->valores['form_fecha_devolucion_estimada']);
		$InventarioLibrosPrestamos->fecha_devolucion = ControladorFechas::invertirFecha($this->valores['form_fecha_devolucion']);
		if(trim($InventarioLibrosPrestamos->fecha_devolucion) != '')
		{
			$InventarioLibrosPrestamos->estado = 'devuelto';
		}
		if(trim($InventarioLibrosPrestamos->id_usuario_solicitante) == '')
		{
			$InventarioLibrosPrestamos->id_usuario_solicitante = $this->valores['form_id_usuario_solicitante'];
		}
		if(trim($InventarioLibrosPrestamos->id_usuario_gestiona) == '')
		{
			$ControlVistaAuthPersona = new ControlVistaAuthPersona();
			$Usuario = $ControlVistaAuthPersona->buscarUsuarioPermisoParticular('gestion_biblioteca_prestamo');
			$InventarioLibrosPrestamos->id_usuario_gestiona = $Usuario[0]['id_persona'];
		}
		
		$InventarioLibrosPrestamos->comentario = $this->valores['form_comentario'];
		if(trim($this->valores['form_archivo_prestamo_firmado']) != '')
		{
			$InventarioLibrosPrestamos->archivo_prestamo_firmado = $this->valores['form_archivo_prestamo_firmado'];
			$InventarioLibrosPrestamos->estado = 'prestado';
			$ControlInventarioLibrosPrestamos = new ControlInventarioLibrosPrestamos(); 
			$InventarioLibrosPrestamos->numero_memo = $ControlInventarioLibrosPrestamos->obtenerNuevoNumeroMemo();			
		}
		if(trim($this->valores['form_fecha_devolucion']) != '')
		{
			$InventarioLibrosPrestamos->fecha_devolucion = ControladorFechas::invertirFecha($this->valores['form_fecha_devolucion']);
			
			$ControlInventarioLibrosPrestamosDetalle = new ControlInventarioLibrosPrestamosDetalle();
			$ControlInventarioLibrosPrestamosDetalle->devolverItemenes($this->valores['id_item'], ControladorFechas::invertirFecha($this->valores['form_fecha_devolucion']));  
			
			$ControlVistaPrestamoLibrosUsuarioDetalle = new ControlVistaPrestamoLibrosUsuarioDetalle();
			$ListaDeObjetos = $ControlVistaPrestamoLibrosUsuarioDetalle->buscarPrestamo($this->valores['id_item']); 
			for($i=0; $i < count($ListaDeObjetos); $i++)
			{
				$InventarioLibrosLibros = new InventarioLibrosLibros();
				$InventarioLibrosLibros->buscarObjeto($ListaDeObjetos[$i]['id_libro']);
				$InventarioLibrosLibros->estado = 'activo';
				$InventarioLibrosLibros->guardarObjeto();
			}
		} 
		
		$InventarioLibrosPrestamos->guardarObjeto($this->valores['id_item']);
			
		if(trim($this->valores['id_item']) == '')
		{
			$this->valores['id_item'] = $InventarioLibrosPrestamos->id;
			$this->valores['id_prestamo'] = $InventarioLibrosPrestamos->id;
			$InventarioLibrosPrestamos->id_prestamo = $InventarioLibrosPrestamos->id;
		} 
		else
		{
			$this->valores['id_prestamo'] = $this->valores['form_id_prestamo'];
		}
		//Funciones::mostrarArreglo($InventarioLibrosPrestamos,true);
		//Funciones::mostrarArreglo($this->valores,true,'dddddddddd');
		
		if(trim($this->valores['formdetallenuevo_id_libro']) != '')
		{
			$this->valores['formdetallenuevo_id_prestamo'] = $this->valores['id_prestamo'];
			 
			$InventarioLibrosPrestamosDetalle = new InventarioLibrosPrestamosDetalle();   
			$InventarioLibrosPrestamosDetalle =	$this->MantenedoresGeneralObjeto->setearVariablesGuardarObjetoSimple($InventarioLibrosPrestamosDetalle,$this->valores,'formdetallenuevo');
			$InventarioLibrosPrestamosDetalle->newObject = true;
			$InventarioLibrosPrestamosDetalle->estado = $InventarioLibrosPrestamos->estado;
			$InventarioLibrosPrestamosDetalle->guardarObjeto();
			
			$InventarioLibrosLibros = new InventarioLibrosLibros();
			$InventarioLibrosLibros->buscarObjeto($this->valores['formdetallenuevo_id_libro']);
			$InventarioLibrosLibros->estado = $InventarioLibrosPrestamos->estado;
			$InventarioLibrosLibros->guardarObjeto();
		}
		
		if(isset($this->valores['form_fecha_devolucion_estimada']) && trim($this->valores['form_fecha_devolucion_estimada']) != '')
		{ 
			$ControlInventarioLibrosPrestamosDetalle = new ControlInventarioLibrosPrestamosDetalle(); 
			$ControlInventarioLibrosPrestamosDetalle->actualizarFechaDevolucionEstimada($this->valores['id_prestamo'],ControladorFechas::invertirFecha($this->valores['form_fecha_devolucion_estimada'])); 
		} 
	}  
	
	function guardarSolicitud()
	{
		$carta = new miniTemplate($this->path_admin.'solicitud.tpl'); 
	 
		$ControlVistaAuthPersona = new ControlVistaAuthPersona();
		$Usuario = $ControlVistaAuthPersona->buscarUsuarioPermisoParticular('gestion_biblioteca_prestamo');
		//  Funciones::mostrarArreglo(array($this),true);
		
		$InventarioLibrosPrestamos = new InventarioLibrosPrestamos();
		$InventarioLibrosPrestamos->fecha_solicitud = date("Y-m-d");
		$InventarioLibrosPrestamos->comentario = $this->valores['comentario_solicitud']; 
		$InventarioLibrosPrestamos->estado = 'solicitud';
		$InventarioLibrosPrestamos->id_usuario_solicitante = $this->persona_datos['id_persona'];
		$InventarioLibrosPrestamos->id_usuario_gestiona = $Usuario[0]['id_persona'];
		$InventarioLibrosPrestamos->guardarObjeto();
		//Funciones::mostrarArreglo($InventarioLibrosPrestamos,true);
		
		$InventarioLibrosPrestamosDetalle = new InventarioLibrosPrestamosDetalle();
		$InventarioLibrosPrestamosDetalle->id_libro = $this->valores['id_libro'];
		$InventarioLibrosPrestamosDetalle->estado = 'solicitud';
		$InventarioLibrosPrestamosDetalle->id_prestamo = $InventarioLibrosPrestamos->id;
		$InventarioLibrosPrestamosDetalle->guardarObjeto();
		//Funciones::mostrarArreglo($InventarioLibrosPrestamosDetalle,true);
		
		$this->Objeto->buscarObjeto($this->valores['id_libro']);
		$this->Objeto->estado = 'solicitud';
		$this->Objeto->guardarObjeto();
		$this->valores['comentario_solicitud'] = nl2br($this->valores['comentario_solicitud']);
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,get_object_vars($InventarioLibrosPrestamos));
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,get_object_vars($this->Objeto));
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$this->valores);
		$carta = $this->MantenedoresGeneral->mostrarElementoValores($carta,$this->persona_datos); 
		 
		Funciones::sendEmail($Usuario[0]['email'],'[INTRANET] Solicitud de pr&eacute;stamo de libro',$carta->toHtml()); 
		Funciones::sendEmail($this->persona_datos['email'],'[INTRANET] Solicitud de pr&eacute;stamo de libro',$carta->toHtml()); 
	  
		// Funciones::mostrarArreglo( $this->ControlHtml->elUsuarioPersona ,true); 
	}	
	
	function limpiezaListado()
	{		
		//$this->ControlClase = new ControlInventarioLibrosLibros();
		$this->ControlClase->eliminarVacias();
	}	 
	
	function mostrarListado()
	{          
        $this->arregloCamposBusqueda = array('id_libro','autores','titulo','editorial','isbn','doi','tipo_libro','proyecto','centro_costo','investigador_acargo','comentarios','palabra_clave');  
        $this->arregloCamposOrdenar  = array(array('id_libro','ID CIAE'), array('fecha_ingreso_base','Fecha ingreso'), array('tipo_libro','Tipo de libro'),array('titulo','T&iacute;tulo'),array('estado','Estado'));   
        $this->arregloReportes = array(array('texto'=>'Descarga reporte libros','id_descarga'=>'inventario_biblioteca','explicacion' => 'Descarga de listado completo de libros'),
		array('texto'=>'Descarga para formulario Gesti&oacute;n de Bienes','id_descarga'=>'inventario_biblioteca_formulario','explicacion' => 'Descarga de listado para creaci&oacute;n de archivo FORMULARIO GESTI&oacute;N DE BIENES DE ACTIVO FIJO CIAE ( F.G.B )') 	);
		$this->arregloManualesUsuario = array(array('texto'=>'Manual mantenedor','doc_manual'=>'biblioteca_libros','explicacion' => 'Descarga de manual de uso de mantenedor de Biblioteca CIAE'));
		echo "eeeeeeee";
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
	
	function mostrarFormularioPrestamo()
	{		
		$e = new miniTemplate($this->path_admin.'formulario_prestamo_masivo.tpl');
        $e = parent::mostrarFormulario($e);   
        
		//Funciones::mostrarArreglo($this->valores,true);
		if(trim($this->valores['id_item']) == '') /* ingreso de nuevo pr&eacute;stamo, desde cero, sin solicitud */
		{
			$e->addTemplate('bloque_persona_solicitante_form');
			$PersonaControl = new PersonaControl();
			$personas = $PersonaControl->getListaEmailSimple();
			$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$personas,'bloque_persona_solicitante_form_option');	
			$e->addTemplate('bloque_fecha_prestamo_form');
			$e->setVariable('fecha_prestamo_html',ControladorFechas::fechaActual(false,false));
			$e->addTemplate('bloque_fecha_devolucion_estimada_form');			
			$e->setVariable('fecha_devolucion_estimada_html',ControladorFechas::fechaActual(false,false,14)); 
			$e->setVariable('fecha_prestamo_html',ControladorFechas::fechaActual(false,false));
			$e->addTemplate('bloque_fecha_solicitud_form'); 
			$e->setVariable('fecha_solicitud_html',ControladorFechas::fechaActual(false,false)); 	  
		}
		else
		{	
			$InventarioLibrosPrestamos = new InventarioLibrosPrestamos();
			$InventarioLibrosPrestamos->buscarObjeto($this->valores['id_item']);
			
			//Funciones::mostrarArreglo($InventarioLibrosPrestamos,true,'-*-*-libros_prestamos_detalle'); 
			
			$ControlVistaPrestamoLibrosUsuarioDetalle = new ControlVistaPrestamoLibrosUsuarioDetalle();
			$ListaDeObjetos = $ControlVistaPrestamoLibrosUsuarioDetalle->buscarPrestamo($this->valores['id_item']); 
			
			$e->setVariable('numero_memo',$InventarioLibrosPrestamos->numero_memo);
			//Funciones::mostrarArreglo($ListaDeObjetos,true,'---libros_prestamos_detalle');
			
        	$fechas = array('fecha_prestamo','fecha_solicitud','fecha_devolucion_estimada','fecha_devolucion');
	        for($i=0; $i < count($fechas); $i++)
	        {
		        if($ListaDeObjetos[0][$fechas[$i]] == '0000-00-00')
		        {
					$e->addTemplate('bloque_'.$fechas[$i].'_form');	 
					$e->setVariable($fechas[$i].'_html',ControladorFechas::fechaActual(false,false));
					if($fechas[$i] == 'fecha_devolucion_estimada')
					{ 
						$e->setVariable($fechas[$i].'_html',ControladorFechas::fechaActual(false,false,14));
					}	
				}
				else
				{
					$e->addTemplate('bloque_'.$fechas[$i].'_dato');	
					$e->setVariable($fechas[$i].'_html',$ListaDeObjetos[0][$fechas[$i].'_html']); 	
				}
			} 
			$e->addTemplate('bloque_nuevo_ingreso_temporal');
			$e->setVariable('id_prestamo',$this->valores['id_item']);
		} 
		
		$ControlInventarioLibrosLibros = new ControlInventarioLibrosLibros();
		$libros = $ControlInventarioLibrosLibros->obtenerLibrosActivos();
		//Funciones::mostrarArreglo($libros,false,'inventario_libros_libros');
		$total = count($ListaDeObjetos);
		if(is_array($ListaDeObjetos) && $total>0)
		{
			for($i=0; $i < $total; $i++)
			{ 				
				$e->addTemplate('bloque_libros_prestamos_detalle');
				$e->setVariable('fila',$i);
				$e = $this->MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[$i]); 
	        	$fechas = array('fecha_devolucion_estimada_libro','fecha_devolucion_libro');
		        for($j=0; $j < count($fechas); $j++)
		        {
		        	if($ListaDeObjetos[$i][$fechas[$j]] == '0000-00-00')
		        	{
						$ListaDeObjetos[$i][$fechas[$j]] == '';
						$ListaDeObjetos[$i][$fechas[$j].'_html'] = '';
					}	
			        if($ListaDeObjetos[$i][$fechas[$j]] == '' && $InventarioLibrosPrestamos->estado == 'prestamo')
			        {
						$e->addTemplate('bloque_'.$fechas[$j].'_form_detalle');	
						$e->setVariable('fila',$i);
					}
					else
					{
						$e->addTemplate('bloque_'.$fechas[$j].'_detalle_dato');	 
						$e->setVariable($fechas[$j].'_html',$ListaDeObjetos[$i][$fechas[$j].'_html']); 	
					}
				}
			}
		} 
		if((isset($ListaDeObjetos[0]['archivo_prestamo_firmado']) && trim($ListaDeObjetos[0]['archivo_prestamo_firmado']) == '') ||  trim($this->valores['id_item']) == '')
		{			
			//Funciones::mostrarArreglo($ListaDeObjetos,true);	
			$e->addTemplate('bloque_libros_prestamos_detalle_nuevo'); 
			$e->setVariable('fila',$total);
			$e = $this->MantenedoresGeneral->mostrarListadoGenerico($e,$libros,'bloque_libros_prestamos_detalle_libros');
			
			$e->addTemplate('bloque_libros_prestamos_generacion_documento_prestamo_form'); 
		}
		else
		{
			$e->addTemplate('bloque_libros_prestamos_generacion_documento_prestamo_descarga');
			$e->setVariable('archivo_prestamo_firmado',$InventarioLibrosPrestamos->archivo_prestamo_firmado);
			
			
			
			$e->addTemplate('bloque_libros_devolucion_fecha_form'); 
			if(trim($InventarioLibrosPrestamos->fecha_devolucion) == '')
			{
				$e->addTemplate('bloque_fecha_devolucion_form'); 
			}
			else
			{
				$e->addTemplate('bloque_fecha_devolucion_dato');
				$e->setVariable('fecha_devolucion_html',ControladorFechas::invertirFecha($InventarioLibrosPrestamos->fecha_devolucion)); 
				
				if(isset($ListaDeObjetos[0]['archivo_devolucion_firmado']) && trim($ListaDeObjetos[0]['archivo_devolucion_firmado']) == '')
				{
					$e->addTemplate('bloque_libros_devolucions_generacion_documento_devolucion_form');
				}
				else
				{
					$e->addTemplate('bloque_libros_devolucion_generacion_documento_prestamo_descarga');
					$e->setVariable('archivo_devolucion_firmado',$InventarioLibrosPrestamos->archivo_devolucion_firmado);
				} 
			} 
		}
		if((isset($ListaDeObjetos[0]['archivo_prestamo_firmado']) && trim($ListaDeObjetos[0]['archivo_prestamo_firmado']) == '') &&  trim($this->valores['id_item']) != '' && is_array($ListaDeObjetos) && $total>0)
		{
			$ControlDocumentoWord = new ControlDocumentoWord();
			$ControlDocumentoWord->prepararTemplate('prestamo_libros_'.$total);
			
			$ControlInventarioLibrosPrestamos = new ControlInventarioLibrosPrestamos(); 
			$ControlDocumentoWord->setValue('numero_memo',$ControlInventarioLibrosPrestamos->obtenerNuevoNumeroMemo());
			$ControlDocumentoWord->setValue('agno_actual',date("Y"));
			$hoy = ControladorFechas::traducirMes(date("d \d\e F \d\e Y"),'en-es',true);
			$ControlDocumentoWord->setValue('fecha_actual',$hoy); 
			echo ControladorFechas::fechaTexto($InventarioLibrosPrestamos->fecha_devolucion_estimada,'en-es',true).'+++';
			$ControlDocumentoWord->setValue('fecha_devolucion',ControladorFechas::fechaTexto($InventarioLibrosPrestamos->fecha_devolucion_estimada,'en-es',true));
			
			$PersonaObjeto = new PersonaObjeto();
			$PersonaObjeto->buscarObjeto($InventarioLibrosPrestamos->id_usuario_gestiona);
			$ControlDocumentoWord->setValue('persona_responsable_prestamos',$PersonaObjeto->nombre.' '.$PersonaObjeto->apellido_paterno);	 
			if(trim($PersonaObjeto->rut) != '')
				$ControlDocumentoWord->setValue('rut_persona_responsable_prestamos',Funciones::formatoNumero($PersonaObjeto->rut).'-'.$PersonaObjeto->rut_dv);
			else
				$ControlDocumentoWord->setValue('rut_persona_responsable_prestamos','');   
			$PersonaObjeto = new PersonaObjeto();
			$PersonaObjeto->buscarObjeto($InventarioLibrosPrestamos->id_usuario_solicitante);
			$ControlDocumentoWord->setValue('persona_solicitante_prestamos',$PersonaObjeto->nombre.' '.$PersonaObjeto->apellido_paterno); 
			if(trim($PersonaObjeto->rut) != '')
				$ControlDocumentoWord->setValue('rut_persona_solicitante_prestamos',Funciones::formatoNumero($PersonaObjeto->rut).'-'.$PersonaObjeto->rut_dv);
			else
				$ControlDocumentoWord->setValue('rut_persona_solicitante_prestamos','');  
			for($i=0; $i < $total; $i++)
			{  
				$ControlDocumentoWord->setValue('numero_inventario_'.$i,$ListaDeObjetos[$i]['id_libro']); 
				$ControlDocumentoWord->setValue('libro_titulo_'.$i,$ListaDeObjetos[$i]['titulo_libro']); 
				$ControlDocumentoWord->setValue('libro_autores_'.$i,$ListaDeObjetos[$i]['autores_libro']); 
				$ControlDocumentoWord->setValue('libro_editorial_'.$i,$ListaDeObjetos[$i]['editorial_libro']); 
			}
			
			$archivo = $ControlDocumentoWord->generarDocumento();
			
			if(is_array($ListaDeObjetos) && count($ListaDeObjetos) > 0)
			{
				$e->addTemplate('bloque_libros_prestamos_generacion_documento_prestamo');
				$e->setVariable('archivo',$archivo);
			} 
		}
		
		//Funciones::mostrarArreglo($libros_activos,true);	 
		
		return $e;
	} 
	
	function mostrarFormulario()
	{	  			 
		$e = new miniTemplate($this->path_admin.'formulario.tpl'); 
		
        $e = parent::mostrarFormulario($e); 
		
        if(trim($this->valores['id_item']) == '')
        {
			$ControlInventarioLibrosLibros = new ControlInventarioLibrosLibros();
			$e->setVariable('id_libro',$ControlInventarioLibrosLibros->obtenerNuevoID());
		}  
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

class ControlGeneralInventarioLibrosPrestamos extends ControlGeneralInventarioLibros
{
	function ControlGeneralInventarioLibrosPrestamos($path_admin,$ControlHtml)
	{
		parent::ControlGeneral($path_admin,$ControlHtml); 			
		$this->valores 		= VarSystem::getPost();
        $this->valoresGet   = VarSystem::getGet();	 
        $this->Objeto  		= new InventarioLibrosLibros();   
		$this->ControlClase = new ControlVistaPrestamoLibrosUsuario(); 
        $this->ObjetoClase  = new ControlVistaPrestamoLibrosUsuario(); 
	}  
	
	  
} 
?>