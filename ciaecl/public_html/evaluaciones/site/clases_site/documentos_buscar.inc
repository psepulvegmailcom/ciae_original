<?php

	global $ControlHtml;
	$lastAction = $ControlHtml->lastActionArray; 
	$valores = VarSystem::getGet(); 
	$valores['p'] = 1; 
	$e 	= new miniTemplate(VarSystem::getPathVariables('dir_template_sitio').'documentos_buscar.tpl');
 	$ControlDocumentos = new ControlDocumentos(); 
 	$e = $ControlDocumentos->buscarDocumentosGet($e,$valores); 
 	echo $e->toHtml();
?>