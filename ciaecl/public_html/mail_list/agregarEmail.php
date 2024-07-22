<title>Agregar Email</title>
<pre>
<!-- <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=agregarEmail.php?u=e889760b9a85dc871b2052565fd1147c"></META> -->
<?php

include('email_conexion.php'); 
  
    



	//envioEmail::inactivarEmailGeneral();

$listado = envioEmail::obtenerListadoTipos();
 //print_r($listado);
 //print_r($_POST);
?> 
</pre>
 

<a href='agregarEmail.php?u=e889760b9a85dc871b2052565fd1147c'>Refrescar</a> <br><br>

<form name="main" method="post" action="agregarEmail.php?u=e889760b9a85dc871b2052565fd1147c"> 
  
<input  type="submit" value="Enviar" /><br /> 
Email <input type="text" name="email"  style="width:80%; "/><br /><br />
Nombre <input type="text" name="nombre" style="width:80%; " /><br /><br />
Apellidos <input type="text" name="apellidos" style="width:80%; " /><br /><br />
Institucion <input type="text" name="institucion" style="width:80%; " /><br /><br />
Actividad <input type="text" name="actividad" style="width:80%; " /><br /><br />
Cargo <input type="text" name="cargo" style="width:80%; " /><br /><br />
Telefono <input type="text" name="telefono" style="width:80%; " /><br /><br />
Tipo Base Nueva  <input type="text" name="tipo_base_nueva" style="width:80%; " /><br /><br />
Tipo Base<br />
<?
for($i=0; $i < count($listado);$i++)
{  	
	echo "<input type='checkbox' name='tipo_base[]' value='".$listado[$i]['tipo_base']."'>".$listado[$i]['tipo_base']." (".$listado[$i]['total'].")<br>\n";
}
?> 
<!--  <select name="tipo_base">
<option value="ciae_general_contacto_web">ciae_general_contacto_web</option>
<option value="ciae_general">ciae_general</option>
<option value="ciae_general_comunicaciones">ciae_general_comunicaciones</option>
<?
/*for($i=0; $i < count($listado);$i++)
{
	echo "<option value='".$listado[$i]['tipo_base']."'>".$listado[$i]['tipo_base']." (".$listado[$i]['total'].")3333</option>\n"; 
} */
?>
</select><br /><br /> -->
<input  type="submit" value="Enviar" /><br /> 
</form>
<pre>
<?php
  
if(count($_POST) > 0)
{ 
	$_POST['email'] = str_replace(array('<','>',';'),array(',',',',','),$_POST['email']);
	$_POST['email'] = strip_tags($_POST['email']);
	//echo '***<textarea >'.$_POST['email'].'</textarea>***<br><br>';
	$_POST['email'] = htmlentities($_POST['email']);
	//echo '***<textarea >'.$_POST['email'].'</textarea>***<br><br>';
	
	$original 	= array("&",'"',"@OPERACIONES","$","*","'","/","&nbsp;","&gt;",":","@mail.gmail.com", "@www.ciae","*","mailto:","?","[","]","&gt;",";","www","=","smtp.mail=", "'",'','(',')' ,'"','<','>',' ','','\\','@gamail.com','@gmail,com','@gmail.con','@gamil.com','@gmail.cl','@mail.com','@hotamil.','@lyahoo.','@hotmai.','@hoatmil.','@yaho.','@yaoo.','@hotmaill.',' ',"\r\n","\n\r","\n","\r","\t","  ","&nbsp;",'@ug.uhile.cl','@u.uhile.cl','@uhile.cl','@gmaill.com','@homail.','@hotmeil.','@hitmail.','@gmai.com','@gmail.com.com','@gmal.com','@hutmail.','@homail.','@htmail.','@hormail.','@gmial.com','@hotmaili.','@jahoo.','@gmail,','@gmail.c,','@gmail.,','@uc.c,','@uhile.c,','@hotmal.com');
	$nuevo  	= array(' &', ',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',','@gmail.com','@gmail.com','@gmail.com','@gmail.com','@gmail.com','@gmail.com','@hotmail.','@yahoo.','@hotmail.','@hotmail.','@yahoo.','@yahoo.','@hotmail.',',',',',',',',',',',',',',',",",'@ug.uchile.cl','@u.uhile.cl','@uchile.cl','@gmail.com','@hotmail.','@hotmail.','@hotmail.','@gmail.com','@gmail.com','@gmail.com','@hotmail.','@hotmail.','@hotmail.','@hotmail.','@gmail.com','@hotmail.','@yahoo.','@gmail.com,','@gmail.com,','@gmail.com,','@uc.cl,','@uchile.cl,','@hotmail.com');
	$_POST['email'] = str_replace($original,$nuevo,strip_tags($_POST['email'])); 
	$_POST['email'] = strip_tags($_POST['email']);	
	$_POST['email'] = htmlentities($_POST['email']);
	$_POST['email'] = str_replace($original,$nuevo,strip_tags($_POST['email']));  
	 
	echo $_POST['email'].'<br><br>';
	$aux = explode(',',strtolower($_POST['email'])); 
	
	if(trim($_POST['tipo_base_nueva']) != '')
	{
		$_POST['tipo_base'] = array($_POST['tipo_base_nueva']);
	}
	if(is_array($aux) && count($aux) > 0)
	{ 
		$total = count($aux);
		for($i=0; $i < $total; $i++)
		{			
			$aux[$i] = trim($aux[$i]);
			if(trim($aux[$i]) == '')
			{
				continue;
			}
			$guardar = true;
			$aux2 = explode(" ", $aux[$i] ); 
			if(count($aux2) > 1)
			{
				$guardar = false;
				echo $aux[$i]." no es email\n\n";
			} 
			$aux2 = explode("@", $aux[$i] ); 
			if(count($aux2) != 2)
			{
				$guardar = false;
				echo $aux[$i]." no es email\n\n";
			} 
			if($guardar)
			{
				echo "\n".envioEmail::agregarEmail(trim($aux[$i]),$_POST['nombre'],$_POST['apellidos'],$_POST['tipo_base'],$_POST['institucion'],$_POST['cargo'],$_POST['telefono'],$_POST['actividad'])."\n\n";
			}		
		}
	}
	else
	{	
		echo "\n".envioEmail::agregarEmail(trim($_POST['email']),$_POST['nombre'],$_POST['tipo_base'],$_POST['institucion'])."\n\n";
	} 
	
	envioEmail::inactivarEmailGeneral();
	if(isset($_POST['externo_interno']) && trim($_POST['externo_interno']) == 'ciae_interno')
	{
		echo "<script>window.close();</script>";
	}
}
?>
</pre>