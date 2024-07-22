<div style="float:right">	<a href="javascript:process('home',0)" >&lt;&lt; Volver</a></div><br /><br />



<!-- START BLOCK : envio_noacceso -->
<p> 
Se envi&oacute; a su cuenta de correo   <strong>{email} </strong> los datos de ingreso y una nueva password.<br />
 Este email le permitir&aacute; recuperar sus datos de usuario en caso de olvido, <strong>NO LO BORRE</strong>.  </p>
<br />Si su problema continua no dude en ponerse en contacto con nosotros 
<br /><br />Centro de Contactos ATE 
<!-- END BLOCK : envio_noacceso -->
<!-- START BLOCK : noimgenvio_noacceso -->
<p> 
<strong> El c&oacute;digo de seguridad no coincide, int&eacute;ntelo nuevamente</strong>  </p>
<br /> 
<!-- END BLOCK : noimgenvio_noacceso -->
<!-- START BLOCK : noenvio_noacceso -->
<p> 
<strong> El correo electr&Oacute;nico  {email}   no existe en nuestro registros, Por favor int&eacute;ntelo nuevamente</strong>  </p>
<br /> 
<!-- END BLOCK : noenvio_noacceso -->
<!-- START BLOCK : formulario_noacceso -->
<p>Por favor, vaya a su cuenta de correo electr&oacute;nico y verifique, tanto en su  bandeja de entrada como en el correo no deseado, que ha recibido el mail de  respaldo enviado por el Centro de contactos ATE. Este correo se gener&oacute;  autom&aacute;ticamente en el momento en que Usted cre&oacute; un &ldquo;nuevo usuario&rdquo; en la p&aacute;gina  web <a href="http://www.registroate.cl">www.registroate.cl</a> y proporciona la  informaci&oacute;n que usted necesita para entrar como &ldquo;usuario registrado&rdquo; al sitio web  del &ldquo;Registro Nacional de Asistencia T&eacute;cnica Educativa&rdquo;.</p>
<br />
 
  <p>Si  Usted no tiene este correo de respaldo seleccione la opci&oacute;n que corresponda a  su situaci&oacute;n.<br /><br />
    <strong>Usted no puede acceder a su cuenta porque:</strong></p>
  <br />
<ol>
  <li><strong>Ha  olvidado su clave y/o su nombre de usuario, pero sabe la direcci&oacute;n de correo  electr&oacute;nico con la cual se registr&oacute;:</strong></li><br />
Ingrese su correo electr&Oacute;nico <input type="text" name="email_recover" id="email_recover"  value="{email}" style="width:30%">
<br  /> 	C&oacute;digo de Seguridad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text"   name="new_captcha"  style="width:100px" id="new_captcha" maxlength="5"   ><img id="imgCaptcha" src="scripts/captcha.php" width="65px" /> (digite el c&Oacute;digo que visualiza en la imagen)  <br  />
 <button type="button" onClick="javascript:sendEmail()"><span><big>Enviar</big></span></button> 
<p>El sistema  generar&aacute; autom&aacute;ticamente un mail con su nombre de usuario y su nueva clave.  Este correo se enviar&aacute; al correo electr&oacute;nico indicado y es el &uacute;nico respaldo  que tendr&aacute; de esta informaci&oacute;n <strong>NO LO BORRE</strong>. Si Usted  lo estima conveniente, podr&aacute; modificar esta nueva clave al ingresar nuevamente  al sistema. </p><br /> 
 
   
 
  <li><strong>Ha olvidado su nombre de usuario y su clave,  y no sabe cu&aacute;l es el mail que se&ntilde;al&oacute; en su registro:</strong> </li>

<p>Lamentablemente  no nos es posible recuperar sus datos y usted deber&aacute; registrarse como <a href="javascript:ate_ir_registro();">&ldquo;Nuevo Usuario&rdquo;</a>. Recuerde que deber&aacute;  ingresar un mail distinto del que utiliz&oacute; en su primer registro, pues el mail  que usted ingres&oacute; la primera vez ya se encuentra en el sistema y no se admiten  repeticiones de este tipo. Este procedimiento significa que, si usted ya hab&iacute;a  ingresado informaci&oacute;n anteriormente, &eacute;sta se perder&aacute;.<br />
  <br />
Recuerde que al crear un &ldquo;Nuevo Usuario&rdquo; el sistema genera autom&aacute;ticamente un  mail de respaldo con su nombre de usuario y su clave. Este correo se enviar&aacute; al  mail que usted ha se&ntilde;alado en su registro y es el &uacute;nico respaldo que tendr&aacute; de  esta informaci&oacute;n <strong>NO LO BORRE</strong>. Si no recibe este  correo en su bandeja de entrada, recuerde revisar su bandeja de correo no  deseado. </p>
</ol>


<script type="text/javascript">

function sendEmail()
{ 
	if(isEmpty(document.getElementById('email_recover').value) )
	{
		alert('Debe ingresar una una direcci&Oacute;n de email'); 
		document.main.email_recover.focus();
		return false;	
	}
	else
		if(!checkMail(document.getElementById('email_recover').value))
		{
			alert('La direcci&Oacute;n de email debe ser v&aacute;lida');
			document.main.email_recover.focus();
			return false;
		} 	
	
	if(isEmpty(document.getElementById('new_captcha').value))
	{
		alert('Debe ingresar el c&Oacute;digo de seguridad');
		document.main.new_captcha.focus();
		return false;
	}	
	process('envio_email',1);

}
</script>

<!-- END BLOCK : formulario_noacceso -->

