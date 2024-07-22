
{tag_volver}
<div class="fieldset_title">{caso_form} Usuario</div>
	
{mensaje_guardar}



<fieldset> 
	<!-- START BLOCK : fecha_creacion -->
	<div>
		<label>	Fecha Creación Usuario </label><br  />
		{fecha_creacion}
		
	</div>
	<!-- END BLOCK : fecha_creacion -->
	<div>
		<label>	Nombre Usuario </label><br  />
		 <input type="text"   name="nombre" value="{nombre}"  id="nombre_nombre"  maxlength="150" value=""> 
		 	 <a href="javascript:convertirMinusculaInput('nombre','');" id='mayuscula1'><img src="images/iconos/convertir_minuscula.gif" /></a> 
	</div>
	<!-- <div>
		<label>	Apellido Paterno </label><br />	  	
		<input type="text"   name="apellido_paterno"  value="{apellido_paterno}" id="apellido_paterno"  maxlength="150"  value="">  	 <a href="javascript:convertirMinusculaInput('apellido_paterno','');" id='mayuscula2'><img src="images/iconos/convertir_minuscula.gif" /></a>
		    
		
	</div> -->
	<input type="hidden"  name="apellido_paterno" >
	<!-- <div>
		<label>	Apellido Materno</label>  <br  />
		<input type="text"   id="apellido_materno"  value="{apellido_materno}" name="apellido_materno"  maxlength="150"  value="">  
		 <a href="javascript:convertirMinusculaInput('apellido_materno','');" id='mayuscula3'><img src="images/iconos/convertir_minuscula.gif" /></a>
		    
	</div> -->
	<input type="hidden"  name="apellido_materno" >
	<div>
		<label>		E-mail  </label><br  />
		<input type="text"   name="email"  id="email"  value="{email}" maxlength="150" > 
	</div>
	<div>
		<label>	Nombre de usuario </label> <span>(mínimo 6 caracteres)</span><br  />
		<input type="text"   id="new_username" style="width:150px"  name="new_username"  onchange="document.main.cambios_excluyentes.value=1"   maxlength="50"  value="{username}">
		
	</div>
	<div>
		<label>	Clave</label> <span>(mínimo 6 caracteres)</span> <br  /> 
		<input type="password"   name="new_password"  style="width:150px"  onchange="document.main.cambios_excluyentes.value=1"  id="new_password"   maxlength="50"  value="{new_password}"  > (password provisional: {new_password})
		
	</div>
	<div>
	<label>	Confirmaci&oacute;n Clave </label> <span>(mínimo 6 caracteres)</span><br  />
	<input type="password"   name="new_repassword"  value="{new_password}"  style="width:150px" id="new_repassword" maxlength="50"   >
	
	</div> 
	<div id='bloque_estado_activo'>
<label>Activo</label><br />
<input type="radio"  class="inputcheckbox" name="activo" value="1"  onchange="document.main.cambios_excluyentes.value=1" {activo_checked}  />Activo   &nbsp;&nbsp;
<input type="radio"  class="inputcheckbox" name="activo" value="0"  onchange="document.main.cambios_excluyentes.value=1" {no_activo_checked}/>Inactivo
</div>
	
	<div id='bloque_tipo_usuario'>
	<label>Tipo Usuario</label><br />
	
  <!-- START BLOCK : lista_permiso_item -->
  	<input type="radio"  class="inputcheckbox" name='perms' value='{list_item_valor}'   {list_item_checked} >{list_item_texto} <br />
  <!-- END BLOCK : lista_permiso_item -->
	</div>
	<input type="hidden"  name="guardar_valor_sexo" value="M"  >
	<!-- <div>
		<label>		Sexo  </label><br  />
		<input  type="radio" name="guardar_valor_sexo" value="F"  class="inputcheckbox" />Mujer 		<input  name="guardar_valor_sexo" type="radio" value="M" class="inputcheckbox"  />Hombre
		 
		<script>
		var valor_sexo = '{sexo}';
		for (var i=0;i < document.main.guardar_valor_sexo.length;i++)
		{  
		   if (document.main.guardar_valor_sexo[i].value == valor_sexo) 
			 document.main.guardar_valor_sexo[i].checked = true; 
		}	
		</script>
	</div> --> 	
	<input type="hidden"  name="guardar_valor_institucion" value=""  >
	<!-- <div>
		<label>	Institución  </label><br  />
		 
		<input   type="text"  name="guardar_valor_institucion"  id="institucion" value="{institucion}"   maxlength="255" >
		 
	</div>  -->	
		<input type="hidden"  name="guardar_valor_cargo" value=""  >
	
	<!--   <div>
		<label>		Ocupación  </label><br  />
		<select   name="guardar_valor_cargo" >
			<option value="">-----</option>
			<option value="Educador de párvulos en ejercicio">Educador de párvulos en ejercicio</option>
			<option value="Profesor en ejercicio">Profesor en ejercicio</option>
			<option value="Docente de carrera de educación de párvulos">Docente de carrera de educación de párvulos</option> 
			<option value="Otro">Otro</option>  -->
		<!-- START BLOCK : cargo_seleccionada -->
			<!-- <option value="{cargo}" selected="selected">{cargo}</option> -->
		<!-- END BLOCK : cargo_seleccionada -->
			<!-- </select>
		 
	</div>   --> 
	
	<input type="hidden"  name="guardar_valor_profesion" value=""  >
	<!-- <div>
		<label>		Profesión  </label><br  /> 
		<select   name="guardar_valor_profesion"  id="profesion">
			<option value="">-----</option>
			<option value="Estudiante de pedagogía">Estudiante de pedagogía</option>  
			<option value="Estudiante de educación de párvulos">Estudiante de educación de párvulos</option>
			<option value="Educador de párvulos titulado">Educador de párvulos titulado</option>
			<option value="Docente de carrera de educación de párvulos">Docente de carrera de educación de párvulos</option>
			<option value="Educador de párvulos con post titulo">Educador de párvulos con post titulo</option>
			<option value="Magister o doctorado en educación">Magister o doctorado en educación</option>
			<option value="Profesor">Profesor</option>
			<option value="Profesor con post título">Profesor con post título</option>
			<option value="Otro">Otro</option>  -->
		<!-- START BLOCK : profesion_seleccionada -->
			<!-- <option value="{profesion}" selected="selected">{profesion}</option> -->
		<!-- END BLOCK : profesion_seleccionada -->
		<!-- </select> 
	</div>  -->
	<input type="hidden"  name="guardar_valor_cargo_agno" value=""  >
	<!-- <div>
		<label>	Años de experiencia  </label><br  /> 

		<select name="guardar_valor_cargo_agno"  >
			<option value=""></option> 
			<option value="0"> sin experiencia</option>
			<option value="1">entre 1 a 5</option>
			<option value="6">entre 6 a 15</option>
			<option value="15"> más de 15</option>
		</select> 
		 		  
		
		<script>
		var valor_cargo_agno = '{cargo_agno}';
		for (var i=0;i < document.main.guardar_valor_cargo_agno.length;i++)
		{   
		   if (document.main.guardar_valor_cargo_agno[i].value == valor_cargo_agno) 
			{ 
			 document.main.guardar_valor_cargo_agno[i].selected = true; 
			}
		}	
		</script>
	</div>  -->
	 
