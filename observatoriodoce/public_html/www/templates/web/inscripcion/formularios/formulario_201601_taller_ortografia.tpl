<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="201601_taller_ortografia_escritura_lenguaje">
 
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_lenguaje"> 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_ciae.tpl -->   
   
 
    <tr>
    <td colspan="2"><strong> 
&iquest;Cu&aacute;les de las siguientes actividades o estrategias le parecen m&aacute;s &uacute;tiles para ense&ntilde;ar ortograf&iacute;a a estudiantes de Educaci&oacute;n B&aacute;sica? Jerarquice de 1 a 3 las que le parezcan m&aacute;s importantes. (*) </strong></td></tr>

<tr><td colspan="2">

<input name="form_campo_extra3" type="radio" value="Dictado">	Dictado<br>
<input name="form_campo_extra3" type="radio" value="Correccion o an&aacute;lisis colectivo de errores de los estudiantes"> Correcci&oacute;n o an&aacute;lisis colectivo de errores de los estudiantes<br>
<input name="form_campo_extra3" type="radio" value="Ense&ntilde;anza de las reglas (incluye diversas estrategias en que se enfatice el conocimiento explicito de la regla)"> Ense&ntilde;anza de las reglas (incluye diversas estrategias en que se enfatice el conocimiento expl&iacute;cito de la regla)
<br>
<input name="form_campo_extra3" type="radio" value="Paredes de palabras"> Paredes de palabras
<br>
<input name="form_campo_extra3" type="radio" value="Cajas de palabras o cuadros de control"> Cajas de palabras o cuadros de control
<br>
<input name="form_campo_extra3" type="radio" value="Actividades de desarrollo de la conciencia fonologica"> Actividades de desarrollo de la conciencia fonol&oacute;gica
<br>
<input name="form_campo_extra3" type="radio" value="Uso de correctores ortograficos computacionales"> Uso de correctores ortogr&aacute;ficos computacionales
<br>
<input name="form_campo_extra3" type="radio" value="Uso del diccionario"> Uso del diccionario
<br>
<input name="form_campo_extra3" type="radio" value="Uso del computador (google, sitios web de diccionarios, etc,)"> Uso del computador (google, sitios web de diccionarios, etc,)
<br>
<input name="form_campo_extra3" type="radio" value="Trabajos y estrategias grupales "> Trabajos y estrategias grupales 
<br>
<input name="form_campo_extra3" type="radio" value="Estrategias basadas en palabras conocidas (derivaci&oacute;n, sufijos, prefijos, etc) o claves nemonicas"> Estrategias basadas en palabras conocidas (derivaci&oacute;n, sufijos, prefijos, etc) o claves nem&oacute;nicas
<br>
<input name="form_campo_extra3" type="radio" value="Correccion de los propios errores en textos escritos mediante pautas u otros instrumentos"> Correcci&oacute;n de los propios errores en textos escritos mediante pautas u otros instrumentos
<br>
<input name="form_campo_extra3" type="radio" value="Marcar (subrayar, encerrar en circulos) los errores en los textos de los estudiantes"> Marcar (subrayar, encerrar en c&iacute;rculos) los errores en los textos de los estudiantes
<br>
<input name="form_campo_extra3" type="radio" value="Felicitarlos por la buena ortografia o las palabras escritas correctamente"> Felicitarlos por la buena ortograf&iacute;a o las palabras escritas correctamente
<br>
<input name="form_campo_extra3" type="radio" value="Descontar decimas en pruebas y trabajo escritos por errores ortograficos"> Descontar d&eacute;cimas en pruebas y trabajo escritos por errores ortogr&aacute;ficos


</td></tr>




    <tr>
    <td colspan="2">Justifique su respuesta (*)<br> <textarea   style="width:100%; height:80px"   name="form_campo_extra1" > </textarea></td>
  </tr> 
  <tr>
    <td colspan="2"><strong>&iquest;Con qu&eacute; frecuencia trabaja usted la ortograf&iacute;a de manera expl&iacute;cita en el aula? (seleccione una) (*) </strong></td></tr>
    <tr>
    <td colspan="2"> 
    
<input name="form_campo_extra2" type="radio" value="No la trabajo de manera explicita o intencionada">No la trabajo de manera expl&iacute;cita o intencionada<br>
<input name="form_campo_extra2" type="radio" value="Pocas veces, no de manera sistematica">Pocas veces, no de manera sistem&aacute;tica
<br>
<input name="form_campo_extra2" type="radio" value="Al menos una vez por semestre">Al menos una vez por semestre
<br>
<input name="form_campo_extra2" type="radio" value="Al menos una vez por mes">Al menos una vez por mes
<br>
<input name="form_campo_extra2" type="radio" value="Al menos una vez cada quince dias">Al menos una vez cada quince d&iacute;as
<br>
<input name="form_campo_extra2" type="radio" value="Al menos una vez por semana">Al menos una vez por semana

    </td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
  
       
   
   
  <input type="hidden"  name="tipo_formulario_confirmacion" value='simple'> 
  <tr>
  <td colspan="2" style="text-align:center">
   <button  type="button" name="submit_enviar" value="submit_enviar" tabindex="28" onclick="javascript:enviarFormulario();" id="submit-submit_enviar">Enviar</button>
  </td></tr>
  
<tr>
<td colspan="2"><br /> 
    </td>
</tr>
<tr>
	<td colspan="2">
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/notas_pie.tpl -->
    </td>
</tr>

   
</table>
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/base_ciae.tpl -->  
	
	if(!validarContenidoPalabra(document.main.form_campo_extra1.value))
	{
		alert('Debe responder todas las preguntas ');
		document.main.form_campo_extra1.focus();
		return false;
	} 
	if(!emptyCheck('form_campo_extra2'))
	{
		alert('Debe responder todas las preguntas  ');
		document.main.form_campo_extra2.focus();
		return false;
	}
	if(!emptyCheck('form_campo_extra3'))
	{
		alert('Debe responder todas las preguntas  ');
		document.main.form_campo_extra3.focus();
		return false;
	}
 	 
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->