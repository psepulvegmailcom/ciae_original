<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="201909_beca_postdoctoral">
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_lenguaje">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_mejoramiento_escuelas">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_politicas_publicas">   
 <input type="hidden" name="bd_lista_extra[]" value="ciae_interesados_area_gestion_curricular">   
  
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
       <input type="hidden" name="form_pais" value="43">
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta_sin_comentario.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_pasaporte_sin_texto_simple.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_nacimiento.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/pais.tpl -->    
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/direccion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/telefono.tpl -->

  <tr>
    <td><strong id='campo_campo_extra1'>Investigador/a con quien desea postular   </strong></td>
    <td> 
	<input type="text" name="form_campo_extra1"  id="form_campo_extra1" style="width:100% " value="{campo_extra1}" maxlength="255"> 
	</td>
  </tr>     
    <tr>
    <td><strong id='campo_campo_extra1'>&Aacute;rea a la que desea postular   </strong></td>
    <td> 
	<input type="text" name="form_campo_extra2"  id="form_campo_extra2" style="width:100% " value="{campo_extra2}" maxlength="255"> 
	</td>
  </tr>    
  <tr><td colspan="2">&nbsp;</td></tr> 
        <tr>
			<td ><strong>Curr&iacute;culum Vitae</strong></td> 
    <td  > <input type="file" name="archivo_extra1" id="archivo_extra1"> </td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Fotocopia simple del Diploma o Certificado de t&iacute;tulo Doctorado</strong></td> 
    <td  >  <input type="file" name="archivo_extra2" id="archivo_extra2"> </td>
  </tr> 

  <tr><td colspan="2">&nbsp;<br /></td></tr>  <tr>
	<td ><strong>Propuesta plan de trabajo formato libre</strong></td> 
    <td  >  <input type="file" name="archivo_extra4" id="archivo_extra4"> </td>
  </tr> 

    <tr><td colspan="2">&nbsp;<br /></td></tr>     

    <!--tr>
    <td><strong>Carta de intenci&oacute;n</strong> <br>Indicando cargo, motivaciones, prop&oacute;sito, expectativas del programa, expectativas futuras, etc </td>
    <td><textarea  style="width:100%; height:150px" name="form_comentario"> </textarea></td>
  </tr-->
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
   
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

<input type="hidden"  name="tipo_formulario_confirmacion" value='postulacion'> 
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/tipo_inscripcion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/telefono.tpl --> 
	<!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/direccion.tpl --> 	

	     
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/fecha_nacimiento.tpl --> 






      
	 if(trim(document.main.form_rut.value) == '')
	{
		alert('Debe ingresar rut o pasaporte');
		document.main.form_rut.focus();
		return false;
	} 
	 if(trim(document.main.form_campo_extra1.value) == '')
	{
		alert('Debe ingresar Investigador con quien postula');
		document.main.form_campo_extra1.focus();
		return false;
	} 
	 if(trim(document.main.form_campo_extra2.value) == '')
	{
		alert('Debe ingresar area a la que postula');
		document.main.form_campo_extra2.focus();
		return false;
	} 	 
 	    	
 	/*if(trim(document.main.form_comentario.value) == '')
	{
		alert('Debe ingresar carta de motivacion');
		document.main.form_comentario.focus();
		return false;
	}  */
  	 if(!validacionCampoTextoSimple('archivo_extra1'))
	 	return false;	
  	 if(!validacionCampoTextoSimple('archivo_extra2'))
	 	return false;
	 if(!validacionCampoTextoSimple('archivo_extra4'))
	 	return false;	
	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->