<?php

	global $ControlHtml;  	 

	   
	$lastAction 				= $ControlHtml->lastActionArray; 	
	
	$e = new miniTemplate(VarSystem::getPathVariables('dir_template').'maqueta/'.$lastAction[0].'.tpl'); 
	Funciones::mostrarArreglo($e);
	$e = $ControlHtml->setVariablesGlobales($e);
	echo $e->toHtml();
?>	