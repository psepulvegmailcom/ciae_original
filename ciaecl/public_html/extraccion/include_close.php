<?php  
		Funciones::mostrarArreglo($POST); 
		Funciones::mostrarArreglo($GET); 	
		Funciones::mostrarArreglo($_FILES);
		Funciones::mostrarArreglo($_SESSION);	
		Funciones::mostrarArreglo($_SERVER); 
		global $indexOutput;
		echo $indexOutput;  
 
?>