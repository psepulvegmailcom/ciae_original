<?php
	include "../../config.cfg"; 
	$Avisos = new Avisos();
	$Avisos->getPopup();
	 
?>
<html>
<head>
<title>Registro de Asistencia Tecnica Educativa</title>
<link rel="stylesheet" href="../style/version3_portal.css" media="all"></link> 
</head>
<body style=" width:500px; padding-left:40px;" >
 
<div style="padding: 15px; text-align:justify;"  >
 
<br> <strong> 
<?php  
	echo $Avisos->titulo;
?>
 </strong> 
<br> 
<br>
<?php 
	echo Funciones::TextoSimple($Avisos->aviso,true);
?>
<br /><br /> 
<?php  
	$siteTitle = VarSystem::getInfoSystem('title'); 
	echo $siteTitle['firm'];
?>

<br /><br /><br />
<center><a href="" onclick="javascript:self.close();" >Cerrar Mensaje</a></center>
</div>  
</body>
</html>
