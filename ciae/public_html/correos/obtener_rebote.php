<title>Obtener ultimos inactivados</title>
<br><br><pre>
<?php 
   
if(trim($_SERVER['PHP_AUTH_USER']) == '')
{
  $_SERVER['PHP_AUTH_USER']   = $_GET['u']; 
}

if ($_SERVER['PHP_AUTH_USER'] != "e889760b9a85dc871b2052565fd1147c" )
{  
  echo 'Authorization Required To Server.';
  die();
}
 

require_once("config/conexion.php");  
 

$envioCorreo = new envioCorreo();
 
/*
$sql = "SELECT email  FROM `envio_email_destino` WHERE `caso_envio` LIKE '20230428-encuesta_ubb' AND `estado` LIKE 'no_enviado'  
ORDER BY `envio_email_destino`.`email_md5` ASC limit 10;";
$inactivos = $envioCorreo->con->obtenerDatos($sql); 
echo "\n\n**********************por inactivar INACTIVOS*************************\n\n";

if(count($inactivos) > 0)
{
	
	echo '<textarea width="90%" height="70px">';
	for($i=0; $i < count($inactivos);$i++)
	{
		echo "UPDATE base_datos_email SET estado = 'inactivo', comentario ='inactivacion por rebote' WHERE  email LIKE '".$inactivos[$i]['email']."' AND estado = 'activo';UPDATE envio_email_destino SET estado = 'rebote'
WHERE  email LIKE '".$inactivos[$i]['email']."' AND estado != 'rebote';\n";
		
		
		//echo $inactivos[$i]['email']."\n";
	}
	//print_r($inactivos);
	
	echo "</textarea>";
}
 */
$inactivos = $envioCorreo->obtenerInactivos('2023-05-17 16:16:32'); 
echo "\n\n**********************INACTIVOS*************************\n\n";

if(count($inactivos) > 0)
{
	echo "ultima inactivos (".count($inactivos).") ".$inactivos[0]['fecha_actualizacion']."\n\n\n\n";
	echo '<textarea  style="width:90%"; " rows="7"  >';
	for($i=0; $i < count($inactivos);$i++)
	{
		//echo '<a target="_blank" href="http://listasciae.uchile.cl/lists/uelt.php?u=e889760b9a85dc871b2052565fd1147c&email_eliminar='.$inactivos[$i]['email'].'"'.">http://listasciae.uchile.cl/lists/uelt.php?u=e889760b9a85dc871b2052565fd1147c&email_eliminar=".$inactivos[$i]['email']."</a>\n";
		echo $inactivos[$i]['email']."\n";
	}
	//print_r($inactivos);
	
	echo "</textarea>";
}
 
$activos = $envioCorreo->obtenerActivos('2023-05-17 16:07:57'); 
echo "\n\n**********************ACTIVOS*************************\n\n";

if(count($activos) > 0)
{
	echo "ultima activos  (".count($activos).") ".$activos[0]['fecha_actualizacion']."\n\n\n\n";
	echo '<textarea  style="width:90%"; "  rows="7">';
	for($i=0; $i < count($activos);$i++)
	{
		echo $activos[$i]['email']."\n";
	}
	//print_r($activos);
	echo "</textarea>";
}



 
?>