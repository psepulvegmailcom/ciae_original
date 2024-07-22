 <a href='04-matriz.php'>Buscar Matrices</a>
<br><br>  
 <form action="04-matriz.php" method="post">
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
		$ControladorMatrices = new ControladorMatrices();
		if(is_array($id_muestras) && count($id_muestras) > 0)
		{
			$output 		= $ControladorMatrices->crearCabeceraMatriz($curso[0],$curso[1]);
			$salida 		= $output['cabecera'];
			$listaCurso 	= $output['listaCurso'];
			$listaCursoId 	= $output['listaCursoId'];
			
			 
			$total_lista = count($listaCurso);
			if(is_array($listaCurso) && count($total_lista) > 0)
			{ 
				
				$ControlPersonasMuestraTotales = new ControlPersonasMuestraTotales();
				$totales = $ControlPersonasMuestraTotales->totalesPorMuestra($id_muestras);
			 	$totalesLista = array();
			 	//echo "<pre>";print_r($totales);echo "</pre>";
			 	for($i=0; $i < count($totales); $i++)
			 	{
					$totalesLista[trim($totales[$i]['id_persona_observadora'])][trim($totales[$i]['fk_id_persona_observada'])] = $totales[$i]['total'];
				}
				//print_r($listaCurso);
				// print_r($totalesLista);
				for($i=0; $i < $total_lista; $i++)
				{
					$salida .= "<tr>\n";
					$salida .= "<td><b>".$listaCurso[$i]['nombre_completo']."</b></td>"; 
					for($j=0; $j < $total_lista; $j++)
					{ 
						$salida .= "<td>0".$totalesLista[$listaCurso[$i]['id_persona']][$listaCurso[$j]['id_persona']]."</td>";
					} 
					$salida .= "</tr>\n";
				} 
			}  
			//print_r($listaCursoId);
			// print_r($totalesLista);
			
			$salida .= "</table>\n";
			$dir_tmp = VarConfig::path_site_repositorio.'tmp/extraccion/';
			$excel   = time().'_matriz.xls';
			$archivo = $dir_tmp.$excel;
			SIDTOOLHtml::escribirArchivo($archivo,$salida); 
			echo "<br><br><a href='../docs/tmp/extraccion/".$excel."' target='_blank' >Descargar Matriz</a>"; 
		} 
	} /** FIN REVISION POST */
?>
<br><br>
 <input type="submit" name="buscar" value="Buscar">
</form>
 