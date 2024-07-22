<?php

	$siteTitle = VarSystem::getInfoSystem('title');
	global $ControlHtml; 
	 // Funciones::mostrarArreglo($ControlHtml->lastActionArray);
	$ControlHtml->revisionSesion(true);		
	$theSession 	= $ControlHtml->theSession;  
 
	$lastAction 	= explode('|',$ControlHtml->laPagina->lastAction);   
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/archivo/'; 
	 		 
	$valores 		= VarSystem::getPost(); 
	$FormGeneral  	= new FormGeneral();  
	//Funciones::mostrarArreglo($_POST);
	$e = new miniTemplate($path_admin.'form.tpl'); 
	echo $e->toHtml();
?>