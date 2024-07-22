<?php

	global $ControlHtml; 
  	$valoresGet = VarSystem::getGet();
  	$valores 	= VarSystem::getPost();
  	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_web').'contacto_es.tpl'); 
  	 
  	if(isset($valores['caso']) && trim($valores['caso']) == 'guardar')
  	{ 
		$ControladorContacto = new ControladorContacto();
		$ControladorContacto->enviarContacto($valores);  
		$e->addTemplate('bloque_mensaje_enviado');
	}
	echo $e->toHtml();
?>