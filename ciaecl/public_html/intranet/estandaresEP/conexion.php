<?php
	$HOST = "localhost";
	$PORT = "3306";
	$USER = "ciaecl_parvesta";
	$PASS = "parv_perjocar_75";
	$DB   = "ciaecl_parvdefinicion";
	$DB_externa   = "ciaecl_parvrevision";
	
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
		
	$ruta		= "documentos";
	$rutaImg	= "imagenes";
	$peso_max 	= 7097152;
?>
