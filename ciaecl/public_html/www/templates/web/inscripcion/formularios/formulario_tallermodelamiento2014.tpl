<table width="97%" border="0" cellpadding="3">  
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta_sin_comentario.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->   
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/ciudad.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/region.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl --> 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
     
     
	 <tr><td><strong>Situaci&oacute;n acad&eacute;mica</strong></td><td>
	 <input type="radio"  name="form_campo_extra1" value="estudiante_educacion_basica_sin_mencion" onClick="javascript:mostrarFormularioSituacionAcademica();" >Estudiante de educaci&oacute;n b&aacute;sica sin menci&oacute;n<br>
	 <input type="radio"  name="form_campo_extra1" value="estudiante_educacion_basica_con_mencion" onClick="javascript:mostrarFormularioSituacionAcademica();" >Estudiante de educaci&oacute;n b&aacute;sica con menci&oacute;n<br>	
	 <input type="radio"  name="form_campo_extra1" value="estudiante_educacion_media" onClick="javascript:mostrarFormularioSituacionAcademica();">Estudiante de educaci&oacute;n media<br>	 
	 </td></tr>
     
     
	 <tr><td><strong>Universidad de estudio</strong></td><td>
	 <input type="text" name="form_institucion"  style="width:100%" maxlength="255" />
	 </td></tr>
	 <tr><td><strong>A&ntilde;o de carrera en curso</strong></td><td>
	 <select name="form_campo_extra3">
	 <option value=""></option>
	 <option value="1">1&deg; a&ntilde;o</option>
	 <option value="2">2&deg; a&ntilde;o</option>
	 <option value="3">3&deg; a&ntilde;o</option>
	 <option value="4">4&deg; a&ntilde;o</option>
	 <option value="5">5&deg; a&ntilde;o</option>
	 <option value="6">6&deg; a&ntilde;o</option> 
	 </select> 
	 </td></tr>
	 <tr><td><strong>Motivaci&oacute;n para participar en el curso</strong></td><td>
	 <textarea name="form_campo_extra4" style="width:100%; height:80px "></textarea>
	 </td></tr>
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/separador.tpl --> 
     <tr><td colspan="2">El cuestionario deber&aacute;s contestado completamente, ya que forma parte de tu postulaci&oacute;n al taller. El cuestionario tiene fines de investigaci&oacute;n y no ser&aacute;n usados sus datos personales.</td></tr>
	 <tr><td></td></tr>
	 <tr id='cuestionario_estudiantes'><td colspan="2"><strong style="text-transform:uppercase ">Cuestionario sobre creencias acerca de la matem&aacute;tica y su ense&ntilde;anza</strong></td></tr>
	 <tr id='formulario_especifico_situacion_estudiante'><td colspan="2"> 
	  
	 
     <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_tallermodelamiento2014_cuestionario.tpl --> 
	  
	 </td></tr>
	  
	 
  <tr>
  <td colspan="2" style="text-align:center">
   <button type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
  </table>
  
  