<title>Consultar Email</title>

<a href='consultarEmail.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>
<?php

include('email_conexion.php');  
 //print_r($listado);
  
?> 


<form name="main" method="post" action="consultarEmail.php?u=e889760b9a85dc871b2052565fd1147c"> 
  
<input  type="submit" value="Enviar" /><br /> 
Email <input type="text" name="email"  style="width:80%; "/> 
<br /> <input  type="submit" value="Enviar" />
</form>
<pre>
<?php
  
if(count($_POST) > 0)
{ 
	 
	$salida = envioEmail::consultarEmailCompleto($_POST['email']);
	print_r($salida);
			 
} 
?>
</pre>