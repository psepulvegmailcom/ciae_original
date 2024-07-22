<pre>
<a href='04-matriz.php'>Buscar Matrices</a>
<br><br><br>
<?php
	include ("config.cfg");
	$ControladorDeObjetos = new ControladorDeObjetos(); 
	 
	$directorio 	= VarConfig::path_extraccion_imagenes;
	$archivos_dir 	= Funciones::obtenerListaArchivos($directorio); 
	$aplicacion 	= VarConfig::path_extraccion_exiftool; 
	
	foreach($archivos_dir as $dias => $archivos)
	{  
		$aux = explode('_',$dias);
		$datos['fecha'] = $aux[0];
		$datos['curso'] = $aux[1];
		$datos['persona'] = $aux[2];
		 
		foreach($archivos as $clip => $imagenes)
		{  
		 	$dir = $directorio.$dias.'/'.$clip.'/';
			if(!is_dir($dir))
		 	{
				continue;
			}
			
			echo '<br><br>///////////////////////////////////////////////////////////////////////////////////<br>';
			
			$aux = explode('_',$clip);
			$datos['clase'] 		= $aux[0];			
			$datos['clip'] 			= $aux[1];  		
			$datos['hora_inicio_completa'] 	= $aux[2];  
			$datos['minutos'] 		= explode('.',$aux[3]);  
			
			/** PROCESAMIENTO DE MINUTOS GRABADOS */
			$datos['segundos'] = $datos['minutos'][0] * 60 * 60 + $datos['minutos'][1] * 60 + $datos['minutos'][2] ; 
			
		 	//print_r($imagenes);
		 	//print_r($datos);
		 	
		 	/** REVISAR SI YA FUE REVISADA EL MUESTREO */
		 	$sql = "SELECT * 
					FROM ext_muestra
					WHERE fecha = '".$datos['fecha']."' AND clase = '".$datos['clase']."' 
					AND clip  = '".$datos['clip']."' AND fk_id_persona = '".$datos['persona']."' AND fk_id_curso = '".$datos['curso']."' ";
		 	$salida = $ControladorDeObjetos->getQuery($sql);
		 	//print_r($salida);
		 	if(is_array($salida) && count($salida) > 0)
		 	{
		 		echo "DIRECTORIO : ".$dias.'/'.$clip." procesado<br><br>";	
				continue;
			} 
			echo "PROCESANDO DIRECTORIO : ".$dias.'/'.$clip."<br><br>";
			
			$datos['hora_inicio'] = str_replace($datos['fecha'],'',$datos['hora_inicio_completa']); 
			
			
		 	$sql = "INSERT INTO  ext_muestra ( fecha ,clase ,clip ,fk_id_persona ,fk_id_curso, hora_inicio,segundos_grabados) 
			 VALUES (  '".$datos['fecha']."', '".$datos['clase']."', '".$datos['clip']."', '".$datos['persona']."', '".$datos['curso']."', '".$datos['hora_inicio_completa']."','".$datos['segundos']."');";
			// echo $sql.'<br>';
		 	$ControladorDeObjetos->getQuery($sql);
		 	
		 	$sql 	= "SELECT max(id_muestra) as maximo FROM ext_muestra";
		 	$salida = $ControladorDeObjetos->getQuery($sql);
		 	 
		 	$datos['id_muestra'] = $salida['0']['maximo'];
		 	//print_r($datos);
		 	$dir = $directorio.$dias.'/'.$clip.'/';
			foreach($imagenes as $file => $valor) 
			{ 	
				$aux = explode('.',$file);
				
				$extension = end($aux);
				$archivo_completo = $dir.$file;
				
				$datos['imagen'] = array();
				if($extension == 'xml')
				{
					$aux = explode('_',str_replace('.'.$extension,'',$file));
					//print_r($aux);
					echo "     Procesando archivo : ".str_replace('.'.$extension,'',$file)."<br>";
					$datos['archivo'] = str_replace('.'.$extension,'',$file);
					$datos['orden'] = str_replace('f','',$aux[2]);
					
					//echo $extension.' '.$archivo_completo.' '.filetype($dir.$file).'<br>'; 
					
					$imagenes_xml = simplexml_load_file($archivo_completo);
					//print_r($imagenes_xml);
					$salida = '';
					
					$datos['imagen'] = array();
					foreach($imagenes_xml as $key0 => $value)
					{
						$salida .= "..1..[$key0] => $value <br />";  
						foreach($value as $key => $value2)
						{
							$salida .= "....2.....[$key] => $value2<br />";
							foreach($value2 as $key2 => $value3)
							{
								$salida .= ".........3..........[$key2] => $value3<br>";	
								if($key2 == 'exif_PixelXDimension' || $key2 == 'exif_PixelYDimension')
								{ 
								 	$aux2 = (array)$value3;
								 	$datos[$key2] = $aux2[0];
								}								 
								foreach($value3 as $key3 => $value4)
								{
									$salida .= "...................4....................[$key3] => $value4<br>";
									foreach($value4 as $key4 => $value5)
									{
										$salida .= ".....................5......................[$key4] => $value5<br>";	
										foreach($value5 as $key5 => $value6)
										{
											$salida .= "......................6.......................[$key5] => $value6<br>";
											$datos['imagen'] = array();
											foreach($value6 as $key6 => $value7)
											{
												$salida .= "..........................7...........................[$key6] => $value7<br>";											 
												switch($key6)
												{
													case 'mwg-rs_Area': 
														foreach($value7 as $key7 => $value8)
														{
															$salida .= "...............................8................................[$key7] => $value8<br>"; 
														 	$aux2 = (array)$value8;
														 	$datos['imagen'][$key7] = $aux2[0]; 
														}
													break;
													case 'mwg-rs_Name';
														$aux2 = (array)$value7;
														$datos['imagen']['mwg-rs_Name'] = $aux2[0];
													break;
													case 'mwg-rs_Type';
														$aux2 = (array)$value7;
														$datos['imagen']['mwg-rs_Type'] = $aux2[0];
													break;	
												} 
											}
											//print_r($datos );
											/** AQUI AGREGAR */
											if($datos['imagen']['mwg-rs_Type'] == 'Face')
											{
												$aux = explode('_',$datos['imagen']['mwg-rs_Name']);
												$sql = "INSERT INTO ext_muestra_persona_vista ( fk_id_muestra, fk_id_persona_observada ,etiqueta, orden , archivo, dimensionX, dimensionY, etiqueta_x, etiqueta_y, etiqueta_h ,etiqueta_w ,etiqueta_unidad)  VALUES ('".$datos['id_muestra']."','".$aux[0]."','".$datos['imagen']['mwg-rs_Name']."','".$datos['orden']."','".$datos['archivo']."','".$datos['exif_PixelXDimension']."','".$datos['exif_PixelYDimension']."','".$datos['imagen']['stArea_x']."','".$datos['imagen']['stArea_y']."','".$datos['imagen']['stArea_h']."','".$datos['imagen']['stArea_w']."','".$datos['imagen']['stArea_unit']."') ";
												//echo $sql."<br>";
												$ControladorDeObjetos->getQuery($sql);	
											} 
										}
									}				
								}
								 
							}
					 	}
					}
					//echo $salida;
						 
					//print_r($datos); 
					 
				}
			
			}			 
		}		
	}
?>
</pre>