<?php

	include('../config.cfg'); 
	
	if ($_GET["ruta_archivo"]!='')
	{
		$output_dir = VarSystem::getPathVariables('dir_repositorio').VarSystem::getVariable('ruta_archivo','GET');
	}
	else
	{
		$output_dir = VarSystem::getPathVariables('dir_repositorio').VarSystem::getVariable('ruta_galeria','GET'); 
	}
	$id_item  = VarSystem::getVariable('id_item','GET');
	if(trim($id_item) == '' || trim($id_item) == 'undefined')
	{
		$id_item = '00';
	}
	$var_name = VarSystem::getVariable('var_name','GET'); //$_GET["var_name"]

	if (!file_exists($output_dir)) 
	{
		mkdir($output_dir, 0755, true);
		@copy(VarSystem::getPathVariables('dir_repositorio').'index.php',$output_dir.'index.php');
	}
	 
	$salida = false;
	$archivo_salida = '';

	if ($_GET["ruta_galeria"]!='')
	{
		if(is_array($_FILES) && count($_FILES) >0)
		{	
			print_r($_FILES);
			exit;
			foreach($_FILES['images']['error'] as $key => $error)
			{
				if($error == UPLOAD_ERR_OK)
				{
					$name = $_FILES['images']['name'][$key];
					$ext = strtolower(end(explode(".", $name)));
					$archivo_salida = $id_item.'_'. $var_name.'.'.$ext;
					//$salida = move_uploaded_file($_FILES['images']['tmp_name'][$key], $output_dir .$archivo_salida);
					$salida = copy($_FILES['images']['tmp_name'][$key], $output_dir .$archivo_salida);
				}
			}
		}                
	}
	else
	{		 
		if(is_array($_FILES) && count($_FILES) >0)
		{
			foreach($_FILES['file']['error'] as $key => $error)
			{
				if($error == UPLOAD_ERR_OK)
				{
					$name = $_FILES['file']['name'][$key];
					$ext = strtolower(end(explode(".", $name)));
					$archivo_salida = $id_item.'_'. $var_name.'.'.$ext;  

					//$salida = move_uploaded_file($_FILES['file']['tmp_name'][$key], $output_dir .$archivo_salida);
					$salida = copy($_FILES['file']['tmp_name'][$key], $output_dir .$archivo_salida);
				}
			}
		}
	} 
	if($salida)
	{
		echo  $archivo_salida;
	}
	else
	{
		echo "ERROR";
	}
	// echo "<pre>";print_r($_POST);print_r($_SERVER);print_r($_SESSION);echo "</pre>";
	//echo "<h4> Archivos correctamente subidos </h4>";
	//echo "<h2>Archivos correctamente subidos</h2>".$id_item;
?>