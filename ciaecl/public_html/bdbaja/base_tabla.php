<?php
	$config = "config.cfg";   
  	include $config;   
  	 
  	$valores = VarSystem::getGet();

	if(!isset($valores['caso']) || trim($valores['caso']) == '')
	{
		$contenido = "ERROR: debe indicar la inscripción a descargar";	
	}
	else
	{
		$ControlInscripcionDescarga = new ControlInscripcionDescarga();
		$output = $ControlInscripcionDescarga->descargaListado($valores['caso']); 
		
		$contenido = Funciones::generarTabla($output); 
		$contenido = stripcslashes($contenido);
	}
	echo $contenido;
?>