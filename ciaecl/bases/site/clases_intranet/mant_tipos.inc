<?php
	 
	global $ControlHtml; 
	//$ControlHtml->revisionSesion(true);		
	$theSession 		= $ControlHtml->theSession;   
	$theSessionPersona 	= $ControlHtml->elUsuarioPersona;
	$lastAction 		= $ControlHtml->lastActionArray;
	
	$ControlHtml->revisionSesion(); 
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/tipos/'; 
	 		  
	$ControlClase	= new ControlObjetos();
	
	$form_especial	= '';  
	  	 
	$ControlGeneral = new ControlGeneralMantenedorTipos($path_admin,$ControlHtml);  
	
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();	 
	switch($lastAction[0])
	{
		case 'view_centro_costo':
			$ControlClase = new ControlVistaCentroCostosResponsable();//ControlGestionCentroCostos(); 
			$ObjetoClase  = new GestionCentroCostos();
			$form_especial= '_centro_costos';
		break;		
		case 'view_tipos_proyecto':
			$ControlClase = new ControlTipoProyectos(); 
			$ObjetoClase  = new TipoProyectos();
		break;
		case 'view_tipos_proyecto_area':
			$ControlClase = new ControlTipoAreaProyectos(); 
			$ObjetoClase  = new TipoAreaProyectos();
		break;
		case 'view_tipos_publicaciones':
			$ControlClase = new ControlTipoPublicaciones(); 
			$ObjetoClase  = new PublicacionesTipo();
			$form_especial= '_publicaciones';
		break;
		case 'view_tipos_personas':
			$ControlClase = new ControlTipoPersona(); 
			$ObjetoClase  = new TipoPersona();
			$form_especial= '_personas';
		break;
		case 'view_tipos_universidad':
			$ControlClase = new ControlUniversidad(); 
			$ObjetoClase  = new Universidad();
			$form_especial= '_universidad';
		break;
		case 'view_tipos_area':
			$ControlClase = new ControlAreas(); 
			$ObjetoClase  = new Areas();
			$form_especial= '_area';
		break;
        case 'view_tipos_recursos':
			$ControlClase = new ControlTipoRecursos(); 
			$ObjetoClase  = new TipoRecursos();
			$form_especial= '_recursos';
		break; 
	} 
	$ControlGeneral->setearControlClase($ControlClase);
	$ControlGeneral->setearObjetoClase($ObjetoClase); 
	 
	if($lastAction[1] == 'guardar')
	{		
		$ControlGeneral->objetoGuardar();
	}
	
	switch($lastAction[1])
	{	
		default: 
			$e = $ControlGeneral->mostrarListado($form_especial); 
		break;		
		case 'modificar':
			if($lastAction[0] == 'view_centro_costo')
			{
				if($valores['id_item'] == 10000)
				{
					echo "<strong>ESTE ELEMENTO NO SE PUEDE MODIFICAR</strong>";
					$e = $ControlGeneral->mostrarListado($form_especial);
				} 
				else
				{
					$e = $ControlGeneral->mostrarFormularioCentroCosto($form_especial);
				}
			}
			else
			{
            	$e = $ControlGeneral->mostrarFormulario($form_especial,$lastAction[0] );
			} 
		break;  
	}
	echo $e->toHtml();
?>