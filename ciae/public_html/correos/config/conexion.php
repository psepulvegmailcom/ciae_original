<?php

	if(!isset($_GET['u'])) 
	{
		$_GET['u'] = '';		
	}	
	
	
	if(!isset($_SERVER['PHP_AUTH_USER']) || trim($_SERVER['PHP_AUTH_USER']) == '')
	{
	  $_SERVER['PHP_AUTH_USER']   = $_GET['u']; 
	}
 
	if ($_SERVER['PHP_AUTH_USER'] != "e889760b9a85dc871b2052565fd1147c" && !isset($_SERVER['SSH_CONNECTION'])  && !isset($_SERVER['SHELL']))
	{  
	  echo 'Authorization Required To Server.';
	  //print_r($_SERVER);
	  die();
	} 
	//error_reporting( 0 );

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	//ini_set( 'display_startup_errors', 1 );
	//ini_set( 'display_errors', 1 );


	/* DATOS DE CONFIGURACION */
	require_once("config/config_local.php"); 
	
	/* CLASSES GENERALES */
	require_once("clases/funciones.php");
	require_once("clases/conexionBaseDatos.php");

	/* CLASSES FUNCIONALES */
	require_once("clases/envioCorreo.php"); 
	require_once("clases/envioCertificado.php"); 
	require_once("clases/envioConfig.php"); 
 

	date_default_timezone_set('Etc/UTC');

	require 'clases/PHPMailer-5.2-stable/PHPMailerAutoload.php';
	require 'clases/fpdf184/fpdf.php';
	
	
?>