<?php
include('email_conexion.php'); 
$e  = new miniTemplate('templates/email.tpl');

$valores = $_POST; 
//print_r($valores);

envioEmail::limpiezaCorreos();
if(count($valores)>0)
{  
	envioEmail::crearEnvioActivo($valores['id_envio'],$valores['tipo_base']);
}   


$plantillas = envioEmail::obtenerPlantillasActivas('inactivo','fecha DESC');
for($i=0; $i < count($plantillas); $i++)
{
	$e->addTemplate('bloque_envio_activo');
	foreach($plantillas[$i] as $var => $val)
	{
		$e->setVariable($var,$val);
	}
}

$tipo = envioEmail::obtenerListadoTipos(); 
for($i=0; $i < count($tipo); $i++)
{
	$e->addTemplate('bloque_tipo_base');
	foreach($tipo[$i] as $var => $val)
	{
		$e->setVariable($var,$val);
	}
}

echo $e->toHtml();

?>