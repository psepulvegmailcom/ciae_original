<title>Rebote Email</title>

<a href='reboteemail.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>
<form name="main" method="post" action="reboteemail.php?u=e889760b9a85dc871b2052565fd1147c"> 
 
<textarea name="email" style="height:150px; width:99%"></textarea> 

<input  type="submit" value="Enviar" />

</form>
<pre style=' white-space: pre-wrap;width:99%; height:480px; overflow:scroll '> 
<?php

include('email_conexion.php'); 

$inactivos_antes = envioEmail::cuantosInactivo();
echo "\n".$inactivos_antes."\n\n";
//envioEmail::actualizarCreacionFecha();
if(count($_POST) > 0)
{ 
	//print_r($_POST);
	$texto = trim($_POST['email']);
	$extra_ciie2012 = "";
	if(trim($texto) != '')
	{ 
		//echo $texto.'----<br>';
		$texto = str_replace(array("@OPERACIONES",";",",","'",'"',"?","\n","(",")","<",">","mailto:",'contacto@torneoslatinoamericanos.org','webmaster@ciae.uchile.cl','contact@sidwod.com','webmaster@ciae.cl','webmaster@ciae.uchile.cl','psepulve@gmail.com','comunicaciones@ciae.uchile.cl','estandaresEP@ciae.uchile.cl','mpalavic@uchile.cl','ciae@uchile.cl',  'modelamiento@ciae.uchile.cl','contacto@ciie2012.cl','\\', 'contacto@ciie2014.cl','correos@uchile.cl','informaciones@ciae.uchile.cl','webmaster@ciae.uchile.cl','webmaster@ciae.cl','investigacion@ciae.uchile.cl','informaciones@ciae.uchile.cl','envioprueba@ciae.uchile.cl','contacto@ciae.uchile.cl','@ciae.uchile.cl','	'),array(""," "," "," "," "," "," "," "," "," "," "," "," ",' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' '),$texto);
		$aux = explode(" ",$texto); 
		$update = "";
		foreach($aux as $i => $palabra)
		{
			$palabra = trim($palabra);
			$aux3 = explode('@',trim($palabra));  
			
			if(count($aux3) == 2)
			{
				if(trim($update) != '')
				{
					 $update .= " OR ";
				}
				$update .= " email = '".trim($palabra)."' ";//OR  email LIKE '".trim($palabra)."%' \n"; 
			} 
		} 
		$update = stripslashes($update);
		$output = envioEmail::inactivarEmail($update);
		echo $output;		
	} 
	echo "</pre><pre>";
	//envioEmail::inactivarEmailGeneral();	
	$inactivos_despues = envioEmail::cuantosInactivo();
	echo "\n".$inactivos_despues."\n\n";
	$diferencia = $inactivos_antes-$inactivos_despues;
	echo "\n\nDiferencia ".$diferencia."\n";
	
	echo "</pre>"; 
	
	
	if(isset($_POST['externo_interno']) && trim($_POST['externo_interno']) == 'ciae_interno')
	{
		echo "<script>window.close();</script>";
	}
	echo " <pre>";
}
?> 
</pre>