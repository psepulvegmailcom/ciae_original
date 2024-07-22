<?php 
		 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	  
	$theSession 	= $ControlHtml->theSession;   
	$lastAction 	= $ControlHtml->lastActionArray; 
	 
	$path_admin		= VarSystem::getPathVariables('dir_template').'evaluaciones/estado/';   

	$MantenedoresGeneral 		= new MantenedoresGeneral();
	$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction );
 
 	$e = new miniTemplate($path_admin.'mant.tpl');
	$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
	
	$ControlGeneralEvaluaciones->revisionEstadoEtapas();
	
	
	$etapas = $ControlGeneralEvaluaciones->datos['etapas']['listado'];
	
	$total = count($etapas);
	
	for($i=0; $i < $total; $i++)
	{
		$e->addTemplate('bloque_lista_item'); 
		$fila = $i + 1;
		$etapas[$i]['fila'] = $fila;
		$etapas[$i]['estado_html'] = ucfirst($etapas[$i]['estado']); 
		$etapas[$i]['etapa_html']  = ucfirst($etapas[$i]['etapa']); 
		$e = $MantenedoresGeneral->mostrarElementoValores($e,$etapas[$i]);
		$e = $MantenedoresGeneral->colorFilaGenerico($e,$i);
		
		$salida = $ControlGeneralEvaluaciones->revisionEstadoCompletoActividad($etapas[$i]['id_etapa']); 
		$e 		= $MantenedoresGeneral->mostrarElementoValores($e,$salida);
		
		Funciones::mostrarArreglo($salida);	
	} 
 	Funciones::mostrarArreglo($ControlGeneralEvaluaciones); 
	echo $e->toHtml(); 
	
?>