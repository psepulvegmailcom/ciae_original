<table width="90%" border="0" cellpadding="3">
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/direccion.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
   
  

      


 
  
  
   <tr>
    <td><strong>Forma de financiamiento (*)</strong></td>
    <td>
	<input type="radio" name="form_campo_extra1"  onClick="javascript:no_financia_colegio();"  value="pago_persona_natural" > Financiamiento personal<br>
	<input type="radio" name="form_campo_extra1"   onClick="javascript:financia_colegio();"    value="pago_institucion_educacional"> Financiamiento por instituci&oacute;n educacional<br>
	
	<input type="radio" name="form_campo_extra1"   onClick="javascript:no_financia_colegio();"  value="pago_otra_institucion"> Otra fuente de financiamiento<br>
	<br><br>
	</td>
  </tr>
  <tr  id='financia_colegio'>
  <td  ><strong>Financiamiento de Instituci&oacute;n Educacional</strong></td>
  <td  >
  <table style="width:100% ">
  <tr ><td style="width: 100px ">
  <strong>RBD</strong>
 
 </td><td> <input type="text" name="form_rbd" style="width:70px" maxlength="8" value="{rbd}"  >&nbsp;-&nbsp;<input type="text" name="form_rbd_dv" style="width:15px" maxlength="1" value="{rbd_dv}"  >   </td></tr>
 
  <tr><td>
  <strong>Nombre de Instituci&oacute;n</strong>
 
 </td><td> <input type="text" name="form_campo_extra3" style="width:100%" maxlength="255" value="{campo_extra3}"  >
 
 <input type="hidden"  name="form_institucion" value="{institucion}">
    </td></tr>
  <tr><td>
  <strong>Direcci&oacute;n de Instituci&oacute;n</strong>
 
 </td><td> <input type="text" name="form_campo_extra4" style="width:100%" maxlength="255" value="{campo_extra4}"  >   </td></tr>
  <tr><td>
  <strong>Nombre Encargado de Instituci&oacute;n</strong>
 
 </td><td> <input type="text" name="form_campo_extra5" style="width:100%" maxlength="255" value="{campo_extra5}"  >   </td></tr>
  <tr><td>
  <strong>Tel&eacute;fono de Instituci&oacute;n</strong>
 
 </td><td> <input type="text" name="form_campo_extra6" style="width:100%" maxlength="255" value="{campo_extra6}"  >   </td></tr>
 <tr><td colspan="2"> </td></tr>
 <tr><td colspan="2"><strong>Orden de compra tipo</strong> <a href="download.php?file=ordenCompraDiplomado.xls">Descargar aqu&Iacute;</a> </td></tr>
 </table>
 <br>
 
 
  </td>
  </tr>

   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/comentario.tpl -->
  <tr><td colspan="2"><strong>Por favor, revise bien el ingreso de sus datos, Tal cual usted los ingresa ser&aacute;n utilizados en su certificaci&oacute;n.</strong></td></tr>
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

 
 function financia_colegio()
 {
	 showtr('financia_colegio'); 
 }
 
  
 function no_financia_colegio()
 { 
		document.main.form_rbd.value = '';
		document.main.form_rbd_dv.value = '';
		document.main.form_campo_extra3.value = '';
		document.main.form_campo_extra4.value = '';
		document.main.form_campo_extra5.value = '';
		document.main.form_campo_extra6.value = '';
		document.main.form_institucion.value = '';
		hidetr('financia_colegio');
 }
 
 no_financia_colegio();
 
 function enviarFormulario()
 { 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/direccion.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->	 
 	 
 	var aux = false;
	var seleccion = '';
	for(i=0; ele = document.main.form_campo_extra1[i];i++)
	{
		if(ele.checked) 
		{
			seleccion = ele.value;
			aux = true;
		}
	}
	if(aux)
	{ 
		if(seleccion == 'pago_institucion_educacional')
		{
			if(document.main.form_rbd.value == '' || document.main.form_rbd_dv.value == '')
			{
				alert('Debe ingresar rbd completo');
				document.main.form_rbd.focus();
				return false;
			}
			else
			{  
				if(!revisaRut(document.main.form_rbd.value,document.main.form_rbd_dv.value))
				{
					alert('Debe ingresar rbd valido'); 	
					document.main.form_rbd.focus();
					return false;
				}
			}
			if(document.main.form_campo_extra3.value == '')
			{
				alert('Debe ingresar el nombre de la institucion');
				document.main.form_campo_extra3.focus();
				return false;
			}
			else
			{
				document.main.form_institucion.value = document.main.form_campo_extra3.value;
			}
			if(document.main.form_campo_extra4.value == '')
			{
				alert('Debe ingresar la direccion de la institucion');
				document.main.form_campo_extra4.focus();
				return false;
			}
			if(document.main.form_campo_extra5.value == '')
			{
				alert('Debe ingresar el nombre del encargado de la institucion');
				document.main.form_campo_extra5.focus();
				return false;
			}
			if(document.main.form_campo_extra6.value == '')
			{
				alert('Debe ingresar el telefono de la institucion');
				document.main.form_campo_extra6.focus();
				return false;
			} 
		}
	}
	else
	{ 
		alert('Debe seleccionar forma de financiamiento');
		return false;	
	}   
	enviarFormularioBase();
 }
</script>


 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->