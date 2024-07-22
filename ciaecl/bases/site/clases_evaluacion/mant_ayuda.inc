<?php 
		 
	global $ControlHtml; 
	$ControlHtml->revisionSesion();	 	
	$theSession 				= $ControlHtml->theSession;   
	$lastAction 				= $ControlHtml->lastActionArray; 
	 
 	$ControlGeneralEvaluaciones	= new ControlGeneralEvaluaciones($ControlHtml->theSession->userObject,$lastAction );
	
 
	 
	$path_admin					= VarSystem::getPathVariables('dir_template').'evaluaciones/';   
	
	
	$e = new miniTemplate($path_admin.'ayuda.tpl');
	
	$e = $ControlGeneralEvaluaciones->baseValoresTemplate($e);
	$e->setVariable('descripcion',$ControlGeneralEvaluaciones->datos['evaluacion']['bienvenida']);
	echo $e->toHtml(); 
	
 	Funciones::mostrarArreglo(array('SALIDA FINAL',$ControlGeneralEvaluaciones));
 
?>