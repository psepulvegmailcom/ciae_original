 <a href='04-matriz.php'>Buscar Matrices</a>
<br><br>  
 <form action="05-matrizCVS.php" method="post">
<?php 
	
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
<b>Ordenar por : </b><br>
<input type="radio" name="tipo_orden" value="nombre" checked>Por persona <br>
<input type="radio" name="tipo_orden" value="fecha"> Por fecha<br>
<input type="radio" name="tipo_orden" value="clase"> Por clase <br>
<?php	
	if(is_array($_POST) && count($_POST) > 0)
	{ 
		$curso = explode('-',$_POST['cursos']); 
		//print_r($_POST);
		$ControlPersonasCursoMuestra = new ControlPersonasCursoMuestraDetalle();
		$listado = $ControlPersonasCursoMuestra->buscarAlumnosCursoAgno($curso[0],$curso[1],$_POST['tipo_orden']); 
?>
<br> <b>Alumnos con muestra: </b><br>
<select name='id_muestra[]'  multiple size="12">
<?php
		for($i=0; $i < count($listado); $i++)
		{
			$separador = ' --- ';
			$persona = "PERSONA: ".trim($listado[$i]['nombre'])." ".trim($listado[$i]['apellido'])." ".$separador." ".strtoupper($listado[$i]['relacion'])." ".$listado[$i]['curso']."";
			$fecha = "FECHA: ".trim($listado[$i]['fecha']);
			$clase = "CLASE: ".trim($listado[$i]['clase'])." ".trim($listado[$i]['clip']);
			switch($_POST['tipo_orden'])
			{
				case 'nombre':
					  $texto_select = $persona." ".$separador." ".$fecha." ".$separador." ".$clase;
				break;
				case 'fecha': 
					  $texto_select = $fecha." ".$separador." ".$clase." ".$separador." ".$persona;
				break;
				case 'clase':  
					  $texto_select = $clase." ".$separador." ".$fecha." ".$separador." ".$persona;
				break;
			} 
			echo "<option  value='".trim($listado[$i]['id_muestra'])."'>".$texto_select."</option>\n";
		} 
?>
</select>
<br><br>

<b>IMPORTANTE: Los valores de las matrices están normalizadas a número de vistas por cada 10.000 segundos</b>
<br><br><br> 
<?php
		//print_r($_POST);
		$id_muestras = $_POST['id_muestra'];
		if(is_array($id_muestras) && count($id_muestras) > 0)
		{
			$ControlPersonasCurso = new ControlPersonasCurso();
			$listaCurso = $ControlPersonasCurso->buscarListaCurso($curso[0],$curso[1]);
			//print_r($listaCurso);
			$total_lista = count($listaCurso);
			if(is_array($listaCurso) && count($total_lista) > 0)
			{
				$listaCursoId = array();
				//$salida  = " <table border=1>\n";
				//$salida .= "<tr><td></td>\n";
				for($i=0; $i < $total_lista; $i++)
				{
					$listaCurso[$i]['nombre_completo'] = trim($listaCurso[$i]['nombre'])." ".trim($listaCurso[$i]['apellido'])." (".$listaCurso[$i]['relacion'].") ".$listaCurso[$i]['id_persona'];
					$listaCurso[$i]['nombre_completo'] = $listaCurso[$i]['id_persona'];
					$listaCurso[$i]['nombre_completo'] = $listaCurso[$i]['id_persona'].' '.trim($listaCurso[$i]['nombre']);
					$listaCurso[$i]['id_persona'] = trim($listaCurso[$i]['id_persona']);
					//$salida .= "<td><b>".$listaCurso[$i]['nombre_completo']."</b></td>\n";
					$salida .= "".$listaCurso[$i]['nombre_completo'].";";
					$listaCursoId[trim($listaCurso[$i]['id_persona'])] = 1; 
				}	
				//$salida .= "</tr>"; /** FIN PRIMERA FILA */
				
				$ControlPersonasMuestraTotales = new ControlPersonasMuestraTotales();
				$totales = $ControlPersonasMuestraTotales->totalesPorMuestra($id_muestras);
			 	$totalesLista = array();
			 	//print_r($totales);
			 	for($i=0; $i < count($totales); $i++)
			 	{
					$totalesLista[trim($totales[$i]['id_persona_observadora'])][trim($totales[$i]['fk_id_persona_observada'])] = $totales[$i]['total'];
				}
				//print_r($listaCurso);
				//print_r($totalesLista);
				for($i=0; $i < $total_lista; $i++)
				{
				//	$salida .= "<tr>\n";
					//$salida .= "<td><b>".$listaCurso[$i]['nombre_completo']."</b></td>";
						$salida .= "".$listaCurso[$i]['nombre_completo'].";";  
					for($j=0; $j < $total_lista; $j++)
					{ 
						$salida .= "0".$totalesLista[$listaCurso[$i]['id_persona']][$listaCurso[$j]['id_persona']].";";
					} 
					//$salida .= "</tr>\n";
					$salida .= "\n";
				} 
			}  
			//print_r($listaCursoId);
			// print_r($totalesLista);
			
		//	$salida .= "</table>\n";
			$dir_tmp = VarConfig::path_site_repositorio.'tmp/extraccion/';
			$excel   = time().'_matriz.cvs';
			$archivo = $dir_tmp.$excel;
			SIDTOOLHtml::escribirArchivo($archivo,$salida); 
			echo "<br><br><a href='../docs/tmp/".$excel."'>Descargar Matriz</a>"; 
		} 
	} /** FIN REVISION POST */
?>
<br><br>
 <input type="submit" name="buscar" value="Buscar">
</form>
 