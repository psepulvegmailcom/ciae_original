 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formulario_base.tpl -->
 
  <tr>
    <td>Rut   (*) </td>
    <td><input type="text" name="form_rut" style="width:100%" maxlength="255" value="{rut}"  ></td>
	</tr>
  <tr>
    <td>Nivel de ense&ntilde;anza que atiende (indicar seg&uacute;n corresponda)   (*) </td>
    <td>
	<select name="form_cargo">
	
	<option value="">--</option>
	<option value="Educaci&oacute;n General B&aacute;sica">Educaci&oacute;n General B&aacute;sica</option>
<option value="Educaci&oacute;n Media" >Educaci&oacute;n Media</option> 
<option value="otro" >Otro. Especifique</option>

	</select>
	  <br />
	  Favor Especificar<br /> <input type="text" name="form_cargo_otro" value="{cargo_otro}" style="width:100%; " maxlength="200" > 
	   </td>
  </tr>
  <script type="text/javascript"> 
    for (var i=0;i<document.main.form_cargo.length;i++)
	{
       if (document.main.form_cargo[i].value == '{cargo}')
       {
		   	document.main.form_cargo[i].checked = true; 
	   }
    } 
  </script>
  
    <tr>
    <td>Comentario</td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
   <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br /><small>(**) En caso de eventos presenciales, no se dispone de estacionamientos</small></td>
</tr>
   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 { 
 	var seleccion_cargo = '';
    for (var i=0;i < document.main.form_cargo.length;i++)
	{
       if (document.main.form_cargo[i].selected   )
       {
	   		seleccion_cargo = document.main.form_cargo[i].value; 
	   }
    }   
	if(seleccion_cargo == '')
	{
		alert('Debe ingresar la nivel que atiende'); 
		return false;
	}
 	else
	{
		if(seleccion_cargo == 'otro' && document.main.form_cargo_otro.value == '')
		{
			alert('Debe ingresar el otro nivel'); 
			document.main.form_cargo_otro.focus();
			return false;
		}
	} 
 
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
		alert('Debe ingresar institucion');
		document.main.form_institucion.focus();
		return false;
	}     
 	if(document.main.form_telefono.value == '')
	{
		alert('Debe ingresar telefono');
		document.main.form_telefono.focus();
		return false;
	}    
 	if(document.main.form_direccion.value == '')
	{
		alert('Debe ingresar la direccion');
		document.main.form_direccion.focus();
		return false;
	}   
 	if(document.main.form_comuna.value == '')
	{
		alert('Debe seleccionar la comuna');
		document.main.form_comuna.focus();
		return false;
	}   
	document.main.page.value = document.main.opcion.value;
	document.main.submit();
 }
  
  
 
</script>