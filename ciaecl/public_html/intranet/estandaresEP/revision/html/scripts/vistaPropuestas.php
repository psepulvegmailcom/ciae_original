<?php
	$config = "../../config.cfg";   
  	include $config;
  	
  	$propuesta = $_GET['propuesta'];
  	
  	$filename = '../images/propuestas/'.$propuesta.'.png';
	$img = imagecreatefrompng($filename);
	//$img 		= Funciones::ImagenMarcaAgua($img );
 	header("Content-Type: image/jpeg");
 
	imagejpeg($img); 
	imagedestroy($img);
?>