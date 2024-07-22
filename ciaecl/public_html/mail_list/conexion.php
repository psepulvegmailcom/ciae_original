<?php
	$HOST = "localhost";
	$PORT = "3306";
	$USER = "ciaecl_correoweb";
	$PASS = "p3rj0c4r_correo";
	$DB   = "ciaecl_correoweb";
	
	$conn = mysql_connect($HOST . ":" . $PORT , $USER, $PASS);
	mysql_select_db($DB);
		 
	
 
?>