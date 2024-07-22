<?
	 
	global $ControlHtml; 
	//$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/personas/'; 
	 		 
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	
	$MantenedoresGeneral = new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto = new MantenedoresGeneralObjeto();
 
	$ControlClase = new ControlPersonaObjeto(); 
	$ObjetoClase  = new PersonaObjeto();
	$FormGeneral  = new FormGeneral();  
	 
	if($lastAction[1] == 'eliminar')
	{		 
		$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores);  
		$ObjetoClase->buscarObjeto($ObjetoClase->id_persona);
		
		$nombre_reemplazo = $ObjetoClase->nombre_publicacion;
		if(trim($ObjetoClase->nombre_publicacion) == '')
		{
			if(trim($ObjetoClase->apellido_materno) != '')
			{
				$ObjetoClase->apellido_materno = " ".trim($ObjetoClase->apellido_materno);
			}
			$nombre_reemplazo = trim($ObjetoClase->apellido_paterno).$ObjetoClase->apellido_materno.', '.trim($ObjetoClase->nombre);
		} 
		
		$ControlPublicacionesPersona = new ControlPublicacionesPersona();
		$ControlPublicacionesPersona->eliminarReemplazoPersonaPublicacion($ObjetoClase->id_persona,$nombre_reemplazo);
		
		$ControlProyectosPersonas = new ControlProyectosPersonas();
		$ControlProyectosPersonas->eliminarReemplazoPersonaProyecto($ObjetoClase->id_persona,$nombre_reemplazo);
		
		$ObjetoClase->eliminarObjeto($ObjetoClase->id_persona); 
		
		echo "La persona '".$ObjetoClase->nombre." ".$ObjetoClase->apellido_paterno."' fue eliminada del sistema.";
	} 
	if($lastAction[1] == 'guardar')
	{ 
		//Funciones::mostrarArreglo($valores);
		//Funciones::mostrarArreglo($archivos);
		$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores);  
		$ObjetoClase->buscarObjeto($ObjetoClase->id_persona);
		
		/** SE GUARDAN LOS ARCHIVOS */
		if(is_array($archivos))
		{ 
			if(is_array($archivos['form_imagen']) && $archivos['form_imagen']['size'] > 0)
			{
				$archivos['form_imagen']['new_name'] = $valores['form_nombre'][0].'_'.$valores['form_apellido_paterno'][0];
				$path  = VarSystem::getPathVariables('dir_repositorio').'image/personas/'; 
				$DocumentFile  = new DocumentFile($path);  
				$DocumentFile->setFileArray($archivos['form_imagen']); 
				if($DocumentFile->saveFile(false))
				{
					$ObjetoClase->imagen  = $DocumentFile->getFileName();	 
				}								 				
			}
			if(is_array($archivos['form_cv_archivo']) && $archivos['form_cv_archivo']['size'] > 0)
			{
				$path  = VarSystem::getPathVariables('dir_repositorio').'doc/cv/'; 
				$archivos['form_cv_archivo']['new_name'] = $valores['form_nombre'][0].'_'.$valores['form_apellido_paterno'][0]; 
				$DocumentFile  = new DocumentFile($path);  
				$DocumentFile->setFileArray($archivos['form_cv_archivo']); 
				if($DocumentFile->saveFile(false))
				{
					$ObjetoClase->cv_archivo  = $DocumentFile->getFileName();	 
				}				
			}
		}
		
		Funciones::mostrarArreglo($ObjetoClase);
		/** SE GUARDAN LOS DATOS */
		if(trim($valores['id_item']) != '')
 		{
			/** EDICION ELEMENTO */
			$ObjetoClase->guardarObjeto($valores['id_item']);
		}
		else
		{
			$ObjetoClase->guardarObjeto();
		} 
		if(!isset($ObjetoClase->id_persona) && isset($ObjetoClase->id) && trim($ObjetoClase->id) != '')
		{
			/* persona nueva */
			$ObjetoClase->id_persona = $ObjetoClase->id;
		} 
		/** GUARDAR AREAS */
		if($ObjetoClase->id_persona != '')
 		{
		 	$ControlPersonaRelacionArea = new ControlPersonaRelacionArea();
			$ControlPersonaRelacionArea->eliminarElementos($ObjetoClase->id_persona);
		 
		 	$areas = $valores['formexterno_area'];
		 	for($i=0; $i < count($areas);$i++)
		 	{
		 		$PersonaRelacionArea = new PersonaRelacionArea();
				$PersonaRelacionArea->id_persona = $ObjetoClase->id_persona;
				$PersonaRelacionArea->id_area	 = $areas[$i];
				$PersonaRelacionArea->guardarObjeto();
			}

		 	$ControlPersonaRelacionTipo = new ControlPersonaRelacionTipo();
			$ControlPersonaRelacionTipo->eliminarElementos($ObjetoClase->id_persona);
		 
		 	$datos = $valores['formexterno_tipo_persona'];
		 	for($i=0; $i < count($datos);$i++)
		 	{
		 		$PersonaRelacionTipo = new PersonaRelacionTipo();
				$PersonaRelacionTipo->id_persona = $ObjetoClase->id_persona;
				$PersonaRelacionTipo->id_tipo	 = $datos[$i];
				$PersonaRelacionTipo->guardarObjeto();
			}			
		} 
	}
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerListado('1');
			 
			// Funciones::mostrarArreglo($ListaDeObjetos[1]);
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
			
			$e->setVariable('tag_volver',$FormGeneral->showVolver($lastAction[0]));
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerElemento($valores['id_item']); 
			
			if(trim($valores['id_item']) == '')
			{
				$ListaDeObjetos[0]['id_universidad'] = '1';
				$ListaDeObjetos[0]['afiliacion'] = 'Centro de Investigación Avanzada en Educación, Universidad de Chile';
			}
  			 
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]);  
			$e = $MantenedoresGeneral->mostrarSeleccionEstado($e,$ListaDeObjetos[0]); 
 
			$ControlUniversidad = new ControlUniversidad();
			$universidades = $ControlUniversidad->obtenerListado();
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_universidad',$universidades,$ListaDeObjetos[0],'id_universidad');			
			$ControlAreas 	= new ControlAreas();
			$areas 			= $ControlAreas->obtenerListado();
			$ControlPersonaRelacionArea = new ControlPersonaRelacionArea();
			$personaarea	= $ControlPersonaRelacionArea->obtenerElemento($ListaDeObjetos[0]['id_persona']);			
			$e = $MantenedoresGeneral->mostrarSeleccionMultiple($e,'bloque_form_id_area',$areas,$personaarea,'id_area');
			
			$ControlTipoPersona 	= new ControlTipoPersona();
			$tipo 			= $ControlTipoPersona->obtenerListado();
			$ControlPersonaRelacionTipo = new ControlPersonaRelacionTipo();
			$personatipo	= $ControlPersonaRelacionTipo->obtenerElemento($ListaDeObjetos[0]['id_persona']);			
			$e = $MantenedoresGeneral->mostrarSeleccionMultiple($e,'bloque_form_id_tipo_persona',$tipo,$personatipo,'id_tipo'); 
			
			
			
			
			
			
		break;  
	}
	echo $e->toHtml();
?>