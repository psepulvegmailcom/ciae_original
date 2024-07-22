<?	 
	global $ControlHtml; 
	//$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray; 	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/proyectos/'; 
	 		 
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	
	$MantenedoresGeneral = new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto = new MantenedoresGeneralObjeto();
 	
	$ControlClase = new ControlProyectos(); 
	$ControlClasePersonas = new ControlProyectosPersonas(); 
	$ControlGeneralIntranet = new ControlGeneralIntranet(); 
	$ObjetoClase  = new Proyectos();
	$FormGeneral  = new FormGeneral();  
	 
	if($lastAction[1] == 'guardar' || $lastAction[2] == 'eliminar_persona')
	{ 
		if($lastAction[2] == 'eliminar_persona')
		{
			$ObjetoClaseP = new ProyectosPersonas();
			$ControlGeneralIntranet->eliminarPersonasMultiples($ObjetoClaseP,$valores);	
		} 
		$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores); 
		$ObjetoClase->buscarObjeto($ObjetoClase->id_proyecto);
		if(!isset($ObjetoClase->id_proyecto) && isset($ObjetoClase->id) && trim($ObjetoClase->id) != '')
		{/* proyecto nuevo */
			$ObjetoClase->id_proyecto = $ObjetoClase->id;
			$valores['id_item'] = $ObjetoClase->id_proyecto;
		} 
		$ProyectosPersonas = new ProyectosPersonas();
		$valores['id_tipo'] = 'id_proyecto';
		$valores['p_extra'] = 'nombre_extra';	
		$ControlGeneralIntranet->formularioPersonasMultiples($ProyectosPersonas,$valores); 		
						
		$ProyectoSitio = new ProyectoSitio();
		$valores['sitio_usuario'] = $ControlHtml->sitioUsuario();
		$ControlGeneralIntranet->asociarSitio($ProyectoSitio,$valores,$ObjetoClase->id_proyecto);
	} 
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerListadoCompleto();			 
			// Funciones::mostrarArreglo($ListaDeObjetos);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$e = $MantenedoresGeneral->mostrarListado($e,$ListaDeObjetos,$ObjetoClase->dbKey,$lastAction[0]);			
			}		
		break;		
		case 'modificar':
			$e = new miniTemplate($path_admin.'form.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$ListaDeObjetos = $ControlClase->obtenerElemento($valores['id_item']); 
  			//  Funciones::mostrarArreglo($ListaDeObjetos);
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);   
			$e = $MantenedoresGeneral->mostrarSeleccionEstado($e,$ListaDeObjetos[0]); 
			
			$ControlTipoProyectos = new ControlTipoProyectos();
			$tipo_proyectos = $ControlTipoProyectos->obtenerListado();
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_tipo_proyecto',$tipo_proyectos,$ListaDeObjetos[0],'id_tipo');			   
			$ControlTipoAreaProyectos = new ControlTipoAreaProyectos();
			$tipo_area_proyectos = $ControlTipoAreaProyectos->obtenerListado();
			//Funciones::mostrarArreglo($tipo_area_proyectos,true);
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_tipo_area_proyecto',$tipo_area_proyectos,$ListaDeObjetos[0],'id_tipo_area_proyecto');
			
			$meses_inicio = $ControlGeneralIntranet->mesesInicio();
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_mes_inicio_proyecto',$meses_inicio,$ListaDeObjetos[0],'mes_inicio');
						    			
			$listado = $ControlClase->obtenerPersonas($ListaDeObjetos[0]['id_item']);
			$e = $MantenedoresGeneral->mostrarPersonasEdicionListado($e,$listado,$lastAction[0]); 
			
			$ControladorHTML = new ControladorHTML();
			$datos['caso'] 	= 'proyectos';
			$datos['id'] 	= $valores['id_item'];
			$listado = $ControladorHTML->buscarListadoAreas($datos);			
			//Funciones::mostrarArreglo($listado);
			$total = count($listado);
			for($i=0; $i < $total; $i++)
			{
				$e->addTemplate('bloque_form_area_ciae');
				$e = $MantenedoresGeneral->mostrarElementoValores($e,$listado[$i]);
			}
		break;  
	}		
	echo $e->toHtml();
?>