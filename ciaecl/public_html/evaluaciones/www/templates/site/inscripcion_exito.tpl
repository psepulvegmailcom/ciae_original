 
 <input type="hidden" name="enviandodatos"  value=''>

<!-- START BLOCK : bloque_envio_exito -->
<center id='mensaje_exito'><big><strong>Su registro se realizó exitosamente. 
<br><br> 

    Por favor le solicitamos confirmar su asistencia, indicándonos las sesiones a las cuales tiene intención de asistir <a href="index.php?page=view_confirmacion">AQUÍ</a> 
</strong></big></center><br><br> <br><br> <br><br> 
<script>
hidetr('fila_email');  
</script>
<!-- END BLOCK : bloque_envio_exito -->


 
  
 
<!-- START BLOCK : bloque_envio_error -->
<center><big><strong style="color:#FF0000; font-size:110%"> {mensaje_error}</strong></big></center><br><br> 
<script>
hiddenId('mensaje_exito');
</script>
<!-- END BLOCK : bloque_envio_error -->

<table width="95%" border="0" cellpadding="3">
 
   <!-- START BLOCK : bloque_persona_registrada -->
  
    <tr id='fila_nombre_registro2'>
    <td  colspan=" " >&nbsp;</td>
    <td  colspan=" " ><strong>Ud ya se encuentra inscrito</strong></td>
  </tr> 
    <tr id='fila_nombre_registro'>
    <td style=" width:30%"><strong>Nombre</strong>   </td>
    <td style="width:70%">        {nombre} {apellidos}   </td>
  </tr> 
    <tr id='fila_nombre_registro3'>
    <td  ><strong>Email</strong>   </td>
    <td  >        {email}   </td>
  </tr> 
    <tr id='fila_nombre_registro2'>
    <td  colspan="2" >&nbsp;</td>
  </tr>  
      <tr id='fila_nombre_registro2'>
    <td  colspan="2" ><strong>Por favor le solicitamos confirmar su asistencia, indicándonos las sesiones a las cuales tiene intención de asistir <a href="index.php?page=view_confirmacion">AQUÍ</a></strong></td>
  </tr> 
      <tr id='fila_nombre_registro2'>
    <td  colspan="2" >&nbsp;</td>
  </tr> 
  <!-- END BLOCK : bloque_persona_registrada -->


<!-- START BLOCK : bloque_inscripcion_instruccion -->
   <tr><td colspan="2">
   <!-- INCLUDE BLOCK : www/templates/site/inscripcion_instruccion.tpl -->
   </td></tr>
      <tr><td colspan="2">&nbsp;   </td></tr>
	  <!-- END BLOCK : bloque_inscripcion_instruccion -->
	  
	  
	  
  <!-- START BLOCK : bloque_envio_archivo -->
  <!-- INCLUDE BLOCK : www/templates/site/inscripcion_envio.tpl -->
  <!-- END BLOCK : bloque_envio_archivo -->
   

   
  <tr id='fila_email'>
    <td style=" width:30%"><strong>Ingrese su dirección de correo electrónico</strong>   </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();">    </td>
  </tr> 
   
  <tr id='fila_1'>
    <td>Nombre (*) </td>
    <td>
        <input type="text" name="form_nombre" style="width:100%" value="{nombre}" maxlength="255"></td>
  </tr>
  <tr  id='fila_2'>
    <td>Apellidos (*) </td>
    <td>
        <input type="text" name="form_apellidos" value="{apellidos}" style="width:100%" maxlength="255"></td>
  </tr>
   <tr  id='fila_3'>
  <td>Cargo/Rol (*)</td>
  <td>
        <input type="text" name="form_rol" value="{rol}" style="width:100%" maxlength="255"></td></tr>
  
  <tr id='fila_4'>
    <td>Instituci&oacute;n (*) </td>
    <td>
        <input type="text" name="form_institucion"  value="{institucion}" style="width:100%" maxlength="255"></td>
  </tr>
    <tr  id='fila_5'>
    <td>Tel&eacute;fono </td>
    <td><input type="text" name="form_telefono"  value="{telefono}" style="width:100%" maxlength="50"></td>
  </tr>
  <tr  id='fila_6'>
    <td>Direcci&oacute;n</td>
    <td><textarea  name="form_direccion"  style="width:100%">{direccion}</textarea></td>
  </tr>
  <tr  id='fila_7'>
  <td>Ciudad (*)</td>
  <td>
        <input type="text" name="form_ciudad" style="width:100%" value="{ciudad}"  maxlength="255"></td></tr>
  <tr  id='fila_8'>
    <td>Pa&iacute;s (*)</td>
    <td>
        <select    name="form_pais" tabindex="7" style="width:100%"  >
 
 
 
<!-- START BLOCK : bloque_inscripcion_pais --> 
<option value="{valor}"   >	{texto}   </option>
<!-- END BLOCK : bloque_inscripcion_pais --> 
</select></td>
  </tr>
  
 
  
  
  <tr id='fila_9'>
  <td>Disciplinas (*)</td>
  <td>
        
		
		
	 
<!-- START BLOCK : bloque_inscripcion_disciplina -->
<input type="checkbox" name="form_disciplina[]"  value="{valor}"  {checked}>	{texto}   <br />
<!-- END BLOCK : bloque_inscripcion_disciplina -->
 
