<?php
$url = "https://www.ciae.uchile.cl/download.php?file=".$_GET['file'];
header("Location: $url");
die();


	//Ejemplo:<a href="download.php?tipo=envios&file=000144.pdf">Bajar Aqui</a>
	//directorio de los archivos
 
	include ("config.cfg");
 
 
	include_once 'download_simple.php'; 
?>
