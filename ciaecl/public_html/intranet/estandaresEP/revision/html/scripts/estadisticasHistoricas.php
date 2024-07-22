<strong><big>TE ACORDASTE DE ACTUALIZAR LA DATA?!?!?!!?!!!!!!!!!</big></STRONG><BR><BR>

<?php

	$config = "../../config.cfg";   
  	include $config;  


	$meses = array ();
	$meses[] = '12-2007'; 
	for($i=1; $i < 13; $i++)
	{	  
		$meses[] = str_pad($i, 2, "0", STR_PAD_LEFT).'-2008';
	}
	$max = date('m')+1;
	for($i=1; $i < $max; $i++)
	{	  
		$meses[] = str_pad($i, 2, "0", STR_PAD_LEFT).'-2009';
	}   
	

	/*****************************************************************************************
		VISTA aaaaa
		SELECT DATE_FORMAT( FROM_UNIXTIME( fecha_estado ) , '%m-%Y' ) AS fecha_real, id_oferente, id_estado, fecha_estado
			FROM ate_oferente_estados
			WHERE fecha_estado >0
	*****************************************************************************************/
	for($i=0; $i < count($meses); $i++)
	{
		$estadisticas[$meses[$i]] = array('inscritos'=>0,'postulantes'=>0,'validados'=>0,'eliminados'=>0);
	}	
	$ControladorDeObjetos 		= new ControladorDeObjetos(); 

	 
	$anterior = 0;
	$estado_anterior = '';
	$envio = false;
	$total_meses = count($meses);  

	$mostrar_debug = false;

	if(	$mostrar_debug)
		$total_meses = 4;  
	$sql_meses = '';

	for($i=0; $i < $total_meses ; $i++)
	{
		if(trim($sql_meses) != '')
			$sql_meses .= ',';
		$sql_meses .= "'".$meses[$i]."'";
		$sql = " SELECT a.*, e.orden
		FROM (	SELECT DATE_FORMAT( FROM_UNIXTIME( fecha_estado ) , '%m-%Y' ) AS fecha_real, id_oferente, id_estado, fecha_estado
			FROM ate_oferente_estados
			WHERE fecha_estado >0) as a, common_estado_oferente as e
		WHERE a.fecha_real in (".$sql_meses.") AND e.id_estado = a.id_estado  
		ORDER BY  a.id_oferente,a.fecha_estado, e.orden ";
//echo $sql.'<br><br>';
		if(	$mostrar_debug)
			echo $sql."<br>";
		
		$output 			= $ControladorDeObjetos->getQuery($sql);
 

		$total 				= count($output);
		$anterior 			= $output[0]['id_oferente'];
		$estado_anterior 	= $output[0]['id_estado'];
		$envio = false;
		for($j=0; $j < $total; $j++)
		{ 				
			if(	$mostrar_debug)
			{	
				echo 'iteracion: '.$j.': oferente '.$output[$j]['id_oferente'].' estado '.$output[$j]['id_estado'].' oferente_anterior '.$anterior.' estado_anterior '.$estado_anterior.' envio '.(int)$envio.'<br>';
			}

			if($anterior != $output[$j]['id_oferente'])
			{
				if(	$mostrar_debug)
					echo 'iteracion (IF): '.$j.': oferente '.$output[$j]['id_oferente'].' estado '.$output[$j]['id_estado'].' oferente_anterior '.$anterior.' estado_anterior '.$estado_anterior.' envio '.(int)$envio.'<br>';
				switch($estado_anterior)
				{
					case 'no_iniciado':					 
						$estadisticas[$meses[$i]]['inscritos'] = $estadisticas[$meses[$i]]['inscritos']+1;
					break;		 		
					case  'validacion_enviado':						 
							$estadisticas[$meses[$i]]['validados'] = $estadisticas[$meses[$i]]['validados']+1;
					break;	 		
					case  'eliminado':						 
							$estadisticas[$meses[$i]]['eliminados'] = $estadisticas[$meses[$i]]['eliminados']+1;
					break;
					default :		
							if($estado_anterior != 'eliminado')
							{
								if($envio)
								{
									$estadisticas[$meses[$i]]['postulantes'] = $estadisticas[$meses[$i]]['postulantes']+1;
								}
								else
								{
									$estadisticas[$meses[$i]]['inscritos'] = $estadisticas[$meses[$i]]['inscritos']+1;
								}
							}
					break;
				}				
				$envio = false;
				
				if(	$mostrar_debug)
					Funciones::mostrarArreglo($estadisticas[$meses[$i]]);
			}
			$anterior 			= $output[$j]['id_oferente'];
			$estado_anterior 	= $output[$j]['id_estado'];
			if($output[$j]['id_estado'] == 'enviado')
			{
				$envio=true;			
			}
		} 
	}
	
	echo "<table>";
	echo "<tr><td>mes</td><td>inscritos</td><td>postulantes</td><td>validados</td><td>eliminados</td><td>total</td></tr>"; 
	foreach($estadisticas as $mes => $valores)
	{
		echo "<td>".$mes."</td>";
		$suma = 0;
		foreach($valores as $estado => $cantidad)
		{ 
			echo "<td>".$cantidad."</td>";
			$suma = $suma +$cantidad;
		}
		echo "<td>".$suma."</td>";
		echo "</tr>";
	} 
		echo "</table>";
	 
?>