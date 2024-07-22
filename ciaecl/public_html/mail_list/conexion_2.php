<?php
	$HOST = "localhost";
	$PORT = "3306";
	$USER = "ciaecl_correoweb";
	$PASS = "correo_perjocar_75";
	$DB   = "ciaecl_correoweb";
	
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
		 
	
 
?>