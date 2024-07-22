<table width="90%" border="0" cellpadding="3">
 <tr>
<td colspan="2"><br />
  
 <input type="hidden" name="form_tipo_inscripcion" value="20231115_postdoctorado">  
  
 
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

  

<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Profesores y profesión docente">Profesores y profesión docente<br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Enseñanza y aprendizaje del lenguaje y literacidad">Enseñanza y aprendizaje del lenguaje y literacidad<br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Enseñanza de las ciencias basada en la indagación">Enseñanza de las ciencias basada en la indagación<br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Educación inicial">Educación inicial<br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Aprendizaje y cognición">Aprendizaje y cognición<br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Desarrollo professional docente">Desarrollo professional docente<br>
<input type="radio" name="form_campo_extra4" id="form_campo_extra4" value="Políticas educacionales">Políticas educacionales<br>


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
    <td ><strong>Proyecto (propuesta de investigación) (*)</strong> </td> 
    <td  >  <input type="file" name="archivo_extra5" id="archivo_extra5"> </td>
  </tr> 
    

 <!-- <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Carta de recomendaci&oacute;n (1) (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra3" id="archivo_extra3"> </td>
  </tr> 
    

  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Carta de recomendaci&oacute;n (2) (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra4" id="archivo_extra4"> </td>
  </tr> -->
    
  <tr><td colspan="2">&nbsp;<br /></td></tr>   <tr>
    <td ><strong>Carta de motivacion (*)</strong></td> 
    <td  >  <input type="file" name="archivo_extra6" id="archivo_extra6"> </td>
  </tr> 
    
       
  <tr><td colspan="2">&nbsp;<br /></td></tr> 
   
    <tr><td colspan="2">
   <b>Cartas de recomendaci&oacute;n: el/la recomendor/a deberá enviar la carta al correo  <a href="mailto:postulacion.postdoc@ciae.uchile.cl?subject=Carta+recomendacion+para+posici%c3%b3n+postdoctoral+2023" target="_blank">postulacion.postdoc@ciae.uchile.cl</a> indicando Nombre de postulante, nombre de recomendador/a y carta de recomendaci&oacute;n. Ambas cartas deben ser enviadas antes de la fecha de cierre de postulaci&oacute;n, de lo contrario ser&aacute; considera postulaci&oacute;n no v&aacute;lida.</b>
   </td></tr> 
   
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
  
 /* if(!validacionCampoTextoSimple('archivo_extra3'))
  {
    return false;   
  }
  
  if(!validacionCampoTextoSimple('archivo_extra4'))
  {
    return false;   
  } */
  
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