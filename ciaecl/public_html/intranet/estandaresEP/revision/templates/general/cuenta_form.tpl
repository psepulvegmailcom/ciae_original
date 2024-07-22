<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->   
<!--<div  class="fieldset_title" >Edici�n Datos Usuario</div>-->

<!-- START BLOCK : mensaje_error --><fieldset>

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
		<label>	Nombre  </label><br  />  
		<input type="text"  name="guardar_valor_nombre"  id="nombre" value="{nombre}"   maxlength="255">
	</div>
	<div>
		<label>	Apellido Paterno  </label><br  />  
		<input type="text"  name="guardar_valor_apellido_paterno"  id="apellido_paterno" value="{apellido_paterno}"   maxlength="255">
	</div>
	<div>
		<label>	Apellido Materno  </label><br  />  
		<input type="text"  name="guardar_valor_apellido_materno"  id="apellido_materno" value="{apellido_materno}"   maxlength="255">
	</div>
	 
	 
	<div>
		<label>		E-mail  </label><br  />
		<input type="text"  name="guardar_valor_email"  id="email" value="{email}"   maxlength="255">
		<span>(*)</span>
	</div> 

	<div>
		<label>		Sexo  </label><br  />
		<input  type="radio" name="guardar_valor_sexo" value="F"  class="inputcheckbox" />Mujer 		<input  name="guardar_valor_sexo" type="radio" value="M" class="inputcheckbox"  />Hombre
		<span>(*)</span>
		<script>
		var valor_sexo = '{sexo}';
		for (var i=0;i < document.main.guardar_valor_sexo.length;i++)
		{  
		   if (document.main.guardar_valor_sexo[i].value == valor_sexo) 
			 document.main.guardar_valor_sexo[i].checked = true; 
		}	
		</script>
	</div> 	
	<div>
		<label>Clave</label> 
		<span>(m�nimo 6 caracteres, si no desea cambiarla deje ambos casilleros en blanco)</span> <br  /> 
		<input type="password"   name="new_password"  style="width:150px"  id="new_password"   maxlength="50"   >
		<span>(*)</span>
	</div>
	<div>
	<label>	Confirmaci&oacute;n Clave </label> <span>(m�nimo 6 caracteres)</span><br  />
	<input type="password"   name="new_repassword"  style="width:150px" id="new_repassword" maxlength="50"   >
	<span>(*)</span>
	</div>
	 	<div>
		<label>	Instituci�n  </label><br  />
		 
		<input   type="text"  name="guardar_valor_institucion"  id="institucion" value="{institucion}"   maxlength="255" >
		<span>(*)</span>
	</div> 	
	<div>
		<label>		Ocupaci�n  </label><br  />
		<select   name="guardar_valor_cargo" >
			<option value="">-----</option>
			<option value="Educador de p�rvulos en ejercicio">Educador de p�rvulos en ejercicio</option>
			<option value="Profesor en ejercicio">Profesor en ejercicio</option>
			<option value="Docente de carrera de educaci�n de p�rvulos">Docente de carrera de educaci�n de p�rvulos</option> 
			<option value="Otro">Otro</option> 
		<!-- START BLOCK : cargo_seleccionada -->
			<option value="{cargo}" selected="selected">{cargo}</option>
		<!-- END BLOCK : cargo_seleccionada -->
			</select>
		<span>(*)</span>
	</div> 
	<div>
		<label>		Profesi�n  </label><br  /> 
		<select   name="guardar_valor_profesion"  id="profesion">
			<option value="">-----</option>
			<option value="Estudiante de pedagog�a">Estudiante de pedagog�a</option>  
			<option value="Estudiante de educaci�n de p�rvulos">Estudiante de educaci�n de p�rvulos</option>
			<option value="Educador de p�rvulos titulado">Educador de p�rvulos titulado</option>
			<option value="Docente de carrera de educaci�n de p�rvulos">Docente de carrera de educaci�n de p�rvulos</option>
			<option value="Educador de p�rvulos con post titulo">Educador de p�rvulos con post titulo</option>
			<option value="Magister o doctorado en educaci�n">Magister o doctorado en educaci�n</option>
			<option value="Profesor">Profesor</option>
			<option value="Profesor con post t�tulo">Profesor con post t�tulo</option>
			<option value="Otro">Otro</option> 
		<!-- START BLOCK : profesion_seleccionada -->
			<option value="{profesion}" selected="selected">{profesion}</option>
		<!-- END BLOCK : profesion_seleccionada -->
		</select>
		<span>(*)</span>
	</div> 
	<div>
		<label>	A�os de experiencia  </label><br  /> 

		<select name="guardar_valor_cargo_agno"  >
			<option value=""></option> 
			<option value="0"> sin experiencia</option>
			<option value="1">entre 1 a 5</option>
			<option value="6">entre 6 a 15</option>
			<option value="15"> m�s de 15</option>
		</select> 
		 		 
		<span>(*)</span>
		
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
	</div> 
	 

		<div>
		<label>		�C�mo calificar�a su nivel de conocimientos en el tema de Formaci�n de educadores de p�rvulos? (indique la alternativa correspondiente) </label><span>(*)</span><br  />
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
	</div> 
	 


	 	</fieldset>
	
