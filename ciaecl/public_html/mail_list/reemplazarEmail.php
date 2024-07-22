<title>Reemplazar Email</title>

<a href='reemplazarEmail.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>
<?php

include('email_conexion.php');  
 //print_r($listado);
?> 


<form name="main" method="post" action="reemplazarEmail.php?u=e889760b9a85dc871b2052565fd1147c"> 
  
<input  type="submit" value="Enviar" /><br /> 
Email original <input type="text" name="email"  style="width:80%; "/> <br />  <br /> 
Email nuevo <input type="text" name="email_nuevo"  style="width:80%; "/> 
 <br /> <input  type="submit" value="Enviar" />
</form>
<pre>
<?php
  
if(count($_POST) > 0)
{ 	 
	
	$salida = envioEmail::consultarEmailCompleto($_POST['email']);
	print_r($salida);
	envioEmail::reemplazarEmail($_POST['email'],$_POST['email_nuevo']);	
	$salida = envioEmail::consultarEmailCompleto($_POST['email_nuevo']);
	print_r($salida);
	  
}
?>
</pre>