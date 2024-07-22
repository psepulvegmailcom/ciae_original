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
	
 

?>
<title>Resumen de herramientas de correos masivos</title>
<br><br>
<style>
li {padding-top:15px;}
</style>
<ul> 
 
 
 
<li><a href="https://www.ciae.uchile.cl/mail_list/agregarEmail.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Agregar correo lista de bases de datos (agregaremail.php)</a></li>
<li><a href="https://www.ciae.cl/correos/obtener.php?u=e889760b9a85dc871b2052565fd1147c&caso=R" target="_blank">Obtener no leidos correo webmaster@ciae REBOTE</a></li> 
<li><a href="https://www.ciae.cl/correos/obtener.php?u=e889760b9a85dc871b2052565fd1147c&caso=C" target="_blank">Obtener no leidos correo webmaster@ciae CONTACTO</a></li> 
<li><a href="https://www.ciae.uchile.cl/mail_list/reboteemail.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Inactivar correo CIAE masivo (rebote)</a></li>
<li><a href="https://www.ciae.uchile.cl/mail_list/email_lista_comunicaciones.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Obtener lista de correos Comunicaciones</a></li>
<li><a href="https://www.ciae.uchile.cl/mail_list/email_lista.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Obtener lista de correos</a></li>
<li><a href="https://www.ciae.uchile.cl/mail_list/eliminarSuscripcion.php" target="_blank">Desuscribir correos CIAE (eliminarSuscripcion.php)</a></li>

<li><a href="https://www.ciae.cl/correos/obtener_rebote.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Obtener listado inactivos de mas nuevos a mas antiguos (obtener_rebote.php)</a></li>


<li><a href="https://www.ciae.uchile.cl/mail_list/consultarEmail.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Consultar correos CIAE</a></li>
<li><a href="https://www.ciae.uchile.cl/mail_list/reemplazarEmail.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Reemplazar correos CIAE (reemplazarEmail.php)</a></li> 
<li><a href="https://www.ciae.uchile.cl/mail_list/test.php?u=e889760b9a85dc871b2052565fd1147c&caso=nuevos" target="_blank">Actualizar correos CIAE --> Phplist NUEVOS</a></li>
<li><a href="https://www.ciae.uchile.cl/mail_list/test.php?u=e889760b9a85dc871b2052565fd1147c&caso=todos" target="_blank">Actualizar correos CIAE --> Phplist TODOS</a></li>
<li><a href="https://www.ciae.cl/correos/envioCorreo.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Envio correos CIAE</a></li> 
<li><a href="https://www.ciae.cl/correos/output_failed.txt" target="_blank">Lectura OUTPUT_FAILED.TXT Correos remitente envios</a></li>  


<li><a href="https://www.ciae.cl/correos/copiaEnvio.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Copiar caso envio personalizado</a></li>
<li><a href="https://www.ciae.cl/correos/checksite.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">Revisión sitios</a></li>
<li><a href="http://listasciae.uchile.cl/lists/admin/" target="_blank">PHPList listaciae acceso</a></li>


 
<li><a href="https://www.ciae.cl/correos/listaa.php?u=e889760b9a85dc871b2052565fd1147c" target="_blank">SQL Varios</a></li>
 
 
</ul>