<center>
<button type="button" onClick="javascript:editUser();"><span>Guardar</span></button> 
</center>

<br><br>
 <input name="guardar_valor_completa" type="hidden" value="0" />


<script>
function editUser()
{ 
	/* NIVEL DE CONOCIMIENTO */
	var valor_nivel_conocimiento = '';
    for (var i=0;i<document.main.guardar_valor_nivel_conocimiento.length;i++){ 
       if (document.main.guardar_valor_nivel_conocimiento[i].checked) 
          valor_nivel_conocimiento = document.main.guardar_valor_nivel_conocimiento[i].value; 
    }	
	if(valor_nivel_conocimiento == '')
	{
		alert('Debe indicar su calificaci�n respecto al nivel de conocimientos'); 
		return false;
	}
	
	/* SEXO */	
	var valor_sexo = '';
    for (var i=0;i < document.main.guardar_valor_sexo.length;i++)
	{  
       if (document.main.guardar_valor_sexo[i].checked) 
          valor_sexo = document.main.guardar_valor_sexo[i].value; 
    }	
	if(valor_sexo == '')
	{
		alert('Debe indicar cu�l es su g�nero'); 
		return false;
	}	
	
	if(isEmpty(document.main.guardar_valor_institucion.value)  )
	{
		alert('La instituci�n debe ingresarse de manera completa');
		document.main.guardar_valor_institucion.focus();
		return false;
	} 
	
	if(isEmpty(document.main.guardar_valor_cargo.value)  )
	{
		alert('Debe seleccionar una ocupaci�n');
		document.main.guardar_valor_cargo.focus();
		return false;
	} 
	if(isEmpty(document.main.guardar_valor_profesion.value)  )
	{
		alert('Debe seleccionar una profesi�n');
		document.main.guardar_valor_profesion.focus();
		return false;
	} 
	
	if(document.main.guardar_valor_cargo_agno.value == '')
	{
		alert('Debe indicar la experiencia');
		document.main.guardar_valor_cargo_agno.focus();
		return false;
	} 
	 
	if(isEmpty(document.getElementById('email').value) || !checkMail(document.getElementById('email').value))
	{
		alert('La direcci�n de email debe ser v�lida');
		document.main.email.focus();
		return false;
	}  
	
	if(isEmpty(document.getElementById('apellido_paterno').value)|| isEmpty(document.getElementById('nombre').value))
	{
		alert('Debe ingresar su nombre'); 
		return false;
	} 
	
	if(!isEmpty(document.getElementById('new_password').value))
	{
		if(!checkFormPasswordUser())
			return false;
	}	
	document.main.guardar_valor_completa.value = 1; 
	process('guardar_datos',1);	

}
</script>
<!-- INCLUDE BLOCK : ../templates/encuesta/barra_superior.tpl -->