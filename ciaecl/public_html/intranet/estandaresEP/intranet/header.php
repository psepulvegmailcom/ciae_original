<?php
 session_start();	
  
 
 if(!isset($_SESSION['nom_usuario']))
 { 
	echo "<script>alert('Debe iniciar sesi�n para acceder a los contenidos');</script>";
	echo '<meta HTTP-EQUIV="REFRESH" content="0; url=../index.php">';
 
 }

 include ("../conexion.php");
 include ("../rules.php");
 
 
/* inclusion de clases extras */

include ("../clases/powerTemplate/class.TemplatePower.inc.php");
include ("../clases/powerTemplate/mod.TPLSerializer.inc.php"); 
include ("../clases/ControllerTemplate.php");
include ("../clases/funciones.php");
include ("../clases/ControladorDeFunciones.php");
include ("../clases/tools.php");
include ("../clases/zipfile.php");
 
 
 
$usuario = $_SESSION["id_usuario"];
$perfil =  $_SESSION["per_usuario"]; 
$nombre =  $_SESSION["nom_usuario"];
 
 
$dir = "../$ruta/tmp/";
$dirTMP = $dir;

?>