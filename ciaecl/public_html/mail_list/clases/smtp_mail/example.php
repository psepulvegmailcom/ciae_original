<?php
spl_autoload("loadsmtp");
$ishtml=true;
$reply_to="psepulve@gmail.com";
$reply_name="pampli";
$from_name="Gourab Singha";
$subject="This Is Subjectee55";
$resipent_address="psepulve@gmail.com";
$htmlcontent=' 
 

<html><body><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Apertura de Inscripción a Torneos Latinoamericanos </title>
</head>
<style>
img { border:0}
body {font-family: "Lucida Sans" ,  sans-serif;}
</style>
<body style="text-align:center ">

<img src="http://www.ciae.uchile.cl/mail_list/email/imagenes/carta_26.jpg" border="0" border="0" usemap="#Map" >
<map name="Map" id="Map">
  <area shape="rect" coords="60,22,225,146" href="http://www.ciae.uchile.cl/" target="_blank" />
  <area shape="rect" coords="486,23,614,167" href="http://www.torneoslatinoamericanos.org/" target="_blank" />
  <area shape="rect" coords="52,180,621,637" href="http://www.torneoslatinoamericanos.org/" target="_blank" />
</map>

<br />
 

<br /><br /> 
<small>Si usted no puede ver este mail correctamente presione <a href="http://www.ciae.uchile.cl/mail_list/email/26.html">aquí </a></small><br /><br />

  <small>Si usted desea ser removido de nuestra base de datos en forma definitiva por favor escríbanos con el asunto "Remover base contacto" a <a href="mailto:webmaster@ciae.uchile.cl?subject=Remover base contacto">webmaster@ciae.uchile.cl</a> </small> 


</body>
</html>
</body></html>


';
send_mail();



?>