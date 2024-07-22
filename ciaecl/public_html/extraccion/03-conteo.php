<body>
<pre>
<?php
	include ("config.cfg");
	$ControladorDeObjetos = new ControladorDeObjetos(); 
	 
	$segundo_redirect = 1;
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
	//echo $id_directorio.' '.$total_directorios;
	$directorio_revisar = '';
	if($id_directorio <= $total_directorios)
	{ /** SE VUELVE A LLAMAR A SI MISMO PARA REVISAR EL DIRECTORIO SIGUIENTE */
 		$aux = 1;
		foreach($solo_directorios_principales as $dir_name => $value)
		{
			$directorio_revisar = $dir_name;
			if($aux == $id_directorio)
			{
				break;
			}	
			$aux++;
		} 
		echo $directorio_revisar.'<br><br>';
	}
	else
	{
		echo "YA TERMINE !!!!";	
		$seguir = false;	
	}
?>
 
<?php 
	if($seguir)
	{
		$directorio 	= VarConfig::path_extraccion_imagenes;
		$archivos_dir 	= Funciones::obtenerListaArchivos($directorio.'/'.$directorio_revisar.'/'); 
		
		$archivos_dir[$directorio_revisar] = $archivos_dir;
		$aplicacion 	= VarConfig::path_extraccion_exiftool; 
		
		if(FALSE)
		{
			/** SOLO PARA CASOS DE DESARROLLO Y PRUEBAS */
			$sql = "TRUNCATE `ext_muestra`;";
		 	$ControladorDeObjetos->getQuery($sql);
		 	$sql = "TRUNCATE `ext_muestra_persona_vista`;";
		 	$ControladorDeObjetos->getQuery($sql);	
		} 
		
		foreach($archivos_dir as $dias => $archivos)
		{  
			$aux = explode('_',$dias);
			$datos['fecha'] = $aux[0];
			$datos['fecha_adquision'] = $aux[0];
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
				$datos['fecha_muestra_inicial'] 	= $aux[2];
				$datos['minutos'] 		= explode('.',$aux[3]);  
				
				
				/** OBTENGO TIME DE ADQUISICION**/
									
				$aux = str_split($datos['fecha_muestra_inicial']);
				$datos['fecha_muestra_inicial_time'] = mktime($aux[8].$aux[9],$aux[10].$aux[11],$aux[12].$aux[13],$aux[4].$aux[5],$aux[6].$aux[7],$aux[0].$aux[1].$aux[2].$aux[3]);	 
				
				
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
			 	$contador_jpg = 0;
				foreach($imagenes as $file => $valor) 
				{ 	 
					$aux = explode('.',$file);
					
					$extension = end($aux);
					$archivo_completo = $dir.$file;
					
					$datos['imagen'] = array();
					
					if($extension == 'jpg' && $contador_jpg == 0)
					{
						/** OBTENER TIME DE PRIMERA FOTO DE CARPETA */
						$datos['fecha_1era_pc'] = $file;
						$aux = str_split($datos['fecha_1era_pc']);
						$datos['fecha_1era_pc_time'] = mktime($aux[8].$aux[9],$aux[10].$aux[11],$aux[12].$aux[13],$aux[4].$aux[5],$aux[6].$aux[7],$aux[0].$aux[1].$aux[2].$aux[3]);		 
						$contador_jpg++;
						
						//
						$datos['delta'] = $datos['fecha_1era_pc_time'] - $datos['fecha_muestra_inicial_time'];
						 
					}
					//print_r($datos);
					
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
													$aux = explode("_",$datos['archivo']);
													$datos['fecha_pc'] = $aux[0];
													
													$aux = str_split($datos['fecha_pc']);
											 
													$datos['fecha_pc_time'] = mktime($aux[8].$aux[9],$aux[10].$aux[11],$aux[12].$aux[13],$aux[4].$aux[5],$aux[6].$aux[7],$aux[0].$aux[1].$aux[2].$aux[3]); 
													
													$datos['fecha_muestra_real_time'] = $datos['fecha_pc_time'] - $datos['delta'];
													 
													$datos['fecha_muestra_real'] = date("YmdHis",$datos['fecha_muestra_real_time']);
													//print_r($datos);
													$aux = explode('_',$datos['imagen']['mwg-rs_Name']);
													$sql = "INSERT INTO ext_muestra_persona_vista ( fk_id_muestra, fk_id_persona_observada ,etiqueta, orden , archivo, dimensionX, dimensionY, etiqueta_x, etiqueta_y, etiqueta_h ,etiqueta_w ,etiqueta_unidad, fecha_muestra_inicial, fecha_pc,fecha_muestra_inicial_time,fecha_pc_time,fecha_muestra_real_time,fecha_muestra_real)  VALUES ('".$datos['id_muestra']."','".$aux[0]."','".$datos['imagen']['mwg-rs_Name']."','".$datos['orden']."','".$datos['archivo']."','".$datos['exif_PixelXDimension']."','".$datos['exif_PixelYDimension']."','".$datos['imagen']['stArea_x']."','".$datos['imagen']['stArea_y']."','".$datos['imagen']['stArea_h']."','".$datos['imagen']['stArea_w']."','".$datos['imagen']['stArea_unit']."','".$datos["fecha_muestra_inicial"]."','".$datos['fecha_pc']."','".$datos["fecha_muestra_inicial_time"]."','".$datos['fecha_pc_time']."','".$datos['fecha_muestra_real_time']."','".$datos['fecha_muestra_real']."') ";
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
	}
	if($seguir)
	{
?>

<meta HTTP-EQUIV="REFRESH" content="<?php echo $segundo_redirect;?>; url=03-conteo.php?id_directorio=<?php echo $id_directorio_sig;?>">
<?php
	}
?> 
</pre>
</body>