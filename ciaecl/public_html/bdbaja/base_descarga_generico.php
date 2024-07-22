<?php

	$config = "../config.cfg";   
  	include $config;   
  	 
  	$valores = VarSystem::getGet();
    
	$c_autorizada = substr(VarConfig::regkey_system,0,6);
	if($valores['caso'] == 'ciae_anexos')
	{
		$valores['c'] = $c_autorizada ;
	} 
	if(trim($valores['dtipo']) == '')
	{
		$valores['dtipo'] = 'excell';
	}
	if(trim($valores['caso_extra']) == '')
	{
		$valores['caso_extra'] = '';
	}

	if(!isset($valores['caso']) || trim($valores['caso']) == '' || !isset($valores['c']) || trim($valores['c']) == '')
	{
		$contenido = "ERROR 1: debe indicar url correcto";	
	}
	else
	{
		if(trim($valores['c']) != $c_autorizada)
		{
			$contenido = "ERROR 2: debe indicar url correcto";	
		}
		else
		{	 
			switch($valores['caso_extra'])
			{
				case  'postulaciones': 
					$base 	= 'view_postulaciones';
					$ControlVistas = new ControlVistas($base); 
					$sql = " SELECT  *
					FROM view_postulaciones WHERE doctorado_postulacion = '".$valores['caso']."'
					ORDER BY apellidos ";
					$output = $ControlVistas->getQuery($sql); 
				break;
				case  'listado_inscripcion':
					$ControlVistas = new ControlVistas($base);
					$Inscripcion = new Inscripcion();
					$sql = " SELECT  fecha_actualizacion,email, tipo_inscripcion,tratamiento, nombre, apellidos, asistencia, telefono_movil
					FROM ".$Inscripcion->sourceTable." WHERE tipo_inscripcion LIKE '".$valores['caso']."%'
					ORDER BY apellidos ";
					$output = $ControlVistas->getQuery($sql); 
					for($i=0; $i < count($output); $i++)
					{
						//$output[$i]['nombre'] 	 = mb_convert_case(ucwords(strtolower(trim($output[$i]['nombre']))), MB_CASE_TITLE);
						//$output[$i]['apellidos'] = mb_convert_case(ucwords(strtolower(trim($output[$i]['apellidos']))), MB_CASE_TITLE);
						$output[$i]['Nombre'] 	 = ucwords(strtolower(trim($output[$i]['Nombre'])));
						$output[$i]['Apellidos'] = ucwords(strtolower(trim($output[$i]['Apellidos']))); 
						$output[$i]['nombre completo'] = $output[$i]['nombre'].' '.$output[$i]['apellidos']; 
					}
				break;
				case  'listado_inscripcion_imprimir':
					$ControlVistas = new ControlVistas($base);
					$Inscripcion = new Inscripcion();
					$sql = " SELECT nombre as Nombre, apellidos as Apellidos, '' as Firma
					FROM ".$Inscripcion->sourceTable." WHERE tipo_inscripcion LIKE '".$valores['caso']."' OR tipo_inscripcion LIKE '".$valores['caso']."_presencial'
					ORDER BY apellidos ";
					//echo $sql;
					$output = $ControlVistas->getQuery($sql); 
					for($i=0; $i < count($output); $i++)
					{
						$output[$i]['Nombre'] 	 = ucwords(strtolower(trim($output[$i]['Nombre'])));
						$output[$i]['Apellidos'] = ucwords(strtolower(trim($output[$i]['Apellidos']))); 
						//$output[$i]['Nombre'] 	 = utf8_encode(mb_convert_case(ucwords(strtolower(trim($output[$i]['Nombre']))), MB_CASE_TITLE));
						//$output[$i]['Apellidos'] = utf8_encode(mb_convert_case(ucwords(strtolower(trim($output[$i]['Apellidos']))), MB_CASE_TITLE)); 
					}
				break;
				case  'inscripcion': 
					$ControlVistas = new ControlVistas($base);
					$Inscripcion = new Inscripcion();
					$sql = " SELECT  fecha_actualizacion,  nombre,  apellidos,  actividad,  institucion,  profesion,  ciudad , tipo_inscripcion
					FROM ".$Inscripcion->sourceTable." 
					WHERE  email NOT LIKE  'psepulve%' AND tipo_inscripcion LIKE '".$valores['caso']."%'
					ORDER BY apellidos; ";//echo $sql;
					$output = $ControlVistas->getQuery($sql); 
					for($i=0; $i < count($output); $i++)
					{
						//$output[$i]['nombre'] 	 = mb_convert_case(ucwords(strtolower(trim($output[$i]['nombre']))), MB_CASE_TITLE);
						//$output[$i]['apellidos'] = mb_convert_case(ucwords(strtolower(trim($output[$i]['apellidos']))), MB_CASE_TITLE); 
						$output[$i]['Nombre'] 	 = ucwords(strtolower(trim($output[$i]['Nombre'])));
						$output[$i]['Apellidos'] = ucwords(strtolower(trim($output[$i]['Apellidos'])));  
					}
				break;														
				default:
					$base 	= 'view_tmp_'.$valores['caso'];
					$ControlVistas = new ControlVistas($base);
					$output = $ControlVistas->obtenerListado();
					//echo $base; print_r($ControlVistas);
				break;
			}		
					
					
			if(is_array($output) && count($output)>0)
			{
				if($valores['dtipo'] == 'sql')
				{
					for($i=0; $i < count($output);$i++)
					{
						$contenido .= "$i .- <br>INSERT IGNORE INTO envio_email_destino (caso_envio, email, email_secundario, nombre, apellidos,   estado ) VALUE ('".$valores['caso']."','".$output[$i]['correo electrónico']."','".$output[$i]['correo electrónico alternativo']."','".$output[$i]['nombre']."','".$output[$i]['apellido_paterno']."','no_enviado'); <br><br>";
					}
				}
				else
				{
					$contenido = trim(Funciones::generarTabla($output,true,false));
					switch($valores['caso'])
					{
						case 'inventario_biblioteca_formulario': 
							$firma = file_get_contents('firma_direccion.tpl');
							 
							//  echo htmlentities($contenido);
							$antes = array('titulo_del_libro','autor','editorial','agno','n_copias','isbn','precio_unitario_sin_iva','iva','total_con_iva','proveedor','n_orden_de_compra','n_factura','fecha_de_factura','n_correlativo_interno','proyecto','director_proyecto','agno_compra');
							$despues = array('T&iacute;tulo del libro','Autor','Editorial','A&ntilde;o','N&deg; copias','ISBN',' Precio Unitario sin iva','iva',' Total c/iva','Proveedor','N&deg; Orden de compra','Nro Factura','Fecha de Factura','N&deg; correlativo interno','Proyecto','Director proyecto','A&ntilde;o de la compra'); 
							$tamano = array('12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12','12');
							for($i=0; $i < count($antes);$i++)
							{
								$contenido = str_replace('<td><b>'.$antes[$i],'<td   style="width:'.$tamano[$i].'px;font-size: 11px;vertical-align: middle;text-align: center; background-color: darkseagreen"><b>'.$despues[$i],$contenido);
							}
							$contenido = str_replace('<td></td>','<td style="font-size: 11px;vertical-align: middle;text-align: center; background-color: darkseagreen"><strong>N&uacute;mero</strong></td>',$contenido);
							$contenido = str_replace('<td>','<td  style="font-size: 10px;vertical;vertical-align: middle">',$contenido);
							$contenido = str_replace('</table>',$firma,$contenido);
							$contenido = "<strong>FORMULARIO GESTI&Oacute;N DE BIENES DE ACTIVO FIJO CIAE ( F.G.B )</strong><br>".$contenido;
							 //echo htmlentities($contenido);
						break;
					} 
					
					if($valores['caso_extra'] == 'listado_inscripcion_imprimir')
					{  
						$ControlVistas = new ControlVistas($base);
						$EventosInforme = new EventosInforme();
						$sql = " SELECT *
						FROM ".$EventosInforme->sourceTable." WHERE id_inscripcion = '".$valores['caso']."'";
						 
						$output = $ControlVistas->getQuery($sql); 
						//echo "<pre>".$contenido."</pre>";
						$contenido = str_replace('<table','<table><tr><td colspan=4    style="text-align: center; height: 40px; vertical-align: middle;  "><strong>'.$output[0]['nombre'].'</strong></td></tr>
						<tr><td colspan=4    style="text-align: center; height: 40px; vertical-align: middle;  ">
						<strong>'.$output[0]['date_texto'].'<strong></td></tr',$contenido);
					}
					if($valores['dtipo'] == 'excell')
					{
						header("Content-type: application/vnd.ms-excel");
						header("Content-Disposition:  filename=".date("YmdHis")."-".$valores['caso']."-".str_replace(" ","",VarConfig::site_title).".xls;"); 
						$contenido = Funciones::corregirCaracteres($contenido);
	 					$contenido = utf8_decode($contenido);
						
						
						$contenido = str_replace("<tr><td>",'<tr><td style=" text-align:center;  border: 1px solid black;height: 50px; vertical-align: middle;">',$contenido); 
						
						$contenido = str_replace("<td>&nbsp;</td>",'<td style="  border: 1px solid black;height: 50px; width:150px; ">&nbsp;</td>',$contenido); 
						$contenido = str_replace("<td>",'<td style="  border: 1px solid black;height: 50px; vertical-align: middle;">&nbsp;',$contenido); 
						
						
						$contenido = Funciones::corregirCaracteres($contenido);
					}
					else
					{
						echo "<title>".$valores['caso']."</title>";	
						$style = file_get_contents('tabla_style.tpl');
						echo $style;
 
						$contenido = str_replace("border=1","",$contenido); 
						$contenido = Funciones::corregirCaracteres($contenido);
	 					//$contenido = utf8_encode($contenido);
						$contenido = Funciones::corregirCaracteres($contenido);
						//$contenido = '"<div class="div_tabla">"'.$contenido."</div>";
					}
					$contenido = stripcslashes($contenido);	
				} 
			}
			else
			{
				$contenido = "ERROR 3: tabla no existe o no tiene contenido";	
			}
		}
	}

	echo $contenido;


// 	global $indexOutput;
// 	echo $indexOutput;  
?>