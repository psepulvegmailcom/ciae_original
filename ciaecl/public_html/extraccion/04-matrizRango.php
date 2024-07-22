
<a href='04-matrizRango.php'>Buscar Matrices por día</a>
<br><br>  
 <form action="04-matrizRango.php" method="post">
<?php  
	
	$indexOutput = '';
	include ("config.cfg");
	$ControladorDeObjetos = new ControladorDeObjetos();
	
	$ControlPersonasCurso = new ControlPersonasCurso();
	$listado = $ControlPersonasCurso->buscarCursosDisponibles();
	
?>
<b>Cursos a buscar: </b><br> 
<?php
	for($i=0; $i < count($listado); $i++)
	{
		echo "<input type='radio' name='cursos'  value='".trim($listado[$i]['id_curso'])."-".trim($listado[$i]['agno'])."' checked>
		CURSO: ".trim($listado[$i]['curso'])." COLEGIO: ".trim($listado[$i]['colegio'])." AÑO: ".trim($listado[$i]['agno'])."<br>\n";
	}
?> 
<br> 
 
<?php	
	if(is_array($_POST) && count($_POST) > 0)
	{ 
		$curso = explode('-',$_POST['cursos']); 
		 //print_r($_POST);
		$ControlPersonasCursoMuestra = new ControlPersonasCursoMuestraDetalle();
		$listado = $ControlPersonasCursoMuestra->buscarFechaCurso($curso[0]); 
?>
<br> <b>Fechas Disponibles: </b><br>
<select name='fechas' >
<option value=''>--</option>
<?php
		for($i=0; $i < count($listado); $i++)
		{ 
			echo "<option  value='".trim($listado[$i]['fecha'])."'>".trim($listado[$i]['fecha'])."</option>\n";
		} 
?>
</select>

<br> <b>Seleccionar rango de horas: </b><br>

<br>  Hora Inicio:  <br>
<select name='hora_inicio'>
<option value=''>--</option>
<?php
	$ControladorMatrices = new ControladorMatrices();
	$horas = $ControladorMatrices->generarBloqueHoras(8,19);
	
	for($k=0; $k < count($horas); $k++)
	{ 
		echo "<option value='".$horas[$k]."'>".$horas[$k]."</option>"; 
	}
?>
</select>
<br> 
<br>  Hora Fin:  <br>
<select name='hora_fin'>
<option value=''>--</option>
<?php

	for($k=0; $k < count($horas); $k++)
	{ 
		echo "<option value='".$horas[$k]."'>".$horas[$k]."</option>"; 
	}
?>
</select>
<br> 	
<br>  Rango de tiempo entre matrices:  <br>

<input type='text' name='rango' > segundos<br>
<small>Ingrese tiempo en segundos enteros (ej: para 10 minutos serán 600 segundos)<br><b>Si intenta generar cada 1 segundo deberá generar como máximo cada 2 horas</b></small>
<br><br><br> 
<?php
		//Funciones::mostrarArreglo($_POST);
		if(isset($_POST['fechas']))
		{
			if(trim($_POST['fechas']) == '' || trim($_POST['hora_inicio']) == '' || trim($_POST['hora_fin']) == '' || trim($_POST['rango']) == '' || (trim($_POST['hora_inicio']) >= trim($_POST['hora_fin'])))
			{ 
				?>
				<b>NO SE PUEDE REALIZAR BÚSQUEDA CON LOS DATOS INGRESADOS (FALTAN VALORES O LAS HORAS NO CORRESPONDEN)<br>INTÉNTELO NUEVAMENTE</b>
				<br><br>
 				<input type="submit" name="buscar" value="Buscar">
				<?php
				die();
			}
			
			
			
			$fechas = $_POST['fechas']; 
			$completo = TRUE;
			$datos['fecha'] = $_POST['fechas'];
			$aux = str_split($datos['fecha']);
			$datos['dia'] 	= $aux[6].$aux[7];
			$datos['mes'] 	= $aux[4].$aux[5];
			$datos['agno'] 	= $aux[0].$aux[1].$aux[2].$aux[3];
			$datos['rango'] = round($_POST['rango']);
			$aux = explode(':', $_POST['hora_inicio']);
			$datos['hora_inicio'] 	= $aux[0];
			$datos['minuto_inicio'] = $aux[1];
			$aux = explode(':', $_POST['hora_fin']);
			$datos['hora_fin'] 		= $aux[0];
			$datos['minuto_fin'] 	= $aux[1];
			$datos['hora_inicio_time'] 	= mktime($datos['hora_inicio']+VarConfig::HoraDiffServ,$datos['minuto_inicio'],0,$datos['mes'],$datos['dia'],$datos['agno']);
			$datos['hora_fin_time'] 	= mktime($datos['hora_fin']+VarConfig::HoraDiffServ,$datos['minuto_fin'],0,$datos['mes'],$datos['dia'],$datos['agno']);
			$datos['inicio_time_recorrido'] = $datos['hora_inicio_time'];
			$datos['hora_inicio_date']	= date("d-m-Y H:i:s",$datos['hora_inicio_time']);
			$datos['hora_fin_date']		= date("d-m-Y H:i:s",$datos['hora_fin_time']); 
		 
			Funciones::mostrarArreglo($datos);
			
			$output 		= $ControladorMatrices->crearCabeceraMatriz($curso[0],$curso[1]);
			$cabecera 		= $output['cabecera'];
			$listaCurso 	= $output['listaCurso'];
			$listaCursoId 	= $output['listaCursoId'];
			$total_lista 	= count($listaCurso); 
			 
			if(is_array($listaCurso) && count($total_lista) > 0)
			{ 
				$ControlPersonasMuestrasTiempos = new ControlPersonasMuestrasTiempos();
				$etiquetas = $ControlPersonasMuestrasTiempos->totalesPorRango($datos['fecha'],$datos['hora_inicio_time'],$datos['hora_fin_time']);
				$total_etiquetas = count($etiquetas); 
				Funciones::mostrarArreglo($etiquetas); 
				
				if(is_array($etiquetas) && $total_etiquetas > 0)
				{
					$totalesLista = array();
					$matriz_id = 0;			 
					for($j=0; $j < $total_etiquetas; $j++)
					{
						$diferencia = $etiquetas[$j]['tiempo'] - $datos['inicio_time_recorrido'];
						
						if($diferencia <= $datos['rango'] && $diferencia > 0)
						{ 
							/**  NO HAGO NADA */
						}
						else
						{
							/** REVISAR CUANTOS RANGOS HAY ENTRE MEDIO */
							$aux  = $datos['inicio_time_recorrido'] + $datos['rango'];
							while($aux < $etiquetas[$j]['tiempo'])
							{
								$matriz_id++;
								$Matrices[$matriz_id] = array();
								
								//$Matrices[$matriz_id]['TIEMPO'] = date("Ymd H:i:s",$datos['inicio_time_recorrido']);
								
								$datos['inicio_time_recorrido'] = $aux;	
								$aux  = $datos['inicio_time_recorrido'] + $datos['rango'];
							}  
						}
						$Matrices[$matriz_id][trim($etiquetas[$j]['id_persona_observadora'])][trim($etiquetas[$j]['id_persona_observada'])] = $Matrices[$matriz_id][trim($etiquetas[$j]['id_persona_observadora'])][trim($etiquetas[$j]['id_persona_observada'])] + 1; 
					}
					/** CHEQUEO DE RANGOS SIN ETIQUETAS */
					$aux  = $datos['inicio_time_recorrido'] + $datos['rango'];
					while($aux <= $datos['hora_fin_time'])
					{
						$matriz_id++;
						$Matrices[$matriz_id] = array();
						$datos['inicio_time_recorrido'] = $aux;	
						$aux  = $datos['inicio_time_recorrido'] + $datos['rango'];
					} 
					//Funciones::mostrarArreglo($Matrices);  
					
					/** CREAR MATRICES EN ARCHIVOS */
					$total_matrices = count($Matrices);
					$listaAlumnos = "";
					$salida_matriz = "A = {";
					
					for($k=0; $k < $total_matrices; $k++)
					{
						$salida_matriz .= " [ ";
						for($i=0; $i < $total_lista; $i++)
						{ 
							$salida_matriz .= "";
							if($i > 0)
							{
								$salida_matriz .= " ; "; 
							}
							//$listaAlumnos  .= "".$listaCurso[$i]['id_persona']." ".$listaCurso[$i]['nombre_completo']."\n"; 
							for($j=0; $j < $total_lista; $j++)
							{ 
								if($j > 0)
								{
									$salida_matriz .= ","; 
								}
								$salida_matriz .= round("0".$Matrices[$k][$listaCurso[$i]['id_persona']][$listaCurso[$j]['id_persona']]);
							}  
						} 					
						$salida_matriz .= " ] ";
					}
					$salida_matriz .= " }";
					//echo $salida_matriz; 
					
					
					echo '<br><b>Búsqueda entre rangos </b><br>Hora inicio '.$datos['hora_inicio_date'].'<br> Hora fin '.$datos['hora_fin_date'].'<br><br><br>';
	
					$dir_tmp = VarConfig::path_site_repositorio.'tmp/extraccion/';
					$excel   = time().'_matriz.txt';
					$archivo = $dir_tmp.$excel;
					SIDTOOLHtml::escribirArchivo($archivo,$salida_matriz); 
					echo "<br><br><a href='../docs/tmp/extraccion/".$excel."' target='_blank' >Descargar Matrices</a>";  
				}
			}
				//	global $indexOutput;
//					echo $indexOutput ;
?>

<?php			
			 
		} /** FIN REVISION POST */
	}
	if(VarConfig::estadoDebug)
	{
		echo '<br><br>'.$indexOutput;
	}
	 
?>
<br><br>
 <input type="submit" name="buscar" value="Buscar">
</form>
 
 