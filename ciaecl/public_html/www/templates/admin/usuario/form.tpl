
{tag_volver}
<div class="fieldset_title">{caso_form} Usuario</div>
	
{mensaje_guardar}



<fieldset> 
	<!-- START BLOCK : fecha_creacion -->
	<div>
		<label>	Fecha Creaci&oacute;n Usuario </label><br  />
		{fecha_creacion}
		
	</div>
	<!-- END BLOCK : fecha_creacion -->
	<div>
		<label>	Nombre </label><br  />
		 <input type="text"   name="nombre" value="{nombre}"  id="nombre_nombre"  maxlength="150" value=""> 
		 	 <a href="javascript:convertirMinusculaInput('nombre','');"><img src="cea/images/iconos/convertir_minuscula.gif" /></a>
		    
		
	</div>
	<div>
		<label>	Apellido Paterno </label><br />	  	
		<input type="text"   name="apellido_paterno"  value="{apellido_paterno}" id="apellido_paterno"  maxlength="150"  value="">  	 <a href="javascript:convertirMinusculaInput('apellido_paterno','');"><img src="cea/images/iconos/convertir_minuscula.gif" /></a>
		    
		
	</div>
	<div>
		<label>	Apellido Materno</label>  <br  />
		<input type="text"   id="apellido_materno"  value="{apellido_materno}" name="apellido_materno"  maxlength="150"  value="">  
		 <a href="javascript:convertirMinusculaInput('apellido_materno','');"><img src="cea/images/iconos/convertir_minuscula.gif" /></a>
		    
	</div>
	<div>
		<label>		E-mail  </label><br  />
		<input type="text"   name="email"  id="email"  value="{email}" maxlength="150" >
		
	</div>
	<div>
		<label>	Nombre de usuario </label> <span>(m&iacute;nimo 6 caracteres)</span><br  />
		<input type="text"   id="new_username" style="width:150px"  name="new_username"  onchange="document.main.cambios_excluyentes.value=1"   maxlength="50"  value="{username}">
		
	</div>
	<div>
		<label>	Clave</label> <span>(m&iacute;nimo 6 caracteres)</span> <br  /> 
		<input type="password"   name="new_password"  style="width:150px"  onchange="document.main.cambios_excluyentes.value=1"  id="new_password"   maxlength="50"  value="{new_password}"  > ({new_password})
		
	</div>
	<div>
	<label>	Confirmaci&oacute;n Clave </label> <span>(m&iacute;nimo 6 caracteres)</span><br  />
	<input type="password"   name="new_repassword"  value="{new_password}"  style="width:150px" id="new_repassword" maxlength="50"   >
	
	</div> 
	<div>
<label>Activo</label><br />
<input type="radio"  class="inputcheckbox" name="activo" value="1"  onchange="document.main.cambios_excluyentes.value=1" {activo_checked}  />Activo   &nbsp;&nbsp;
<input type="radio"  class="inputcheckbox" name="activo" value="0"  onchange="document.main.cambios_excluyentes.value=1" {no_activo_checked}/>Inactivo
</div>
	
	<div>
	<label>Tipo Usuario</label><br />
	
  <!-- START BLOCK : lista_permiso_item -->
  	<input type="radio"  class="inputcheckbox" name='perms' value='{list_item_valor}'   {list_item_checked} >{list_item_texto} <br />
  <!-- END BLOCK : lista_permiso_item -->
	</div>
 	<button type="button" onClick="javascript:editUser();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
	 
<input type="hidden" name="cambios_excluyentes" value="0">
<input type="hidden" name="id_item" value="{id_item}">

<script type="text/javascript">

function editUser()
{  

	if(isEmpty(document.getElementById('nombre_nombre').value) || isEmpty(document.getElementById('apellido_paterno').value))
	{
		alert('El nombre de la persona tener al menos nombre y apellido paterno');
		document.main.nombre_nombre.focus();
		return false;
	} 
	
	if(isEmpty(document.getElementById('email').value) || !checkMail(document.getElementById('email').value))
	{
		alert('La direcci&oacute;n de email debe ser v&aacute;lida');
		document.main.email.focus();
		return false;
	}
	if(!isEmpty(document.getElementById('new_password').value) || document.main.id_item.value == '')
	{
		if(!checkFormPasswordUser())
			return false;
	}
		
	process('guardar',1);	

}
</script>
{tag_volver}