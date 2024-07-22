<head>
<title>Base inscritos</title>

<script type="text/javascript" src="http://www.ciae.uchile.cl/www/libjs/Function.js?version=1461742513"></script>
</head>
<style>
table  {  margin:0px;}
td { border-bottom:1px solid #363131;border-right:1px solid #363131; padding: 5px;}
</style>
<a href="http://www.ciae.uchile.cl/index.php?langSite=es&page=view_inscripcion_validacionpruebas2016_extra" target="_blank" >Formulario de registro</a><br>
<?php

	$config = "../config.cfg";   
  	include $config;   
  	 
	$base 			= 'site_inscripcion_inicia2016_datos_providencia';
  	$valores 		= VarSystem::getGet();
	$caso_global 	= $valores['caso_g'];

	$c_autorizada = substr(VarConfig::regkey_system,0,6);  
	$con_fila = true;
	if(trim($valores['c']) != $c_autorizada)
	{
		$contenido = "ERROR 2: debe indicar url correcto";	
	}
	else
	{			
		if($caso_global == 'detalle_fecha')
		{
			$contenido = "";
			$ControlVistas = new ControlVistas($base);
			$ControlVistas->where = " inicia_rendicion_fecha LIKE '%extra%'";
			$ControlVistas->orden = " apellidos";	
			$output = $ControlVistas->obtenerListado(); 
			$salida = array();
			$salida2 = array();
			for($i=0; $i < count($output);$i++)
			{
				$aux = explode('|',$output[$i]['inicia_rendicion_fecha']);
					
				for($j=0; $j < count($aux); $j++)
				{
					if(trim($aux[$j]) == '')
						continue;
					$salida[$aux[$j]][$output[$i]['inicia_situacion_academica_carrera']] = $salida[$aux[$j]][$output[$i]['inicia_situacion_academica_carrera']] + 1;
					//$salida[$aux[$j]]['participantes'] = $salida[$aux[$j]]['participantes']."<br>".$output[$i]['rut'].'-'.$output[$i]['rut_dv']."\t".$output[$i]['nombre']." ".$output[$i]['apellidos']."<br>";
					//$salida[$aux[$j]]['participantes_email'][] = array('email' => $output[$i]['email'],'nombre' => $output[$i]['nombre']." ".$output[$i]['apellidos']);
					$salida2[$output[$i]['inicia_situacion_academica_carrera']] = $salida2[$output[$i]['inicia_situacion_academica_carrera']] + 1; 
				}
			}
			ksort($salida);
			ksort($salida2);
			echo "<pre>";print_r($salida);	print_r($salida2);		echo "</pre>";
		}
		else
	    {
			echo '<form name="main" method="post" action="base_inicia.php?c='.$c_autorizada.'&caso_g='.$caso_global.'"> ';  
			
			if(trim($valores['orden']) != '')
			{
				$valores['orden'] = 'comentario DESC';
			}
			if(count($_POST) > 0)
			{ 
				
				$caso_global = $_POST['caso_g'];
				$rut 		= $_POST['rut']; 
				$email 		= $_POST['email']; 
				$caso 		= $_POST['comentario-'.$rut];
				
				$Inscripcion = new Inscripcion();
				$Inscripcion->consultaInscripcionRut($rut,'2016-ValidacionPruebaINICIA');
				$Inscripcion->comentario = $caso;
				if($caso_global == 'detalle_formas')
				{
					$Inscripcion->inicia_rendicion_forma_1 = $_POST['inicia_rendicion_forma_1-'.$rut]; 
					$Inscripcion->inicia_rendicion_forma_2 = $_POST['inicia_rendicion_forma_2-'.$rut];
					$Inscripcion->inicia_rendicion_forma_3 = $_POST['inicia_rendicion_forma_3-'.$rut];
					$Inscripcion->inicia_rendicion_forma_4 = $_POST['inicia_rendicion_forma_4-'.$rut];
					$Inscripcion->inicia_rendicion_estado_asistencia = $_POST['inicia_rendicion_estado_asistencia-'.$rut];		
				}
				
				if($caso == 'no_cumple' || $caso == 'no_participara' || $caso == 'no_molestar')
				{
					$Inscripcion->tipo_inscripcion  = '2016-ValidacionPruebaINICIA_'.$caso;
				}
				
				$Inscripcion->saveObject("email='".$email."' AND rut = '".$rut."' AND tipo_inscripcion = '2016-ValidacionPruebaINICIA'");
				
				
				//echo "<pre>";print_r($Inscripcion);	 /*	print_r($_POST);*/		echo "</pre>"; 
			}  
			$ControlVistas = new ControlVistas($base); 	
			if(trim($valores['orden']) == '')
			{
				$valores['orden'] = 'comentario DESC, inicia_situacion_academica_carrera';
			} 
			$ControlVistas->order = $valores['orden'];	
			 
				
			$output = $ControlVistas->obtenerListado(); 
			//echo $base; print_r($ControlVistas);
			if(is_array($output) && count($output)>0)
			{
				$total = count($output);
				$contenido = ''; 
				if(is_array($output) && $total > 0)
				{	   	 			
					$contenido = '<table border=0><tr>';
					if($con_fila)
					{
						$contenido .= "<td></td>";
					}				
					foreach($output[0] as $campo => $valor)
					{
						if($caso_global == 'detalle_formas')
						{
							 
							if($campo == 'telefono_movil' || $campo == 'telefono' || $campo == 'inicia_rendicion_fecha' || $campo == 'tratamiento')
							{
								continue;	
							}
						}
						$contenido .= "<td><b>".$campo."&nbsp;&nbsp;<a  href='?c=".$c_autorizada."&orden=".$campo." ASC'>&uarr;</a>&nbsp;&nbsp;<a  href='?c=".$c_autorizada."&orden=".$campo." DESC'>&darr;</a></b></td>\n";
						 
					}
					$contenido .= '</tr>\n';
					for($j=0; $j < $total; $j++)
					{
						$contenido .= "<tr>"; 
						$aux = $j + 1;
						if($con_fila)
						{
							$contenido .= "<td>".$aux."</td>";
						}
						foreach($output[$j] as $campo => $valor)
						{
							if(trim($valor) == '')
							{
								$valor = '&nbsp;';
							}					
							$valor = strip_tags($valor);
														
							if($caso_global == 'detalle_formas')
							{
								if($campo == 'inicia_rendicion_forma_1' || $campo == 'inicia_rendicion_forma_2' || $campo == 'inicia_rendicion_forma_3'  || $campo == 'inicia_rendicion_forma_4' || $campo == 'inicia_rendicion_estado_asistencia')
								{
									$valor = "<input name='".$campo."-".$output[$j]['rut']."' value='".$valor."' onChange=".'"'."javascript:GuardarEstado('".$output[$j]['rut']."','".$output[$j]['email']."');".'"'.">";	
								}
								if($campo == 'telefono_movil' || $campo == 'telefono' || $campo == 'inicia_rendicion_fecha' || $campo == 'tratamiento')
								{
									continue;	
								}
							}
							
							
							if($campo == 'estado')
							{
								if($valor == "&nbsp;")
								{
									$valor = '';	
								}
								$aux = "\n<select name='comentario-".$output[$j]['rut']."' onChange='javascript:GuardarEstado(".'"'.$output[$j]['rut'].'"'.",".'"'.$output[$j]['email'].'"'.");'> 
								<option value=''></option>
								<option value='no_constesta_1_llamadas'>No contesta llamar de nuevo (1 llamada)</option>
								<option value='no_constesta_2_llamadas'>No contesta llamar de nuevo (2 llamada)</option>
								<option value='no_constesta_3_llamadas'>No contesta llamar de nuevo (3 llamada)</option>
								<option value='no_constesta_4_llamadas'>No contesta llamar de nuevo (4 llamada no llamar mas)</option>
								<option value='volver_llamar'>Volver a llamar mas tarde</option>
								<option value='mensaje_buzon'>Se dejo mensaje en buzon de voz</option>
								<option value='revisara_informacion_para_particiar'>Lo vera mas tarde y se inscribira despues</option>
								<option value='mensaje_persona'>Se dejo mensaje con otra persona</option>
								<option value='participara_registro'>Contesto y se registro participacion</option>
								<option value='no_cumple'>No cumple requisitos</option>
								<option value='no_participara'>No desea participar nuevamente</option>
								<option value='no_molestar'>No desea que lo llamemos nuevamente</option>
								
								<option value='otro'>otro</option>
								</select>
								
								<script>
								  selectValue('comentario-".$output[$j]['rut']."','".$valor."');
								  </script>
								
								";
								$valor = $aux;
							}
							$contenido .= "<td>".$valor."</td>\n";
						}
						$contenido .= "</tr>\n";
					}
					$contenido .= "</table>";
				}
				
			}
		}
	}
	 
	$contenido = stripcslashes($contenido);	
	echo $contenido;
	
	echo "<input name='caso_g'  type='hidden' value='".$caso_global."'>\n";
?>
<input type="hidden" name="rut">
<input type="hidden" name="email">

</form>
<script>
function GuardarEstado(rut,email)
{
	document.main.rut.value = rut;
	document.main.email.value = email;
	document.main.submit();
}
  setTimeout("location.reload()", 300000); 
</script>