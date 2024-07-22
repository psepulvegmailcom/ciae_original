<?php 
 
include "../../site/clases_general/ControladorDeFunciones.php";
 
   
session_start();

$_SESSION['tmp_captcha'] 	= Funciones::generarPassword(5);
$captcha 					= imagecreatefromgif("../images/bgcaptcha.gif");
$colText 					= imagecolorallocate($captcha, 0, 0, 0);
imagestring($captcha, 8, 10, 4, $_SESSION['tmp_captcha'], $colText);
header("Content-type: image/gif");
imagegif($captcha);



?>
