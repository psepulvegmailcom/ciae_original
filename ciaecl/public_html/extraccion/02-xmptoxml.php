<body>
<pre> 
<?php
	include ("config.cfg");
	$ControladorDeObjetos = new ControladorDeObjetos(); 
	$segundo_redirect = 5;
	$directorio 	= VarConfig::path_extraccion_imagenes;
	
	$solo_directorios_principales 	= Funciones::obtenerListaArchivos($directorio,true,false);
	//Funciones::mostrarArreglo($solo_directorios_principales,true);  	
	 
	$total_directorios = count($solo_directorios_principales);
	
	$id_directorio = $_GET['id_directorio'];
	if(trim($id_directorio) == '')
	{
		$id_directorio = 1;		
	}
	$id_directorio_sig = $id_directorio + 1;
	$seguir = true; 

	
	if($id_directorio <= $total_directorios)
	{ /** SE VUELVE A LLAMAR A SI MISMO PARA REVISAR EL DIRECTORIO SIGUIENTE */
 		$aux = 1;
		foreach($solo_directorios_principales as $dir_name => $value)
		{
			$directorio_revisar = $dir_name;
			if($aux == $id_directorio)
				break;
			$aux++;
		} 
		echo $directorio_revisar.'<br><br>';
	}
	else
	{
		echo "YA TERMINE !!!!";	   
		$seguir = false;	
	}
 
	if($seguir)
	{
		$directorio_completo = $directorio.$directorio_revisar.'/'; 
		$archivos_dir 	= Funciones::obtenerListaArchivos($directorio_completo); 
		$archivos_dir[$directorio_revisar] = $archivos_dir;
		//Funciones::mostrarArreglo($archivos_dir,true);
		$aplicacion 	= VarConfig::path_extraccion_exiftool;
		
		foreach($archivos_dir as $dias => $archivos)
		{ 					
			$aux = explode('_',$dias);
			$datos['fecha'] = $aux[0];
			$datos['curso'] = $aux[1];
			$datos['persona'] = $aux[2];
			
			foreach($archivos as $clip => $imagenes)
			{ 
				$aux = explode('_',$clip);
				$datos['clase'] = $aux[0];			
				$datos['clip'] 	= $aux[1];   
			 	  
			 	//print_r($datos);
			 	$dir = $directorio.$dias.'/'.$clip.'/';
			 	if(!is_dir($dir))
			 	{
					continue;
				}
			 	echo "<br>DIRECTORIO ".$dias.'/'.$clip.'/'."<br><br>";
				foreach($imagenes as $file => $valor) 
				{
					$aux = explode('.',$file);
					$extension = end($aux);
					$archivo_completo = $dir.$file;
					
					if($extension == 'xmp')
					{ 
						$archivo_completo_xml = str_replace('.xmp','.xml',$archivo_completo); 
						if(!file_exists($archivo_completo_xml))
						{ 
							echo "   TRANSFORMANDO ".$file." a xml <br>";
							$contenido = file($archivo_completo);  
							unset($contenido[0]);
							$contenido = implode("\n", $contenido);
							$contenido = str_replace(":","_",$contenido);
							file_put_contents($archivo_completo_xml, $contenido); 
						}
						else
						{
							echo "      ERROR ".str_replace('.xmp','.xml',$file)." ya transformado a xml<br>";
						}
					} 
				} 
			}
		}
	}
	if($seguir)
	{
?>

<meta HTTP-EQUIV="REFRESH" content="<?php echo $segundo_redirect;?>; url=02-xmptoxml.php?id_directorio=<?php echo $id_directorio_sig;?>">
<?php
	}
?> 
</pre>

</body>
<?php
	
?>