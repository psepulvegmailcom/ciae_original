<?php

	$oferentes  		= VarSystem::getVariable('oferentes');  
	$oferentes 			= explode('-',$oferentes);  
	$total 				= count($oferentes);

	global $ControlHtml;  
	$ControlLogs 		= new ControlLogs();

	for($i=0; $i < $total; $i++)
	{
		if(trim($oferentes[$i]) == '')
			continue;

		echo "mostrarCargandoImagen('info_oferente_".$oferentes[$i]."');";
	}

	
	$con_titulo = VarSystem::getVariable('con_titulo');
	if($con_titulo == 'si')
		echo "mostrarCargandoImagen('titulo_info_alternativo');";	  
 
?>