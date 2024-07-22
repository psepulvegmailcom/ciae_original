<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="202204_concurso_postdoc">  
  
 
 </td>
 </tr>
  <tr><td colspan="2">&nbsp;<br /></td></tr>
   
   
       <input type="hidden" name="form_pais" value="43">
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_consulta.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/rut_pasaporte_sin_texto_simple.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/nombre_completo.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/fecha_nacimiento.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/genero.tpl -->  

    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/celular.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/direccion.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/pais.tpl -->  
      
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/profesion.tpl -->
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/institucion.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/campos/email_alternativo.tpl --> 

       
        

      <tr>
    <td><strong id='campo_campo_extra4'>&Aacute;rea de postulaci&oacute;n (*)  </strong></td>
    <td style="text-align:left">  

 
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"    value="Profesores y la profesion docente">Profesores y la profesi&oacute;n docente <br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"    value="Ensenanza aprendizaje de la escritura">Ense&ntilde;anza aprendizaje de la escritura <br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"    value="Ensenanza Aprendizaje STEM integrado">Ense&ntilde;anza Aprendizaje STEM integrado <br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"    value="Desarrollo profesional docente">Desarrollo profesional docente <br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"    value="Educacion inicial">Educaci&oacute;n inicial <br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"    value="Aprendizaje y cognicion">Aprendizaje y cognici&oacute;n <br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4"   value="Politicas educacionales">Pol&iacute;ticas educacionales <br>

  </td>
  </tr> 

     
    
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
        <tr>
    <td ><strong>CV </strong></td> 
    <td  > <input type="file" name="archivo_extra1" id="archivo_extra1"> </td>
  </tr> 
  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Copia de t&iacute;tulos y/o grados</strong></td> 
    <td  >  <input type="file" name="archivo_extra2" id="archivo_extra2"> </td>
  </tr> 

  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Proyecto (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra5" id="archivo_extra5"> </td>
  </tr> 
    

  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Carta de recomendaci&oacute;n (1) (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra3" id="archivo_extra3"> </td>
  </tr> 
    

  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Carta de recomendaci&oacute;n (2) (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra4" id="archivo_extra4"> </td>
  </tr> 
    
  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Carta de motivacion (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra6" id="archivo_extra6"> </td>
  </tr> 
    
       
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

<input type="hidden"  name="tipo_formulario_confirmacion" value='con_pago'> 
<input type="hidden" value="view_inscripcion"  name="opcion" /> 
<input type="hidden" name="page" value="">
<input type="hidden" name="guardar" value="guardar">

<script type="text/javascript">
 
 function enviarFormulario()
 {  
	 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/rut.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/nombre_completo.tpl -->  
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/fecha_nacimiento.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email.tpl -->  
    
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/genero.tpl -->   
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/celular.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/direccion.tpl --> 

    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/institucion.tpl --> 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/profesion.tpl --> 
 
    <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/validacion/email_alternativo.tpl --> 
      
  if(!validacionCampoTextoSimple('form_campo_extra4'))
  {
    mostrarAlertCampoFaltante('form_campo_extra4');
    return false;
  }  



 
  if(!validacionCampoTextoSimple('archivo_extra1'))
  {
    return false; 
  }
  
  if(!validacionCampoTextoSimple('archivo_extra2'))
  {
    return false;   
  }
  
  if(!validacionCampoTextoSimple('archivo_extra3'))
  {
    return false;   
  }
  
  if(!validacionCampoTextoSimple('archivo_extra4'))
  {
    return false;   
  }
  
  if(!validacionCampoTextoSimple('archivo_extra5'))
  {
    return false;   
  }
  
  if(!validacionCampoTextoSimple('archivo_extra6'))
  {
    return false;   
  }
 
 

	enviarFormularioBase();
 }
</script>
 <!-- INCLUDE BLOCK : www/templates/web/inscripcion/formularios/formulario_base_script.tpl -->