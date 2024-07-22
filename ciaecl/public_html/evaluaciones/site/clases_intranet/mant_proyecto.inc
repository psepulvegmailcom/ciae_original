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
	$ObjetoClase  = new Proyectos();
	$FormGeneral  = new FormGeneral();  
	 
	if($lastAction[1] == 'guardar' || $lastAction[2] == 'eliminar_persona')
	{ 
		if($lastAction[2] == 'eliminar_persona')
		{
			$ProyectosPersonas = new ProyectosPersonas();
			$ProyectosPersonas->id_persona 		= $valores['persona_eliminar_id'];
			$ProyectosPersonas->id_proyecto 	= $valores['id_item'];
			$ProyectosPersonas->orden 			= $valores['persona_eliminar_orden'];
			$ProyectosPersonas->nombre_extra 	= $valores['persona_eliminar_nombre']; 
			$ProyectosPersonas->eliminarObjetoPersona();
		} 
		$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores); 
		$ObjetoClase->buscarObjeto($ObjetoClase->id_proyecto);
		 
		$total = count($valores['persona_extra_nombre']);
		for($i=0; $i < $total; $i++)
		{
			$ProyectosPersonas = new ProyectosPersonas();
			$ProyectosPersonas->id_persona 		= $valores['persona_extra_id'][$i];
			$ProyectosPersonas->id_proyecto 	= $ObjetoClase->id_proyecto;
			$ProyectosPersonas->orden 			= $valores['persona_extra_orden'][$i];
			$ProyectosPersonas->cargo 			= $valores['persona_extra_cargo'][$i];
			if($ProyectosPersonas->id_persona == 1)
			{
				$ProyectosPersonas->nombre_extra 	= $valores['persona_extra_nombre'][$i];	
			} 
			$ProyectosPersonas->guardarObjeto();
		} 
		$ProyectosPersonas = new ProyectosPersonas();
		$ProyectosPersonas->id_persona 		= 1;
		$ProyectosPersonas->id_proyecto 	= $ObjetoClase->id_proyecto;
		$ProyectosPersonas->orden 			= 30;
		$ProyectosPersonas->nombre_extra 	= ''; 
		$ProyectosPersonas->eliminarObjetoPersona();	 
	} 
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerListado();
			 
			// Funciones::mostrarArreglo($ListaDeObjetos);
			if(!is_array($ListaDeObjetos) || count($ListaDeObjetos) == 0)
			{
				$e->addTemplate('item_lista_nohay'); 
			}
			else
			{ 
				$e = $MantenedoresGeneral->mostrarListado($e,$ListaDeObjetos,$ObjetoClase->dbKey,$lastAction[0]);
				//$ControlClasePersonas->obtenerListadoPersonasCompleto();
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