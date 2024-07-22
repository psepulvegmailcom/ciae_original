<?php 
	if(VarConfig::estadoDebug)
	{
		Funciones::mostrarArreglo($POST); 
		Funciones::mostrarArreglo($GET); 
		Funciones::mostrarArreglo($_FILES);
		Funciones::mostrarArreglo($_SESSION);
		global $indexOutput; 
		echo $indexOutput;  
	}
	else
	{ 
		error_reporting(0);
	}	
?>