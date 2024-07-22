<!DOCTYPE html>
<html>
<head>
	<title>Leer Archivo Excel</title>
</head>
<body>
<h1>Leer Archivo Excel</h1>
<pre>
<?php
require_once '../Classes/PHPExcel.php';
require_once '../../../../domains/ciae.uchile.cl/public_html/config.cfg';

	$indexOutput = '';
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);
  
$caso = 1;
if(isset($_GET['caso']))
	$caso = $_GET['caso'];
 
	
$objPHPExcel = $objReader->load("H:/Drive/DesarrolloInfo/2011-SistemaGestion/Honorarios/Material/importacion/0".$caso.".xlsx");

echo "Leyendo archivo 0".$caso.'<br>';
$caso = $caso + 1; 

$objHoja = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//print_r($objHoja);
$total = count($objHoja);
$datos = array();
$persona = array(); 
for($row=2; $row <= $total; $row++)
{
	$datos[$row]['rut'] = $objHoja[$row]['A'];
	$aux = explode('-',str_replace('.','',$datos[$row]['rut']));
	$datos[$row]['rut'] = (int)$aux[0];
	$datos[$row]['rut_dv'] = $aux[1];
	$persona[$datos[$row]['rut']]['rut'] = $datos[$row]['rut'];
	$persona[$datos[$row]['rut']]['rut_dv'] = $datos[$row]['rut_dv'];
	
	//$objHoja[$row]['B'] =  utf8_decode($objHoja[$row]['B']);
 	$objHoja[$row]['B'] = formatoTextoTitulo(utf8_decode($objHoja[$row]['B']));
 	//echo $objHoja[$row]['B'].'--<br>';
	$aux = explode(' ',trim($objHoja[$row]['B']));
	$largo_nombre = count($aux);
	switch($largo_nombre)
	{
		case 2:		 
			$datos[$row]['nombre'] = trim($aux[0]);
			$datos[$row]['apellido_paterno'] = trim($aux[1]);		 
		break;
		case 3:		 
			$datos[$row]['nombre'] = trim($aux[0]);
			$datos[$row]['apellido_paterno'] = trim($aux[1]).' '.trim($aux[2]);	
		break;
		case 4:		 
			$datos[$row]['nombre'] = trim($aux[0]).' '.trim($aux[1]);
			$datos[$row]['apellido_paterno'] = trim($aux[2]).' '.trim($aux[3]);		
		break;	
	}

	$persona[$datos[$row]['rut']]['nombre'] = $datos[$row]['nombre'];  
	$persona[$datos[$row]['rut']]['apellido_paterno'] =  $datos[$row]['apellido_paterno'];
	$datos[$row]['email'] = str_replace('_x000D_','',trim(utf8_decode($objHoja[$row]['C'])));
	$datos[$row]['email'] = trim($datos[$row]['email']);
	$persona[$datos[$row]['rut']]['email'] = $datos[$row]['email']; 
	$datos[$row]['labor'] = str_replace('_x000D_','',utf8_decode($objHoja[$row]['D'])); 
	$persona[$datos[$row]['rut']]['grado_academico'] = formatoTextoTitulo(utf8_decode($objHoja[$row]['AO'])); 
	$datos[$row]['labor_resumida'] = str_replace('_x000D_','',utf8_decode($objHoja[$row]['AX'])); 
	$datos[$row]['calidad'] = strtolower(str_replace(' ','_',utf8_decode($objHoja[$row]['E'])));
	$datos[$row]['centro_costo'] = utf8_decode($objHoja[$row]['AY']);
	$datos[$row]['supervisor'] = formatoTextoTitulo(utf8_decode($objHoja[$row]['G']));
	$datos[$row]['proyecto_corto'] = utf8_decode($objHoja[$row]['I']);
	$datos[$row]['proyecto'] = utf8_decode($objHoja[$row]['K']);
	$datos[$row]['responsable'] = formatoTextoTitulo(utf8_decode($objHoja[$row]['M']));
	$datos[$row]['monto'] =  utf8_decode($objHoja[$row]['O']);
	$datos[$row]['cuotas'] = utf8_decode($objHoja[$row]['P']);
	/*if(trim($datos[$row]['cuotas']) == '')
	{
		$datos[$row]['cuotas'] = 1; 
	}*/
	$datos[$row]['monto_mensual'] = utf8_decode($objHoja[$row]['P']);  
	$datos[$row]['observaciones'] = str_replace('_x000D_','',utf8_decode($objHoja[$row]['AE'])); 
		
	$datos[$row]['fecha_renuncia'] = obtencionFechaFormato($objHoja[$row]['AD']);
	$datos[$row]['fecha_desde'] = obtencionFechaFormato($objHoja[$row]['AF']); 
	if(trim($datos[$row]['fecha_desde']) == '')
	{
		$datos[$row]['fecha_desde'] = date("Y-m-d");
	}
	$datos[$row]['fecha_hasta'] = obtencionFechaFormato($objHoja[$row]['AG']);
	$datos[$row]['fecha_convenio'] = obtencionFechaFormato($objHoja[$row]['AH']);
	$datos[$row]['fecha_firma'] = obtencionFechaFormato($objHoja[$row]['U']);
	$datos[$row]['fecha_firma'] = '';
	$datos[$row]['fecha_compromiso'] = obtencionFechaFormato($objHoja[$row]['AJ']);
	if(trim($datos[$row]['fecha_compromiso']) == '')
	{
		$datos[$row]['fecha_compromiso'] = $datos[$row]['fecha_desde'];
	}
	$datos[$row]['fecha_creacion'] = $datos[$row]['fecha_compromiso'];		
	$datos[$row]['fecha_aprobacion'] = obtencionFechaFormato($objHoja[$row]['AK']); 
	$datos[$row]['estado'] = strtolower(str_replace(' ','_',utf8_decode($objHoja[$row]['AL']))); 	
	$datos[$row]['horas_jornada'] = utf8_decode($objHoja[$row]['AM']); 	
	$datos[$row]['comentarios'] = utf8_decode($objHoja[$row]['AN']).' ';
	if(trim($datos[$row]['comentarios']) != '')
	{
		$datos[$row]['comentarios'] = (100 * $datos[$row]['comentarios']).' %';
	}			
	$datos[$row]['fecha_termino'] = obtencionFechaFormato($objHoja[$row]['AP']); 
	$datos[$row]['numero_convenio'] = utf8_decode(trim($objHoja[$row]['AQ']));
	$datos[$row]['numero_decreto'] = utf8_decode(trim($objHoja[$row]['AR']));  
	$datos[$row]['numero_memo'] = utf8_decode(trim($objHoja[$row]['AS']));  
	
	$datos[$row]['monto_mensuales'][] =  '';
	$datos[$row]['monto_mensuales'][] = trim(str_replace(array('$','-'),array('',''),  utf8_decode($objHoja[$row]['R'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['S'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['T'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['U'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['V'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['W'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['X'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['Y'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['Z'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['AA'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['AB'])));
	$datos[$row]['monto_mensuales'][] =  trim(str_replace(array('$','-'),array('',''), utf8_decode($objHoja[$row]['AC']))); 
} 

print_r($datos); 
print_r($persona); 

foreach($persona as $rut => $valores)
{
	$PersonaObjeto = new PersonaObjeto();
	$PersonaObjeto->buscarRutEmail($rut,$valores['email']);
	//print_r($PersonaObjeto);
	if(isset($PersonaObjeto->email) && trim($PersonaObjeto->email) != '' )
	{
		$persona[$rut]['id_persona'] = $PersonaObjeto->id_persona;
		$guardar = false;
		if($PersonaObjeto->email != $persona[$rut]['email_alternativo'])
		{
			$PersonaObjeto->email_alternativo = trim($persona[$rut]['email_alternativo']);
			$guardar = true; 
		} 
		if(trim($PersonaObjeto->rut) == '')
		{ 
			$PersonaObjeto->rut =  $valores['rut'] ;
			$PersonaObjeto->rut_dv =  $valores['rut_dv'] ;
			$guardar = true; 
		}
		if(trim($PersonaObjeto->user_id) == '')
		{
			$PersonaObjeto->user_id = md5($valores['email'].time());
			$guardar = true; 
		} 
		if($guardar)
		{
			$PersonaObjeto->guardarObjeto();
		}
		
		if(trim($PersonaObjeto->user_id) == '')
		{			
			crearUsuario($PersonaObjeto,$valores,$persona,$rut);
		}
	}
	else
	{
		$PersonaObjeto->rut = $rut;
		$PersonaObjeto->rut_dv = strtoupper($valores['rut_dv']);
		$PersonaObjeto->nombre = $valores['nombre'];
		$PersonaObjeto->id_tipo_contrato = 'sin_informacion';
		$aux = explode(' ',$PersonaObjeto->apellido_paterno);
		$valores['apellido_materno'] = '';
		if(count($aux) == 2 && is_array($aux))
		{
			$valores['apellido_paterno'] = $aux[0];
			$valores['apellido_materno'] = $aux[1];
		}
		$PersonaObjeto->apellido_paterno = $valores['apellido_paterno'];
		$PersonaObjeto->apellido_materno = $valores['apellido_materno'];
		$PersonaObjeto->email = $valores['email'];
		//$PersonaObjeto->email_alternativo = $valores['email'];
		$PersonaObjeto->grado_academico_honorarios = $valores['grado_academico']; 
		$PersonaObjeto->user_id = md5($valores['email'].time());
		$PersonaObjeto->guardarObjeto();
		 
		$persona[$rut]['id_persona'] = $PersonaObjeto->id; 
		
		crearUsuario($PersonaObjeto,$valores,$persona,$rut);		
	}	
	$persona[$rut]['email_alternativo'] = $PersonaObjeto->email_alternativo;
}




$ControlGestionCentroCostos = new ControlGestionCentroCostos();
$aux = $ControlGestionCentroCostos->obtenerListado();
//print_r($aux);
$centros_costo = array();
for($j=0; $j < count($aux);$j++)
{
	$centros_costo[$aux[$j]['codigo']] = $aux[$j];
}
 print_r($centros_costo);

$total = count($datos)+1;
//echo "total ".$total;
for($i=2;$i <= $total;$i++)
{
	//print_r($datos[$i]);
	$GestionHonorarios = new GestionHonorarios(); 
	$GestionHonorarios->id_persona = $persona[$datos[$i]['rut']]['id_persona'];
	$GestionHonorarios->numero_convenio = $datos[$i]['numero_convenio'];
	$GestionHonorarios->numero_decreto = $datos[$i]['numero_decreto'];
	$GestionHonorarios->numero_memo = $datos[$i]['numero_memo']; 
	$GestionHonorarios->fecha_creacion = $datos[$i]['fecha_creacion'];
	$GestionHonorarios->fecha_termino = $datos[$i]['fecha_termino']; 
	if($datos[$i]['centro_costo'] == '#N/A')
	{
		$datos[$i]['centro_costo'] = '';		
	}
	$GestionHonorarios->id_centro_costo = 10000;
	if(isset($centros_costo[$datos[$i]['centro_costo']]))
	{
		$GestionHonorarios->id_centro_costo = $centros_costo[$datos[$i]['centro_costo']]['id_centro_costo'];
	}
	/*else
	{
		$GestionCentroCostos = new GestionCentroCostos();
		$GestionCentroCostos->codigo = $datos[$i]['centro_costo'];
		$GestionCentroCostos->proyecto = $datos[$i]['proyecto'];
		$GestionCentroCostos->usuario_responsable = 'fda1c50799dde551b1a9f1543b51f75a';
		$GestionCentroCostos->activo = 0;
		$GestionCentroCostos->guardarObjeto();
		$GestionHonorarios->id_centro_costo = $GestionCentroCostos->id;
	}*/
	$GestionHonorarios->centro_costo = $datos[$i]['centro_costo'];
	$GestionHonorarios->proyecto = $datos[$i]['proyecto'];	
	$GestionHonorarios->monto_comprometido = $datos[$i]['monto'];
	$GestionHonorarios->numero_cuotas = $datos[$i]['cuotas'];  
	if(trim($datos[$i]['cuotas']) == '') 
	{
		$datos[$i]['monto_cuotas'] = floor($datos[$i]['monto']/$datos[$i]['cuotas']);
	}
	$GestionHonorarios->fecha_desde = $datos[$i]['fecha_desde'];
	$GestionHonorarios->fecha_hasta = $datos[$i]['fecha_hasta'];
	$GestionHonorarios->fecha_convenio = $datos[$i]['fecha_convenio'];
	$GestionHonorarios->fecha_firma = $datos[$i]['fecha_firma'];
	$GestionHonorarios->fecha_compromiso  = $datos[$i]['fecha_compromiso'];
	$GestionHonorarios->fecha_aprobacion = $datos[$i]['fecha_aprobacion']; 
	$GestionHonorarios->horas_jornada = $datos[$i]['horas_jornada'];
	$GestionHonorarios->comentario_horas_jornada = $datos[$i]['comentarios'];
	$GestionHonorarios->labor = $datos[$i]['labor'];
	$GestionHonorarios->labor_resumida = substr ($datos[$i]['labor'],0,70);
	$GestionHonorarios->proyecto_corto	= $datos[$i]['proyecto_corto'];
	$GestionHonorarios->observacion = $datos[$i]['observaciones'];
	if($datos[$i]['responsable'] == '#N/A')
		$datos[$i]['responsable'] = '';
	if($datos[$i]['supervisor'] == '#N/A')
		$datos[$i]['supervisor'] = '';
	$GestionHonorarios->investigador_responsable = $datos[$i]['responsable'];
	$GestionHonorarios->investigador_supervisor  = $datos[$i]['supervisor'];
	$GestionHonorarios->id_tipo_honorarios_calidad = $datos[$i]['calidad'];
	if(trim($datos[$i]['estado']) == '')
	{
		$datos[$i]['estado'] = 'pendiente';
	}
	$GestionHonorarios->id_tipo_estados_honorarios = $datos[$i]['estado'];
	$GestionHonorarios->guardarObjeto();
	$GestionHonorarios->id_honorario = $GestionHonorarios->id; 
 
 	$fecha_desde = explode('-',$GestionHonorarios->fecha_desde);
 	$datos[$i]['monto_parcial'] = $datos[$i]['monto']; 
 	$aux = 1; 
 	for($j=1; $j < count($datos[$i]['monto_mensuales']);$j++)
 	{ 	 
 		if(trim($datos[$i]['monto_mensuales'][$j]) != '')
 		{
			$GestionHonorariosCuotas = new GestionHonorariosCuotas();
		 	$GestionHonorariosCuotas->id_honorario = $GestionHonorarios->id_honorario;
		
		 	$GestionHonorariosCuotas->numero_agno = 2018;
		 	$GestionHonorariosCuotas->numero_mes  = $j;
		 	$GestionHonorariosCuotas->numero_cuota = $aux;
			$GestionHonorariosCuotas->monto_cuota = $datos[$i]['monto_mensuales'][$j];		
		 	$siguiente = $j+1;
		 	if((isset($datos[$i]['monto_mensuales'][$siguiente]) && trim($datos[$i]['monto_mensuales'][$siguiente]) == '') || $siguiente == count($datos[$i]['monto_mensuales']))
		 	{
				$GestionHonorariosCuotas->tipo = 'final';
			}
		 	$GestionHonorariosCuotas->guardarObjeto();
		 	
		 	$aux++;
	 	}
	}
 	
 	/*if(trim($datos[$i]['cuotas']) != '')
 	{
	 	for($j=1; $j <= $datos[$i]['cuotas']; $j++)
	 	{
		 	$GestionHonorariosCuotas = new GestionHonorariosCuotas();
		 	$GestionHonorariosCuotas->id_honorario = $GestionHonorarios->id_honorario;

		 	$GestionHonorariosCuotas->numero_agno = $fecha_desde[0];
		 	$GestionHonorariosCuotas->numero_mes  = (int)$fecha_desde[1];
		 	if($fecha_desde[1] == 13)
		 	{
				$fecha_desde[0]++;
				$fecha_desde[1]=1;
			}
			else
			{
				$fecha_desde[1]++;
			}		 	
		 	$GestionHonorariosCuotas->numero_cuota = $j; 
		 	
		 	if($j%2 == 0)
		 	{
				$datos[$i]['cuotas_parcial'] = $datos[$i]['monto_cuotas'] + 3 + $j;
			}
			else
			{
				if($j == 1)
				{
					$datos[$i]['cuotas_parcial'] = $datos[$i]['monto_cuotas'] + 1;
				}
				else
				{
					$datos[$i]['cuotas_parcial'] = $datos[$i]['monto_cuotas'] - 3 + $j;
				}
			}
			if($j == $datos[$i]['cuotas'])
			{
				$datos[$i]['cuotas_parcial'] = $datos[$i]['monto_parcial'];
			} 
	
		 	$GestionHonorariosCuotas->monto_cuota = $datos[$i]['cuotas_parcial'];		
			$datos[$i]['monto_parcial'] = $datos[$i]['monto_parcial'] - $datos[$i]['cuotas_parcial'];
		 	$GestionHonorariosCuotas->guardarObjeto();
		 	//print_r($GestionHonorariosCuotas);
	 	}
 	}*/
}
 

//print_r($persona);
print_r($datos); 
//print_r($objHoja);

function crearUsuario($PersonaObjeto,$valores,$persona,$rut)
{
	$PersonaInfoObjeto = new PersonaObjetos();
	$PersonaInfoObjeto->id_persona 	= $persona[$rut]['id_persona'];
	$PersonaInfoObjeto->user_id 	 = $PersonaObjeto->user_id;
	$PersonaInfoObjeto->nombre 	 = $valores['nombre'];
	$PersonaInfoObjeto->apellido_paterno  = $valores['apellido_paterno'];
	$PersonaInfoObjeto->apellido_materno  = $valores['apellido_materno'];	
	$PersonaInfoObjeto->email		 = $valores['email'];
	$PersonaInfoObjeto->guardarObjeto();
	
	$Usuarios = new Usuarios();
	$Usuarios->user_id 	= $PersonaInfoObjeto->user_id;
	$Usuarios->username = $PersonaInfoObjeto->email;	
	$Usuarios->password = md5('ciae2017');	
	$Usuarios->perms 	= 20;
	$Usuarios->activo = 1;
	$Usuarios->saveObject();
}

function obtencionFechaFormato($valor)
{
	if(trim($valor) != '')
		$valor = date( "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP(($valor+1)));
	return $valor;
}

function formatoTextoTitulo($valor)
{
	return mb_convert_case(ucwords(strtolower(trim($valor))), MB_CASE_TITLE);
}

global $indexOutput;
echo $indexOutput; 
?>
</pre>
<form  name='main' action="lectura_honorarios-importacion.php" method="get">
<input type="hidden" name="caso" value="<?php echo $caso; ?>">
<script>
	/*setTimeout(function(){
   document.main.submit();
}, 3000);*/
 
</script>
</form>

</body>