<pre>
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
 
 

$sitios = array("https://www.escuelaschile.cl/","https://www.ciae.uchile.cl/","https://educalenguasoriginarias.ciae.cl/");
$total = count($sitios);
for($i=0; $i < $total; $i++)
{

	$homepage = trim(file_get_contents($sitios[$i]));
	echo strlen($homepage)."\n".htmlspecialchars( $homepage);
}
 

 
 
  
 
 
 ?>