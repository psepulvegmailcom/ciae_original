<?php
	$config_file = '../config/config_evaluaciones.cfg';   
	if(!is_file($config_file))
	{
		$config_file = '../'.$config_file;
	}
	
	include $config_file;  

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	/*LECTURA DE VARIABLES DEL POST*/
	$variablesPost = array('_GET','_POST');
	foreach($variablesPost as $i => $varPost)
		if(count($$varPost) > 0 )
			foreach($$varPost as $var => $value)
				$$var=$value;   
	/******************************************************************************************************
						CHEQUEOS PARA LOGIN DEL SISTEMA
	******************************************************************************************************/ 
  	$GET 	= VarSystem::getGet();
	$POST 	= VarSystem::getPost();
	
	
	$indexOutput = '';
	Funciones::mostrarArreglo($POST); 
?>