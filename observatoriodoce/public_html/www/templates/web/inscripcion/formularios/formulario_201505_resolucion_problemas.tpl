<table width="95%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
<strong style="text-decoration:underline">  La inscripci&oacute;n se encontrar&aacute; disponible hasta el s&aacute;bado 30 de mayo de 2015.<br>
 Esta confirmaci&oacute;n v&Iacute;a email es requisito para poder participar en el taller presencialmente.   <br /> 
 </td></tr>
  <tr><td  >&nbsp; </td><td >&nbsp; </td></tr>
    <tr><td colspan="2"><strong style="text-decoration:underline; font-size:15px">Datos personales</strong></td></tr>
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_sin_texto_simple.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl --> 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/edad.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_simple.tpl -->
 
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl -->
    <tr><td colspan="2"><strong style="text-decoration:underline; font-size:15px">Datos acad&eacute;micos</strong></td></tr>
    
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/universidad_estudio.tpl -->
   
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/region_que_estudia.tpl -->
   <tr>
    <td><strong>Carrera que estudia (*)</strong></td>
    <td> 
     <select name="form_tipo_inscripcion" >
     <option value=""></option> 
     <option value="201506_0506_resolucion_problemas_matematica_media">Pedagog&iacute;a en matem&aacute;tica de ense&ntilde;anza media</option> 
     <option value="201506_0506_resolucion_problemas_matematica_basica">Pedagog&Iacute;a en educaci&oacute;n b&aacute;sica con menci&oacute;n matem&aacute;tica</option>
     <option value="201506_0506_resolucion_problemas_basica_sinmencion">Pedagog&Iacute;a b&aacute;sica sin menci&oacute;n en matem&aacute;tica.</option>
     </select>  
    </td>
  </tr> 
  
   <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/agno_estudio.tpl -->  
   


    <tr><td colspan="2"><strong style="text-decoration:underline; font-size:15px">Experiencia</strong></td></tr>
    
          <tr>
    <td colspan="2"><strong>Ha participado en talleres de resoluci&oacute;n de problemas? (si o no?) (*)</strong></td>
    
     
  </tr> 
  <tr>
  <td></td>
    <td  >  
    <select name="form_campo_extra3" > 
    <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
    <option value="si">Si</option>
    <option value="no">No</option>
    
    </select>
    </td>
  </tr> 
    
    <tr>
      <td colspan="2"> <strong>¿Cu&aacute;nta experiencia docente tiene ud en matem&aacute;tica de ense&ntilde;anza b&aacute;sica o media? (*)</strong> </td>
  </tr> 
  <tr>
  <td></td>
    <td  > 
    <select name="form_campo_extra4">
    <option value=""></option>
    <option value="ninguna">Ninguna</option>
    <option value="menos_1_a&ntilde;o">Menos de 1 a&ntilde;o</option>
    <option value="entre_1_3_a&ntilde;os">Entre 1 y 3 a&ntilde;os</option>
    <option value="mas_3_a&ntilde;os">M&aacute;s de 3 a&ntilde;os</option>
    </select>
    </td>
  </tr> 
  
  <tr>
      <td colspan="2"><strong>Se&ntilde;ale cu&aacute;l fue su experiencia (ej: profesor de reemplazo, pr&aacute;ctica universitaria, etc) (*)</strong></td>
  </tr> 
  <tr>
  <td></td>
    <td  > 
    <textarea name="form_campo_extra5" style="width:99%; height:100px">{campo_extra5}</textarea> 
    </td>
  </tr> 
  <tr>
      <td colspan="2"><strong>Se&ntilde;ale si tiene ud experiencia profesional en un &aacute;rea docente diferente a la docencia den matem&aacute;tica (*)</strong></td>
  </tr> 
  <tr>
  <td></td>
    <td  > 
    <textarea name="form_campo_extra6" style="width:99%; height:100px">{campo_extra6}</textarea> 
    </td>
  </tr> 
     <tr>
      <td colspan="2"><strong>¿Qu&eacute; le motiva a ud a participar en este taller? (*)</strong></td>
  </tr> 
  <tr>
  <td></td>
    <td  > 
    <textarea name="form_campo_extra2" style="width:99%; height:100px">{campo_extra2}</textarea> 
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
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/edad.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono_movil.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/universidad_estudio.tpl -->
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/region.tpl -->	
 
	
	if(!checkSelectedMultiple('form_tipo_inscripcion'))
	{
		showAlert('Debe seleccionar la carrera que estudia');
		document.main.form_tipo_inscripcion.focus();
		return false;
	}
	
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/agno_estudio.tpl -->	
	if(trim(document.main.form_campo_extra3.value) == '')
	{
		alert('Debe constestar si ha participado en talleres');
		document.main.form_campo_extra3.focus();
		return false;
	}    
 	 
	if(trim(document.main.form_campo_extra4.value) == '')
	{
		alert('Debe contestar pregunta sobre si tiene experiencia en matematica');
		document.main.form_campo_extra4.focus();
		return false;
	}  
	if(trim(document.main.form_campo_extra5.value) == '')
	{
		alert('Debe contestar pregunta sobre cual es su experiencia en matematica');
		document.main.form_campo_extra5.focus();
		return false;
	}   
	if(trim(document.main.form_campo_extra6.value) == '')
	{
		alert('Debe contestar pregunta sobre experiencia en otras docencias');
		document.main.form_campo_extra6.focus();
		return false;
	}   
	if(trim(document.main.form_campo_extra2.value) == '')
	{
		alert('Debe contestar pregunta sobre motivacion');
		document.main.form_campo_extra2.focus();
		return false;
	}   
			 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->