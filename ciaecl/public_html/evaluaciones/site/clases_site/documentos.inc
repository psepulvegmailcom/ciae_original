<?php

	global $ControlHtml;
	$lastAction = $ControlHtml->lastActionArray; 
	$opcionHtml = VarSystem::getVariable('page','GET');  
 
 	$ControlDocumentos = new ControlDocumentos();
 	
	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'documentos.tpl');
 	$e = $ControlDocumentos->obtenerListadoDocumentos($e,$opcionHtml);
 	echo $e->toHtml();
?>