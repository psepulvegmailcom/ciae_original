   
<div  class="fieldset_title" >Edici&Oacute;n Datos Usuario</div>

<!-- START BLOCK : mensaje_error -->
<fieldset>

<ul> 
<li><strong>El email esta siendo utilizado por otro usuario, no se pudo modificar </strong></li> 
</ul>
</fieldset>

<!-- END BLOCK : mensaje_error -->
<!-- START BLOCK : mensaje_exito -->
<fieldset>

<ul> 
<li><strong>Sus datos fueron modificados exitosamente </strong></li> 
</ul>
</fieldset>

<!-- END BLOCK : mensaje_exito -->
<fieldset>
	<div>(*) Campos Obligatorios<br  /> </div>	
	<div>
		<label>	Nombre Usuario </label><br  />
		{username} 
		
		<input type="hidden"   id="new_username"   name="new_username"  value="{username}">
	</div>
	<div>
		<label>	Nombre </label><br  />
		<input type="text"   name="nombre_nombre"  id="nombre_nombre"   maxlength="150" value="{nombre}">
		<span>(*)</span>
	</div>
	<div>
		<label>	Apellido Paterno </label><br />	  	
		<input type="text"   name="apellido_paterno"  id="apellido_paterno"  maxlength="150"  value="{apellido_paterno}">	
		<span>(*)</span>
	</div>
	<div>
		<label>	Apellido Materno</label>  <br  />
		<input type="text"   id="apellido_materno"  name="apellido_materno"  maxlength="150"  value="{apellido_materno}">
		<span>(*)</span>
	</div>
	<div>
		<label>		E-mail  </label><br  />
		<input type="text"   name="email"  id="email" value="{email}" maxlength="150" >
		<span>(*)</span>
	</div> 
	<div>
		<label>Clave</label> 
		<span>(m&iacute;nimo 6 caracteres, si no desea cambiarla reingrese su clave actual)</span> <br  /> 
		<input type="password"   name="new_password"  style="width:150px"  id="new_password"   maxlength="50"   >
		<span>(*)</span>
	</div>
	<div>
	<label>	Confirmaci&oacute;n Clave </label> <span>(m&iacute;nimo 6 caracteres)</span><br  />
	<input type="password"   name="new_repassword"  style="width:150px" id="new_repassword" maxlength="50"   >
	<span>(*)</span>
	</div>
	 

	 	</fieldset>
	<center>
<button type="button" onClick="javascript:editUser();"><span>Guardar</span></button> 
</center>

<script type="text/javascript">
function editUser()
{
	if(isEmpty(document.getElementById('nombre_nombre').value) || isEmpty(document.getElementById('apellido_paterno').value) || isEmpty(document.getElementById('apellido_materno').value))
	{
		alert('El nombre de la persona debe ingresarse de manera completa');
		document.main.nombre_nombre.focus();
		return false;
	} 
	
	if(isEmpty(document.getElementById('email').value) || !checkMail(document.getElementById('email').value))
	{
		alert('La direcci&Oacute;n de email debe ser v&aacute;lida');
		document.main.email.focus();
		return false;
	}

	if(!checkFormPasswordUser())
		return false;
		
	process('guardar_datos',1);	

}
</script>