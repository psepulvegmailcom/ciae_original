 

<!-- START BLOCK : bloque_envio_exito -->
<center id='mensaje_exito'><big><strong>Su preinscripci&oacute;n se realiz&oacute; exitosamente. Nos contacter&eacute;mos v&iacute;a telef&oacute;nica para confirmar su asistencia<br /><br />  </strong></big></center><br /><br /> 

  

<!-- END BLOCK : bloque_envio_exito -->
 
  
 
<!-- START BLOCK : bloque_envio_error -->
<center><big><strong style="color:#FF0000; font-size:110%"> {mensaje_error}</strong></big></center><br /><br /> 
<script type="text/javascript">
hiddenId('mensaje_exito');
</script>
<!-- END BLOCK : bloque_envio_error -->

<div style=" ; font-weight:bold; padding-bottom:10px ">
Participaci&oacute;n gratuita. Cupos limitados.<br />
Para su participaci&oacute;n se requiere su preinscripci&oacute;n.<br /> Su participaci&oacute;n al seminario se confirmar&aacute; telef&oacute;nicamente.<br /><br /> 
El p&uacute;blico objetivo al cual est&aacute; dirigido el Seminario :<br />
<ul>
<li>Directivos de la Educaci&oacute;n</li><li>DAEM</li><li> Directores y rectores de establecimientos educacionales</li><li> Sostenedores de establecimientos educacionales de Educaci&oacute;n B&aacute;sica y Media.</li></ul>

</div>
<table width="90%" border="0" cellpadding="3">
  <tr>
    <td style=" width:30%">Email personal (*) </td>
    <td style="width:70%"> 
        <input type="text" name="form_email" style="width:100%" maxlength="255" value="{email}" onchange="javascript:consultarPorEmail();">    </td>
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
    <td>Instituci&oacute;n   (*) </td>
    <td>
        <input type="text" name="form_institucion"  value="{institucion}" style="width:100%" maxlength="255"></td>
  </tr>
  
   
  <tr>
    <td>Cargo   (*) </td>
    <td>
       <input  type="radio" style="width:15px; height:15px " name="form_cargo" value="Director"> Director<br />
       <input  type="radio" style="width:15px; height:15px " name="form_cargo" value="Sostenedor"> Sosteneder<br />	   
	  <input  type="radio" style="width:15px; height:15px " name="form_cargo" value='otro'> Otro. <br />
	  <div style="padding-left:25px ">Favor Especificar<br /> <input type="text" name="form_cargo_otro" value="{cargo_otro}" style="width:100%; " maxlength="200" ></div>
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
    <td>Direcci&oacute;n (*)</td>
    <td><textarea  name="form_direccion"  style="width:100%">{direccion}</textarea></td>
  </tr>
    <tr>
  <td>Comuna  (*)</td>
  <td>
  <select name="form_comuna" style="width:98%">
  <option value="">---</option>
  <!-- START BLOCK : bloque_comuna -->
  <option value="{comuna_id}">{comuna} - {region}</option>
  <!-- END BLOCK : bloque_comuna -->
  </select>
 
  </td> </tr>
  <tr>
    <td>Tel&eacute;fono (*) </td>
    <td><input type="text" name="form_telefono"  value="{telefono}" style="width:100%" maxlength="50"></td>
  </tr>
  <tr>
    <td>Tel&eacute;fono movil  (*) </td>
    <td><input type="text" name="form_telefono_movil"  value="{telefono_movil}" style="width:100%" maxlength="50"></td>
  </tr>
 
  <tr>
    <td>Comentario</td>
    <td><textarea  style="width:100%; height:80px" name="form_comentario">{comentario}</textarea></td>
  </tr>
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br /><small>(*) Inscripci&oacute;n gratuita<br>(**) En caso de eventos presenciales, no se dispone de estacionamientos</small></td>
</tr>
   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" />
  
  
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 { 
 	var seleccion_cargo = '';
    for (var i=0;i<document.main.form_cargo.length;i++)
	{
       if (document.main.form_cargo[i].checked)
       {
	   		seleccion_cargo = document.main.form_cargo[i].value;
	   }
    } 
	
	if(seleccion_cargo == '')
	{
		alert('Debe ingresar el cargo'); 
		return false;
	}
 	else
	{
		if(seleccion_cargo == 'otro' && document.main.form_cargo_otro.value == '')
		{
			alert('Debe ingresar el otro cargo'); 
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
 	if(document.main.form_telefono_movil.value == '')
	{
		alert('Debe ingresar celular');
		document.main.form_telefono_movil.focus();
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
 
 function consultarPorEmail()
 {
 	document.main.guardar.value = 'consultaEmail';
	document.main.page.value = document.main.opcion.value;
 	document.main.submit();
 } 
 
 
  <!-- START BLOCK : bloque_select_comuna -->
   selectValue('form_comuna','{comuna_id}');
  <!-- END BLOCK : bloque_select_comuna -->
 
 
</script>