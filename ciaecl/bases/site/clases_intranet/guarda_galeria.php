<?php

/**
 * @author 
 * @copyright 2017
 */
 
 	die(); /* por seguridad esta archivo no se esta utilizando y puede ser mal utilizado*/
 
	global $ControlHtml;  	
	$theSession 	= $ControlHtml->theSession;   
	$theSessionPersona = $ControlHtml->elUsuarioPersona;
	$lastAction 	= $ControlHtml->lastActionArray; 
	//   Funciones::mostrarArreglo($ControlHtml);
	$path_admin		= VarSystem::getPathVariables('dir_template').'site/admin/noticias/'; 
	 		 
	$filas_externas = 10;
	$valores 		= VarSystem::getPost();	
	$archivos		= VarSystem::getFile();
	
	$MantenedoresGeneral 		= new MantenedoresGeneral();
 	$MantenedoresGeneralObjeto 	= new MantenedoresGeneralObjeto(); 
	$FormGeneral  				= new FormGeneral(); 

	$ControlClase = new ControlNoticiaSitioObjeto(); 
	$ObjetoClase  = new NoticiaObjeto(); 
	

$ruta = './Files/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
		{
			$NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
			$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino = $ruta.$NombreOriginal;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada		
		}

	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
			$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
		}
	if ($key['error']!='')//Si existio alg&uacute;n error retornamos un el error por cada archivo.
		{
			$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: n'.$key['error']; 
		}
	
}
echo $mensage;// Regresamos los mensajes generados al cliente
?>
	
	
	

   ?>