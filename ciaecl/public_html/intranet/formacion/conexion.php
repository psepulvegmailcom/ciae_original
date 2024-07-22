<?php
	$HOST = "localhost";
	$PORT = "3306";
	$USER = "ciaecl_formacion";
	$PASS = "formacion_perjocar_75";
	$DB = "ciaecl_formacion";
	
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
		
	$ruta="documentos";
	$rutaImg="imagenes";
	$peso_max = 2097152;
?>
