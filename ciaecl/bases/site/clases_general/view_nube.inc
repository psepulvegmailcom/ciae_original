<?php
		
	global $ControlHtml; 
  	$valoresGet = VarSystem::getGet();
  	$valores 	= VarSystem::getPost();
  	$e 			= new miniTemplate(VarSystem::getPathVariables('dir_template_general').'palabras_claves.tpl'); 
  	$ControlNube = new  ControlNube();
  	
	$palabras = $ControlNube->obtenerListadoPalabras();   
 		
	Funciones::mostrarArreglo($palabras);
	  
	$e->addTemplate('bloque_palabras_nube');  
		
	echo $e->toHtml();
?>