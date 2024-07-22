<table width="95%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
 
   
<input type="hidden" name="form_tipo_inscripcion"    value="201508_estudio_ciencia_escolar">
 </td></tr>
  <tr><td  >&nbsp; </td><td >&nbsp; </td></tr> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
      
       <tr>
    <td><strong>&Aacute;rea que ense&ntilde;a (*)</strong></td>
    <td> 
     <select name="form_campo_extra2" id="form_campo_extra2" >
     <option value=""></option>  
     <option value="quimica">Qu&iacute;mica</option>
     <option value="biologia">Biolog&iacute;a</option>
     <option value="fisica">F&iacute;sica</option>
     <option value="otro">Otro asignatura</option>
     
      </select>  
    </td>
  </tr>  
       <tr>
    <td><strong>Nivel educativo (*)</strong></td>
    <td> 
     <select name="form_campo_extra1"  id="form_campo_extra1" >
     <option value=""></option>  
     <option value="basica_primer_ciclo">B&aacute;sica primer ciclo</option>
     <option value="basica_segundo_ciclo">B&aacute;sica segundo ciclo</option>
     <option value="media_1_2">Media 1&deg; y 2&deg;</option>
     <option value="media_3_4">Media 3&deg; y 4&deg;</option> 
      </select>  
    </td>
  </tr> 
       <tr>
    <td><strong>  Establecimiento donde ejercer&aacute; durante 2016 (*)</strong></td>
    <td> 
      <input  type="text"   name="form_institucion"  id="form_institucion" style="width:100% " value="{institucion}" maxlength="255">
    </td>
  </tr> 
    <tr>
    <td colspan="2"><strong>En su experiencia docente, &iquest;cu&aacute;l es el tema o materia que ha sido para usted m&aacute;s dif&iacute;cil de ense&ntilde;ar en ciencias? Explique. (*)</strong></td></tr>
    <td colspan="2"><textarea  style="width:100%; height:80px" name="form_campo_extra3">{form_campo_extra3}</textarea></td>
  </tr> 
  <tr>
    <td colspan="2"><strong>Explique c&oacute;mo eval&uacute;a usted los aprendizajes de sus estudiantes respecto a los conceptos cient&iacute;ficos. (*)</strong></td></tr>
    <td colspan="2"><textarea  style="width:100%; height:80px" name="form_campo_extra4">{form_campo_extra4}</textarea></td>
  </tr> 
  <tr>
    <td colspan="2"><strong>En su experiencia, &iquest;cu&aacute;l es la diferencia entre aprender ciencias y ense&ntilde;ar ciencias en la escuela? (*)</strong></td></tr>
    <td colspan="2"><textarea  style="width:100%; height:80px" name="form_campo_extra5">{form_campo_extra5}</textarea></td>
  </tr> 
  <tr>
    <td colspan="2"><strong>Motivaci&oacute;n para participar en este estudio (*)</strong></td></tr>
    <td colspan="2"><textarea  style="width:100%; height:80px" name="form_campo_extra6">{form_campo_extra6}</textarea></td>
  </tr> 
  
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
 

   
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->   
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl -->    
	if(!checkSelectedMultiple('form_campo_extra2'))
	{
		showAlert('Debe seleccionar el area que ensena');
		document.main.form_campo_extra2.focus();
		return false;
	}
	if(!checkSelectedMultiple('form_campo_extra1'))
	{
		showAlert('Debe seleccionar el nivel');
		document.main.form_campo_extra1.focus();
		return false;
	}	 
	if(trim(document.main.form_institucion.value) == '')
	{
		alert('Debe indicar establecimiento');
		document.main.form_institucion.focus();
		return false;
	} 
	if(trim(document.main.form_campo_extra3.value) == '')
	{
		alert('Debe contestar todas las preguntas  ');
		document.main.form_campo_extra3.focus();
		return false;
	}  
	if(trim(document.main.form_campo_extra4.value) == '')
	{
		alert('Debe contestar todas las preguntas  ');
		document.main.form_campo_extra4.focus();
		return false;
	}  
	
	if(trim(document.main.form_campo_extra5.value) == '')
	{
		alert('Debe contestar todas las preguntas  ');
		document.main.form_campo_extra5.focus();
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