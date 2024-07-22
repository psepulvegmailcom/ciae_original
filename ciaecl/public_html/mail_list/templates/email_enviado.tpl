<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Enviando correo masivo</title>
</head>

<body   >
<a href="email_enviado.php" >Refrescar</a><br /><br />
Envio {fecha_html}<br />
Próximo envio en {minutos} minutos<br /><br />
 
<strong>Envios pendientes</strong>
<ol>
<!-- START BLOCK : bloque_pendiente -->
<li>{total} - {asunto} </li>
<!-- END BLOCK : bloque_pendiente -->
</ol> Correo enviado <strong>{asunto}</strong><br /> 
<ol>
<!-- START BLOCK : bloque_enviado_email -->
<li>{email} <strong>ENVIADO</strong> </li>
<!-- END BLOCK : bloque_enviado_email -->
</ol>


<form name="main" method="post" action="email_enviado.php"> 
</form>
<script>
function enviarEmail()
{
	//alert('enviar');
	document.main.submit();
}
 setTimeout('enviarEmail()',{milisegundos});  
 //setTimeout('enviarEmail()',5000); // 5000 -> 5 seg
  
</script>
</body>
</html>
