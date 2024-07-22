<title>Inactivar Email</title>

<META HTTP-EQUIV="REFRESH" CONTENT="3600;URL=https://www.ciae.uchile.cl/mail_list/test.php?u=e889760b9a85dc871b2052565fd1147c&indice=0&caso=nuevos"> 
<a href='test.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>
<a href='http://listasciae.uchile.cl/lists/salida_query.sql'  target="_blank">Salida SQL</a> <br><br>

<pre style='    white-space: pre-wrap; font-family: Verdana, "Bitstream Vera Sans", Geneva, sans-serif; font-size:12px; '>
 
<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

	include('email_conexion.php'); 
	echo date("Y-m-d H:i:s",mktime(date("H")-4, date("i"), date("s"), date("m")  , date("d"), date("Y")))."\n\n";
		
	 //print_r($listado);
	
	$salida = envioEmail::obtenerTotalTodos();
	$total = $salida[0]['total'] + $salida[1]['total'];
	$salida[]['total'] = $total;
	print_r(json_encode($salida)); 
	
	$order=' creacion_fecha ASC';
	$maximo = 50;
	$tiempo = 220; //segundos
	$caso_completo = $_GET['caso'];
	//$indice = $_GET['indice'];
	$indice = envioEmail::obtenerIndice($caso_completo);  
	if(trim($indice) == '')
	{
		$indice = 0;
	}
	
	if(trim($caso_completo) == '')
	{
		$caso_completo = 'nuevos'; 
	}
	
	if($caso_completo == 'nuevos')
	{ 
		$order = ' fecha_actualizacion DESC';
		$tiempo = 150; //segundos dado que no esta consultanod BD
	}	
	else
	{		
		$tiempo = 20; //segundos		
	}
	$tiempo = 30;
	if($indice > $total)
	{
		$indice = 0; //reinicio al llegar al final
	}	 
	if($caso_completo == 'nuevos' && $indice > 6000)
	{
		$indice = 0 ; //reinicio caso de nuevos
	}
	 
	//$caso_eliminacion = TRUE;  	$caso_agregar = FALSE;
	//$caso_eliminacion = FALSE;  	$caso_agregar = TRUE;
	$caso_eliminacion = TRUE;  	$caso_agregar = TRUE;
	 
	if($caso_agregar)
	{		 
		echo "<BR><BR>--------------------ACTIVACION---------------------------------------<BR><BR>";
		$salida = envioEmail::obtenerListadoActivosEnviarPHPList($indice,$maximo,$order);
		$email = " "; 	 
		$total_activos = count($salida);
		
		for($i=0; $i < count($salida); $i++)
		{
			$email .= trim($salida[$i]['email'])." "; 
		}   
		echo envioEmail::agregarPhplist($email);  
	}
	
	if($caso_eliminacion)
	{	 
		echo "<BR><BR>---------------------ELIMINACION---------------------------------------<BR><BR>";
		$salida = envioEmail::obtenerListadoInactivosEnviarPHPList($indice,$maximo,$order); 
		$email = " "; 
		 //print_r($salida);
		$total_inactivos = count($salida);
		for($i=0; $i < count($salida); $i++)
		{
			$email .= trim($salida[$i]['email'])." ";
		}  
		//echo $email;
		echo envioEmail::eliminarPhplist($email);
	}
	if($total_inactivos == 0 && $total_activos == 0)
		$indice = 0;
	else
		$indice = $indice + $maximo;
	
	
	envioEmail::editarIndice($caso_completo,$indice);
?>
 
</pre>

 <!-- <META HTTP-EQUIV="REFRESH" CONTENT="<?php echo $tiempo;?>;URL=https://www.ciae.uchile.cl/mail_list/test.php?u=e889760b9a85dc871b2052565fd1147c&indice=<?php echo $indice;?>&caso=<?php echo $caso_completo;?>"> --> 


<script> 
setTimeout("window.close()",30000);
</script>