<input type="hidden"  name="guardar_valor_nivel_conocimiento" value=""  >
		<!-- <div>
		<label>		¿Cómo calificaría su nivel de conocimientos en el tema de Formación de educadores de párvulos? (indique la alternativa correspondiente) </label><span>(*)</span><br  />
		<input  type="radio" name="guardar_valor_nivel_conocimiento" class="inputcheckbox"  value="MA" />Muy Alto 		 <br />
		<input  type="radio" name="guardar_valor_nivel_conocimiento" class="inputcheckbox"  value="A" />Alto 		 <br />
		<input  type="radio" name="guardar_valor_nivel_conocimiento" class="inputcheckbox"  value="M" />Medio 		 <br />
		<input  type="radio" name="guardar_valor_nivel_conocimiento" class="inputcheckbox"  value="B" />Bajo 		 <br />
		<input  type="radio" name="guardar_valor_nivel_conocimiento" class="inputcheckbox"  value="MB" />Muy Bajo 		 <br />
		
		<script>
		var valor_nivel = '{nivel_conocimiento}';
		for (var i=0;i < document.main.guardar_valor_nivel_conocimiento.length;i++)
		{  
		   if (document.main.guardar_valor_nivel_conocimiento[i].value == valor_nivel) 
			 document.main.guardar_valor_nivel_conocimiento[i].checked = true; 
		}	
		</script>
	</div>  -->
	
	
	
	
	
	
 	<button type="button" onClick="javascript:editUser();"><span>Guardar</span></button> 
<button onclick="javascript:process('{opcion_modulo}',0);" type="button" title="Cancelar"><span>Cancelar</span></button> 
  
	
	 	</fieldset>
	 
<input type="hidden" name="cambios_excluyentes" value="0">
<input type="hidden" name="id_item" value="{id_item}">

<script>
<!-- START BLOCK : bloque_nueva_cuenta -->
 hiddenId('bloque_estado_activo');
 hiddenId('bloque_tipo_usuario');
 hiddenId('mayuscula1');
 hiddenId('mayuscula2');
 hiddenId('mayuscula3');
<!-- END BLOCK : bloque_nueva_cuenta -->
function editUser()
{  

	if(isEmpty(document.getElementById('nombre_nombre').value)  )
	{
		alert('El nombre de la persona tener al menos nombre ');
		document.main.nombre_nombre.focus();
		return false;
	} 
	
 	/*if(isEmpty(document.getElementById('email').value) || !checkMail(document.getElementById('email').value))
	{
		alert('La dirección de email debe ser válida');
		document.main.email.focus();
		return false;
	} */
	if(!isEmpty(document.getElementById('new_password').value) || document.main.id_item.value == '')
	{
		if(!checkFormPasswordUser())
			return false;
	}
		
	process('guardar',1);	

}
</script>
{tag_volver}