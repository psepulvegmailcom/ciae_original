 
<strong>Estimado/a usuario/a:</strong><br  />
Para acceder a los formularios de inscripci&oacute;n al {nombre_sistema} {sigla_sistema}, es necesario que se registre como nuevo usuario.
Este paso lo realizará solo una vez<br  />
<!--
<br />
Aqu&iacute; encontrar&aacute; orientaciones para registrar su oferta de asistencia t&eacute;cnica y asesor&iacute;as. Desc&aacute;rguelo y l&eacute;alo atentamente. <a  class="link_simple" href="download.php?caso=general&file=manual_usuario.pdf" target="_blank">Descargar Documento</a> <br />

Aun as&iacute;, durante el proceso de registro se encuentra con nuevas dudas y dificultades, usted cuenta con el soporte de un equipo de profesionales en l&iacute;nea, escr&iacute;banos: <a class="link_simple" href="mailto:{tpl_email_contacto}">Aquí</a> 


<br />
<br />
-->





<div  class="fieldset_title" >Términos y Condiciones</div>
{condiciones_form}
<div> 



<br />
<input type="checkbox"  class="inputcheckbox" name="reglas_ok" alue='1' > He le&iacute;do, comprendido y aceptado los t&eacute;rminos y condiciones  generales de inscripci&oacute;n en el Registro de Asistencia T&eacute;cnica Educativa ATE. (*)<br />
	</div>
<div  class="fieldset_title" >Formulario de Registro para Nuevos Usuarios</div>




<fieldset>
	<div>(*) Campos Obligatorios<br  /> </div>
	<div>
		<label>	Nombre </label><br  />
		<input type="text"   name="nombre_nombre"  id="nombre_nombre"  maxlength="150" value="">
		<span>(*)</span>
	</div>
	<div>
		<label>	Apellido Paterno </label><br />	  	
		<input type="text"   name="apellido_paterno"  id="apellido_paterno"  maxlength="150"  value="">	
		<span>(*)</span>
	</div>
	<div>
		<label>	Apellido Materno</label>  <br  />
		<input type="text"   id="apellido_materno"  name="apellido_materno"  maxlength="150"  value="">
		<span>(*)</span>
	</div>
	<div>
		<label>		E-mail  </label><br  />
		<input type="text"   name="email"  id="email" value="" maxlength="150" >
		<span>(*)</span>
	</div>
	<div>
		<label>	Nombre de usuario </label> <span>(mínimo 6 caracteres)</span><br  />
		<input type="text"   id="new_username" style="width:150px"  name="new_username"  maxlength="50"  value="">
		<span>(*)</span>
	</div>
	<div>
		<label>	Clave</label> <span>(mínimo 6 caracteres)</span> <br  /> 
		<input type="password"   name="new_password"  style="width:150px"  id="new_password"   maxlength="50"   >
		<span>(*)</span>
	</div>
	<div>
	<label>	Confirmaci&oacute;n Clave </label> <span>(mínimo 6 caracteres)</span><br  />
	<input type="password"   name="new_repassword"  style="width:150px" id="new_repassword" maxlength="50"   >
	<span>(*)</span>
	</div>
	<div>
	<label>		Tipo Oferente  </label><br  />	
		<select name="tipo_registro" id="tipo_registro">
		<option value="">Seleccione Tipo de Oferente</option>
		<!-- START BLOCK : select_tipooferente -->
		<option value="{select_tipooferente_id}" >{select_tipooferente_tipo}</option>
		<!-- END BLOCK : select_tipooferente -->
		</select>
		<span>(*)</span>
	 </div>

	<div>
	<label>	C&oacute;digo de Seguridad  </label><br  /><span>(digite el código que visualiza en la imagen)</span><br  />
	<input type="text"   name="new_captcha"  style="width:100px" id="new_captcha" maxlength="5"   ><img id="imgCaptcha" src="scripts/captcha.php" width="65px" />
	<span>(*)</span>
	</div>	 
	
	 	</fieldset>
	<center>
<button type="button" onClick="javascript:ate_checkFormNewUser();"><span>Registrar Nuevo Usuario</span></button> 
</center>