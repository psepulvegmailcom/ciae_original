<?php 
  
 include_once 'config.cfg';

$valoresGet = VarSystem::getGet();
$texto 	= $valoresGet['e'];
$tamano = $valoresGet['t'];
$color  = $valoresGet['c'];
if(trim($color) != '')
{
	$color = '_'.$color;
}
if(trim($tamano) == '')
{
	$tamano = 10;
}
$y = $tamano + 5;
 
$captcha 					= imagecreatefrompng("www/imagenes/email".$color.".png");
$colText 					= imagecolorallocate($captcha, 0, 51, 104);
  
$fuente = 'www/extra/arial.ttf';
imagettftext($captcha, $tamano, 0, 3, $y, $colText, $fuente, $texto);
header("Content-type: image/gif");
imagegif($captcha);



?>