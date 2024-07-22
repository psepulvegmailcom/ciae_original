 

<!-- START BLOCK : bloque_envio_exito -->
<center id='mensaje_exito'><big><strong>Su registro se realiz&Oacute; exitosamente, pronto nos comunicaremos con ud</strong></big></center><br /><br /> 
<!-- END BLOCK : bloque_envio_exito -->
 
  
 
<!-- START BLOCK : bloque_envio_error -->
<center><big><strong style="color:#FF0000; font-size:110%"> {mensaje_error}</strong></big></center><br /><br /> 
<script type="text/javascript">
hiddenId('mensaje_exito');
</script>
<!-- END BLOCK : bloque_envio_error -->


<table width="95%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%">Email (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();">    </td>
  </tr>
  <tr>
    <td style=" width:30%">Clave (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_clave" style="width:30%" maxlength="10" value="{clave}"  >
		 <small>{clave_explicacion}<br /> <strong style="color:#FF0000; font-size:85%">{error_clave}</strong>
		 
		  
         <!-- START BLOCK : bloque_olvido_clave -->
		<a href="javascript:olvidoClave();">Olvide mi clave</a></small>
		<!-- END BLOCK : bloque_olvido_clave -->    </td>
  </tr>  
  <tr>
    <td>Nombre (*) </td>
    <td>
        <input type="text" name="form_nombre" style="width:100%" value="{nombre}" maxlength="255"></td>
  </tr>
  <tr>
    <td>Apellidos (*) </td>
    <td>
        <input type="text" name="form_apellidos" value="{apellidos}" style="width:100%" maxlength="255"></td>
  </tr>
   <tr>
  <td>Cargo/Rol (*)</td>
  <td>
        <input type="text" name="form_rol" value="{rol}" style="width:100%" maxlength="255"></td></tr>
  
  <tr>
    <td>Instituci&oacute;n (*) </td>
    <td>
        <input type="text" name="form_institucion"  value="{institucion}" style="width:100%" maxlength="255"></td>
  </tr>
    <tr>
    <td>Tel&eacute;fono </td>
    <td><input type="text" name="form_telefono"  value="{telefono}" style="width:100%" maxlength="50"></td>
  </tr>
  <tr>
    <td>Direcci&oacute;n</td>
    <td><textarea  name="form_direccion"  style="width:100%">{direccion}</textarea></td>
  </tr>
  <tr>
  <td>Ciudad (*)</td>
  <td>
        <input type="text" name="form_ciudad" style="width:100%" value="{ciudad}"  maxlength="255"></td></tr>
  <tr>
    <td>Pa&iacute;s (*)</td>
    <td>
        <select    name="form_pais" tabindex="7" style="width:100%"  >
 
 
 
<!-- START BLOCK : bloque_inscripcion_pais --> 
<option value="{valor}"   >	{texto}   </option>
<!-- END BLOCK : bloque_inscripcion_pais --> 
</select></td>
  </tr>
  
 
  
  
  <tr>
  <td>Disciplinas (*)</td>
  <td>
        
		
		
	 
<!-- START BLOCK : bloque_inscripcion_disciplina -->
<input type="checkbox" name="form_disciplina[]"  value="{valor}"  {checked}>	{texto}   <br />
<!-- END BLOCK : bloque_inscripcion_disciplina -->
 
<br />
Otra : <input type="text" name="form_otra_disciplina" value="{otra_disciplina}" style="width:100%" maxlength="255">		</td></tr>
		
		
  <tr>
  <td>&aacute;reas de Inter&eacute;s (*)</td>
  <td> 
<!-- START BLOCK : bloque_inscripcion_areas --> 
<input type="checkbox" name="form_areas[]"  value="{valor}"  {checked}>	{texto}  <br />
<!-- END BLOCK : bloque_inscripcion_areas --> </td></tr>
  
   
  
 
  <tr>
    <td>Comentario</td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
  
  
<input type="hidden" value="view_inscripcion"  name="opcion" />
  <!-- START BLOCK : bloque_envio_archivo -->
  <script type="text/javascript">
  document.main.opcion.value = 'view_envio';
  </script>
    <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
    <tr>
    <td><span class="destacado"> Envio Trabajo</span></strong></td>
    <td> </td>
  </tr>
      <tr>
    <td colspan="2"><strong>Recuerde: </strong>Se debe presentar un resumen de  m&aacute;ximo 8 p&aacute;ginas&nbsp; a un espacio y medio    (letra Times New Roman 12) donde se explicite la pregunta o el problema   a  abordar, una revisi&oacute;n de la literatura que sit&uacute;e al trabajo dentro   de ella, la  metodolog&iacute;a e informaci&oacute;n utilizada, y los principales   resultados y  conclusiones. Para mayor informaci&oacute;n, favor revisar la secci&oacute;n <a href="?page=view_faq">&quot;Preguntas Frecuentes&quot;</a>.   </td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td> </td>
  </tr>
  <tr>
    <td>T&iacute;tulo  </td>
    <td><input  type="text" name="titulo_trabajo"  style="width:100%" /></td>
  </tr>
  <tr>
  <td>&aacute;reas  (*) </td>
  <td>
        <select    name="area_trabajo" tabindex="7"  style="width:100%"  >

<option value="" >	-------------- </option>
<!-- START BLOCK : bloque_inscripcion_areas_envio --> 
<option value="{valor}"   >	{texto}   </option>
<!-- END BLOCK : bloque_inscripcion_areas_envio --> 
</select></td></tr>
  <tr>
    <td>Archivo</td>
    <td><input type="file" name="archivo_trabajo"  style="width:100%" /> <strong><small> (S&Oacute;lo doc, docx o pdf) </small></strong></td>
  </tr>
  <!-- END BLOCK : bloque_envio_archivo -->
  
  <tr>
    <td colspan="2" align="center"> <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarInscripcion();" id="submit-submit_enviar">
  Enviar</button> </td>
  </tr>
</table>

<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
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
		alert('Debe ingresar instituci&Oacute;n');
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
		alert('Debe ingresar pa&iacute;s');
		document.main.form_pais.focus();
		return false;
	}
 	if(document.main.form_rol.value == '')
	{
		alert('Debe ingresar Cargo/Rol');
		document.main.form_rol.focus();
		return false;
	} 
 	if(document.main.form_clave.value == '')
	{
		alert('Debe ingresar clave');
		document.main.form_clave.focus();
		return false;
	} 
 	if(document.main.opcion.value == 'view_envio')
	{
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
		alert('La clave se le envi&Oacute; v&iacute;a email');
		document.main.guardar.value = 'olvidoEmail';
		document.main.page.value = document.main.opcion.value;
 		document.main.submit();
	}
  }
 
 <!-- START BLOCK : bloque_consulta_email --> 
	selectValue('pais','{pais}'); 
 <!-- END BLOCK : bloque_consulta_email -->
 
</script>