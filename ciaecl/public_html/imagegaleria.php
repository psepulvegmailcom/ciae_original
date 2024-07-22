<?php

	include ("config.cfg");


	error_reporting(E_ERROR | E_WARNING | E_PARSE); 


	$ControlHtml		= new ControlHtml(); 
	
	$ControlHtml->checkIPBlock();
	$valores 			= VarSystem::getGet(); 
	 
	$dir = VarSystem::getPathVariables('dir_repositorio')."image/noticias/".$valores['id']; 
	$galeria = Funciones::obtenerListaArchivos($dir);
	echo json_encode($galeria);
?>