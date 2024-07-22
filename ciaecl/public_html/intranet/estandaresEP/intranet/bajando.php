<?php
 include ("../conexion.php");
 $enlace = "../".$ruta."/".$_GET["archivo"];
 $archivo=str_replace(" ", "_", $_GET["archivo"]);
 header ("Content-Disposition: attachment; filename=".$archivo."\n\n");
 header ("Content-Type: application/octet-stream");
 header ("Content-Length: ".filesize($enlace));
 readfile($enlace);
?>