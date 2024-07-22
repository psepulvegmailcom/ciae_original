<?php
 session_start();	
  
 
 if(!isset($_SESSION['nom_usuario']))
 { 
	echo "<script>alert('Debe iniciar sesión para acceder a los contenidos');</script>";
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=../index.php">';
 
 }

 include ("../conexion.php");
 include ("../rules.php");
 
 
/* inclusion de clases extras */

include ("../clases/powerTemplate/class.TemplatePower.inc.php");
include ("../clases/powerTemplate/mod.TPLSerializer.inc.php"); 
include ("../clases/ControllerTemplate.php");
include ("../clases/funciones.php");
 
 ?>