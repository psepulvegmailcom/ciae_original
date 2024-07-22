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
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition:  filename=".date("Ymd")."-Inscritos-".str_replace(" ","",VarConfig::site_title).".xls;");
		$contenido = stripcslashes($contenido);	
	}

	echo $contenido;
?>