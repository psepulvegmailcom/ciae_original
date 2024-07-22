<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
<strong style="text-decoration:underline"> La inscripci&oacute;n permanecer&aacute; abierta hasta el lunes 27 de octubre de 2014.  Los estudiantes seleccionados ser&aacute;n confirmados v&iacute;a correo electr&oacute;nico durante el fin de semana del primero de noviembre.<br /><br />
<big>Esta confirmaci&oacute;n v&iacute;a email es requisito para poder participar en el seminario presencialmente.</big>  <br /> 
 </td></tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
   <tr>
    <td><strong>Carrera que estudia (*)</strong></td>
    <td> 
    <input type="text" name="form_campo_extra2"  value="{campo_extra2}" style="width:100%" maxlength="255">
    </td>
  </tr> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/universidad_estudio.tpl -->
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/agno_estudio.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl -->
      <tr>
    <td><strong>Ha realizado alguna pr&aacute;ctica profesional? (donde? a quienes?) (*)</strong></td>
    <td> 
    <textarea name="form_campo_extra3" style="width:99%; height:100px">{campo_extra3}</textarea> 
    </td>
  </tr> 
    <tr>
    <td><strong>Tiene alg&uacute;n otro estudio (*)</strong></td>
    <td> 
    <textarea name="form_campo_extra4" style="width:99%; height:100px">{campo_extra4}</textarea> 
    </td>
  </tr> 
  
    <tr>
    <td><strong>Motivaci&oacute;n para participar en el seminario (*)</strong></td>
    <td> 
    <textarea name="form_campo_extra5" style="width:99%; height:100px">{campo_extra5}</textarea> 
    </td>
  </tr> 
  
  
   <tr>
    <td><strong>Secci&oacute;n a participar&nbsp;(*)</strong></td>
    <td>
	  <input type="radio" name="form_tipo_inscripcion"    value="20141107-08_resolucion_problemas_matematica_media"   >    Estudiantes de Pedagog&iacute;a en matem&aacute;tica de ense&ntilde;anza media</strong>  <br>  
	<input type="radio" name="form_tipo_inscripcion"       value="20141107-08_resolucion_problemas_matematica_basica"> Estudiantes de Pedagog&iacute;a en educaci&oacute;n b&aacute;sica con menci&oacute;n matem&aacute;tica<br>  
	<input type="radio" name="form_tipo_inscripcion"     value="20141107-08_resolucion_problemas_basica_sinmencion">  Estudiantes de Pedagog&iacute;a en educaci&oacute;n b&aacute;sica sin menci&oacute;n.
	 
	
	 
	</td>
  </tr>
  
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
         <tr><td colspan="2">El cuestionario deber&aacute;s contestado completamente, ya que forma parte de tu postulaci&oacute;n al taller. El cuestionario tiene fines de investigaci&oacute;n y no ser&aacute;n usados sus datos personales.</td></tr>
	
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
	 
   <tr>
  <td colspan="2">
  <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_201411_resolucion_problemas_cuestionario.tpl -->
  </td>
  </tr>
   
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
<tr>
<td colspan="2"><br />
<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
<br />  
   </td>
</tr>

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="tipo_formulario_cuestionario" value="cuestionario_multiple">
<input type="hidden" name="tipo_formulario_confirmacion" value="confirmacion">
<input type="hidden" name="guardar" value="guardar">

<div id='testing'></div>

<script type="text/javascript">
 
 function enviarFormulario()
 { 
 	var x = document.main.elements;	
	
	/*var cuestionario_numero = array['1','2','3','4','5','6'];
	var cuestionario_letra  = array['A','B','C','D','F','G','H','I','J','K','L','N','O','P','Q','R','S'];
	
	for (var i=0 ; i < x.length ; i++)
	{			 
		for(var j=0; j < cuestionario_numero.length; j++)
		{
			for(var k=0; k < cuestionario_letra.length; k++)
			{
				var aux_campo = 'campo_extra2['+ cuestionario_numero[j] + cuestionario_letra[k] + ']';
				if(x[i].name == aux_campo && x[i].checked)
				{
					 	//document.getElementById('testing').innerHTML = document.getElementById('testing').innerHTML + ' checked ' + x[i].name + '<br>'; 
				} 
			}
		}
		
		document.getElementById('testing').innerHTML = document.getElementById('testing').innerHTML + '<br> ' + x[i].name; 
	} */
 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut_simple.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/universidad_estudio.tpl -->	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/agno_estudio.tpl -->	 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/ciudad.tpl -->	
	if(document.main.form_campo_extra3.value == '')
	{
		alert('Debe contestar la pregunta relacionada a las pasantia');
		document.main.form_campo_extra3.focus();
		return false;
	}    
 	 
	if(document.main.form_campo_extra4.value == '')
	{
		alert('Debe contestar la pregunta relacionada a otros estudios');
		document.main.form_campo_extra4.focus();
		return false;
	}  
	if(document.main.form_campo_extra5.value == '')
	{
		alert('Debe contestar la pregunta relacionada al interes por el seminario');
		document.main.form_campo_extra5.focus();
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
	if(!fecha)
	{ 
		alert('Debe seleccionar la seccion que desea participar');
		return false;	
	}  

	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->