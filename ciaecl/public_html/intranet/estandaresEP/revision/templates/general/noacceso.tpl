<div style="float:right">	<a href="javascript:process('home',0)" >&lt;&lt; Volver</a></div><br /><br />


 
<!-- START BLOCK : envio_noacceso -->
<p> 
Se envi&oacute; a su cuenta de correo   <strong>{email} </strong> los datos de ingreso y una nueva password.<br>
 Este email le permitir&aacute; recuperar sus datos de usuario en caso de olvido, <strong>NO LO BORRE</strong>.  </p>
<br>Si su problema continua no dude en ponerse en contacto con nosotros 
<br><br> 
<!-- END BLOCK : envio_noacceso -->
<!-- START BLOCK : noimgenvio_noacceso -->
<p> 
<strong> El c&oacute;digo de seguridad no coincide, int&eacute;ntelo nuevamente</strong>  </p>
<br> 
<!-- END BLOCK : noimgenvio_noacceso -->
<!-- START BLOCK : noenvio_noacceso -->
<p> 
<strong> El correo electrónico  {email}   no existe en nuestro registros, Por favor inténtelo nuevamente</strong>  </p>
<br> 
<!-- END BLOCK : noenvio_noacceso -->
<!-- START BLOCK : formulario_noacceso -->
 <br>
 
   
    <strong>Usted no puede acceder a su cuenta porque:</strong></p>
  <br> <strong>Ha  olvidado su clave y/o su nombre de usuario, pero sabe la direcci&oacute;n de correo  electr&oacute;nico con la cual se registr&oacute;:</strong></li><br>
Ingrese su correo electrónico <input type="text" name="email_recover" id="email_recover"  value="{email}" style="width:30%">
<br  /> 	C&oacute;digo de Seguridad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text"   name="new_captcha"  style="width:100px" id="new_captcha" maxlength="5"   ><img id="imgCaptcha" src="scripts/captcha.php" width="65px" /> (digite el código que visualiza en la imagen)  <br  />
 <button type="button" onClick="javascript:sendEmail()"><span><big>Enviar</big></span></button> 
<p>El sistema  generar&aacute; autom&aacute;ticamente un mail con su nombre de usuario y su nueva clave.  Este correo se enviar&aacute; al correo electr&oacute;nico indicado y es el &uacute;nico respaldo  que tendr&aacute; de esta informaci&oacute;n <strong>NO LO BORRE</strong>. Si Usted  lo estima conveniente, podr&aacute; modificar esta nueva clave al ingresar nuevamente  al sistema. </p><br> 
 
   
  


<script>

function sendEmail()
{ 
	if(isEmpty(document.getElementById('email_recover').value) )
	{
		alert('Debe ingresar una una dirección de email'); 
		document.main.email_recover.focus();
		return false;	
	}
	else
		if(!checkMail(document.getElementById('email_recover').value))
		{
			alert('La dirección de email debe ser válida');
			document.main.email_recover.focus();
			return false;
		} 	
	
	if(isEmpty(document.getElementById('new_captcha').value))
	{
		alert('Debe ingresar el código de seguridad');
		document.main.new_captcha.focus();
		return false;
	}	
	process('envio_email',1);

}
</script>

<!-- END BLOCK : formulario_noacceso -->

