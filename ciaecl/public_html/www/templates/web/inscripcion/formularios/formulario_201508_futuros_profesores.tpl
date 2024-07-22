<table width="95%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
<strong style="text-decoration:underline">  La inscripci&oacute;n se encontrar&aacute; disponible hasta el jueves 20 de agosto de 2015.<br>
 Esta confirmaci&oacute;n v&iacute;a email es requisito para poder participar en el taller presencialmente. <br>
 Previo a inscripci&oacute;n debe completar un encuesta <a href="https://es.surveymonkey.com/r/testerroresCIAE" target="_blank">AQUI</a>
   <br /> 
   
<input type="hidden" name="form_tipo_inscripcion"    value="201508_futuros_profesores">
 </td></tr>
  <tr><td  >&nbsp; </td><td >&nbsp; </td></tr>
    <tr><td colspan="2"><strong style="text-decoration:underline; font-size:15px">Datos personales</strong></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto_simple.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl -->  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
     
     
   <tr>
    <td><strong>Carrera que estudia (*)</strong></td>
    <td> 
     <select name="form_campo_extra2" >
     <option value=""></option>  
     <option value="basica_matematica">Pedagog&iacute;a en educaci&oacute;n b&aacute;sica con menci&oacute;n matem&aacute;tica</option>
     <option value="basica_sinmencion">Pedagog&iacute;a en educaci&oacute;n b&aacute;sica sin menci&oacute;n en matem&aacute;tica.</option>
     <option value="media_conmencion">Pedagog&iacute;a en educaci&oacute;n media con menci&oacute;n en matem&aacute;tica.</option>
     <option value="media_otra">Pedagog&iacute;a en educaci&oacute;n media.</option>
     
     <option value="otra_carrera_profesion">No aplica (indicar profesi&oacute;n o carrera en motivaci&oacute;n)</option>
     </select>  
    </td>
  </tr> 
   
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/agno_estudio.tpl -->  
    
  <tr>
    <td><strong>Motivaci&oacute;n para participar en este taller</strong></td>
    <td><textarea  style="width:100%; height:80px" name="form_campo_extra6">{form_campo_extra6}</textarea></td>
  </tr>

 <tr><td><strong>C&oacute;digo de encuesta</strong></td>
 
 <td><input type="text" value="" name="form_campo_extra3"><br>
 <small>Para conseguir el c&oacute;digo debes completar la encuesta <a href="https://es.surveymonkey.com/r/testerroresCIAE" target="_blank">AQUI</a></small></td></tr> 
    
   
  
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
<input type="hidden" name="tipo_formulario_confirmacion" value="confirmacion">
<input type="hidden" name="guardar" value="guardar">

<div id='testing'></div>

<script type="text/javascript">
 
 function enviarFormulario()
 { 
 	var x = document.main.elements;	 
 

	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut_simple.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/genero.tpl -->  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl -->  
 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/agno_estudio.tpl -->	
	
	if(!checkSelectedMultiple('form_campo_extra2'))
	{
		showAlert('Debe seleccionar la carrera que estudia');
		document.main.form_tipo_inscripcion.focus();
		return false;
	}
	 	
	if(trim(document.main.form_campo_extra3.value) == '' || md5(trim(document.main.form_campo_extra3.value)) != '7884a9652e94555c70f96b6be63be216')
	{
		alert('Ingresar el codigo correcto de la encuesta');
		document.main.form_campo_extra3.focus();
		return false;
	}    
	
	if(trim(document.main.form_campo_extra6.value) == '')
	{
		alert('Debe contestar pregunta sobre motivacion');
		document.main.form_campo_extra6.focus();
		return false;
	}   
 	  
			 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->