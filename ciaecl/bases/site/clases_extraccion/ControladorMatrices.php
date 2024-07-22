<?php

class ControladorMatrices
{
	function ControladorMatrices()
	{
		
	}
	
	function crearCabeceraMatriz($id_curso,$agno,$tipo='xls')
	{
		$ControlPersonasCurso = new ControlPersonasCurso();
		$listaCurso = $ControlPersonasCurso->buscarListaCurso($id_curso,$agno);
	 	//echo "<pre>";print_r($listaCurso);echo "</pre>";
		$total_lista = count($listaCurso);
		$salida = '';
		$listaCursoId = array();
			
		if(is_array($listaCurso) && count($total_lista) > 0)
		{
			if($tipo == 'xls')
			{
				$salida  = " <table border=1>\n";
				$salida .= "<tr><td></td>\n";	 
			}
			else
			{
				$salida  = "";
			}

			for($i=0; $i < $total_lista; $i++)
			{
				//$listaCurso[$i]['nombre_completo'] = trim($listaCurso[$i]['nombre'])." ".trim($listaCurso[$i]['apellido'])." (".$listaCurso[$i]['relacion'].") ".$listaCurso[$i]['id_persona'];
				//$listaCurso[$i]['nombre_completo'] 	= $listaCurso[$i]['id_persona'];
				$listaCurso[$i]['nombre_completo'] 	= $listaCurso[$i]['id_persona'].' '.trim($listaCurso[$i]['nombre']);
				$listaCurso[$i]['id_persona'] 		= trim($listaCurso[$i]['id_persona']);
				if($tipo == 'xls')
				{
					$salida .= "<td><b>".$listaCurso[$i]['nombre_completo']."</b></td>\n";	
				}
				else
				{
					$salida .= "".$listaCurso[$i]['nombre_completo'].";";
				}				
				$listaCursoId[trim($listaCurso[$i]['id_persona'])] = 1; 
			}	
			if($tipo == 'xls')
			{
				$salida .= "</tr>"; /** FIN PRIMERA FILA */
			}
		}
		$output = array('cabecera' => $salida,'listaCursoId' => $listaCursoId, 'listaCurso' => $listaCurso);
		//echo "<pre>";print_r($output);echo "</pre>";
		return $output;
	}
	
	function generarBloqueHoras($hora_inicio,$hora_fin)
	{
		$horas = array();
		for($k=$hora_inicio; $k < $hora_fin; $k++)
		{
			$hora = $k;
			if($hora < 10)
			{
				$hora = "0".$hora;
			}
			$horas[] = $hora.":00"; 
			$horas[] = $hora.":30";  
		}
		return $horas;	
	}
}

?>