<br>
Otra : <input type="text" name="form_otra_disciplina" value="{otra_disciplina}" style="width:100%" maxlength="255">		</td></tr>
		
		
  <tr  id='fila_10'>
  <td>Áreas de Interés (*)</td>
  <td> 
<!-- START BLOCK : bloque_inscripcion_areas --> 
<input type="checkbox" name="form_areas[]"  value="{valor}"  {checked}>	{texto}  <br />
<!-- END BLOCK : bloque_inscripcion_areas --> </td></tr>
  
   
  
 
  <tr  id='fila_11'>
    <td>Comentario</td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
  
  

  <tr  id='fila_12'>
    <td>&nbsp;</td>
    <td>(*) datos obligatorios</td>
  </tr>

  
  <tr id='fila_boton'>
    <td colspan="2" align="center"> 
	<input type="hidden" value="view_inscripcion"  name="opcion" />
	<button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarInscripcion();" id="submit-submit_enviar">
  Aceptar</button> </td>
  </tr>
  
</table>

<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">
<input type="hidden" name="mostrar" value="{mostrardatos}">

<script>
 
	 function enviarInscripcion()
	 {
		if(document.main.form_email.value == '')
		{
			alert('Debe ingresar email');
			document.main.form_email.focus();
			return false;
		}
		else
		{
			if(!checkMail(document.main.form_email.value))
			{
				alert('Debe ingresar email con formato correcto');
				document.main.form_email.focus();
				return false;
			}
		}		
		if(document.main.mostrar.value == 'mostrardatos')
		{
			if(document.main.form_nombre.value == '')
			{
				alert('Debe ingresar nombre');
				document.main.form_nombre.focus();
				return false;
			}
			if(document.main.form_apellidos.value == '')
			{
				alert('Debe ingresar apellidos');
				document.main.form_apellidos.focus();
				return false;
			}
			if(document.main.form_institucion.value == '')
			{
				alert('Debe ingresar institucion');
				document.main.form_institucion.focus();
				return false;
			}
			if(document.main.form_ciudad.value == '')
			{
				alert('Debe ingresar ciudad');
				document.main.form_ciudad.focus();
				return false;
			}
			if(document.main.form_pais.value == '')
			{
				alert('Debe ingresar pais');
				document.main.form_pais.focus();
				return false;
			}
			if(document.main.form_rol.value == '')
			{
				alert('Debe ingresar cargo/rol');
				document.main.form_rol.focus();
				return false;
			} 
			/*if(document.main.form_clave.value == '')
			{
				alert('Debe ingresar clave');
				document.main.form_clave.focus();
				return false;
			} */ 
			if(!emptyCheck('form_areas[]'))
			{
				alert('Debe seleccionar al menos un area de interes'); 
				return false;
			}
			if(!emptyCheck('form_disciplina[]') && document.main.form_otra_disciplina.value == '')
			{
				alert('Debe seleccionar al menos una disciplina'); 
				return false;
			}
			if(document.main.enviandodatos.value == 'enviandodatos')
			{
				if(!emptyCheck('tipo_sesion'))
				{ 
					alert('Debe indicar que tipo de sesion desea ser evaluado'); 
					return false;
				} 
				if(document.main.titulo_trabajo.value == '')
				{
					alert('Debe ingresar archivo del trabajo');
					document.main.titulo_trabajo.focus();
					return false;
				}
				if(document.main.area_trabajo.value == '')
				{
					alert('Debe ingresar area del trabajo');
					document.main.area_trabajo.focus();
					return false;
				}
				if(document.main.archivo_trabajo.value == '')
				{
					alert('Debe ingresar archivo del trabajo');
					document.main.archivo_trabajo.focus();
					return false;
				}
			}	 
		}
		document.main.page.value = document.main.opcion.value;
		document.main.submit();
	 }
 
	function consultarPorEmail()
	{
		document.main.guardar.value = 'consultaEmail';
		document.main.page.value = document.main.opcion.value;
		document.main.submit();
	}
  
  function olvidoClave()
  {
  	if(document.main.form_email.value == '')
	{	
		alert('Debe ingresar su email');
	}
	else
	{
		alert('La clave se le envio via email');
		document.main.guardar.value = 'olvidoEmail';
		document.main.page.value = document.main.opcion.value;
 		document.main.submit();
	}
  }
  
	function ocultarTablas()
	{
		for(var i=1;i<13;i++)
		{
			hidetr('fila_'+i);
		}
	}
	 
  	if(document.main.mostrar.value == '')
	{
		ocultarTablas();
	}
	
	<!-- START BLOCK : bloque_consulta_email --> 
	selectValue('pais','{pais}'); 
	<!-- END BLOCK : bloque_consulta_email -->
	
	
	<!-- START BLOCK : bloque_formulario_oculto --> 
	ocultarTablas(); 
	<!-- END BLOCK : bloque_formulario_oculto -->
	<!-- START BLOCK : bloque_formulario_mostrar --> 
	mostrarTablas(); 
	<!-- END BLOCK : bloque_formulario_mostrar -->
	
	
	
  <!-- START BLOCK : bloque_persona_registrada2 --> 
  ocultarTablas(); 
  hidetr('fila_email');
  hidetr('fila_boton'); 
  <!-- END BLOCK : bloque_persona_registrada2 -->
  <!-- START BLOCK : bloque_persona_registrada3 --> 
  ocultarTablas(); 
  hidetr('fila_email'); 
  hidetr('fila_titulo');
  <!-- END BLOCK : bloque_persona_registrada3 -->
 
</script>