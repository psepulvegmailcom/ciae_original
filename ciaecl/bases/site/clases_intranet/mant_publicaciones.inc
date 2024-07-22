<?php	
 
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
	$ControlGeneralIntranet = new ControlGeneralIntranet(); 
	$ControlGeneralMantenedor = new ControlGeneralMantenedorPublicaciones($path_admin,$ControlHtml);  
	 
	if($lastAction[1] == 'guardar' || $lastAction[2] == 'eliminar_persona')
	{ 
		if($lastAction[2] == 'eliminar_persona')
		{
				$ObjetoClaseP = new PublicacionesPersona();
				$ControlGeneralIntranet->eliminarPersonasMultiples($ObjetoClaseP,$valores);	
		}
		//Funciones::mostrarArreglo($valores,false,"valores");
		if(!isset($valores['form_numero']))
		{
			$valores['form_numero'] = '0';
		}
		Funciones::mostrarArreglo($valores,false,"valores");




		$ObjetoClase = $MantenedoresGeneralObjeto->guardarObjetoSimple($ObjetoClase,$valores);
		$ObjetoClase->buscarObjeto($ObjetoClase->id_publicaciones);
		
		if(!isset($ObjetoClase->id_publicaciones) && isset($ObjetoClase->id) && trim($ObjetoClase->id) != '')
		{  /* prensa nueva */			
			$ObjetoClase->id_publicaciones = $ObjetoClase->id;
			$valores['id_item'] = $ObjetoClase->id_publicaciones;
		} 					 
		$PublicacionesPersona = new PublicacionesPersona();
		$valores['id_tipo'] = 'id_publicaciones';
		$valores['p_extra'] = 'persona_nombre';		
		$ControlGeneralIntranet->formularioPersonasMultiples($PublicacionesPersona,$valores); 	 		
		/******* SE GUARDAN LOS ARCHIVOS *************/
		if(is_array($archivos))
		{ 
			$path  = 'doc/publicaciones/';
			$tipoArchivo = 'documento';
			$nuevoNombre = $valores['form_titulo'][0];  			
			$ObjetoClase->documento = $ControlGeneralIntranet->guardarArchivos($archivos,$valores,$path,$tipoArchivo,$nuevoNombre);
		}  
		$ObjetoClase->guardarObjeto($ObjetoClase->id_publicaciones); 
		$PublicacionSitio = new PublicacionSitio();
		$valores['sitio_usuario'] = $ControlHtml->sitioUsuario();
		if ($valores['sitio_usuario']=='') $valores['sitio_usuario']=1;
		$ControlGeneralIntranet->asociarSitio($PublicacionSitio,$valores,$ObjetoClase->id_publicaciones);		
		$personas= $valores['persona_extra_id'];
		$total_p = count($personas);
		for ($i=0; $i < $total_p; $i++)
		{
			if ($valores['persona_extra_id'][$i]=='13' or $valores['persona_extra_id'][$i]=='15' or $valores['persona_extra_id'][$i]=='149' or $valores['persona_extra_id'][$i]=='213' or $valores['persona_extra_id'][$i]=='388' or $valores['persona_extra_id'][$i]=='56' or $valores['persona_extra_id'][$i]=='387' or $valores['persona_extra_id'][$i]=='221' or $valores['persona_extra_id'][$i]=='297' or $valores['persona_extra_id'][$i]=='3' or $valores['persona_extra_id'][$i]=='381' or $valores['persona_extra_id'][$i]=='328' or $valores['persona_extra_id'][$i]=='106' or $valores['persona_extra_id'][$i]=='273' or $valores['persona_extra_id'][$i]=='124' or $valores['persona_extra_id'][$i]=='41' or $valores['persona_extra_id'][$i]=='40')
			{
				$valores['sitio_usuario']=6;
				$ControlGeneralIntranet->asociarSitio($PublicacionSitio,$valores,$ObjetoClase->id_publicaciones);					
			}
		}	
	} 	 
	
	if($lastAction[1] == 'eliminar')
	{ 		 
			$ControlGeneralMantenedor->eliminarPublicaciones();			
	}	
	
	Funciones::mostrarArreglo($lastAction,false,"tipo_listado lastAction");
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
				$e = $ControlGeneralMantenedor->mostrarListado();
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
			$tipo_listado = $ControlTipo->obtenerTipoAcademico();
			
			 Funciones::mostrarArreglo($tipo_listado,false,"tipo_listado");
			 $e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_tipo_publicacion_tipo',$tipo_listado,$ListaDeObjetos[0],'id_tipo');
			$ControlTipo = new ControlAreas();
			$tipo_listado = $ControlTipo->obtenerListado();
			$e = $MantenedoresGeneral->mostrarSeleccion($e,'bloque_form_id_area',$tipo_listado,$ListaDeObjetos[0],'id_area');

			$listado = $ControlClase->obtenerPersonas($ListaDeObjetos[0]['id_item']); 
			$e = $MantenedoresGeneral->mostrarPersonasEdicionListado($e,$listado,$lastAction[0]); 
			 
		break;  
	}
	echo $e->toHtml();
?>