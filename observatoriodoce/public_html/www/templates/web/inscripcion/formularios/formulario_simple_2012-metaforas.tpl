<table width="90%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%">Email personal (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}"  >    </td>
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
    <td>T&Iacute;tulo profesional  (*) </td>
    <td>
        <input type="text" name="form_cargo"  value="{cargo}" style="width:100%" maxlength="255"></td>
  </tr>  
  <tr>
    <td>Nombre Establecimiento Educacional   (*) </td>
    <td>
        <input type="text" name="form_institucion"  value="{institucion}" style="width:100%" maxlength="255"></td>
  </tr> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/pais_select.tpl -->
  <tr>
    <td>Ciudad  (*)  </td>
    <td> 
	
	 <input type="text" name="form_ciudad"  value="{ciudad}" style="width:100%" maxlength="255">
	</td>
  </tr>
   <tr>
    <td>Nivel o grado(s) en que ense&ntilde;a  (*)</td>
    <td><textarea  name="form_campo_extra1"  style="width:100%; " >{campo_extra1}</textarea></td>
  </tr>
   <tr>
    <td>Nombre de el o los equipos con que participar&aacute; en el seminario (*) </td>
    <td><textarea  name="form_campo_extra2"  style="width:100%; " >{campo_extra2}</textarea></td>
  </tr>
  
  
   <tr>
    <td>Fecha del seminario al que se inscribe (elija s&oacute;lo una opci&oacute;n) (*)</td>
    <td>
	<input type="radio" name="form_tipo_inscripcion" disabled value="2012_metaforas-20121128"> Mi&eacute;rcoles 28 de Noviembre  de 14:00 a 19:00<br>
	<input type="radio" name="form_tipo_inscripcion"  disabled value="2012_metaforas-20121219"> Mi&eacute;rcoles 19 de Diciembre, de 09:00 a 14:00<br>
	<input type="radio" name="form_tipo_inscripcion" value="2012_metaforas-20130109"> Mi&eacute;rcoles 9 de Enero, de 09:00 a 14:00 
	
	
	
	</td>
  </tr>
 
  <tr>
    <td>Comentario</td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br /><small>(*) Campos obligatorios</small><br /> </td>
</tr>
   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
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
 	if(document.main.form_cargo.value == '')
	{
		alert('Debe ingresar Titulo profesional');
		document.main.form_cargo.focus();
		return false;
	}    
 	if(document.main.form_institucion.value == '')
	{
		alert('Debe ingresar Nombre Establecimiento Educacional');
		document.main.form_institucion.focus();
		return false;
	}     
 	if(document.main.form_pais.value == '')
	{
		alert('Debe seleccionar pais');
		document.main.form_pais.focus();
		return false;
	}  
 	if(document.main.form_ciudad.value == '')
	{
		alert('Debe ingresar ciudad');
		document.main.form_ciudad.focus();
		return false;
	}   
	
 	if(document.main.form_campo_extra1.value == '')
	{
		alert('Debe ingresar Nivel o grado');
		document.main.form_campo_extra1.focus();
		return false;
	}  
 	if(document.main.form_campo_extra2.value == '')
	{
		alert('Debe ingresar Nombre de el o los equipos');
		document.main.form_campo_extra2.focus();
		return false;
	}   
	var fecha = false;
	for(i=0; ele = document.main.form_tipo_inscripcion[i];i++)
	{
		if(ele.checked) 
		{
			fecha = true;
		}
	}
	if(fecha)
	{
	 // nada
	}
	else
	{ 
		alert('Debe fecha de participacion');
		return false;	
	}
    
	
	 
	
	
	
	
	
	
	
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
 }
</script>