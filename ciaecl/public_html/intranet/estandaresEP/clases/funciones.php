<?php 

function GeneralUbicacion($e,$titulo,$link=array())
{
	$e->setVariable('titulo_modulo',$titulo); 
	if(count($link) >0)
	{
		for($i=0; $i < count($link); $i++)
		{
			$e->addTemplate('bloque_ubicacion');
			$e->setVariable('link',$link[$i]['link']);
			$e->setVariable('url',$link[$i]['url']);
		}
		$e->refreshTemplate();
	}
	return $e;
}

function GeneralImprimirHeader($menu='')
{
	$e  = new miniTemplate('templates/body.tpl'); 
	$e->setVariable('nombre_usuario',$_SESSION["nom_usuario"]);
	$e->setVariable('fecha',date("d-m-Y H:i:s"));
	//GeneralPrint($_SESSION);
	if($_SESSION["per_usuario"] == 1)
	{
		$e->addTemplate('bloque_administracion');
	}
	if(trim($menu) != '')
	{
		$e->addTemplate($menu);
		if($menu == 'bloque_menu_herramientas')
		{
			$e = GeneralImprimirHeaderMenuLateral($e);
		}
	}
	$e = GeneralImprimirHeaderTemas($e);
	echo $e->toHtml(); 
}

function GeneralImprimirFooter()
{
	$e  = new miniTemplate('templates/footer.tpl');  
	echo $e->toHtml(); 
}

function GeneralImprimirHeaderTemas($e)
{
	$qryBd 	= new qryBd();
	$output = $qryBd->obtenerTemas();  
	$total	= count($output);  
	if(is_array($output))
	{  
		$id_tema_anterior = 0;
		for($i=0;$i < $total;$i++)
		{ 
			if($id_tema_anterior != $output[$i]['id_tema'])
			{
				$e->addTemplate('bloque_menu_tema');
				$e->setVariable('id_tema',$output[$i]['id_tema']);
				$e->setVariable('tema',$output[$i]['tema']);
			}
			$id_tema_anterior = $output[$i]['id_tema'];
		}
	}
	return $e;
}

function GeneralImprimirHeaderMenuLateral($e)
{  
	$qryBd 	= new qryBd();
	$output = $qryBd->obtenerTemas(); 
	$total	= count($output); 
	$id_tema_anterior = 0;
	if(is_array($output))
	{  
		for($i=0;$i < $total;$i++)
		{
			if($output[$i]['id_tema'] != $id_tema_anterior)
			{
				$e->addTemplate('bloque_menu_lateral');
				foreach($output[$i] as $var => $val)
				{
					$e->setVariable($var,$val);
				}
			}
			$e->addTemplate('bloque_menu_lateral_sub');
			foreach($output[$i] as $var => $val)
			{
				$e->setVariable($var,$val);
			}
			$id_tema_anterior = $output[$i]['id_tema'];
		}
	}
	//GeneralPrint($output);
	return $e; 
}


function GeneralPrint($arreglo,$imprimir=false )
{	 
	if(is_array($arreglo) || is_object($arreglo))
	{
		$salida = " 	<left><pre style='text-align:left' class='div_debug'>";
		$salida .= print_r($arreglo,true);
		$salida .= "</pre></left> ";	
	}
	else
	{ 
		$arreglo = str_replace(",",", ",$arreglo);
		$salida = " 	<div class='div_debug'>		 ";
		$salida .= print_r($arreglo,true);
		$salida .= " </div> ";						
	}  
	if( $_SERVER['HTTP_HOST'] ==  'localhost') // || $imprimir
	{
		echo $salida; 
	}
}		 

function GeneralGenerarTabla($output)
{
	$total = count($output);
	$contenido = '';
	if(is_array($output) && $total > 0)
	{	   	 			
		$contenido = '<table border=1><tr>';
		foreach($output[0] as $campo => $valor)
		{
			$contenido .= "<td><b>".$campo."</b></td>";
		}
		$contenido .= '</tr>';
		for($j=0; $j < $total; $j++)
		{
			$contenido .= "<tr>"; 
			foreach($output[$j] as $campo => $valor)
			{
				$contenido .= "<td>".$valor."</td>";
			}
			$contenido .= "</tr>";
		}
		$contenido .= "</table>";
	}
	return $contenido;
}

function GeneralSQLQuery($sql,$salidaNormal=true,$output=true)
{
	global  $DB,$conn  ; 
	 //GeneralPrint($sql);
	@mysql_select_db($DB) or die(" no se puede seleccionar la base de datos ".$DB);
	$result = mysql_query($sql, $conn);
	if (!$result) {
	    die('<b>ERROR::: Invalid query:</b><br>'.$sql.' <br><br>' . mysql_error());
	}	 
	else
	{
		if($output)
		{
			if($salidaNormal)
			{
				$row = mysql_fetch_full_result_array($result);
			}
			else
			{
				$row = @mysql_fetch_row($result);
			}		
			//GeneralPrint($row);
			return $row;
		}
		else
		{
			//GeneralPrint($sql); 
			return mysql_insert_id($conn);
		}
	}
}

function GeneralSQLInsertar($tabla,$datos)
{
	$sql = "INSERT INTO ".$tabla." (";
	foreach($datos as $var => $val)
	{
		$sql .= $var.",";
		$sql_val .= "'".$val."',";
	}
	$sql = substr($sql,0,-1);
	$sql_val = substr($sql_val,0,-1);
	
	$sql .= ") VALUES (".$sql_val.")";
	GeneralPrint($sql); 
	return GeneralSQLQuery($sql,true,false);
}

function GeneralSQLUltimoIngreso($tabla,$key)
{
	
}

function GeneralEscribirTablaExcel($output,$campos=array(),$dir)
{ 
	if(is_array($output) && count($output)>0)
 	{
 		if(!is_array($campos) || count($campos) == 0)
 		{
			$aux = $output[0];
			$campos = array();
			foreach($output[0] as $var => $val)
			{
				$campos[$var] = $var;
			}
		}
		$contenido = '<table><tr>';
		$total = count($output); 
		for($i=0; $i < $total;$i++)
		{
			if($i==0)
			{
				foreach($campos as $var => $val)
				{ 
					$contenido .= "<td valign='top'><strong>".$val."</strong></td>"; 
				} 
				$contenido .= "</tr>";
			} 
			$contenido .= "<tr>";
			foreach($campos as $var => $val)
			{  
				$output[$i][$var] = cleanOutputText($output[$i][$var]);
				$contenido .= "<td>".$output[$i][$var]."</td>"; 
			} 
			$contenido .= "</tr>";			 	
		} 
		$archivo = SIDTOOLHtml::escribirExcelTabla($contenido,$dir );
 	}
 	return $archivo;
}
 

function mysql_fetch_full_result_array($result)
{
    $table_result=array();
    $r=0;
    while($row = mysql_fetch_assoc($result))
	{
        $arr_row=array();
        $c=0;
        while ($c < mysql_num_fields($result)) 
		{       
            $col = mysql_fetch_field($result, $c);   
            $arr_row[$col -> name] = $row[$col -> name];           
            $c++;
        }   
        $table_result[$r] = $arr_row;
        $r++;
    }   
    return $table_result;
}

function cleanOutputText($texto)
{
	$antes = array("\\\\","\\'","\\","\\\"",'\\"','\"');
	$despues = array("\\","'","","\"",'"','"'); 
	$texto 		= stripslashes($texto); 
	$texto 		= str_replace($antes, $despues,$texto); 
	$texto 		= stripslashes($texto); 				
	return $texto;		
 
}
 

?>