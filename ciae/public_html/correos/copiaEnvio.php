<title>Copia Correos personalizados</title>
 <pre>
<style>
p {padding: 5px 50px 5px 50px}
li {padding: 4px 50px 4px 5px}
ul {padding: 4px 50px 4px 100px}

</style>
<?php
 
require_once("config/conexion.php");  


$funciones = new FuncionesGenerales();    


$envioConfig = new envioConfig();

 
?> 

<form name="main" method="post" action="copiaEnvio.php?u=e889760b9a85dc871b2052565fd1147c"> 
<p><b>Selección caso de envio a copiar</b> <br>
<select name='caso_envio'>
<option value=''></option>
<?php
	$caso_envios = $envioConfig->obtenerEnviosAntiguos();
	for($i=0; $i < count($caso_envios); $i++)
	{
		echo "<option value='".$caso_envios[$i]['caso_envio']."'>".$caso_envios[$i]['caso_envio']." - ".$caso_envios[$i]['asunto']."</option>";
	}
?>
</select>
</p>
<p ><b>Nuevo caso envio</b> <br> 
<input  type="text" name='nuevo_caso_envio' style='width:90%'   >  <br>
</p>
<p ><b>Nuevo asunto caso envio (dejar en blanco si debe ser igual)</b> <br> 
<input  type="text" name='nuevo_asunto' style='width:90%'   >  <br>
</p>

<p ><b>Nuevo contenido (dejar en blanco si debe ser igual)</b> <br> 
<input  type="text" name='nuevo_contenido' style='width:90%'   >  <br>
</p>
<p><b>Opciones de copia</b> <br> 
<input  type="checkbox" name='opcion' value='email' checked> Correos enviados<br>
</p>
 <p>
<input  type="submit" value="Copiar"  />
</p> 
</form> 
<?php  
if(count($_POST) > 0)
{ 
	$envioConfig->copiarEnvio($_POST);			 
}
?>
<p>Casos envio actuales</p>
<ul>
<?php
	for($i=0; $i < count($caso_envios); $i++)
	{
		echo "<li>".trim($caso_envios[$i]['caso_envio'])." - ".trim($caso_envios[$i]['asunto'])."</li>";
	}
?>
</ul>
</pre>