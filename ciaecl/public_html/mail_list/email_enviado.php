<?php

include('email_conexion.php'); 
$valores = $_POST; 
$e  	 = new miniTemplate('templates/email_enviado.tpl');

$minutos = round(rand(15,20));
$enviar  = round(rand(8,10));

 
$minutos = round(rand(25,35));
$enviar  = round(rand(3,6));
 

$milisegundos = $minutos * 60 * 1000;
$e->setVariable('milisegundos',$milisegundos);
$e->setVariable('minutos',$minutos);  

$e->setVariable('fecha_html',date("d-m-Y H:i:s")); 
$activos = envioEmail::obtenerPlantillasActivas('activo');
if(is_array($activos) && count($activos)>0)
{  
	$e->setVariable('asunto',$activos[0]['asunto']);
	$output = envioEmail::envioEmailListado($activos[0]['id_plantilla'],$enviar);
	if(is_array($output) && count($output)>0)
	{
		for($i = 0; $i < count($output); $i++)
		{
			$e->addTemplate('bloque_enviado_email');
			foreach($output[$i] as $var => $val)
			{
				$e->setVariable($var,$val);
			}	
		} 
		envioEmail::enviarEmail($output);	  	
	}
}

$pendientes = envioEmail::enviosPendientes();
for($i=0; $i < count($pendientes); $i++)
{	
	$e->addTemplate('bloque_pendiente');
	foreach($pendientes[$i] as $var => $val)
	{
		$e->setVariable($var,$val);
	}		
}
 
echo $e->toHtml();
?>