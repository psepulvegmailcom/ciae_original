<?php 

// Start the session
$_GET['u'] = "e889760b9a85dc871b2052565fd1147c";
session_start();

include('email_conexion.php');
$mostrar_formulario = true;
$mensaje_formulario = "Si Usted desea cancelar su suscripci&oacute;n, ingrese su correo electr&oacute;nico";


if(trim($_GET['email']) != '' && (trim($_GET['ie']) == md5(trim($_GET['email'])) || trim($_GET['ie']) == trim($_GET['email'])))
{
	$_POST['email'] 		= SIDTOOLPost::cleanSqlInjection($_GET['email']);
	$_POST['imagen_text']   = 'ingreso_previo';
	 
}

if(count($_POST) > 0)
{
	$envio_post = true;
//	print_r($_POST); 
//	print_r($_SESSION);
	
	$_POST['email'] 		= SIDTOOLPost::cleanSqlInjection($_POST['email']);	
	 
	$_POST['imagen_text'] 	= SIDTOOLPost::cleanSqlInjection($_POST['imagen_text']);	
	 
	if(trim($_POST['imagen_text']) == trim($_SESSION['digit']) || $_POST['imagen_text']   == 'ingreso_previo'  )
	{
		$error_captcha = false;
		$mostrar_formulario = false;
		$mensaje_formulario = "El correo electr&oacute;nico <b>".$_POST['email']."</b> fue eliminado de nuestra base de datos. <br> <br>";
		$salida = envioEmail::consultarEmailCompleto($_POST['email']);
		 
		$listado = $salida[1];
		//print_r($listado);
		if(is_array($listado) && count($listado) >= 1)
		{ 
			if($salida[0][0]['estado'] == 'inactivo')
			{
				$mensaje_formulario = "El correo electr&oacute;nico <b>".$_POST['email']."</b> ya fue eliminado anteriormente de nuestra base de datos. <br><br>Si sigue recibiendo correos nuestro, es posible que se encuentre inscrito en alguna lista de correos externa.<br><br> Disculpe las molestias. <br>";
				
				$update = "email = '".$_POST['email']."'";			
				envioEmail::inactivarEmail($update,'Inactivacion por eliminacion de suscripcion'); 
			}
			else
			{	
				$update = "email = '".$_POST['email']."'";			
				envioEmail::inactivarEmail($update,'Inactivacion por eliminacion de suscripcion'); 
			} 
		}
		else
		{
			$mensaje_formulario = "El correo electr&oacute;nico <b>".$_POST['email']."</b> NO existe en nuestra base de datos por lo que no puede ser eliminado. <br>";
		}   
	}
	else
	{			 
		$mensaje_formulario = "<b style='color:#C41F22'>El texto de la imagen no corresponde, por favor ingr&eacute;selo nuevamente.</b>  <br>";
	} 
} 
?><head>
<title>Eliminar Suscripci&oacute;n</title>
<link href="../www/style/estilos_ciae3.css" rel="stylesheet" type="text/css" />
</head>
 
<style>
 body{ 
 
font-size:14px;
line-height:113%;
font-family:"Lucida Sans Unicode";
 }
</style>
<body style="text-align:center ">

<table border="0" style="width:100% ">
 <tr><td colspan="3">&nbsp;</td></tr>
  <tr>
 <td style="width:25% "></td>
  <td style=" width:800px ">
<table cellpadding="0" cellspacing="0" style="width:600px ">
  <tr>
    <td   style="width:800px " >
	 <a href="https://www.ciae.uchile.cl/index.php?langSite=es"  style=" border-bottom:none;" >
	<img src="https://www.ciae.uchile.cl/www/images_new/logo-ciae.png" alt="Logo IE-CIAE Universidad de Chile" border="0" width="90%"  > </a>
	<br><br>
	 </td>
	</tr>
	<tr> 
	<td> 
          </td>
        </tr> 
	 <tr>
	 <td   style="width:800px; font-size:12px; vertical-align:bottom ">
	 <form name="main" action="eliminarSuscripcion.php" method="post">
	  <p style="font-size:14px; font-family:"Lucida Sans Unicode";"><?php echo $mensaje_formulario; ?></p>
	 <?php
	 if(!$mostrar_formulario)
	 {?>
		<p><a href="eliminarSuscripcion.php"> Volver a formulario</a></p>
	<?}
	else
	{?>
	    
     
     
    <strong> Correo electr&oacute;nico:</strong> <input  type="text" maxlength="200"  value='<?php echo $_POST['email']; ?>' name="email" style="width:300px"><br><br>
     
     <strong>Escriba el texto:</strong> <img src="../captcha.php" > <input  type="text" maxlength="10" name="imagen_text"    style="width:100px"><br><br>
     <input type="submit" name="enviar"  value="Enviar">	
	<?}?> 
     </form>
     
     <p></p>
 
 
 
         </td>
          </tr>
      </table></td>
  </tr>
</table>
</td>
 <td style="width:25% "></td>
 </tr>
 <tr><td colspan="3" style="text-align:center ">

   </td></tr>

 <td>&nbsp;</td></tr>
 
 
 
 
 
</table> 
<!--pie-->
<P>En caso de consulta favor escr&iacute;banos a <a href="mailto:desuscribir_correo@ciae.uchile.cl?subject=Desubcripcion correo">desuscribir_correo@ciae.uchile.cl</a></P>

</body>

 