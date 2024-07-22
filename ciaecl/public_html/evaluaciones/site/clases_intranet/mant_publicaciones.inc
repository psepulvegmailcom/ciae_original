<?
	 
	global $ControlHtml; 
	//$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/publicaciones/'; 
	 		 
	$valores 		= VarSystem::getPost();  
	$archivos		= VarSystem::getFile();
 
	$MantenedoresGeneral = new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto = new MantenedoresGeneralObjeto();
	$FormGeneral  = new FormGeneral(); 
	$ControlClase = new ControlPublicaciones(); 
	$ControlClasePersonas = new ControlPublicacionesPersona(); 
	$ObjetoClase  = new Publicaciones(); 
	
	if($lastAction[1] == 'guardar' || $lastAction[2] == 'eliminar_persona')
	{ 
		if($lastAction[2] == 'eliminar_persona')
		{
			$PublicacionesPersona = new PublicacionesPersona();
			$PublicacionesPersona->id_persona 		= $valores['persona_eliminar_id'];
			$PublicacionesPersona->id_publicaciones	= $valores['id_item'];
			$PublicacionesPersona->orden 			= $valores['persona_eliminar_orden'];
			$PublicacionesPersona->persona_nombre 	= $valores['persona_eliminar_nombre']; 
			$PublicacionesPersona->eliminarObjetoPersona();
		} 
		$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores);
		if(isset($ObjetoClase->id) && trim($ObjetoClase->id) != '')
		{
			$ObjetoClase->id_publicaciones = $ObjetoClase->id;
		} 
		
		//Funciones::mostrarArreglo($ObjetoClase,true);
		$ObjetoClase->buscarObjeto($ObjetoClase->id_publicaciones);
		 
		$total = count($valores['persona_extra_nombre']);
		for($i=0; $i < $total; $i++)
		{
			if((trim($valores['persona_extra_nombre'][$i]) != '' && $valores['persona_extra_id'][$i] == 1) || (trim($valores['persona_extra_nombre'][$i]) == '' && $valores['persona_extra_id'][$i] > 1))
			{
				$PublicacionesPersona = new PublicacionesPersona();
				$PublicacionesPersona->id_persona 		= $valores['persona_extra_id'][$i];
				$PublicacionesPersona->id_publicaciones	= $ObjetoClase->id_publicaciones;
				$PublicacionesPersona->orden 			= $valores['persona_extra_orden'][$i];
				$PublicacionesPersona->cargo 			= $valores['persona_extra_cargo'][$i];
				if($PublicacionesPersona->id_persona == 1)
				{
					$PublicacionesPersona->persona_nombre 	= $valores['persona_extra_nombre'][$i];	
				} 
				$PublicacionesPersona->guardarObjeto();
			}
		} 
		$PublicacionesPersona = new PublicacionesPersona();
		$PublicacionesPersona->id_persona 		= 1;
		$PublicacionesPersona->id_publicaciones	= $ObjetoClase->id_publicaciones;
		$PublicacionesPersona->orden 			= 30;
		$PublicacionesPersona->persona_nombre 	= ''; 
		$PublicacionesPersona->eliminarObjetoPersona();	 
		
		/******* SE GUARDAN LOS ARCHIVOS *************/
		if(is_array($archivos))
		{  
			if(is_array($archivos['form_documento']) && $archivos['form_documento']['size'] > 0)
			{
				$path  = VarSystem::getPathVariables('dir_repositorio').'doc/publicaciones/'; 
				$archivos['form_documento']['new_name'] = $valores['form_titulo'][0]; 
				$DocumentFile  = new DocumentFile($path);  
				$DocumentFile->setFileArray($archivos['form_documento']); 
				if($DocumentFile->saveFile(false))
				{
					$ObjetoClase->documento  = $DocumentFile->getFileName();	 
				}				
			}
		}  
		$ObjetoClase->guardarObjeto($ObjetoClase->id_publicaciones); 
	} 	
	
	
	switch($lastAction[1])
	{	
		default:
			$e = new miniTemplate($path_admin.'mant.tpl'); 
			$e->setVariable('opcion_modulo',$lastAction[0]); 
			$ListaDeObjetos = $ControlClase->obtenerListadoCompleto(); 
		  	//Funciones::mostrarArreglo($ListaDeObjetos,true);
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
			$ListaDeObjetos[0]['id_item'] = $ListaDeObjetos[0][$ObjetoClase->dbKey];
			$e = $MantenedoresGeneral->mostrarElementoValores($e,$ListaDeObjetos[0]); 
			
			$e = $MantenedoresGeneral->mostrarSeleccionBinario($e,$ListaDeObjetos[0],'activo');
			$e = $MantenedoresGeneral->mostrarSeleccionBinario($e,$ListaDeObjetos[0],'destacado');
			$e = $MantenedoresGeneral->mostrarSeleccionBinario($e,$ListaDeObjetos[0],'ver_detalle');
			$e = $MantenedoresGeneral->mostrarSeleccionBinario($e,$ListaDeObjetos[0],'isi');
			$e = $MantenedoresGeneral->mostrarSeleccionBinario($e,$ListaDeObjetos[0],'documento_publico'); 

			$ControlTipo = new ControlTipoPublicaciones();
			$tipo_listado = $ControlTipo->obtenerListado();
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_tipo_publicacion',$tipo_listado,$ListaDeObjetos[0],'id_tipo');			   		 
			$ControlTipo = new ControlAreas();
			$tipo_listado = $ControlTipo->obtenerListado();
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_area',$tipo_listado,$ListaDeObjetos[0],'id_area');

			$listado = $ControlClase->obtenerPersonas($ListaDeObjetos[0]['id_item']); 
			$e = $MantenedoresGeneral->mostrarPersonasEdicionListado($e,$listado,$lastAction[0]); 
			 
		break;  
	}
	echo $e->toHtml();
?>